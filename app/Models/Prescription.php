<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity', 'health_record_id','medication_id',
    ];

    public function healthRecord(){
        return $this->belongsTo(HealthRecord::class);
    }

    public function medication(){
        return $this->belongsTo(Medication::class);
    }
}
