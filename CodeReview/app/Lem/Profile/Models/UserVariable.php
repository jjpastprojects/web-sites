<?php namespace Lem\Profile\models;

use Illuminate\Database\Eloquent\Model;

class UserVariable extends Model {

    protected $fillable = ['user_id', 'variable_id'];


    public function user()
    {
        return $this->belongsTo('Lem\User\Models\User');
    }

}
