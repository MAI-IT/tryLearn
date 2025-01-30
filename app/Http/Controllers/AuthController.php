<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    // Register a new user 
    public function register(Request $request) {
         $validated = $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:users,email',
             'password' => 'required|string|min:8',
        ]);

         $user = User::create([ 
              'name' => $validated['name'],
              'email' => $validated['email'],
              'password' => Hash::make($validated['password']),
                 ]); 

         return response()->json([
             'message' => 'User registered successfully', 'user' => $user, 'token' => $user->createToken('LMS')->plainTextToken, 
            ]);
     } 

    // Login an existing user
     public function login(Request $request) {
         $validated = $request->validate([ 
            'email' => 'required|email', 
            'password' => 'required|string',
         ]); 
         
         if (!Auth::attempt($validated)) {
             return response()->json(['message' => 'Invalid credentials'], 401);
             } 
        $user = Auth::user();
        return response()->json([ 'message' => 'Login successful', 'user' => $user, 'token' => $user->createToken('LMS')->plainTextToken,
     ]); 
    }

    // public function login(Request $request) { 
    //     $request->validate([ 
    //         'email' => 'required|email',
    //         'password' => 'required', 
    //     ]); 
        
    //     $user = User::where('email', $request->email)->first();
        
    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //          return response()->json(['message' => 'Invalid credentials'], 401); 
    //         } 
            
    //     return response()->json([ 'token' => $user->createToken('auth_token')->plainTextToken ]);
    //  }


    // Logout the authenticated user
    public function logout(Request $request) { 
        $request->user()->tokens->each(function ($token) { 
            $token->delete(); 
        }); 
    
        return response()->json(['message' => 'Logged out']); 
    }

}
