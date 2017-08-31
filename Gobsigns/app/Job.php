<?php
namespace App;
use Eloquent;

class Job extends Eloquent {

	protected $fillable = [
							'location_id',
							'job_title',
							'user_id',
							'numbers',
							'job_description',
							'status'
						];
	protected $primaryKey = 'id';
	protected $table = 'jobs';

    public function location()
    {
        return $this->belongsTo('App\Location'); 
    }

    public function user()
    {
        return $this->belongsTo('App\User'); 
    }

    public function application()
    {
        return $this->hasMany('App\Application'); 
    }
}
