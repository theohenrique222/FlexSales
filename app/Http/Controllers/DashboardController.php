<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Sale;
use App\Models\Seller;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke() 
    {
        $sellers    = Seller::all();
        $sales      = Sale::all();
        $users      = User::all();
        $clients    = Client::all();
        
        $allClients = Client::count();
        $allSales = Sale::count();

        return view('admin.dashboard', ['seller' => $sellers, 'user' => $users, 'client' => $clients, 'allSales' => $allSales, 'allClients' => $allClients]);
    }
}
