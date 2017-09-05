<?php

namespace Lembarek\Blog\Models;

use Lembarek\Blog\Models\Post;

class Tag extends Model
{

    protected $fillable = ['name', 'title', 'subtitle', 'page_image', 'meta_description', 'layout', 'direction'];

    /**
     * get posts
     *
     * @return Post
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
