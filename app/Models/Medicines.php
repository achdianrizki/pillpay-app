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
        'code',
        'category',
        'selling_price',
        'purchase_price',
        'stock',
        'packaging',
        'expiration_date',
        'drug_class',
        'standard_name',
        'description',
        'usage_instruction',
        'images',
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
