<?php

namespace Lem\Page\Models;

use Illuminate\Database\Eloquent\Model;

class UserPage extends Model
{
    protected $table = 'user_page';
    protected $fillable = ['user_id', 'page_id', 'score'];
}
