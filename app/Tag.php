<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function posts()
    {
        return $this->belongsToMany('App\Post', 'posts_tags')
            ->orderByDesc('id')
            ->get();
    }
}
