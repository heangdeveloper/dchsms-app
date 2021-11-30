<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class StudentReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('report/student_report');
    }

    public function searchNewStudent(Request $request)
    {
        $student = DB::table('students')
        ->whereBetween('date_admission', [$request->new_start_date, $request->new_end_date])
        ->where('students.branch_id', Auth::user()->campus_id)
        ->select('students.*', DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS full_name"))
        ->get();

        if (count($student) > 0) {
            $i=0;
            $output = "
                <table class='table table-bordered w-100' id='student_new'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Gender</th>
                            <th>National</th>
                            <th>DOB</th>
                            <th>Province</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach($student as $row) {
                            $i++;
                            $output .= "
                                <tr>
                                    <td>$i</td>
                                    <td>$row->full_name</td>
                                    <td>$row->gender</td>
                                    <td>$row->national</td>
                                    <td>$row->dob</td>
                                    <td>$row->province</td>
                                    <td>$row->date_admission</td>
                                </tr>
                            ";
                        }
                    $output .= "</tbody>
                </table>
            ";
            return $output;
        }
    }

    public function searchStopStudent(Request $request)
    {
        $studentstop = DB::table('students')
        ->whereBetween('date_admission', [$request->stop_start_date, $request->stop_end_date])
        ->where('students.branch_id', Auth::user()->campus_id)
        ->where('students.status', '=', 'Stop')
        ->select('students.*', DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS full_name"))
        ->get();

        if (count($studentstop) > 0) {
            $i=0;
            $output = "
                <table class='table table-bordered w-100' id='student_stop'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Student Name</th>
                            <th>Gender</th>
                            <th>National</th>
                            <th>DOB</th>
                            <th>Province</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach($studentstop as $row) {
                            $i++;
                            $output .= "
                                <tr>
                                    <td>$i</td>
                                    <td>$row->full_name</td>
                                    <td>$row->gender</td>
                                    <td>$row->national</td>
                                    <td>$row->dob</td>
                                    <td>$row->province</td>
                                    <td>$row->date_admission</td>
                                </tr>
                            ";
                        }
                    $output .= "</tbody>
                </table>
            ";
            return $output;
        }
    }

    public function searchSkipStudent(Request $request)
    {
        $studentskip = DB::table('students')
        ->whereBetween('date_admission', [$request->skip_start_date, $request->skip_end_date])
        ->where('students.branch_id', Auth::user()->campus_id)
        ->where('students.status', '=', 'Suspension')
        ->select('students.*', DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS full_name"))
        ->get();

        if (count($studentskip) > 0) {
            $i=0;
            $output = "
                <table class='table table-bordered' id='student_skip'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Gender</th>
                            <th>National</th>
                            <th>DOB</th>
                            <th>Province</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach($studentskip as $row) {
                            $i++;
                            $output .= "
                                <tr>
                                    <td>$i</td>
                                    <td>$row->full_name</td>
                                    <td>$row->gender</td>
                                    <td>$row->national</td>
                                    <td>$row->dob</td>
                                    <td>$row->province</td>
                                    <td>$row->date_admission</td>
                                </tr>
                            ";
                        }
                    $output .= "</tbody>
                </table>
            ";
            return $output;
        }
    }
}
