<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suppliers extends Model
{
    use SoftDeletes;
    protected $table = 'suppliers';
    protected $primaryKey = 'supplier_id';
    protected $fillable = [
        'name', 'phone_one', 'phone_two', 'email', 'address', 'city', 
        'state', 'country'
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

    public function getCityAttribute($value){
        return ucfirst($value);
    }

    public function getStateAttribute($value){
        return ucwords($value);
    }

    public function getCountryAttribute($value){
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

    public function setCityAttribute($value){
        return $this->attributes['city'] = $value;
    }

    public function setStateAttribute($value){
        return $this->attributes['state'] = $value;
    }

    public function setCountryAttribute($value){
        return $this->attributes['country'] = $value;
    }




    public function product(){
        return $this->hasMany('App\Products', 'product_id');
    }

    public function inventory(){
        return $this->hasMany('App\Suppliers', 'supplier_id', 'stock_id');
    }
}
