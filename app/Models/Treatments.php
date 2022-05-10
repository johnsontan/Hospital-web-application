<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatments extends Model
{
    use HasFactory;
    protected $fillable = [
        'duration', 'price', 'treatmentTitle', 'medication', 
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function appointment(){
        return $this->hasMany(Appointment::class);
    }

    public function specialisation(){
        return $this->belongsTo(Specialisation::class);
    }
}
