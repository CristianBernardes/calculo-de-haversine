<?php

namespace App\Models;

use App\Models\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getDateOfSaleAttribute()
    {
        return formatDateAndTime($this->date_hour_sale, 'Y-m-d');
    }

    public function getHourOfSaleAttribute()
    {
        return formatDateAndTime($this->date_hour_sale, 'H:i');
    }

    public function salesman()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
