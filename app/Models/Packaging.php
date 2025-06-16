<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packaging extends Model
{
    protected $fillable = [
        'name'
    ];

    public function medicinies()
    {
        return $this->hasMany(Medicines::class);
    }
}
