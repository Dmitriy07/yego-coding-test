<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Scooter extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'scooters';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'type',
    ];

    public function statuses(): HasMany
    {
        return $this->hasMany(ScooterStatus::class);
    }
}
