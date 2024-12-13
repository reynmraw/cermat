<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if(Auth::check())
        {
            return view('dashboard', ['role' => $user->role, 'user' => $user]);
        }else {
            abort(403);
        }
        // Pass the user's role to the view
    }
}
