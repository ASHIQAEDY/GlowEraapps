<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;           

class SkinProfileForm extends Model
{
    use HasFactory;

    // Specify the custom primary key if it's not 'id'
    protected $primaryKey = 'FormID';

    // If you don't have timestamps in your table, uncomment the line below
    // public $timestamps = false;

    protected $fillable = [
        'Acne',
        'FineLine',
        'Darkspots',
        'Redness',
        'Dryness',
        'Oily',
        'PoresRate',
        'Irritation',
        'Firmness',
        'Darkcircles',
        'TotalScore',
        'InterpretationStatus',
    ];

    // Optional: Add custom methods, relationships, etc.
    protected $dates = ['deleted_at']; // This enables SoftDeletes
}
