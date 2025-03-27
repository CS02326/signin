<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    public $timestamps = false;  // 禁用时间戳功能
    // 添加 title 和 content 到 fillable 数组中
    protected $fillable = ['title', 'content', 'image'];


}
