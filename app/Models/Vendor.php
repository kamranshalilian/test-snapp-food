<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = ["id"];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function delayReports()
    {
        return $this->hasMany(DelayReport::class);
    }
}
