<?php
namespace App\Http\Controllers;
use App\Http\Requests\DocumentTypeRequest;
use App\DocumentType;
use App\Classes\Helper;
use Config;

Class DocumentTypeController extends Controller{

	public function index(){
	}

	public function show(){
	}

	public function create(){
	}

	public function edit(DocumentType $document_type){
		return view('document_type.edit',compact('document_type'));
	}

	public function store(DocumentTypeRequest $request, DocumentType $document_type){	

		$document_type->create($request->all());

		return redirect('/configuration#document')->withSuccess(config('constants.ADDED'));				
	}

	public function update(DocumentTypeRequest $request, DocumentType $document_type){

		$document_type->fill($request->all())->save();

		return redirect('/configuration#document')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(DocumentType $document_type){
        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

        $document_type->delete();
        return redirect('/configuration#document')->withSuccess(config('constants.DELETED'));
	}
}
?>