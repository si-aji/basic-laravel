<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    public $fillable = [
        'name'
    ];

    /**
     * Primary Key
     */
    public function regency()
    {
        return $this->hasMany(\App\Models\Regency::class, 'province_id');
    }

    /**
     * Foreign Key
     */
    // 
}
