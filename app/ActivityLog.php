<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ActivityLog extends Model
{
    use SoftDeletes;
    protected $table = 'activity_logs';
    public $primaryKey = 'activity_id';
    protected $fillable = [
        'user_id', 'operations',
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
