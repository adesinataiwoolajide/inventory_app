<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Employee extends Model
{
    use SoftDeletes;
    protected $table = 'employees';
    protected $primaryKey = 'employee_id';
    protected $fillable = [
        'full_name', 'address', 'phone_number', 'contract_type', 'email', 'ware_house_id',
    ];

    public function getFullNameAttribute($value){
        return ucwords($value);
    }

    public function setFullNameAttribute($value){
        return $this->attributes['full_name'] = $value;
    }

    public function getWareHouseIdAttribute($value){
        return ucwords($value);
    }

    public function setWareHouseIdAttribute($value){
        return $this->attributes['ware_house_id'] = $value;
    }

    public function getAddressAttribute($value){
        return ucwords($value);
    }

    public function setAddressAttribute($value){
        return $this->attributes['address'] = $value;
    }

    public function getPhoneNumberAttribute($value){
        return $value;
    }

    public function setPhoneNumberAttribute($value){
        return $this->attributes['phone_number'] = $value;
    }

    public function getContractTyoeAttribute($value){
        return ucwords($value);
    }

    public function setContractTypeAttribute($value){
        return $this->attributes['contract_type'] = $value;
    }

    public function getEmailAttribute($value){
        return $value;
    }

    public function setEmailAttribute($value){
        return $this->attributes['email'] = $value;
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

    public function salary(){
        return $this->hasOne('App\Salaries', 'salary_id');
    }

    public function warehouse(){
        return $this->belongsTo('App\WareHouseManagement', 'ware_house_id');
    }
}
