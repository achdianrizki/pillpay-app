<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockEntry extends Model
{
    protected $fillable = ['medicine_id', 'purchase_id', 'quantity', 'entry_date', 'expiration_date', 'purchase_price', 'packaging'];



    /**
     * Get the medicine associated with the stock entry.
     */
    public function medicine()
    {
        return $this->belongsTo(Medicines::class);
    }
    /**
     * Get the purchase associated with the stock entry.
     */
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
