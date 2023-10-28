<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Taks extends Model
{
    use HasFactory;
    protected $table = 'taks';
    protected $fillable = [
        'name',
        'description',
        'photo',
        'document',
        'status',
        'id_user'
    ];

    /**
     * Relasi tabel taks dengan tabel user
     * id_user pada tabel taks sebagai foreign key
    */
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
