<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\MagicLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MagicLinkController extends Controller
{
    /**
     * Process the email submission and send the link.
     */
    public function sendLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Find the user, or create a brand new one if they don't exist yet
        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => 'Pro Contractor', 
                'password' => bcrypt(Str::random(32)) // Secure random dummy password
            ]
        );

        // Generate a secure 60-character random string
        $token = Str::random(60);
        
        // Save token to the user
        $user->magic_token = $token;
        $user->save();

        // Send the email
        Mail::to($user->email)->send(new MagicLink($token));

        return back()->with('status', 'Magic link sent! Check your inbox.');
    }

    /**
     * Authenticate the user when they click the email link.
     */
    public function verify($token)
    {
        // Find the user with this exact token
        $user = User::where('magic_token', $token)->firstOrFail();

        // Log them in securely
        Auth::login($user);

        // Invalidate the token so it can't be used twice
        $user->magic_token = null;
        $user->save();

        // Send them to their profile builder!
        return redirect('/dashboard');
    }
}