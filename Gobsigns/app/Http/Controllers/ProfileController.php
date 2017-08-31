<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Classes\Helper;

class ProfileController extends Controller
{

  public function index(){
    
  }

   public function changePassword(){
        return view('auth.change_password');
   }

   public function doChangePassword(Request $request)
   {
		$this->validate($request, [
            'old_password' => 'required|valid_password',
            'new_password' => 'required|confirmed|different:old_password|min:4',
            'new_password_confirmation' => 'required|different:old_password|same:new_password'
        ]);
        $credentials = $request->only(
                'new_password', 'new_password_confirmation'
        );

        $user = Auth::user();
        
        $user->password = bcrypt($credentials['new_password']);
        $user->save();
        return redirect('change_password')->withSuccess('Password has been changed.');    
    }
}