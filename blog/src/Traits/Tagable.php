<?php

namespace Lembarek\Blog\Traits;

use Lembarek\Blog\Models\Tag;

trait Tagable
{
    /**
    * get tags
    *
    * @return Tag
    */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
    * check if the post has a tag
    *
    * @param  string  $tag
    * @return boolean
    */
    public function hasTag($tag)
    {
        foreach ($this->tags()->get() as $r) {
            if ($r->name == $tag) {
                return true;
            }
        }
        return false;
    }

    /**
    * assign a tag to a post
    *
    * @param  string  $tag
    * @return void
    */
    public function assignTag($tag)
    {
        $this->tags()->attach($tag);
    }
}
