<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CustomerEntity extends Model
{
    use HasUuids;
    protected $table="customers";
    protected $keyType = 'string';
    public  $timestamps = false;

    protected $fillable = ['name', 'contract_date', 'address', 'customer_code'];
    protected $casts = [
        'contract_date' => 'datetime:Y-m-d\TH:i:s.vZ',
    ];
}
