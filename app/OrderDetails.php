<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class OrderDetails extends Model
{
    use SoftDeletes;
    protected $table = 'order_details';
    protected $primaryKey = 'details_id';
    protected $fillable = [
        'transaction_number', 'distributor_id', 'invoice_number', 'ware_house_id', 'order_status',
    ];

     public function getTransactionNumberAttribute($value){
        return $value;
    }

    public function setTransactionNumberAttribute($value){
        return $this->attributes['transaction_number'] = $value;
    }

    public function getDistributorIdAttribute($value){
        return $value;
    }

    public function setDistributorIdAttribute($value){
        return $this->attributes['distributor_id'] = $value;
    }

    public function getInvoiceNumberAttribute($value){
        return $value;
    }

    public function setInvoiceNumberAttribute($value){
        return $this->attributes['invoice_number'] = $value;
    }
   

    public function getWareHouseIdAttribute($value){
        return $value;
    }

    public function setWareHouseIdAttribute($value){
        return $this->attributes['ware_house_id'] = $value;
    }

    public function getOrderStatusAttribute($value){
        return $value;
    }

    public function setOrderStatusAttribute($value){
        return $this->attributes['order_status'] = $value;
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

    public function warehouse(){
        return $this->belongsTo('App\WareHouseManagement', 'ware_house_id');
    }

    public function payment(){
        return $this->hasOne('App\Payments', 'details_id', 'payment_id');
    }

    public function order(){
        return $this->belongsTo('App\Distributors', 'distributor_id');
    }
}
