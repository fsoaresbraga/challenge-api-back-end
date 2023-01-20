<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $fillable = [
        'name',
        'name_fantasy',
        'cnpj'
    ];

    public function unity() {
        return $this->belongsTo(Unity::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}

