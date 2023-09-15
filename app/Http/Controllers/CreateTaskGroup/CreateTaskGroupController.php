<?php

namespace App\Http\Controllers\CreateTaskGroup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateTaskGroupController extends Controller
{
    /**
     * Display the Create Task Group view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('create-task-group');
    }

}
