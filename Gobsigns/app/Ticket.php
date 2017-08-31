<?php
namespace App;
use Eloquent;

class Ticket extends Eloquent {

	protected $fillable = [
							'user_id',
							'ticket_subject',
							'ticket_description',
							'ticket_priority',
							'ticket_status'
						];
	protected $primaryKey = 'id';
	protected $table = 'tickets';

    public function user()
    {
        return $this->belongsTo('App\User'); 
    }
}
