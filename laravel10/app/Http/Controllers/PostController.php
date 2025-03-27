<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function register(Request $request)
    {
        // 输入验证
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:4|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 插入数据到 users 表
        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,

        ]);

        return redirect()->route('home')->with('status', '注册成功！');
    }
    public function login(){
        return view('signin');

    }
    public function sgnin(Request $request)
    {
        // 验证请求数据
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:4',
        ]);

        // 使用 DB 查询用户
        $user = DB::table('users')->where('name', $request->name)->first();

        // 如果用户不存在或者密码不匹配
        if (!$user || $user->password !== $request->password) {
            return response()->json(['message' => '用户名或密码错误'], 401);
        }
        return redirect()->route('store')->with('message', '登录成功');

    }
    public function registerviwe(){
        return view('register');
    }

}
