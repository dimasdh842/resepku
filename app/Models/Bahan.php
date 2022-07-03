<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    protected $table = 'bahan';
    use HasFactory;
    public function resep()
    {
        return $this->belongsTo('App\Resep',"resep_id");
    }
}
