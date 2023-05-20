<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Coltura;

class Raccolte extends Model
{
    use HasFactory;
    protected $fillable = ['quantita', 'data_raccolta', 'note', 'coltura_id'];

    protected $table = "raccolte";
    public function coltura()
    {
        return $this->belongsTo(Coltura::class);
    }
}
