<?php
namespace App;
use Eloquent;

class Task extends Eloquent {

	protected $fillable = [
							'task_title',
							'task_description',
							'start_date',
							'due_date',
							'hours',
							'task_progress'
						];
	protected $primaryKey = 'id';
	protected $table = 'tasks';

	public function user()
    {
        return $this->belongsToMany('App\User','assigned_tasks','task_id','user_id');
    }

	public function comment()
    {
        return $this->hasMany('App\Comment');
    }

	public function note()
    {
        return $this->hasMany('App\Note');
    }
    
	public function attachment()
    {
        return $this->hasMany('App\Attachment');
    }
}
