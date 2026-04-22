<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'objet_depense', 'montant_depense','justificatif'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}