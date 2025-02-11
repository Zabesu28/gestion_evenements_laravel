<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evenement extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description', 'monstre', 'recompense', 'temps_completion'];

    public function chasseurs()
    {
        return $this->belongsToMany(User::class, 'evenement_user')->withTimestamps();
    }
}