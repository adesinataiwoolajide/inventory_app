<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Order extends Model
{
    use SoftDeletes;
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'stock_id', 'transaction_number', 'quantity', 'unit_amount', 'total_amount', 'distributor_id'
    ];

    public function getTransactionNumberAttribute($value){
        return $value;
    }

    public function getQuantityAttribute($value){
        return $value;
    }
    public function getUnitAmountAttribute($value){
        return $value;
    }

    public function getTotalAmountAttribute($value){
        return $value;
    }

    public function setTransactionNumberAttribute($value){
        return $this->attributes['transaction_number'] = $value;
    }

    public function setQuantityAttribute($value){
        return $this->attributes['quantity'] = $value;
    }
    public function setUnitAmountAttribute($value){
        return $this->attributes['unit_amount'] = $value;
    }

    public function setTotalAmountAttribute($value){
        return $this->attributes['total_amount'] = $value;
    }

    public function setDistributorIdAttribute($value){
        return $this->attributes['distributor_id'] = $value;
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

    public function distributor(){
        return $this->belongsTo('App\Distributors', 'distributor_id');
    }

    // public function product(){
    //     return $this->hasMany('App\Product', 'product_id', 'category_id');
    // }

    public function inventory(){
        return $this->belongsTo('App\InventoryStock', 'stock_id');
    }


    public function warehouseOrder(){
        return $this->hasOne('App\WareHouseManagement');
    }

    
}
