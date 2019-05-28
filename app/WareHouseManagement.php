<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WareHouseManagement extends Model
{
    use SoftDeletes;
    protected $table = 'ware_house_managements';
    public $primaryKey = 'ware_house_id';
    protected $fillable = [
        'name', 'address', 'city', 'state', 'country', 'start_date', 'user_id',
    ];

    public function getNameAttribute($value){
        return ucwords($value);
    }
    public function setNameAttribute($value){
        return $this->attributes['name'] = strtolower($value);

    }

    public function getUserIdAttribute($value){
        return ($value);
    }
    public function setUserIdAttribute($value){
        return $this->attributes['user_id'] = ($value);

    }

    public function getCityAttribute($value){
        return ($value);
    }
    public function setCityAttribute($value){
        return $this->attributes['city'] = ($value);

    }

    public function getCountryAttribute($value){
        return ($value);
    }
    public function setCountryAttribute($value){
        return $this->attributes['country'] = ($value);

    }

    public function getStartDateAttribute($value){
        return ($value);
    }
    public function setStartDateAttribute($value){
        return $this->attributes['start_date'] = ($value);

    }

    public function getAddressAttribute($value){
        return ($value);
    }
    public function setAddressAttribute($value){
        return $this->attributes['address'] = ($value);

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

   

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function product(){
        return $this->hasMany('App\Products', 'product_id');
    }

    public function inventory(){
        return $this->hasMany('App\WareHouseManagement', 'ware_house_id', 'stock_id');
    }

    public function order(){
        return $this->hasMany('App\OrderDetails', 'distributor_id');
    }

    public function payment(){
        return $this->hasMany('App\Payments', 'payment_id');
    }
    
    public function warehouseOrder(){
        return $this->hasMany('App\WareHouseManagement', 'ware_house_id');
    }

    public function credit(){
        return $this->hasMany('App\CreditManagement', 'credit_id');
    }

    public function creditPaid(){
        return $this->hasMany('App\CreditPayment', 'pay_id');
    }

    public function employee(){
        return $this->hasMany('App\Employee', 'employee_id');
    }

    public function salary(){
        return $this->hasMany('App\Salaries', 'salary_id');
    }
}
