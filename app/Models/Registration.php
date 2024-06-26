<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Registration extends Model
{
    use HasApiTokens, HasFactory;
    public $incrementing = false;
    protected $fillable = [
        'user_id',
        'training_id',
        'status',
        'advance',
        'remaind',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function training(){
        return $this->belongsTo(Trainings::class);
    }
}
