<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'quantity',
        'scheduled_meal_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function scheduledMeal()
    {
        return $this->belongsTo('App\Models\ScheduledMeal');
    }
}
