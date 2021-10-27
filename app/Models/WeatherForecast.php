<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherForecast extends Model
{
    use HasFactory;
	protected $table = 'weather_forecast';

	/**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'object',
    ];

	/**
     * Get the user that owns the property.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
