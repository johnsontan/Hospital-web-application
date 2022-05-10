<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalMaterial extends Model
{
    use HasFactory;
    use \Conner\Tagging\Taggable;
    
    protected $fillable = [
        'title', 'eduDesc', 
    ];
}
