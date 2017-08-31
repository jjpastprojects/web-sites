<?php
namespace App;
use Eloquent;

class CustomField extends Eloquent {

	protected $fillable = [
							'form',
							'field_name',
							'field_title',
							'field_type',
							'field_values',
							'field_required'
						];
	protected $primaryKey = 'id';
	protected $table = 'custom_fields';

	public function customFieldValue()
    {
        return $this->hasMany('App\customFieldValue');
    }
}
