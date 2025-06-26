<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleDetail extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'sale_id',
        'medicine_id',
        'quantity',
        'sub_total',
        'unit_price',
        'change'
    ];

    /**
     * Get the sale that owns the sale detail.
     */
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Get the medicine associated with the sale detail.
     */
    public function medicine()
    {
        return $this->belongsTo(Medicines::class, 'medicine_id');
    }
}
