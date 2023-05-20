<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coltura extends Model
{
    protected $fillable = ['nome', 'descrizione', 'costo', 'profitto'];
    protected $table = "colture";

    public function lavorazioni($id)
    {
        return $this->hasMany(Lavorazione::class)->where('coltura_id', $id)->get();
    }
    public function irrigazioni()
    {
        return $this->belongsTo(Irrigation::class, 'id', 'coltura_id');
    }
}