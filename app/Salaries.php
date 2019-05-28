<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Salaries extends Model
{
    use SoftDeletes;
    protected $table = 'salaries';
    protected $primaryKey = 'salary_id';
    protected $fillable = [
        'employee_id', 'over_time', 'hours', 'rate', 'basic_salary', 'total', 'month', 
        'weekly', 'monthly', 'ware_house_id',
    ];

    public function getEmployeeIdAttribute($value){
        return ($value);
    }
    public function setEmployeeIdAttribute($value){
        return $this->attributes['employee_id'] = ($value);
    }

    public function getWareHouseIdAttribute($value){
        return ($value);
    }
    public function setWareHouseIdAttribute($value){
        return $this->attributes['ware_house_id'] = ($value);
    }

    public function getWeeklyAttribute($value){
        return ($value);
    }
    public function setWeeklyAttribute($value){
        return $this->attributes['weekly'] = ($value);
    }

    public function getDailyAttribute($value){
        return ($value);
    }
    public function setDailyIdAttribute($value){
        return $this->attributes['daily'] = ($value);
    }

    public function getMonthAttribute($value){
        return ($value);
    }
    public function setMonthAttribute($value){
        return $this->attributes['month'] = ($value);
    }
    

    public function getOverTimeAttribute($value){
        return ($value);
    }
    public function setOverTimeAttribute($value){
        return $this->attributes['over_time'] = ($value);

    }

    public function getHoursAttribute($value){
        return ($value);
    }
    public function setHoursAttribute($value){
        return $this->attributes['hours'] = ($value);

    }

    public function getRateAttribute($value){
        return ($value);
        
    }
    public function setRateAttribute($value){
        return $this->attributes['rate'] = ($value);

    }
    public function getBasicSalaryAttribute($value){
        return ($value);
    }
    public function setBasicSalaryAttribute($value){
        return $this->attributes['basic_salary'] = ($value);

    }

    public function getTotalAttribute($value){
        return ($value);
    }

    public function setTotalAttribute($value){
        return $this->attributes['total'] = ($value);

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

    public function employee(){
        return $this->belongsTo('App\Employee', 'employee_id');
    }

    public function warehouse(){
        return $this->belongsTo('App\WareHouseManagement', 'ware_house_id');
    }

    
}
