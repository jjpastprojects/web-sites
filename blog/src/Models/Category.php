<?php

namespace Lembarek\Blog\Models;

use App\Traits\Categoriable;
use Lembarek\Blog\Models\Post;

class Category extends Model
{
  protected $fillable = ['name', 'slug', 'description', 'parent', 'model'];

  public function setNameAttribute($value)
  {
    $this->attributes['name'] = $value;

    if (! $this->exists) {
      $this->attributes['slug'] = str_slug($value);
    }
  }

   /**
    * return children of this category
    *
    * @return Category
    */
   public function childrenCategories()
   {
        return $this->whereParent($this->id)->get();
   }

    /**
     * it return all posts belong to this catogories
     *
     * @return Post
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
