<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $hidden = [
        'section_id',
        'updated_at',
        'deleted_at'
    ];

    protected $appends = [ //Esto añade una field calculada, ver getTagsAttribute
        'tags'
    ];

    protected $visible = ['id', 'title', 'body', 'section', 'tags', 'created_at'];

    public static function getPostsDesc() {
        return DB::table('posts')
            ->orderByDesc('id')
            ->get();
    }


    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'posts_tags');
    }

    public function getTagsAttribute() {
        return $this->tags()
            ->get();
    }

    public function usesTag($tag) {
        $tags = $this->tags();

        foreach ($tags as $t) {
            if ($t->id == $tag->id) {
                return true;
            }
        }
        return false;
    }

}
