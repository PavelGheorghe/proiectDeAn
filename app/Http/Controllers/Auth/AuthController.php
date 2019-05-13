<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Exception;
use URL;
use Validator;
use App\Exceptions\PermissionException;
use App\Exceptions\AuthenticationException;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use DB;
use Hash;
use Datatables;
use App\Jobs\ResetPassword;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }


    public function reset_password(){
    	return view('auth.reset_password');
    }

    public function new_password($token){

    	return view('auth.new_password',[
    		'token'=> $token
    	]);
    }

    public function save_password(Request $request){

    	$rules['password']                  = 'required|min:4|max:255|confirmed';
    	$rules['password_confirmation']     = 'min:4|max:255';

    	$this->validate($request, $rules);

    	$info =  DB::table('password_resets')->where('token', $request->token_url)->first();

    	if(!empty($info)) {

    		$user = User::where('email',$info->email)->first();

    		if ( !empty($request->password) ) {
    			$user->password = Hash::make($request->password);
    		}
    		$user->save();
    		DB::table('password_resets')->where('email', $info->email)->delete();
    	}else{
    		return view('message.error', [
    			'errors' => [
    				'Incorrect Email. Please, try again.'
    			],
    		]);
    	}

    	

    	return response()->view('message.success', array('message' => trans('Reset password has been successfully '),'redirect'=>'login' ));
    }




    public function reset(Request $request){

    	$rules['email']   = 'required|email';
    	$this->validate($request, $rules);

    	$check = User::where('email',$request->email)->first();


    	if(empty($check)){
    		return view('message.error', [
    			'errors' => [
    				'Incorrect Email. Please, try again.'
    			],
    		]);
    	}
    	$token = str_random(25);
    	DB::table('password_resets')->where('email', $request->email)->delete();
    	DB::table('password_resets')->insert(
    		['email'    => $request->email, 
    		'token'     => $token,
    		'created_at'=>time()]
    	);
    	$this->dispatch(new ResetPassword($request->email, $token));

    	return response()->view('message.success', array('message' => trans('The password reset link was mailed'),'redirect'=>'login' ));



    }


    public function login(Request $request){

    	try {

    		$data = $request->only('email', 'password');

    		if(!Auth::attempt($data, $request->has('remember'))){
    			throw new AuthenticationException(trans('lang.error_login'));
    		}

    		$user = Auth::user();
    		return view('message.success', [
    			'message' => trans('lang.Going to dashboard'),
    			'redirect' => '/'
    		]);

    	}

    	catch(AuthenticationException $e){
    		return view('message.error', [
    			'errors' => [
    				$e->getMessage()
    			],
    		]);
    	}

    	catch(PermissionException $e){
    		return view('message.error', [
    			'errors' => [
    				$e->getMessage()
    			],
    		]);
    	}

    	catch(Exception $e){
    		return view('message.error', [
    			'errors' => [
    				(env('APP_DEBUG')) ? $e->getMessage() : trans('Internal Server Error')
    			],
    		]);
    	}
    }

}
