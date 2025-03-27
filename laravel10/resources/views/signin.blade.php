<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>登录</title>
    <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
</head>
<body>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="box">
        <form method="POST" action="/sgnin" class="form-container">
            @csrf
            <div class="form-item">
                <label for="name">用户名：</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="请输入用户名">
                @error('name')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-item">
                <label for="password">密码：</label>
                <input id="password" type="password" name="password" placeholder="请输入密码">
                @error('password')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-actions">
                <!-- 登录按钮 -->
                <button type="submit" class="el-button el-button--primary">登录</button>
                <!-- 注册按钮 -->
                <button type="button" class="el-button"><a href="/register">注册</a></button>
            </div>
        </form>
    </div>

<script>
</script>

</body>
</html>
