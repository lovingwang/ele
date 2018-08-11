<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Closure;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function __construct()
    {
   $this->middleware('auth:admin')->except('login');
//    判断用户有没有权限
        $this->middleware(function($request, Closure $next){
//得到当前用户
            $admin = Auth::guard('admin')->user();
            //判断当前路由在不在这个数组里，不在的话才验证权限，在的话不验证，还可以根据排除用户ID为1
            if (!in_array(Route::currentRouteName(), ['admin.login', 'admin.logout']) && $admin->id !== 1) {
                //判断当前用户有没有权限访问 路由名称就是权限名称
                if ($admin->can(Route::currentRouteName()) === false) {
                    /* echo view('admin.fuck');
                      exit;*/
                    //显示视图 不能用return 能exit
                    exit(view('admin.res'));

                }

            }
            return $next($request);
        });


    }
}
