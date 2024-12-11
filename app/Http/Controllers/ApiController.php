<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;

class ApiController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle the login request
    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // API endpoint
    $url = 'https://apg.peruri.co.id:9055/gateway/intelob/1.0/userLogin/v1';

    // API key
    $apiKey = '3a1c7663-0459-4880-8a84-a4de257e5a17';

    // Request payload
    $body = [
        'param' => [
            'email' => $request->email,
            'password' => $request->password,
        ],
    ];

    // Send API request
    $response = Http::withHeaders([
        'x-Gateway-APIKey' => $apiKey,
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ])->post($url, $body);

    if ($response->successful()) {
        $data = $response->json();

        if (isset($data['data'])) {
            $userData = $data['data'];

            // Determine role based on departmentId
            $role = $userData['departmentId'] == "8" ? 'admin' : 'user';

            // Store user-specific data in the session
            session([
                'user_id' => $userData['id'],
                'user_name' => $userData['name'],
                'user_email' => $userData['email'],
                'api_token' => $userData['accessToken'],
                'department_id' => $userData['departmentId'],
                'role' => $role,
            ]);

            // Authenticate the user using Auth facade
            $user = \App\Models\User::updateOrCreate(
                ['email' => $userData['email']], // Match the user by email
                [
                    'name' => $userData['name'],
                    'role' => $role,
                    'password' => bcrypt('default_password'), // Default password since it's not provided by the API
                ]
            );

            Auth::login($user,true);

            // Redirect to the dashboard
            return $role === 'admin' 
                ? redirect()->route('admin.dashboard') 
                : redirect()->route('dashboard');
        } else {
            return redirect()->route('login.form')->with('error', 'Unexpected API response format.');
        }
    }

    return redirect()->route('login.form')->with('error', 'Login failed! Please check your credentials.');
}
    
    public function logout()
    {
        Auth::logout();
        // Clear the session
        session()->flush();    
        // Cookie::queue(Cookie::forget('laravel_session'));
        // Cookie::queue(Cookie::forget('XSRF-TOKEN'));   

        return redirect()->route('login.form')->with('success', 'You have been logged out.');
    }
}
