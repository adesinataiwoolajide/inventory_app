<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Outlets extends Model
{
    use SoftDeletes;
    protected $table = 'outlets';
    protected $primaryKey = 'outlet_id';
    protected $fillable = [
        'outlet_name', 'distributor_id'
    ];

    public function getOutletNameAttribute($value){
        return ucwords($value);
    }
    public function setOutletNameAttribute($value){
        return $this->attributes['outlet_name'] = ($value);
    }

    public function getDistributorIdAttribute($value){
        return $value;
    }
    public function setDistributorIdAttribute($value){
        return $this->attributes['distributor_id'] = ($value);
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

    //working
    public function assign(){
        return $this->hasMany('App\AssignOutlet', 'outlet_id', 'assign_id');
    }
}
