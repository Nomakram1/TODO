<?php

namespace App\Http\Controllers\ShowTask;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowTaskController extends Controller
{
    /**
     * Display the Show Task view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('dashboard');
    }

}
