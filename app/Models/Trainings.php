<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;


class Trainings extends Model
{
    use HasFactory,HasApiTokens;
    public $incrementing = false;
    protected $fillable = [
        'title',
        'description',
        'price',
        'duration',
        'trainer_id',
    ];
    protected $casts = [
        'id'=>'string',
        'trainer_id'=>'string',
    ];

    public function trainer(){
        return $this->belongsTo(User::class,"trainer_id");
    }
    public function registration(){
        return $this->hasMany(Registration::class);
    }
}
