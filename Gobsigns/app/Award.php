<?php
namespace App;
use Eloquent;

class Award extends Eloquent {

	protected $fillable = [
							'award_type_id',
							'gift',
							'cash',
							'month',
							'year',
							'award_description',
							'award_date'
						];
	protected $primaryKey = 'id';
	protected $table = 'awards';

	public function user()
    {
        return $this->belongsToMany('App\User','assigned_awards','award_id','user_id');
    }

	public function awardType()
    {
        return $this->belongsTo('App\AwardType');
    }
}
