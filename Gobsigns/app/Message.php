<?php
namespace App;
use Eloquent;

class Message extends Eloquent {

	protected $fillable = [
							'from_user_id',
							'to_user_id',
							'subject',
							'content',
							'attachment',
							'read',
							'delete_sender',
							'delete_receiver',
						];
	protected $primaryKey = 'id';
	protected $table = 'messages';

    public function user()
    {
        return $this->belongsTo('App\User'); 
    }
}
