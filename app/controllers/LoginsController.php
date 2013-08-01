<?php

class LoginsController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = ['errMsg' => '', 'userID' => '', 'remember' => 0];
        return View::make('login.login', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $password = Input::get('login_pw');
        $userID = Input::get('login_id');

        // first query to see if we supplied an email address, if so retrieve the user name and perform
        // authentication validation
        $user = User::where('email','=',$userID)->first();
        if($user) $userID = $user->username;

        $credentials = ['username' => $userID, 'password' => $password];
        $result = Auth::attempt($credentials);
        if($result) {
            $user = User::where('username','=',$userID)->first();
            if($user->active) {
                $user->connections++;
                $user->save();
                $reqUrl = Session::get('url');
                if(is_null($reqUrl)) {
                    return Redirect::to('/');
                } else {
                    // redirect to the page the user originally requested
                    return Redirect::to($reqUrl['intended']);
                }
            } else {
                $data = [
                    'errMsg'   => '<strong>User Account Suspended</strong>. Please contact system administrator.',
                    'userID'   => '',
                    'remember' => 0
                    ];
                return View::make('login.login', $data);
            }
        } else {
            $data = [
                'errMsg'   => 'Invalid User ID or Password, please try again.',
                'userID'   => Input::get('login_id'),
                'remember' => Input::get('login_remember') ? 1 : 0
                ];
            return View::make('login.login', $data);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        return 'perform login';
        // Cookie::put('remember',Input::get('remember'));
        // Cookie::put('username',Input::get('username'));
        // Cookie::put('password',Input::get('password'));

        // if(Cookie::get('remember') == 'yes' )
        //     Auth::user(Cookie::get('username'));


        // $credentials = array('username' => Input::get('username'), 'password' => Input::get('password') );
        // if ( Auth::attempt($credentials) ) {
        //     return Redirect::to('users');
        // } else {
        //     return Redirect::to('login')->with('login_errors', true)->with('title','User Login')->with_input();
        // }
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}