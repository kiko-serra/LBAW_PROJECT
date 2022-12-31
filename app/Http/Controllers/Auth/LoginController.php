<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use App\Mail\PasswordRecovery;

use Mail;
use Validator;

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
    protected $redirectTo = '/timeline';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getUser(){
        return $request->user();
    }

    public function home() {
        return redirect('login');
    }

    public function recoveryShow() {
        return view('auth.recovery');
    }

    public function recovery(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|string|email|max:255|regex:/[a-zA-Z0-9]*@[a-zA-Z0-9]+(?>\.[a-zA-Z]+)+/'
            ],
            [
            'email.required'=> 'Your group should have a name',
            ]
        );
    
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $mailExists = User::where('account.email', '=', $request['email'])->exists();
        
        if (!$mailExists) return back()->withInput(['error' => 'An account with this email does not exist']);
        
        $user = User::where('account.email', '=', $request['email'])->first();

        $bytes = random_bytes(32);

        $recoveryCode = bin2hex($bytes);

        $mailData = [
            'account_tag' => $user->account_tag,
            'recovery_code' => $recoveryCode,
            'email' => $request['email'], // Change to your email for testing.
        ];
    
        Mail::to($mailData['email'])->send(new PasswordRecovery($mailData));

        return $mailData;
    }
}
