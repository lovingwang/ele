<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mrgoon\AliSms\AliSms;

class MemberController extends Controller
{

    public function sms(Request $request)
    {
        //     先得到验证码
//        \跟上面写request一样
        $tel = $request->input('tel');
        $code = rand(1000, 9999);
//  并把验证码先存于redis
//        Redis::setex("tel_" . $tel, 300, $code);//存进来
//        存缓存中
        Cache::put("tel_".$tel, $code, 300);

//    测试
        return [
            "status" => "true",
            "message" => "获取短信验证码成功" . $code
        ];
//  $config = [
//      'access_key' => 'LTAIRa6RADNzNbVI',
//      'access_secret' => 'XoF7WTW48TO8kWgAHl4tCiGjEYy1iD',
//      'sign_name' => '王波',
//  ];
//
//    $aliSms = new AliSms();
//    $response = $aliSms->sendSms($tel, 'SMS_140625143', ['code'=> $code], $config);
////  dd($response);
//    if($response->Message=='OK'){
//        return [
//            "status"=>"true",
//            "message"=> "获取短信验证码成功".$code
//        ];
//    }else{
//        return [
//            "status"=>"flase",
//            "message"=>"获取短信验证码失败"
//        ];
//    }

    }

//注册功能
    public function reg(Request $request)
    {
//    得到所有数据
        $data = $request->all();

//     手创建一个验证规则动 看是否符合规范
//        这里不能用$this->
        $validator = Validator::make($data, [
            'username' => 'required|unique:members|min:2|max:6',
            'sms' => 'required|integer|min:1000|max:9999',
            'password' => 'required',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/',
                'unique:members'
            ],
        ]);

        if ($validator->fails()) {
            //返回错误
            return [
                'status' => "false",
                //获取错误信息
                "message" => $validator->errors()->first()];
        }

//     验证code是不是与刚才redis中的code相等
        $tel = $data['tel'];


//        $redis = Redis::get("tel_" . $tel);
//        得到缓存中的值

       $redis= Cache::get("tel_".$tel);
//       var_dump($redis);
//       var_dump($data['sms']);
//       exit;

        if ($redis = $data['sms']) {
            $data['password'] = bcrypt($data['password']);
            $data['status']=1;
            Member::create($data);
            return [
                'status' => 'ture',
                'message' => '注册成功'
            ];

        } else {
            return [
                'status' => 'false',
                'message' => '验证码有错'
            ];

        }
    }

//    登录功能
    public function login(Request $request)
    {
        $username = $request->post('name');
//dd($username);
        $member = Member::where("username", $username)->first();


        if ($member && Hash::check($request->post('password'), $member->password)) {
//dd($member);
            if($member->status==1){
              return [
                    'status' => "true",
                    'message' => "登录成功",
                    'user_id' => "$member->id",
                    'username' => "$member->username"
                ];


            }else{

                return
                    [
                    'status'=>"false",
                    'message'=>"对不起，你的账号被禁用"
                ];
            }
//            dd($member->username);

    }else{
            return ['status' => "false",
                'message' => '账号或密码错误'];
        }
        }
//    重置密码
    public function reset(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'sms' => 'required|integer|min:1000|max:9999',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/',
            ],
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            //返回错误
            return [
                'status' => "false",
                //获取错误信息
                "message" => $validator->errors()->first()];
        }
//        得到电话
        $tel = $data['tel'];
        $redis = Redis::get("tel_" . $tel);


        $member = Member::where('tel', $tel)->first();

        if ($redis === $data['sms']) {
//            dd('111');

            $member->update(['password' => bcrypt($data['password'])]);


            return [
                'status' => "true",
                'message' => '密码重置成功'
            ];
        } else {
            return [
                'status' => "false",
                'message' => '密码重置失败'
            ];
        }

    }

//        修改密码
    public function change(Request $request)
    {

        $data = $request->post();

        $member = Member::where('id', '=', $data['id'])->first();
//dd($member->password);
//得到旧密码去与数据库中这一条数据中的password对比
        if (Hash::check($request->post('oldPassword'), $member->password)) {
//        给数据库密码赋值新密码
         $member->password=bcrypt($data['newPassword']);
//         保存
         $member->save();

            return [
                'status' => "true",
                'message' => '密码修改成功'
            ];

        }else {
                return [
                    'status' => "false",
                    'message' => '密码修改失败'
                ];
        }

    }

    public function detail(){
//得到传过来的值
       $data=\request()->input('user_id');
     return  Member::where('id',$data)->first();

    }

}