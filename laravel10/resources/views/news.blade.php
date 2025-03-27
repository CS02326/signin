
@extends('layouts.fbxw')

@section('content')
    <form action="/store" method="POST" enctype="multipart/form-data">
    @csrf  <!-- CSRF 保护 -->
        <div class="form-group">
            <label for="title">标题</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="请输入新闻标题" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="content">内容</label>
            <textarea id="content" name="content" class="form-control" placeholder="请输入新闻内容" required>{{ old('content') }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">图片</label>
            <input type="file" id="image" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">发布新闻</button>
    </form>
@endsection
