<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public $timestamps = false;

    protected $table = 'devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'User_OID', 'DeviceName', 'MacAddress', 'DeviceType'
    ];

    /**
     * Get the user record associated with the device.
     */
    public function user()
    {
        return $this->hasOne('App\User', 'oid', 'User_OID');
    }

    /**
     * Get the metrics for the device.
     */
    public function metrics()
    {
        return $this->hasMany('App\Metric', 'Device_ID', 'ID');
    }
}
