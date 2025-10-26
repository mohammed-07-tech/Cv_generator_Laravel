<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diploma extends Model
{
    use HasFactory;

    protected $fillable = ['cv_id', 'diploma', 'institution', 'start_date', 'end_date'];

    public function cv()
    {
        return $this->belongsTo(CvData::class, 'cv_id');
    }
}
