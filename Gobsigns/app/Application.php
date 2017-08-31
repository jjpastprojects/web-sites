<?php
namespace App;
use Eloquent;

class Application extends Eloquent {

	protected $fillable = [
							'job_id',
							'user_id',
							'name',
							'email',
							'contact_number',
							'address',
							'app_description',
							'status',
							'resume'
						];
	protected $primaryKey = 'id';
	protected $table = 'applications';

	public function job()
    {
        return $this->belongsTo('App\Job');
    }
}
