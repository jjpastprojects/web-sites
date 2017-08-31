<?php
namespace App;
use Eloquent;

class ExpenseHead extends Eloquent {

	protected $fillable = [
							'expense_head'
						];
	protected $primaryKey = 'id';
	protected $table = 'expense_heads';


	public function expense()
    {
        return $this->hasMany('App\Expense');
    }
}
