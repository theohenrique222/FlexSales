<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
        $roles = Role::all();
        return view('admin.sellers.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($request->role);

        Seller::create([
            'user_id' => $user->id,
        ]);

        return redirect()->route('sellers.index')->with('success', 'Vendedor cadastrado com sucesso!');
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
        $roles = Role::all();
        return view('admin.sellers.edit', ['seller' => $seller, 'roles' => $roles]);
    }


    public function update(Request $request, Seller $seller)
    {
        $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required|email|max:255|unique:users,email,' . $seller->user->id,
            'password'  => 'nullable|min:6',
            'role'      => 'required|exists:roles,name',
        ]);

        $user = $seller->user;

        $user->name     = $request->name;
        $user->email    = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->syncRoles([$request->role]);

        $user->save();

        return redirect()->route('sellers.index')->with('success', 'Vendedor atualizado com sucesso!');
    }

    public function destroy(Seller $seller)
    {
        $user = $seller->user;
        $user->delete();
        return redirect()->route('sellers.index');
    }
}
