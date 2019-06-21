<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Distributors extends Model
{
    use SoftDeletes;
    protected $table = 'distributors';
    protected $primaryKey = 'distributor_id';
    protected $fillable = [
        'name', 'phone_one', 'phone_two', 'email', 'address', 'credit_limit', 
        'credit_reduction_per_month'
    ];

    public function getNameAttribute($value){
        return ucwords($value);
    }
    public function getPhoneOneAttribute($value){
        return $value;
    }

    public function getPhoneTwoAttribute($value){
        return $value;
    }
    public function getEmailAttribute($value){
        return $value;
    }

    public function getAddressAttribute($value){
        return ucfirst($value);
    }

    public function getCreditLimitAttribute($value){
        return $value;
    }

    public function getCreditReductionPerMonthAttribute($value){
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


    public function setNameAttribute($value){
        return $this->attributes['name'] = strtolower($value);
    }
    public function setPhoneOneAttribute($value){
        return $this->attributes['phone_one'] = $value;
    }

    public function setPhoneTwoAttribute($value){
        return $this->attributes['phone_two'] = $value;
    }
    public function setEmailAttribute($value){
        return $this->attributes['email'] = $value;
    }

    public function setAddressAttribute($value){
        return $this->attributes['address'] = $value;
    }

    public function setCreditLimitAttribute($value){
        return $this->attributes['credit_limit'] = $value;
    }

    public function setCreditReductionPerMonthAttribute($value){
        return $this->attributes['credit_reduction_per_month'] = $value;
    }




    public function order(){
        return $this->hasMany('App\OrderDetails', 'distributor_id');
    }

    public function payment(){
        return $this->hasMany('App\Payments', 'payment_id');
    }

    public function assign(){
        return $this->hasMany('App\AssignOutlet', 'distributor_id', 'assign_id');
    }

    public function outlets(){
        return $this->hasMany('App\Outlets', 'outlet_id', 'distributor_id');
    }

    public function creditPaid(){
        return $this->hasMany('App\CreditPayment', 'pay_id');
    }


    // public function credit(){
    //     return $this->hasMany('App\CreditManagement');
    // }
}
