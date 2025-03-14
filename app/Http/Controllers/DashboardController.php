<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Seller;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke() 
    {
        $sellers    = Seller::all();
        $users      = User::all();
        $clients    = Client::all();

        return view('admin.dashboard', ['seller' => $sellers, 'user' => $users, 'client' => $clients, ]);
    }
}
