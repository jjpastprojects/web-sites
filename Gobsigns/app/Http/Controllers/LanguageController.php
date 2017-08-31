<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\LanguageRequest;
use File;
use App\Classes\Helper;
use Config;
use Entrust;
use Lang;
use Activity;

Class LanguageController extends Controller{

	public function index(){

		if(!Entrust::can('manage_language'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $languages = Helper::getAllLanguages();
		$translation_count = count(Helper::getTranslationWords());
        $token = csrf_token();

        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Locale'),
        		trans('messages.Language Name'),
        		trans('messages.Percentage Translation')
        		);

        foreach($languages as $key => $language){

			$trans = File::getRequire(base_path().'/resources/lang/'.$key.'/messages.php');
    		$percentage = ($translation_count) ? round(((count($trans)*100)/$translation_count),2) : 0;

			$col_data[] = array(
					'<div class="btn-group btn-group-xs">'.
					'<a href="/language/'.$key.'/edit" class="btn btn-default btn-xs md-trigger"> <i class="fa fa-edit"></i></a> '.
					'<a href="/language/'.$key.'" class="btn btn-default btn-xs md-trigger"> <i class="fa fa-eye"></i></a> '.
					delete_form(['language.destroy',$key]).'</div>',
					$key,
					$language,
					$percentage." % translation"
					);	
        }

        Helper::writeResult($col_data);

		return view('language.index',compact('col_heads'));
	}

	public function show($id){

		if(!Entrust::can('manage_language'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $languages = Helper::getAllLanguages();

		if(!array_key_exists($id, $languages))
			return redirect()->back()->withErrors(config('constants.INVALID_LINK'));

		$language = $languages[$id];

		$language_entries = Helper::getTranslationWords();
		asort($language_entries);

		$trans = File::getRequire(base_path().'/resources/lang/'.$id.'/messages.php');
		
		$data = [
			'language' => $language,
			'language_entries' => $language_entries,
			'trans' => $trans,
			'locale' => $id
			];

		return view('language.show',$data);
	}

	public function create(){
	}

	public function edit($id){

		if(!Entrust::can('manage_language'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $languages = Helper::getAllLanguages();

		if(!array_key_exists($id, $languages))
			return redirect()->back()->withErrors(config('constants.INVALID_LINK'));

		$language = $languages[$id];

		return view('language.edit',[
				'language' => $language,
				'locale' => $id
				]);
	}

	
	public function update(LanguageRequest $request, $id){

		if(!Entrust::can('manage_language'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $languages = Helper::getAllLanguages();

		if(!array_key_exists($id, $languages))
			return redirect()->back()->withErrors(config('constants.INVALID_LINK'));

		if(in_array($request->input('name'),$languages))
			return redirect()->back()->withErrors('This language is already added. ');

		$languages[$id] = $request->input('name');
		$filename = base_path().config('paths.LANG_PATH');
		File::put($filename,var_export($languages, true));
		File::prepend($filename,'<?php return ');
		File::append($filename, ';');

		$activity = 'Updated a language';
		Activity::log($activity);
		return redirect('/language')->withSuccess(config('constants.UPDATED'));
	}

	public function store(LanguageRequest $request){

		if(!Entrust::can('manage_language'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $languages = Helper::getAllLanguages();

        $locale = $request->input('locale');
        $name = $request->input('name');

		if(array_key_exists($locale, $languages) || in_array($name,$languages))
			return redirect()->back()->withErrors('This language is already added. ');

		$languages[$locale] = $name;
		$filename = base_path().config('paths.LANG_PATH');
		File::put($filename,var_export($languages, true));
		File::prepend($filename,'<?php return ');
		File::append($filename, ';');

		$result = File::makeDirectory(base_path().'/resources/lang/'.$locale);
		if (!File::exists(base_path().'/resources/lang/'.$locale.'/messages.php'))
		File::put(base_path().'/resources/lang/'.$locale.'/messages.php','<?php return array();');
		
		$activity = 'Added new Language';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));	
	}

	public function setLanguage($id){

		if(!Entrust::can('set_language'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $languages = Helper::getAllLanguages();
		if(!array_key_exists($id, $languages))
			return redirect()->back()->withErrors(config('constants.INVALID_LINK'));

		$configuration = Helper::getConfiguration();
		$configuration['default_language'] = $id;
		$filename = base_path().'/config/config.php';
		File::put($filename,var_export($configuration, true));
		File::prepend($filename,'<?php return ');
		File::append($filename, ';');

		return redirect()->back()->withSuccess(config('constants.SAVED'));
	}

	public function addWords(Request $request){

		if(!Entrust::can('manage_language'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		
		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		
		if($request->input('text') == '')
			return redirect()->back()->withInput()->withErrors('Please enter word for translation. ');

		$translation = Helper::getTranslationWords();
		if(in_array($request->input('text'),$translation))
			return redirect()->back()->withInput()->withErrors('This word is already added. ');

		array_push($translation,$request->input('text'));
		$filename = base_path().config('paths.LANGUAGE_PATH');
		File::put($filename,var_export($translation, true));
		File::prepend($filename,'<?php return ');
		File::append($filename, ';');
		
		$activity = 'Added new transalation';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));	
	}

	public function updateTranslation(Request $request, $id){

		if(!Entrust::can('manage_language'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		
		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

        $languages = Helper::getAllLanguages();
		if(!array_key_exists($id, $languages))
			return redirect()->back()->withErrors(config('constants.INVALID_LINK'));

		$language_entries = Helper::getTranslationWords();

		$translation = array();

		foreach($language_entries as $key => $language_entry){
			if($request->input($key))
			$translation[$language_entry] = $request->input($key);
		}
		
		$filename = base_path().'/resources/lang/'.$id.'/messages.php';
		File::put($filename,var_export($translation, true));
		File::prepend($filename,'<?php return ');
		File::append($filename, ';');

		return redirect('/language/'.$id)->withSuccess(config('constants.UPDATED'));	
	}

	public function destroy($id){
		if(!Entrust::can('manage_language'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		
        $languages = Helper::getAllLanguages();
		if(!array_key_exists($id, $languages))
			return redirect()->back()->withErrors(config('constants.INVALID_LINK'));

		if($id == 'en')
			return redirect('/language')->withErrors('You cannot delete primary language. ');

		if(config('config.default_language') == $id)
			return redirect('/language')->withErrors('This language is currently default language of system, Please change system langauge. ');

		$result = File::deleteDirectory(base_path().'/resources/lang/'.$id);
		unset($languages[$id]);
		$filename = base_path().config('paths.LANG_PATH');
		File::put($filename,var_export($languages, true));
		File::prepend($filename,'<?php return ');
		File::append($filename, ';');

		$activity = 'Deleted a Language';
		Activity::log($activity);

		return redirect('/language')->withSuccess(config('constants.DELETED'));
	}
}
?>