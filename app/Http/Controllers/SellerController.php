<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = Seller::all();

        return view('admin.sellers.index', ['sellers' => $sellers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sellers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $request->password,
        ]);

        Seller::create([
            'user_id'   => $user->id,
        ]);

        return redirect()->route('sellers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seller $seller)
    {
        return view('admin.sellers.edit', ['seller' => $seller]);
    }

    public function update(Request $request, Seller $seller)
    {
        $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required',
            'password'  => 'required'
        ]);

        $user = $seller->user;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password  = $request->password;


        $user->save();
        return redirect()->route('sellers.index');
    }

    public function destroy(Seller $seller)
    {
        $user = $seller->user;
        $user->delete();
        return redirect()->route('sellers.index');
    }
}
