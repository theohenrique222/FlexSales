<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sales = Sale::all();
        $clients = Client::all();
        $products = Product::all();

        return view('admin.sales.index', [
            'sales' => $sales,
            'clients' => $clients,
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sales = Sale::all();
        $clients = Client::all();
        $products = Product::all();

        return view('admin.sales.create', [
            'sales' => $sales,
            'clients' => $clients,
            'products' => $products,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
        ]);

        $sale = Sale::create([
            'client_id'   => $request->client_id,
            'seller_id' => $request->user()->seller->id,
        ]);

        return to_route('sales.edit', [
            'sale' => $sale->id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {

        $clients = Client::all();
        $products = Product::all();

        return view('admin.sales.edit', [
            'sale' => $sale,
            'clients' => $clients,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $sale->update([
            'client_id' => $request->client_id,
            'product_id' => $request->product_id,
        ]);

        SaleProduct::create([
            'product_id' => $request->product_id,
            'sale_id' => $sale->id,
            'quantity' => $request->quantity,
        ]);
        return redirect()->route('sales.index', $sale->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
