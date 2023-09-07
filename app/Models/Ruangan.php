<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';
    protected $fillable = [
        'nama', 'gedung_id'
    ];

    public function gedung(){
        return $this->belongsTo(Gedung::class);
    }
}
