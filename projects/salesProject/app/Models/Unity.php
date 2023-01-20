<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unity extends Model
{
    use HasFactory;

    protected $table = 'unities';
    protected $fillable = [
        'name',
        'latitude',
        'longitude'
    ];


    public function company() {
        return $this->hasOne(Company::class);
    }

    public function director() {
        return $this->belongsTo(Director::class);
    }
}
