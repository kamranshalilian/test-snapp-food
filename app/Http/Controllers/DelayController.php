<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlertRequest;
use App\Http\Requests\AssignRequest;
use Illuminate\Http\Request;

class DelayController extends Controller
{
    public function report()
    {
        return 1;
    }

    public function alert(AlertRequest $request)
    {
        return 2;

    }

    public function assign(AssignRequest $request)
    {
        return 3;
    }
}
