<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CreditPayment extends Model
{
    use SoftDeletes;
    protected $table = 'credit_payments';
    protected $primaryKey = 'pay_id';
    protected $fillable = [
        'credit_id', 'amount_paid', 'payment_number', 'ware_house_id', 'distributor_id'
    ];

    public function getPaymentNumberAttribute($value){
        return $value;
    }

    public function getAmountPaidAttribute($value){
        return $value;
    }
    public function getWareHouseIdAttribute($value){
        return $value;
    }

    public function getTotalDistributorIdAttribute($value){
        return $value;
    }

    public function setPaymentNumberAttribute($value){
        return $this->attributes['payment_number'] = $value;
    }

    public function setAmountPaidAttribute($value){
        return $this->attributes['amount_paid'] = $value;
    }
    public function setUnitWareHouseIdAttribute($value){
        return $this->attributes['ware_house_id'] = $value;
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


    public function credit(){
        return $this->belongsTo('App\CreditManagement', 'credit_id');
    }

    public function distributor(){
        return $this->belongsTo('App\Distributors', 'distributor_id');
    }

    public function warehouse(){
        return $this->belongsTo('App\WareHouseManagement', 'ware_house_id');
    }
}
