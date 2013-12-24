<?php 

class UsersController extends BaseController {

	public function get_new()
	{
		return View::make('users.new')->with('title', 'Make It Snappy Q&A - Register');
	}

	public function post_create()
	{
		$input = Input::all();

		$rules = array(
			'username' => 'required|unique:users|alpha_dash|min:4',
			'password' => 'required|alpha_num|between:4,8',
			'password_confirmation' => 'required|alpha_num|between:4,8|same:password'
	    );

	    $validator = Validator::make($input, $rules);

	    if ($validator->fails()) 
	    {
	    	return Redirect::back()->withErrors($validator)->withInput();
	    } 
	    else 
	    {
	    	$user = new User;
	    		$user->username = Input::get('username');
	    		$user->password = Hash::make(Input::get('password'));
	    	$user->save();

	    	$user = User::where('username', '=', Input::get('username'))->first();
	    	Auth::login($user);

	    	return Redirect::to('/')->with('message', 'Thanks for registering. You are now loggen in!');
	    }
	    
	}

	public function get_login()
	{
		return View::make('users.login')->with('title', 'Make It Snappy Q&A - Login');
	}

	public function post_login()
	{
		$user = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);

		if (Auth::attempt($user)) {
			return Redirect::to('/')->with('message', 'You are logged in!');
		} 
		else 
		{
			return Redirect::to('/login')
				->with('message', 'You username/password combination was incorrect')
				->withInput();
		}
		
	}

	public function get_logout()
	{
		if (Auth::check()) {
			Auth::logout();
			return Redirect::to('login')->with('message', 'You are now logged out!');
		}
		else 
		{
			return Redirect::to('/');
		}
	}
}