<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockEntries extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'medicine_id',
        'quantity',
        'entry_type', // 'purchase' or 'sale'
        'user_id',
    ];

    /**
     * Get the medicine associated with the stock entry.
     */
    public function medicine()
    {
        return $this->belongsTo(Medicines::class);
    }

    /**
     * Get the user who created the stock entry.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
