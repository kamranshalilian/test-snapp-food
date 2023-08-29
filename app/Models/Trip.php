<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = ["id"];

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
