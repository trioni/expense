<?php

class SessionsController extends BaseController {


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('sessions.create')->with('slug', Lang::get('app.pages.login.title'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
        $attempt = Auth::attempt(array('username' => $input['username'],'password' => $input['password']), true);


        if($attempt)
        {
            return Redirect::intended('/')->with('flash_message',array('msg'=>'Inloggad','status'=>'success'));
        }
        else
        {
            Redirect::back()->with('flash_message',array('msg'=>'Felaktiga inloggningsuppgifter'))->withInput();
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();
        return Redirect::to('/');
	}

}
