<?php
namespace App;
use Eloquent;

class Salary extends Eloquent {

	protected $fillable = [
							'user_id',
							'salary_type_id',
							'amount'
						];
	protected $primaryKey = 'id';
	protected $table = 'salary';
}
