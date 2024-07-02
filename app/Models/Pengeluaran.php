<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'jumlah_pengeluaran', 'deskripsi', 'id_kartu'];
    public $timestamp = true;

    public function kartu()
    {
        return $this->belongsTo(Kartu::class, 'id_kartu');
    }
}
