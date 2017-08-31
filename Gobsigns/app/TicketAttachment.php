<?php
namespace App;
use Eloquent;

class TicketAttachment extends Eloquent {

	protected $fillable = [
							'attachment_title',
							'attachment_description',
							'ticket_id',
							'attachment_username',
							'file'
						];
	protected $primaryKey = 'id';
	protected $table = 'ticket_attachments';

	public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }
}
