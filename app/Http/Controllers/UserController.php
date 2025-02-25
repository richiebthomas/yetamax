<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request) {
        $incomingFields = $request->validate([
            'loginroll_no' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['roll_no' => $incomingFields['loginroll_no'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate();
            return redirect('/allevents')->with('success', 'You have successfully logged in.');
        } else {
            return redirect('/')->with('failure', 'Invalid login.');
        }
    }
    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    public function showCorrectHomepage() {
        $events = Event::all();
        $users = User::all();
        
        return view('homepage', ['events' => $events, 'users' => $users]);
    }

    public function register(Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:20'],
            'roll_no' => ['required', 'min:7', 'max:7', Rule::unique('users', 'roll_no')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = User::create($incomingFields);
        auth()->login($user);
        return redirect('/')->with('success', 'Thank you for creating an account.');
    }
}
