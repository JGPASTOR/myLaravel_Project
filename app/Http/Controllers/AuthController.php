<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AuthController extends Controller
{
    public function authLogin(Request $request): Response
    {
      
          // Return the schedules to the Inertia view
          return inertia('Auth/Login', [


          ]);
    }

    public function serviceBooking(): Response
    {
        // Check if the user is logged in
        $isLoggedIn = Auth::check();

        return Inertia::render('ServiceBooking', [
            'isLoggedIn' => $isLoggedIn,
        ]);
    }
}