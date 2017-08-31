<?php
namespace App;
use Eloquent;

class Notice extends Eloquent {

	protected $fillable = [
							'from_date',
							'to_date',
							'title',
							'content',
							'username'
						];
	protected $primaryKey = 'id';
	protected $table = 'notice';

	public function location()
    {
        return $this->belongsToMany('App\Location','notice_location','notice_id','location_id');
    }

}
