<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function add(Request $request)
    {
        $data = $request->post();
        //     手创建一个验证规则动 看是否符合规范
//        这里不能用$this->

        $validator = Validator::make($data, [
            'name' => 'required|min:2|max:6',
            'provence' => 'required',
            'city' => 'required',
            'area' => 'required',
            'detail_address' => 'required',
            'tel' => [
                'required',
                'regex:/^0?(13|14|15|17|18|19)[0-9]{9}$/',
                'unique:addresses'
            ],
        ]);
        if ($validator->fails()) {
            //返回错误
            return [
                'status' => "false",
                //获取错误信息
                "message" => $validator->errors()->first()];
        }
//dd($data);

        if ($data) {
//           找到之前数据库中存在1的字段 然后全部改0
            Address::where('user_id', $data['user_id'])
                ->where('is_default', 1)->update(['is_default' => 0]);
//再次保存，并写入1
            Address::create($data);
            //  跳转

            return [
                'status' => "true",
                'message' => "添加地址成功"
            ];

        };

    }

//地址列表

    public function list(Request $request)
    {
        $data = $request->post();
//     dd($data);
//           找到符合这个账号的所有地址
        $address = Address::where('user_id', $data['user_id'])->get();
//       返回数据
        return $address;
    }

    public function show(Request $request)
    {
        $id = $request->post('id');
        return Address::where('id', $id)->first();
    }

    public function edit(Request $request)
    {

        $data = $request->post();
//找到这条数据
        $address = Address::find($data['id']);
//保存
        $address->update($data);
        return [
            'status' => 'true',
            'message' => "修改地址成功"
        ];

    }
}