<?php

namespace App\Http\Controllers\CreateTask;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateTaskController extends Controller
{
    /**
     * Display the Create Task view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('create');
    }

}
