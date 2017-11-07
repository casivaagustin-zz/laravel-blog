<?php

use App\PostsTags;
use App\Tag;
use Illuminate\Database\Seeder;

class PostsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 50)->create()->each(function ($post) {
            $postTag = new PostsTags();
            $postTag->post_id = $post->id;
            $postTag->tag_id = Tag::inRandomOrder()->first()->id;
            $postTag->save();
        });
    }
}
