<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $Tasks = DB::select('select count(*) from tasks ');
        return view('')
    }
}
