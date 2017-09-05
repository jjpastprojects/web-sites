<?php namespace Lem\Profile\models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model {

    protected $fillable = ['var_id', 'condition', 'action'];

    public function variable()
    {
        return $this->belongsTo('Lem\profile\Models\Variable');
    }

}
