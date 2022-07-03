<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $table = 'resep';
    protected $fillable = ['judul', 'deskripsi', 'foto','suka'];
    use HasFactory;

    public function bahan()
    {
        return $this->hasMany('App\Models\Bahan',"resep_id","id");
    }
    public function langkah()
    {
        return $this->hasMany('App\Models\Langkah',"resep_id","id");
    }
}
