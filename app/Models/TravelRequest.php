<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class TravelRequest extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'requester_name',
        'destination',
        'departure_date',
        'return_date',
        'status',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(fn ($model) => $model->id = Str::uuid());
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
