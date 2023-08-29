<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUlids;

    protected $guarded = ["id"];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function delayReports()
    {
        return $this->hasMany(DelayReport::class);
    }

}
