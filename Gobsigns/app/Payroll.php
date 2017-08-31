<?php
namespace App;
use Eloquent;

class Payroll extends Eloquent {

	protected $fillable = [
							'payroll_slip_id',
							'salary_type_id',
							'amount'
						];
	protected $primaryKey = 'id';
	protected $table = 'payroll';

    public function payrollSlip()
    {
        return $this->belongsTo('App\PayrollSlip'); 
    }

    public function salaryType()
    {
        return $this->belongsTo('App\SalaryType'); 
    }
}
