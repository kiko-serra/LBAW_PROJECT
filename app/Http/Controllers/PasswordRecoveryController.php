<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\RecoveryCode;

use App\Mail\PasswordRecovery;

use Mail;
use Validator;

class PasswordRecoveryController extends Controller
{
    public function recoveryShow() {
        return view('pages.recovery.show');
    }

    public function recoverySentShow($email) {
        return view('pages.recovery.sent', ['email' => $email]);
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
        
        if (!$mailExists) return back()->with('emailnotfound', 'An account with this email does not exist');
        
        $user = User::where('account.email', '=', $request['email'])->first();

        $recoveryCode = "";

        do {

            $bytes = random_bytes(32);

            $recoveryCode = bin2hex($bytes);
            
        } while (RecoveryCode::where('code', '=', $recoveryCode)->exists()); // Generate another token if this one exists

        $newRecoveryCode = new RecoveryCode([
            'id_account' => $user->id_account,
            'code' => $recoveryCode,
            'valid_until' => date("Y-m-d H:i:s", strtotime('+2 hours'))
        ]);

        $newRecoveryCode->save();

        $mailData = [
            'account_tag' => $user->account_tag,
            'recovery_code' => $recoveryCode,
            'email' => $request['email'],
        ];
    
        Mail::to($mailData['email'])->send(new PasswordRecovery($mailData));

        return $mailData;
    }

    public function afterTokenShow($token) {        
        $mailExists = RecoveryCode::where('code', '=', $token)->exists();
        
        if (!$mailExists) return 'Page not found';

        



        return $token;
    }
}
