<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CreditManagement extends Model
{
    use SoftDeletes;
    protected $table = 'credit_managements';
    protected $primaryKey = 'credit_id';
    protected $fillable = [
        'payment_number', 'distributor_id', 'credit_amount', 'paid_status', 'ware_house_id'
    ];

    public function getCreatedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function getDeletedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function getUpdatedAtAttribute($value){
        return \Carbon\Carbon::parse($value)->format('d-m-Y');
    }


    public function warehouseProduct(){
        return $this->belongsTo('App\Distributors');
    }

    public function warehouse(){
        return $this->belongsTo('App\WareHouseManagement', 'ware_house_id');
    }

    public function distributor(){
        return $this->belongsTo('App\Distributors', 'distributor_id');
    }

    public function credit(){
        return $this->belongsTo('App\CreditPayment', 'pay_id');
    }

}
