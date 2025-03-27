@extends('layouts.news')
@section('content')
    <div class="news-container">
        <h2 class="title">最新新闻</h2>

        <!-- 显示新闻列表 -->
        @forelse ($newsList as $news)
            <div class="news-item">
                <h3>{{ $news->title }}</h3>
                <p>{{ $news->content }}</p>

                <!-- 如果有图片则显示，否则显示无图片提示 -->
                <div class="news-image">
                    @if ($news->image)
                        <img src="{{ $news->image }}" alt="News Image" />
                    @else
                        <p>No image available</p>
                    @endif
                </div>

                <!-- 更改和删除按钮 -->
                <div class="action-buttons">
                    <!-- 编辑按钮 -->
                    <a href="{{ route('news.edit', $news->id) }}" class="btn edit-btn">更改</a>

                    <!-- 删除按钮，使用表单提交以确保删除请求 -->
                    <form action="{{ route('news.destroy', $news->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn delete-btn" onclick="return confirm('确定要删除这条新闻吗？')">删除</button>
                    </form>
                </div>
            </div>
        @empty
            <p>暂无新闻。</p>
    @endforelse

    <!-- 分页链接 -->
        <div class="pagination">
            <!-- 上一页 -->
            @if ($newsList->currentPage() > 1)
                <a href="{{ $newsList->previousPageUrl() }}" class="pagination-btn">上一页</a>
            @endif

        <!-- 分页数字 -->
            @foreach(range(1, $newsList->lastPage()) as $page)
                <a href="{{ $newsList->url($page) }}" class="pagination-btn {{ $page == $newsList->currentPage() ? 'active' : '' }}">
                    {{ $page }}
                </a>
            @endforeach

        <!-- 下一页 -->
            @if ($newsList->hasMorePages())
                <a href="{{ $newsList->nextPageUrl() }}" class="pagination-btn">下一页</a>
            @endif
        </div>
    </div>

    <style>
        .news-container {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .news-item {
            border-bottom: 1px solid #ccc;
            padding: 15px 0;
            margin-bottom: 20px;
        }

        .news-item h3 {
            font-size: 20px;
            font-weight: bold;
        }

        .news-item p {
            font-size: 16px;
            color: #555;
        }

        .news-image img {
            max-width: 100%;
            height: auto;
        }

        .action-buttons {
            margin-top: 10px;
        }

        .btn {
            padding: 8px 15px;
            margin-right: 10px;
            text-decoration: none;
            font-size: 14px;
            border-radius: 5px;
            display: inline-block;
        }

        .edit-btn {
            background-color: #007bff;
            color: white;
        }

        .edit-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination-btn {
            padding: 8px 15px;
            margin: 0 5px;
            background-color: #f0f0f0;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination-btn.active {
            background-color: #007bff;
            color: white;
        }

        .pagination-btn:hover {
            background-color: #007bff;
            color: white;
        }
    </style>


    <style>
        .news-container {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .news-item {
            border-bottom: 1px solid #ccc;
            padding: 15px 0;
        }

        .news-item h3 {
            font-size: 20px;
            font-weight: bold;
        }

        .news-item p {
            font-size: 16px;
            color: #555;
        }

        .news-image img {
            max-width: 100%;
            height: auto;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination-btn {
            padding: 8px 15px;
            margin: 0 5px;
            background-color: #f0f0f0;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination-btn.active {
            background-color: #007bff;
            color: white;
        }

        .pagination-btn:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
@endsection

