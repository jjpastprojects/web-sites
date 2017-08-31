<?php
namespace App;
use Eloquent;

class Holiday extends Eloquent {

	protected $fillable = [
							'date',
							'holiday_description'
						];
	protected $primaryKey = 'id';
	protected $table = 'holidays';

}
