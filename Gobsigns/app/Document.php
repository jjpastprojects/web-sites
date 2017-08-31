<?php
namespace App;
use Eloquent;

class Document extends Eloquent {

	protected $fillable = [
							'user_id',
							'document_type_id',
							'expiry_date',
							'document_title',
							'document_description',
							'document'
						];
	protected $primaryKey = 'id';
	protected $table = 'documents';

    public function user()
    {
        return $this->belongsTo('App\User'); 
    }

    public function DocumentType()
    {
        return $this->belongsTo('App\DocumentType'); 
    }
}
