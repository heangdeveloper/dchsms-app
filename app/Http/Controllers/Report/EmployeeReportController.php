<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Datatables;
use App\Models\Employee;
use DB;

class EmployeeReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('report/employee_report');
    }

    public function searchEmployeeReport(Request $request)
    {
        $newemployee = DB::table('employees')
        ->join('branches', 'employees.branch_id', '=', 'branches.id')
        ->join('provinces', 'employees.pro_id', '=', 'provinces.id')
        ->whereBetween('hire', [$request->startdate, $request->enddate])
        ->where('employees.branch_id', Auth::user()->branches_id)
        ->select('employees.*', 'branches.name_en', DB::raw("CONCAT(employees.fname,' ',employees.lname) AS full_name"), 'provinces.name')
        ->get();

        if (count($newemployee) > 0) {
            $i=0;
            $output = "
                <table class='table table-bordered' id='emp_report'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Phone</th>
                            <th>Hire Date</th>
                            <th>DOB</th>
                            <th>Province</th>
                            <th>Branch</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach($newemployee as $row) {
                            $i++;
                            $output .= "
                                <tr>
                                    <td>$i</td>
                                    <td>$row->full_name</td>
                                    <td>$row->gender</td>
                                    <td>$row->tel</td>
                                    <td>$row->dob</td>
                                    <td>$row->hire</td>
                                    <td>$row->name</td>
                                    <td>$row->name_en</td>
                                </tr>
                            ";
                        }
                    $output .= "</tbody>
                </table>
            ";
            return $output;
        } else {
            $output = "
                <table class='table table-bordered' id='employee_report'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Phone Number</th>
                            <th>Hire Date</th>
                            <th>DOB</th>
                            <th>Province</th>
                            <th>Branch</th>
                        </tr>
                    </thead>
                </table>
            ";
            return $output;
        }
    }
}
