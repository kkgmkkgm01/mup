<?php

namespace App\Http\Controllers\Auth;

use Socialite;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    
    /**
     * ログイン後の処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        // ログインしたら、ユーザー自身のプロフィールページへ移動
        return redirect('users/' . $user->id)->with('my_status', __('You logged in.'));
    }

    /**
     * ユーザーをログアウトさせる
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();

        // ログアウトしたら、トップページへ移動
        return $this->loggedOut($request) ?: redirect('/')->with('my_status', __('You logged out.'));
    }



   /**
    * ソーシャルログインリクエストをハンドル(SNSへリダイレクト)
    *
    * @return response
    */
    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }
   
    /**
     * ソーシャルログインからユーザー情報を得る(ユーザーが既にusersテーブルに存在するかどうかをチェックしリダイレクト)
     * @param $social
     * @return Response
     */
    public function handleProviderCallback($social)
    {
        $userSocial = Socialite::driver($social)->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        if($user){
            Auth::login($user);
            return redirect()->action('HomeController@index');
        }else{
            return view('auth.register',['name' => $userSocial->getName(), 'email' => $userSocial->getEmail()]);
        }
    }

}
