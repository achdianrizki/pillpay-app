<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['user_id', 'supplier', 'purchase_date', 'total_amount', 'notes'];

    /**
     * Get the user that made the purchase.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the stock entries associated with the purchase.
     */
    public function stockEntries()
    {
        return $this->hasMany(StockEntry::class);
    }
}
