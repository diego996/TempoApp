<?php

namespace App\Models;
use App\Models\Coltura;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Irrigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'notes',
        'culture_id'
    ];

    public function coltura()
    {
        return $this->belongsTo(Coltura::class, 'coltura_id', 'id');
    }


}
