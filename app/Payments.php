<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Payments extends Model
{
    use SoftDeletes;
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';
    protected $fillable = [
        'details_id', 'total_amount', 'paid_amount', 'ware_house_id', 'credit', 'distributor_id', 
        'paid_status', 'payment_number'
    ];

    public function getTotalAmountAttribute($value){
        return $value;
    }
    public function setNameAttribute($value){
        return $this->attributes['total_amout'] = $value;
    }

    public function getPaidAmountAttribute($value){
        return $value;
    }
    public function setPaidAmountAttribute($value){
        return $this->attributes['paid_amount'] =$value;
    }

    public function getWareHouseIdAttribute($value){
        return $value;
    }
    public function setWareHouseIdAttribute($value){
        return $this->attributes['ware_house_id'] =$value;
    }

    public function getCreditAttribute($value){
        return $value;
    }
    public function setCreditAttribute($value){
        return $this->attributes['credit'] =$value;
    }

    public function getDistributorIdAttribute($value){
        return $value;
    }
    public function seDistributorIdAttribute($value){
        return $this->attributes['distributor_id'] =$value;
    }

    public function getPaidStatusAttribute($value){
        return $value;
    }
    public function setPaidStatusAttribute($value){
        return $this->attributes['paid_status'] =$value;
    }

    public function getPaymentNumberAttribute($value){
        return $value;
    }
    public function setPaymentNumbreAttribute($value){
        return $this->attributes['payment_number'] =$value;
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

    public function order(){
        return $this->belongsTo('App\OrderDetails', 'details_id');
    }

    public function distributor(){
        return $this->belongsTo('App\Distributors', 'distributor_id');
    }

    public function warehouse(){
        return $this->belongsTo('App\WareHouseManagement', 'ware_house_id');
    }
}
