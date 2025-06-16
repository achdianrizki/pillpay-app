<?php

namespace App\Models;

use App\Models\Category;
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
        'category_id',
        'selling_price',
        'purchase_price',
        'stock',
        'packaging_id',
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

    public function packaging()
    {
        return $this->belongsTo(Packaging::class, 'packaging_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
