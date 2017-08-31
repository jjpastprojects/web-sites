<?php
namespace App\Http\Controllers;
use App\User;
use App\Document;
use Config;
use Entrust;
use Activity;
use File;
use App\Classes\Helper;
use Illuminate\Http\Request;
use App\Http\Requests\DocumentRequest;

Class DocumentController extends Controller{

	public function store(DocumentRequest $request, Document $document){

		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		$id = $request->input('user_id');
        $employee = User::find($id);

        if(!$employee)
            return redirect('/employee')->withErrors(config('constants.INVALID_LINK'));

		$filename = uniqid();
		$data = $request->all();
        if($request->input('expiry_date') == '')
            $data['expiry_date'] = null;

     	if ($request->hasFile('file')) {
	 		$extension = $request->file('file')->getClientOriginalExtension();
	 		$file = $request->file('file')->move('uploads/document/', $filename.".".$extension);
	 		$data['document'] = $filename.".".$extension;
		 }

	    $document->fill($data);
        $employee->document()->save($document);
        return redirect('/employee/'.$id."#document")->withSuccess(config('constants.ADDED'));			
	}

	public function destroy(Document $document){
		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		
		if(!Entrust::hasRole('admin'))
			return redirect()->back()->withErrors(config('constants.INVALID_LINK'));
		
		$id = $document->User->id;
		File::delete('uploads/document/'.$document->document);
		$activity = 'Document deleted';
		Activity::log($activity);
		$document->delete();

		return redirect('/employee/'.$id."#document")->withSuccess(config('constants.DELETED'));
	}
}
?>