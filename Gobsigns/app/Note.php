<?php
namespace App;
use Eloquent;

class Note extends Eloquent {

	protected $fillable = [
							'note_content',
							'note_username',
							'task_id'
						];
	protected $primaryKey = 'id';
	protected $table = 'notes';

	public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
