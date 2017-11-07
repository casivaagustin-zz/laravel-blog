<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    //

    public static function getPostsDesc() {
        return DB::table('posts')
            ->orderByDesc('id')
            ->get();
    }


    public function section()
    {
        return $this->belongsTo('App\Section')->first();
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'posts_tags')->get();
    }
}
