<?php

namespace Tests\Feature;

use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testGetNewsList()
    {
        $this->withoutExceptionHandling();

        News::factory()->count(3)->create();
        $response = $this->get(route('news.index'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data'
            ]);
    }

    public function testCreateNews()
    {
        Storage::fake('public');

        $this->withoutExceptionHandling();
        $news = News::factory()->make();
        $file = UploadedFile::fake()->image('avatar.png');


        $response = $this->post(route('news.store'), [
            'title' => $news->title,
            'text' => $news->text,
            'image' => $file
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'data'
            ]);
    }
}
