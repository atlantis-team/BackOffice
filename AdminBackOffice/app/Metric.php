<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
    public $timestamps = false;

    protected $table = 'metrics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Device_ID', 'MetricValue', 'MetricDate',
    ];

    /**
     * Get the device record associated with the metric.
     */
    public function device()
    {
        return $this->hasOne('App\Device', 'ID', 'Device_ID');
    }
}
