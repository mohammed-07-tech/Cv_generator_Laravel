<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['cv_id', 'job_title', 'company', 'start_date', 'end_date', 'description'];

    public function cv()
    {
        return $this->belongsTo(CvData::class, 'cv_id');
    }
}
