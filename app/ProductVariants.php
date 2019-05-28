<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ProductVariants extends Model
{

    use SoftDeletes;
    protected $table = 'product_variants';
    protected $primaryKey = 'variant_id';
    protected $fillable = [
        'variant_name', 'category_id', 'variant_size',
    ];

    public function getVariantNameAttribute($value){
        return ucwords($value);
    }

    public function getVariantSizeAttribute($value){
        return ucwords($value);
    }

    public function getCreatedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function getDeletedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function getUpdatedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function setVariantNameAttribute($value){
        return $this->attributes['variant_name'] = strtolower($value);
    }
    public function setVariantSizeAttribute($value){
        return $this->attributes['variant_size'] = strtolower($value);

    }

    //Working perfectly
    public function category(){
        return $this->belongsTo('App\Categories', 'category_id');
    }

    //Working perfectly
    public function product(){
        return $this->belongsTo('App\Products', 'product_id');
    }

    //Working perfectly
    public function inventory(){
        return $this->belongsTo('App\InvetoryStock', 'stock_id');
    }


}
