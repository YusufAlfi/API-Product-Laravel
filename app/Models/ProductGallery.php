<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\softDeletes;

class ProductGallery extends Model
{
    //
    use softDeletes;

    protected $fillable = [
        'products_id', 'photo', 'is_default'

    ];

    protected $hidden = [];

    // relasi 
    public function product() {

        // 1 produk banyak gallery relasi ke productgallery pdan nama fieldnya
      return $this->belongsTo(Product::class, 'products_id','id');
    }


    // assesor liat di documentasi ($value) adalahnilai dari field photo di database
    public function getPhotoAttribute($value) 
    {
        // tambahkan url yg parameternya storage
        // lalu symlinkan php artisan storage:link
        return url('storage/' . $value);
    }

}
