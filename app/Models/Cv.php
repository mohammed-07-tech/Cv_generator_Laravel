<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','title','full_name','email','phone','address','role','summary',
        'education','experience','skills','languages','projects','links',
        'template','photo_path',
    ];

    protected $casts = [
        'education' => 'array',
        'experience'=> 'array',
        'skills'    => 'array',
        'languages' => 'array',
        'projects'  => 'array',
        'links'     => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
