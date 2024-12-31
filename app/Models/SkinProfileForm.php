<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkinProfileForm extends Model
{
    use HasFactory;
     // Specify the custom primary key if it's not 'id'
     protected $primaryKey = 'FormID';

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
}
