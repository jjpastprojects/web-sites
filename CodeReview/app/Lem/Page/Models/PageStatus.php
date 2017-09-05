<?php

namespace Lem\Page\Models;

use Illuminate\Database\Eloquent\Model;

class PageStatus extends Model
{
    protected $fillable = ['user_id', 'page_id', 'isReaded', 'inTrash', 'isSaved'];
    protected $table = 'page_status';
}
