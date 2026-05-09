<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show registration form
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'username' => 'required|string|max:255|unique:users,name',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->username,
            'email' => $request->username . '@computerfriends.ma', // Temporary email based on username
            'password' => Hash::make($request->password),
            // Store additional info in a separate profile table or use JSON column
        ]);

        // Store additional user info in session for now (simplified approach)
        session([
            'user_nom' => $request->nom,
            'user_prenom' => $request->prenom,
            'user_telephone' => $request->telephone,
        ]);

        return redirect()->route('home')->with('success', 'Inscription réussie ! Connectez-vous maintenant.');
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Custom login logic since we're using username instead of email
        $user = User::where('name', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            return redirect()->route('home')->with('success', 'Connexion réussie !');
        }

        return back()->withErrors([
            'username' => 'Nom d\'utilisateur ou mot de passe incorrect.',
        ]);
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Déconnexion réussie.');
    }
}