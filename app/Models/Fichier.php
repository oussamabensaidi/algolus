<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fichier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
    ];

    // public function dossier()
    // {
    //     return $this->belongsTo(Dossier::class, 'dossier_id', 'id');
    // }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
