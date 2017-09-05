<?php

use Ccp\Interfaces\BuyInterface;

use Ccp\Interfaces\SellInterface;

use Ccp\Interfaces\ContactUsInterface;

class HomeController extends BaseController {

    protected $buyRepo;

    protected $sellRepo;

    protected $ContactUsRepo;

    public function __construct(BuyInterface $buyRepo, SellInterface $sellRepo, ContactUsInterface $contactUsRepo)
    {
        $this->buyRepo = $buyRepo;
        $this->sellRepo = $sellRepo;
        $this->contactUsRepo = $contactUsRepo;
    }


    public function home(){

        $sell = $this->sellRepo->isActive();
        $buy = $this->buyRepo->isActive();

        return View::make('home', compact('sell', 'buy'));
    }


    public function terms(){
        $terms = Lang::get('terms');
        return View::make('general.terms', compact('terms'));
    }


    public function AboutMe(){
        return View::make('general.AboutMe');
    }


    public function faq(){
        $faqs = Lang::get('faq');
        return View::make('general.faq', compact('faqs'));
    }


    public function GetContactUs(){
        return View::make('general.contact_us');
    }


    public function PostContactus(){
        $validator = Validator::make(Input::all(),array(
                'subject' => 'required|min:6',
                'message' => 'required|min:20'
            ));
        if($validator->fails()){
            return Redirect::route('contact_us')
                            ->withErrors($validator)
                            ->withInput();
        }else{
            $contact_us  = $this->contactUsRepo->create(array(
                'subject' => Input::get('subject'),
                'message' => Input::get('message'),
                'status' => 'not_readed',
                ));
            if($contact_us){
                return Redirect::route('home')
                        ->with('global',Lang::get('general.contact_me_success'));
            }
        }
    }


    /**
     * show the informaiton about the us
     *
     * @return void
     */
    public function info()
    {
        return  View::make('general.info');
    }

}
