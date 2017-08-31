<?php
namespace App;
use Eloquent;

class Leave extends Eloquent {

	protected $fillable = [
							'user_id',
							'leave_type_id',
							'from_date',
							'to_date',
							'leave_description',
							'leave_status'
						];
	protected $primaryKey = 'id';
	protected $table = 'leaves';

    public function user()
    {
        return $this->belongsTo('App\User','user_id'); 
    }

    public function leaveType()
    {
        return $this->belongsTo('App\LeaveType'); 
    }
}
