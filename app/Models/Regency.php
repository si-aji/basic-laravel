<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    use HasFactory;

    public $fillable = [
        'province_id',
        'name'
    ];

    /**
     * Primary Key
     */
    // 

    /**
     * Foreign Key
     */
    public function province()
    {
        return $this->belongsTo(\App\Models\Province::class, 'province_id');
    }
}
