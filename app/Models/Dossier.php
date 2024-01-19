<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'name',
        'file_number',
    ];

    
    // public function fichier()
    // {
    //     return $this->hasMany(Fichier::class, 'dossier_id', 'id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
