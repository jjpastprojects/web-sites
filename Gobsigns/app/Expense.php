<?php
namespace App;
use Eloquent;

class Expense extends Eloquent {

	protected $fillable = [
							'expense_head_id',
							'user_id',
							'amount',
							'expense_date',
							'remarks'
						];
	protected $primaryKey = 'id';
	protected $table = 'expenses';

	public function expenseHead()
    {
        return $this->belongsTo('App\ExpenseHead');
    }
}
