<?php namespace Lem\Profile\Models;

use Illuminate\Database\Eloquent\Model;


class Variable extends Model {

    protected $fillable = ['name', 'type', 'min', 'max'];


    public function action()
    {
        return $this->hasOne('Lem\Profile\Models\Action');
    }


    public function values()
    {
        return $this->hasMany('Lem\Profile\Models\UserValue');
    }
}
