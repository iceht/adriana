<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasUuids;
    protected $keyType = 'string';

    protected $fillable = ['name', 'contract_date', 'address', 'customer_code'];
}
