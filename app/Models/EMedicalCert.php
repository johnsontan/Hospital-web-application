<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EMedicalCert extends Model
{
    use HasFactory;
    protected $fillable = [
        'startDate', 'durationInDays', 'remarks', 'health_record_id', 
    ];

    public function healthRecord(){
        return $this->belongsTo(HealthRecord::class);
    }
}
