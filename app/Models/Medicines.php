<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicines extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'generic_name',
        'manufacturer',
        'description',
        'unit',
        'purchase_price',
        'selling_price',
        'stock_quantity',
    ];

    /**
     * Get the stock entries associated with the medicine.
     */
    public function stockEntries()
    {
        return $this->hasMany(StockEntries::class);
    }

    /**
     * Get the sale details associated with the medicine.
     */
    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
