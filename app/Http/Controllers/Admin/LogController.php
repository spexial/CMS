<?php

namespace App\Http\Controllers\Admin;

use App\Log;
use App\Repositories\LogRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogController extends Controller
{
    /**
     * LogController constructor.
     */
    public function __construct()
    {
        $this->middleware('admin:admin');
    }

    /**
     * @param LogRepository $log
     * @return mixed
     */
    public function index(LogRepository $log)
    {
        $log = $log->paginate(15);
        return view('admin.log.log')->withLog($log);
    }
}
