<?php

namespace Lembarek\Blog\Models;

use Lembarek\Blog\Models\Tag;
use Lembarek\Blog\Traits\Tagable;
use Lembarek\Blog\Models\Category;

class Post extends Model
{
  use Tagable;

  protected $fillable = ['title', 'description', 'body', 'published_at', 'active', 'author'];

  protected $dates = ['published_at'];

  public function setTitleAttribute($value)
  {
    $this->attributes['title'] = $value;

    if (! $this->exists) {
      $this->attributes['slug'] = str_slug($value);
    }
  }


  public  function scopePublishedBeforeNow($query)
  {
      return $query->where('published_at', '<', \Carbon\Carbon::now());
  }

  public function save(array $options = [])
  {
      $this->attributes['author'] = auth()->user()->username;
      parent::save($options);
  }

  /**
   * it get the catetory of this post
   *
   * @return Category
   */
  public function categories()
  {
      return $this->belongsToMany(Category::class);
  }

  /**
      * return all categories that this post
      * do not belongs to.
   *
   * @return Category
   */
  public function CategoriesNotIn()
  {
      $category_ids = $this->categories->map(function($category){return $category->id;});
      return Category::whereNotIn('id', $category_ids)->get();
  }

    /**
    * assign a category to a user
    *
    * @param  string  $category
    * @return void
    */
    public function addToCategory($category)
    {
        $this->categories()->attach($category);
    }

    /**
    * delete a category to a user
    *
    * @param  string  $category
    * @return void
    */
    public function deleteFromCategory($category)
    {
        $this->categories()->detach($category);
    }

    /**
     * return the popularity of post
     *
     * @return integer
     */
    public function popularity()
    {
        return $this->hasOne(Popularity::class);
    }

    /**
     * assign popularity
     *
     * @param  integer  $popularity
     * @return Model
     */
    public function assignPopularity($popularity=0)
    {
        $day = \Carbon\Carbon::now()->format('Y-m-d');
        return $this->popularity()->create(['day' => $day, 'post_id' => $this->id, 'popularity' => $popularity]);
    }

    /**
     * get the relatives posts of post
     *
     * @return Posts
     */
    public function relateds()
    {
        return $this->belongsToMany(Post::class, 'post_related', 'post_id', 'related');
    }

    /**
     * add relative
     *
     * @param  Post  $post
     * @return void
     */
    public function addRelated($post)
    {
        return $this->relateds()->attach($post);
    }
}
