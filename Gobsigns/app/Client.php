<?php
namespace App;
use Eloquent;

class Client extends Eloquent {

	protected $fillable = [
							'client_name',
							'client_description'
						];
	protected $primaryKey = 'id';
	protected $table = 'clients';

	protected  function location(){
        return $this->hasMany('App\Location','client_id','id');
    }

}
