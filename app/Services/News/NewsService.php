<?php

namespace App\Services\News;

use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class NewsService
{

    public function getNewsList()
    {
        return News::all();
    }

    public function getNews($id)
    {
        return News::findOrFail($id);
    }

    public function create(CreateRequest $request)
    {
        $path = $request->file('image')->store(News::STORAGE_PATH, 'public');
        Storage::disk('public')->setVisibility($path, 'public');

        $news = News::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'text' => $request['text'],
            'image' => $path
        ]);

        return $news;
    }

    public function update(UpdateRequest $request, $id)
    {
        $path = $request->file('image')->store(News::STORAGE_PATH, 'public');
        Storage::disk('public')->setVisibility($path, 'public');

        $news = News::findOrFail($id);
        Storage::disk('public')->delete($news->image);
        $news->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'text' => $request['text'],
            'image' => $path
        ]);

        return $news;
    }

    public function makePublish($id)
    {
        $news = News::findOrFail($id);
        $news->published_at = Carbon::now();
        $news->save();
        return $news;
    }

    public function makeUnpublish($id)
    {
        $news = News::findOrFail($id);
        $news->published_at = null;
        $news->save();
        return $news;
    }

    public function delete($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        Storage::disk('public')->delete($news->image);
        return $news;
    }


}
