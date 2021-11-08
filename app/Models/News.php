<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class News extends Model
{
    public const STORAGE_PATH = 'news_images';

    use HasFactory;

    protected $fillable = ['title', 'description', 'text', 'image', 'published_at'];

    public function getUrl()
    {
        return Storage::disk('public')->url($this->image);
    }
}
