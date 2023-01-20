<?php

namespace App\Models;

use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 */
class Sale extends Model
{
    use HasFactory, Uuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'unit_id',
        'unit_name',
        'latitude',
        'longitude',
        'sale_value',
        'roaming'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['date_of_sale', 'hour_of_sale'];

    /**
     * @return string
     */
    public function getDateOfSaleAttribute()
    {
        $sale = $this->find($this->sale_id);

        return formatDateAndTime($sale->date_hour_sale, 'Y-m-d');
    }

    /**
     * @return string
     */
    public function getHourOfSaleAttribute()
    {
        $sale = $this->find($this->sale_id);

        return formatDateAndTime($sale->date_hour_sale, 'H:i');
    }

    /**
     * @return BelongsTo
     */
    public function salesman()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
