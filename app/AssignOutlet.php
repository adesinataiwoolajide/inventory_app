<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignOutlet extends Model
{
    protected $table = 'assign_outlets';
    protected $fillable = [
        'outlet_id','distributor_id',
    ];

    public function getDistributorIdAttribute($value){
        return $value;
    }
    public function seDistributorIdAttribute($value){
        return $this->attributes['distributor_id'] =$value;
    }

    public function getOutletIdAttribute($value){
        return $value;
    }
    public function setOutletIdAttribute($value){
        return $this->attributes['outlet_id'] =$value;
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

    //Working
    public function outlet(){
        return $this->belongsTo('App\Outlets', 'outlet_id');
    }
}
