<?php
namespace App;
use Eloquent;

class BankAccount extends Eloquent {

	protected $fillable = [
							'user_id',
							'bank_name',
							'account_name',
							'account_number',
							'ifsc_code',
							'bank_branch'
						];
	protected $primaryKey = 'id';
	protected $table = 'bank_accounts';

    public function user()
    {
        return $this->belongsTo('App\User'); 
    }
}
