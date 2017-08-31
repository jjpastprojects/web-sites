<?php
namespace App;
use Eloquent;

class AwardType extends Eloquent {

	protected $fillable = [
							'award_name'
						];
	protected $primaryKey = 'id';
	protected $table = 'award_types';

	public function award()
    {
        return $this->hasMany('App\Award');
    }
}
