<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Employee;
use App\Models\role;
use App\Models\User;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $totalstudent = DB::table('students')
        ->where('branch_id', '=', Auth::user()->campus_id)
        ->count();

        $totalteacher = DB::table('employees')
        ->where('type_id', '=', '1')
        ->where('branch_id', '=', Auth::user()->campus_id)
        ->count();

        $totalclass = DB::table('student_classes')
        ->where('branch_id', '=', Auth::user()->campus_id)
        ->count();

        $totaluser = DB::table('users')
        ->where('campus_id', '=', Auth::user()->campus_id)
        ->count();

        return view('dashboard', [
            'totalstudent' => $totalstudent,
            'totalteacher' => $totalteacher,
            'totalclass' => $totalclass,
            'totaluser' => $totaluser,
        ]);
    }
}
