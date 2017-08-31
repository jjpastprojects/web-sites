<?php
namespace App;
use Eloquent;

class Attachment extends Eloquent {

	protected $fillable = [
							'attachment_title',
							'attachment_description',
							'task_id',
							'attachment_username',
							'file'
						];
	protected $primaryKey = 'id';
	protected $table = 'attachments';

	public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
