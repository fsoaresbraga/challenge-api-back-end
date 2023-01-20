<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $fillable = [
        'value',
        'date_sale',
        'latitude',
        'longitude',
        'roaming'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

}
