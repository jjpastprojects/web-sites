<?php
namespace App;
use Eloquent;

class PayrollSlip extends Eloquent {

	protected $fillable = [
							'user_id',
							'month',
							'year',
						];
	protected $primaryKey = 'id';
	protected $table = 'payroll_slip';

	
    public function user()
    {
        return $this->belongsTo('App\User'); 
    }

    public function payroll()
    {
        return $this->hasMany('App\Payroll'); 
    }
}
