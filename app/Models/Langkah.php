<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langkah extends Model
{
    protected $table = 'langkah';
    use HasFactory;
    public function resep()
    {
        return $this->belongsTo('App\Resep',"resep_id");
    }
}
