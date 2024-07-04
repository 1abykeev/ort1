<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use Dotenv\Exception\ValidationException;

class EnterController extends Controller
{
    public function register(Request $req) {
        try{
         $incomingFields = $req->validate([
             'name' => 'required',
             'surname' => 'required',
             'email' => ['required', Rule::unique('users', 'email')],
             'grade_level' => 'required',
             'number' => 'required',
             'school' => 'required',
             'location' => 'required',
             'password' => ['required', 'confirmed'],
         ]);
       
         // `confirmed` validation automatically checks that 'password_confirmation' matches 'password'
         // Remove the `password_confirmation` as it should not be saved in the database
         unset($incomingFields['password_confirmation']);
        

         $incomingFields['password'] = bcrypt($incomingFields['password']);
        //  $user = User::create($incomingFields);
        //  auth()->login($user);


        User::create($incomingFields);
        return redirect('/login');
        }catch(ValidationException $e){
         var_dump($e);
         echo "Erorr";
        }
     }
    
     public function login(Request $req) {
        $incomingFields = $req->validate([
            'email' => 'required|email', 
            'password' => 'required'
        ]);


        if (auth()->attempt(['email' => $incomingFields['email'], 'password' => $incomingFields['password']])) {
            $req->session()->regenerate();


            $user = auth()->user(); // This retrieves the currently authenticated user

            $encryptedId = Crypt::encrypt($user->id);
            
            return redirect()->route('profile.show', ['encryptedId' => $encryptedId]);
            //return redirect()->intended('/');

        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
    }
    }


    public function showProfile($encryptedId) {

        $id = Crypt::decrypt($encryptedId);
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('/')->with('error', 'User not found.');
        }

        // // Check if the authenticated user is the same as the user profile being viewed
        // if (auth()->id() !== $user->id) {
        //     return redirect()->route('/')->with('error', 'Unauthorized access.');
        // }


        return view('profile', ['user' => $user]);
    }
}