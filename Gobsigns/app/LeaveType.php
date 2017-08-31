<?php
namespace App;
use Eloquent;

class LeaveType extends Eloquent {

	protected $fillable = [
							'leave_name'
						];
	protected $primaryKey = 'id';
	protected $table = 'leave_types';

    public function leave()
    {
        return $this->hasMany('App\Leave'); 
    }
}
