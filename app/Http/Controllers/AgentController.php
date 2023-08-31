<?php

namespace App\Http\Controllers;


use App\Http\Resources\AgentResource;
use App\Models\Agent;

class AgentController extends Controller
{
    public function index()
    {
        return AgentResource::collection(Agent::get());
    }
}
