<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CvData extends Model
{
    use HasFactory;

    protected $table = 'cv_data'; 

    protected $fillable = [
        'name', 'email', 'phone', 'address', 'skills', 'langs', 
        'hobbies', 'etat_civil', 'birth_date', 'image_path'
    ];

    // 🔸 علاقة مع جدول الشهادات
    public function diplomas()
    {
        return $this->hasMany(Diploma::class, 'cv_id');
    }

    // 🔸 علاقة مع جدول التجارب المهنية
    public function experiences()
    {
        return $this->hasMany(Experience::class, 'cv_id');
    }

    public function hobbies()
    {
        return $this->hasMany(Hobby::class, 'cv_id');
    }

    public function languages()
    {
        return $this->hasMany(Language::class, 'cv_id');
    }

}

