<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockEntry extends Model
{
    protected $fillable = ['medicine_id', 'supplier', 'quantity', 'entry_date', 'expiration_date'];



    /**
     * Get the medicine associated with the stock entry.
     */
    public function medicine()
    {
        return $this->belongsTo(Medicines::class);
    }
}
