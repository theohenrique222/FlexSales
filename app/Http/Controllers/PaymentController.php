<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sale = Sale::all();

        Payment::create([
            'sale_id'           => $request->sale_id,
            'payment_method'    => $request->payment_method,
            'amount'            => $request->amount,
            'installments'      => $request->installments,
        ]);



        return to_route('sales.index', [
            'sale'      => $sale,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($saleId)
    {
        $sale = Sale::findOrFail($saleId);
        $products               = Product::all();
        $total                  = 0;

        foreach ($sale->products as $product) {
            $subtotal           = $product->price * $product->pivot->quantity;
            $total             += $subtotal;
        }

        return view(
            'admin.payments.edit',
            [
                'sale'           => $sale,
                'products'       => $products,
                'total'          => $total,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
