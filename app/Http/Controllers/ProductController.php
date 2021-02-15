<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductGallery;
use App\Http\requests\ProductRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
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

     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();

        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //
        $data = $request->all();
        $data['slug'] = Str::slug($request->name);

        Product::create($data);

        // session flashData
        return redirect()->route('products.index')->with('status', 'Data berhasil di tambahkan');
        
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // carii id yang ingin di dit
        $item = Product::findOrFail($id);

        return view('pages.products.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        //form request
        $data = $request->all();
        // slug
        $data['slug'] = Str::slug($request->name);
        //temukan id produk
        $item = Product::findOrFail($id);
        //lalu update
        $item->update($data);


         // session flashData
         return redirect()->route('products.index')->with('status', 'Data berhasil di ubah');


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
        $item = Product::findOrFail($id);

        $item->delete();

        // jika product di hapus amakan gallerynya juga terhapus
        ProductGallery::where('products_id', $id)->delete();

        // session flashData
        return redirect()->route('products.index')->with('status', 'Data berhasil di hapus');
    }

    public function gallery(Request $request, $id)
    {

        $product = Product::findOrFail($id);
        // ini berlelasi dengan product
        $items = ProductGallery::with('product')->where('products_id', $id)->get();


        return view('pages.products.gallery', compact('product', 'items'))->with('status', 'List ditambahkan');



    }
}
