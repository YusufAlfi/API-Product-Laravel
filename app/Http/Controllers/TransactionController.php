<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Transaction::all();

        return view('pages.transactions.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //ini memanggil relasi ke details liat di model transaction dan model trnsactiondetails
        $items = Transaction::with('details.product')->findOrFail($id);

        return view('pages.transactions.show', compact('items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $item = Transaction::findOrFail($id);
        
        return view('pages.transactions.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //form request
        $data = $request->all();
        //temukan id produk
        $item = Transaction::findOrFail($id);
        //lalu update
        $item->update($data);


         // session flashData
         return redirect()->route('transactions.index')->with('status', 'Data berhasil di ubah');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $item = Transaction::findOrFail($id);

        $item->delete();


        // session flashData
        return redirect()->route('transactions.index')->with('status', 'Data berhasil di hapus');
    }


    // function ubah status pending success failed
    public function setStatus(Request $request, $id)
    {

        // validasi
        $request->validate([
            'status' => 'required|in:PENDING,SUCCESS,FAILED'
        ]);


        $item = Transaction::findOrFail($id);
        $item->transaction_status = $request->status;


        $item->save();

        return redirect()->route('transactions.index');








    }









}
