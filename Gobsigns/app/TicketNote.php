<?php
namespace App;
use Eloquent;

class TicketNote extends Eloquent {

	protected $fillable = [
							'note_content',
							'note_username',
							'ticket_id'
						];
	protected $primaryKey = 'id';
	protected $table = 'ticket_notes';

	public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
