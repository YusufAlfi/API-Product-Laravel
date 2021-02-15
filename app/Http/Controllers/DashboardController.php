<?php

namespace App\Http\Controllers;


use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        // hanya menampilkan transaction_status yg sukses 
        // mengambil field transaction_status, SUCCESS adalah isi dari field transaction_status  
        $income = Transaction::where('transaction_status', 'SUCCESS')->sum('transaction_total');

        // menghitung terangsaksi yang masuk
        $sales = Transaction::count();

        // mengambil transaksi terakhir dengan order by id ambil 5
        $items = Transaction::orderBy('id', 'asc')->take(5)->get();

        $pie = [
            'pending' => Transaction::where('transaction_status', 'PENDING')->count(),
            'failed' => Transaction::where('transaction_status', 'FAILED')->count(),
            'success' => Transaction::where('transaction_status', 'SUCCESS')->count(),
        ];

        // $item = Transaction
        return view('pages.dashboard', compact('income', 'sales', 'items', 'pie'));
    }
}
