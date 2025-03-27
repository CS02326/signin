@extends('layouts.app')
@section('content')
    <div class="register-form">
        <h2>用户注册</h2>
        <form method="POST" action="/register">
            @csrf
            <div>
                <label for="name">用户名</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    placeholder="请输入用户名"
                />
                @error('name')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="email">邮箱</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    placeholder="请输入邮箱"
                />
                @error('email')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password">密码</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    placeholder="请输入密码"
                />
                @error('password')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label for="password_confirmation">确认密码</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    placeholder="请确认密码"
                />
            </div>

            <button type="submit">注册</button>
        </form>
    </div>
@endsection
