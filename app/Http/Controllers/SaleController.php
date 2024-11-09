<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Seller;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('products')->get();
        $products = Product::all();
        $payment = Payment::all();

        foreach ($payment as $payments) {
            $total = $payments->amount;
        }

        return view('admin.sales.index', [
            'sales'    => $sales,
            'products' => $products,
            'total'    => $total,
            'payment' => $payment,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sales          = Sale::all();
        $clients        = Client::all();
        $products       = Product::all();

        return view('admin.sales.create', [
            'sales'     => $sales,
            'clients'   => $clients,
            'products'  => $products,
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
            'client_id' => $request->client_id,
            'seller_id' => $request->user()->seller->id,
        ]);

        return to_route('sales.edit', [
            'sale'      => $sale->id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($saleId)
    {
        $sale = Sale::with([
            'products'  => function ($query) {
                $query->withPivot('quantity');
            }
        ])->findOrFail($saleId);

        $sellers        = Seller::all();
        $clients        = Client::all();
        $products       = Product::all();

        $total          = 0;

        foreach ($sale->products as $product) {
            $subtotal   = $product->price * $product->pivot->quantity;
            $total     += $subtotal;
        }

        return view('admin.sales.show', [
            'sale'     => $sale,
            'sellers'  => $sellers,
            'clients'  => $clients,
            'products' => $products,
            'total'    => $total,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $clients       = Client::all();
        $products      = Product::all();

        return view('admin.sales.edit', [
            'sale'     => $sale,
            'clients'  => $clients,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'client_id'     => 'required|exists:clients,id',
            'product_id'    => 'required|array',
            'product_id.*'  => 'exists:products,id',
            'quantity'      => 'required|array',
            'quantity.*'    => 'integer|min:1',
        ]);

        $sale->update([
            'client_id'     => $request->client_id,
        ]);

        foreach ($request->product_id as $index => $product_id) {
            $sale->products()->attach(
                $product_id,
                ['quantity' => $request->quantity[$index]]
            );
        }

        return redirect()->route('sales.show', ['sale' => $sale->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
