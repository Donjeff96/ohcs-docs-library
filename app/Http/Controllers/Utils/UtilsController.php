<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use App\Models\CurrentLeave;
use App\Models\DeferredLeave;
use App\Models\LeaveMain;
use Illuminate\Http\Request;

class UtilsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

}
