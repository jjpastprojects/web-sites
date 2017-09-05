<?php namespace Lem\Profile\models;

use Illuminate\Database\Eloquent\Model;

class UserValue extends Model {

    protected $fillable = ['user_id', 'variable_id', 'values'];

    /**
     * to convert the values attribute to string
     *
     * @param  divers  $values
     * @return string
     */
    public function setAttrinuteValues($values)
    {
        return (string)$values;
    }



    public function user()
    {
        return $this->belongsTo('Lem\User\Models\User');
    }

}
