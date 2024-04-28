<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'latitude',
        'longitude',
    ];

    // scope search
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('start_date', 'like', '%' . $search . '%')
            ->orWhere('end_date', 'like', '%' . $search . '%')
            ->orWhere('latitude', 'like', '%' . $search . '%')
            ->orWhere('longitude', 'like', '%' . $search . '%');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
