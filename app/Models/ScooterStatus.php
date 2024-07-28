<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScooterStatus extends Model
{
    use HasFactory;

    protected $table = 'scooter_statuses';

    protected $fillable = [
        'scooter_id',
        'lat',
        'lng',
        'battery',
    ];
}
