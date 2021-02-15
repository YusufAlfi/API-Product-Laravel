<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function All(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $slug = $request->input('slug');
        $type = $request->input('type');
        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');


        // memngambil data sesuai id
        if($id)
        {
            // panggil relasi gallies
            $product = Product::with('galleries')->find($id);

            if($product)
                return ResponseFormatter::success($product, 'Data Product berhasil diambil');
            else
                return ResponseFormatter::error(null, 'Data Product tidak ada', 404);
        }


        // memngambil data sesuai slug
        if($slug)
        {
            // panggil relasi gallies
            $product = Product::with('galleries')->where('slug', $slug)->first();

            if($product)
                return ResponseFormatter::success($product, 'Data Product berhasil diambil');
            else
                return ResponseFormatter::error(null, 'Data Product tidak ada', 404);
        }

        // pagill model product berserta relasi gallery
        $product = Product::with('galleries');

        if($name)
         $product->where('name', 'like', '%'. $name . '%');


        if($type)
         $product->where('type', 'like', '%'. $type . '%');


        if($price_from)
         $product->where('price', '>=', $price_from);
         
         
        if($price_to)
          $product->where('price', '<=', $price_to);



          return ResponseFormatter::success(

            $product->paginate($limit),
            'Data List Produk Berhasil diambil'
          );



    }
}
