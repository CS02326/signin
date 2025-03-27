<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\News;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    // 获取所有新闻，分页支持

    public function index(Request $request)
    {
        // 获取每页显示的新闻数量（默认为 5）
        $perPage = $request->get('per_page', 5);

        // 获取分页数据并按 id 倒序排序
        $newsList = News::orderBy('id', 'desc')->paginate($perPage);

        // 遍历新闻列表，将图片 BLOB 数据转换为 Base64 编码
        foreach ($newsList as $news) {
            if ($news->image) {
                try {
                    // 使用 fileinfo 扩展来检测 MIME 类型
                    $finfo = finfo_open(FILEINFO_MIME_TYPE); // 获取 MIME 类型
                    $mimeType = finfo_buffer($finfo, $news->image);
                    finfo_close($finfo);

                    // 检查 MIME 类型是否有效
                    if (in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif'])) {
                        // 根据 MIME 类型生成正确的 Base64 前缀
                        $base64Prefix = 'data:' . $mimeType . ';base64,';

                        // 将 BLOB 数据转换为 Base64 编码并添加格式前缀
                        $news->image = $base64Prefix . base64_encode($news->image);
                    } else {
                        // 如果 MIME 类型不支持，设置一个默认的占位符或保持原始值
                        $news->image = null;
                    }
                } catch (\Exception $e) {
                    // 捕获可能的异常并处理
                    $news->image = null;
                }
            }
        }

        // 将分页数据转换为数组并返回，确保返回的数据符合前端需求
        return [
            'newsList' => $newsList->items(),  // 获取当前页的新闻列表数据
            'currentPage' => $newsList->currentPage(),
            'lastPage' => $newsList->lastPage(),
            'total' => $newsList->total(),
        ];
    }



    public function news(Request $request)
    {
        // 获取每页显示的新闻数量（默认为 5）
        $perPage = $request->get('per_page', 5);

        // 获取分页数据
        $newsList = News::paginate($perPage);

        // 遍历新闻列表，将图片 BLOB 数据转换为 Base64 编码
        foreach ($newsList as $news) {
            if ($news->image) {
                try {
                    // 使用 fileinfo 扩展来检测 MIME 类型
                    $finfo = finfo_open(FILEINFO_MIME_TYPE); // 获取 MIME 类型
                    $mimeType = finfo_buffer($finfo, $news->image);
                    finfo_close($finfo);

                    // 检查 MIME 类型是否有效
                    if (in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif'])) {
                        // 根据 MIME 类型生成正确的 Base64 前缀
                        $base64Prefix = 'data:' . $mimeType . ';base64,';

                        // 将 BLOB 数据转换为 Base64 编码并添加格式前缀
                        $news->image = $base64Prefix . base64_encode($news->image);
                    } else {
                        // 如果 MIME 类型不支持，设置一个默认的占位符或保持原始值
                        $news->image = null;
                    }
                } catch (\Exception $e) {
                    // 捕获可能的异常并处理
                    $news->image = null;
                }
            }
        }

        // 将分页数据和图片的 Base64 编码传递给视图
        return view('store', compact('newsList'));
    }

    public function storeviem(){
        return view('news');
    }
    // 发布新闻
    public function store(Request $request)
    {
        // 表单验证规则
        $request->validate([
            'title' => 'required|string|max:255',       // 标题必须为字符串，最大长度255
            'content' => 'required|string',             // 内容必须为字符串
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,bmp|max:2048', // 图片必须存在，且格式为 jpg, jpeg, png, gif, bmp，最大2MB
        ]);

        // 处理图片上传
        $imageData = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // 获取文件内容并转为二进制数据
            $imageData = file_get_contents($image->getRealPath());
        }

        // 创建新闻记录，保存到数据库，image 字段存储二进制数据
        News::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $imageData,  // 存储为 BLOB（二进制数据）
        ]);

        // 重定向到新闻列表页面
        return redirect()->route('news');
    }


    // 更新新闻
    public function update(Request $request, $id)
    {
        // 验证请求数据
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // 查找新闻记录，如果找不到则返回 404 错误
        $news = News::find($id);
        if (!$news) {
            return response()->json(['error' => 'News not found'], 404);
        }

        // 更新新闻记录
        $news->update($validated);

        return response()->json($news);
    }
    public function destroy($id)
    {
        // 查找新闻并删除
        $news = News::findOrFail($id);
        $news->delete();

        // 可以选择重定向回新闻列表页面
        return redirect()->route('news')->with('success', '新闻已成功删除');
    }

}
