<?php

namespace App\Http\Controllers;


use App\Http\Resources\VendorResource;
use App\Models\Vendor;


class VendorController extends Controller
{
    public function index()
    {
        return VendorResource::collection(Vendor::get());
    }
}
