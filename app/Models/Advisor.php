<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    protected $fillable = [
        'code',
        'name',
    ];

    /**
     * Get all of the customers for the Advisor
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers()
    {
        return $this->hasMany(Customer::class, 'advisor_id', 'id');
    }
}
