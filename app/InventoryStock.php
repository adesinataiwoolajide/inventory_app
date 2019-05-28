<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryStock extends Model
{
    protected $table = 'inventory_stocks';
    protected $primaryKey = 'stock_id';
    protected $fillable = [
        'product_name', 'supplier_id', 'ware_house_id', 'quantity', 
        'category_id', 'variant_id'
    ];

    public function getProductNameAttribute($value){
        return ucwords($value);
    }

    public function getQuantityAttribute($value){
        return $value;
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

    public function setProductNameAttribute($value){
        return $this->attributes['product_name'] = strtolower($value);
    }
    
    public function setSupplierIdAttribute($value){
        return $this->attributes['supplier_id'] = $value;
    }

    public function setVariantIdAttribute($value){
        return $this->attributes['variant_id'] = $value;
    }

    public function setCategoryIdIdAttribute($value){
        return $this->attributes['category_id'] = $value;
    }

    public function setWareHouseIdAttribute($value){
        return $this->attributes['ware_house_id'] = $value;
    }

    public function setQuantityAttribute($value){
        return $this->attributes['quantity'] = $value;

    }

    public function category(){
        return $this->belongsTo('App\Categories', 'category_id');
    }

    public function variant(){
        return $this->belongsTo('App\Products', 'variant_id');
    }

    public function invenvariant(){
        return $this->belongsTo('App\ProductVariants', 'variant_id');
    }

    public function supplier(){
        return $this->belongsTo('App\Suppliers', 'supplier_id');
    }

    public function warehouse(){
        return $this->belongsTo('App\WareHouseManagement', 'ware_house_id');
    }

    public function order(){
        return $this->hasMany('App\Order', 'stock_id', 'order_id');
    }

    // public function category(){
    //     return $this->belongsTo('App\Categories', 'category_id');
    // }
}
