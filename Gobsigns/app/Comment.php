<?php
namespace App;
use Eloquent;

class Comment extends Eloquent {

	protected $fillable = [
							'task_id',
							'comment',
							'comment_username'
						];
	protected $primaryKey = 'id';
	protected $table = 'comments';

	public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
