<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaceAnalysis extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'analysis'];

    protected $casts = [
        'analysis' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}