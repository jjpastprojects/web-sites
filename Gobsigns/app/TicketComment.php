<?php
namespace App;
use Eloquent;

class TicketComment extends Eloquent {

	protected $fillable = [
							'ticket_id',
							'comment',
							'comment_username'
						];
	protected $primaryKey = 'id';
	protected $table = 'ticket_comments';

	public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
