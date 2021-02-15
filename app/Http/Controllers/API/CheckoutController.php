<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Http\Requests\API\CheckoutRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function checkout(CheckoutRequest $request)
    {
        // semua request kecuali expect() transaction_details
        $data = $request->expect('transaction_details');

        // menentukan indetifayer kode barang
        $data['uuid'] = 'TRX' . mt_rand(10000, 99999) . mt_rand(100, 999);

        // create
        $transaction = Transaction::create($data);

        // loping dan memangil relasi transaction_details
        foreach($request->transaction_details as $product)
        {
            $details[] = new TransactionDetail([
                'transactions_id' => $transaction->id,
                'products_id' => $product,

            ]);

            // temukan product lalu kurangin (decrement)
            Product::find($product)->decrement('quantity');
        }


        //relasi detail 
        $transaction->details()->saveMany($details);

        return ResponseFormatter::success($transaction);












    }
}
