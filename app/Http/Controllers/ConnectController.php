<?php

namespace App\Http\Controllers;

use App\Models\connect;
use Illuminate\Http\Request;

class ConnectController extends Controller
{
    private Connect $connect;

    public function __construct(Connect $connect)
    {
        $this->connect = $connect;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return $this->connect->createConnect($request->ip());
    }
}
