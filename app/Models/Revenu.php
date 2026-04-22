<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenu extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'origine', 'montant'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}