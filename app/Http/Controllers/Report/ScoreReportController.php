<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Datatables;
use App\Models\Score;
use DB;

class ScoreReportController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth');
    }

    public function index()
    {
        $teacher = DB::table('employees')->where('type_id', 1)->select('id', DB::raw("CONCAT(employees.fname,' ',employees.lname) AS full_name"))->get();
        $term = DB::table('terms')->get();
        return view('report/score_report', [
            'teacher' => $teacher,
            'term' => $term
        ]);
    }

    public function getTeacherClass($id)
    {
        $teacherclass = DB::table('teacherclass')
        ->join('classes', 'teacherclass.claid', '=', 'classes.id')
        ->select('teacherclass.*', 'classes.classnum', 'classes.grade')
        ->where('teacherclass.teaid','=' , $id)
        ->get();
        return json_encode($teacherclass);
    }

    public function serchListStudentScore(Request $request)
    {
        $listscore = DB::select("SELECT scores.*, CONCAT(students.sunameen,' ',students.finameen) AS full_name, students.gender FROM scores INNER JOIN students ON scores.student_id = students.id WHERE scores.class_id = '".$request->classs."' AND scores.term_id = '".$request->terms."' AND scores.branch_id = '".Auth::user()->campus_id."'");
        if (count($listscore) > 0) {
            $i = 0;
            $output = "
                <table class='table table-bordered' id='listscore'>
                    <thead class='bg-gradient-success text-light'>
                        <tr>
                            <th style='width: 10px; text-align: center'>#</th>
                            <th style='width: 100px; text-align: center'>Name</th>
                            <th style='width: 10px; text-align: center'>Sex</th>
                            <th>Language Arts</th>
                            <th>Mathematics</th>
                            <th>Science</th>
                            <th>Arts</th>
                            <th>Music</th>
                            <th>Khmer</th>
                            <th>Moral Education</th>
                            <th style='width: 10px; text-align: center'>Total</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach($listscore as $row) {
                            $i++;
                            $output .= "
                                <tr>
                                    <td>$i</td>
                                    <td>$row->full_name</td>
                                    <td>$row->gender</td>
                                    <td>$row->lart</td>
                                    <td>$row->math</td>
                                    <td>$row->science</td>
                                    <td>$row->art</td>
                                    <td>$row->music</td>
                                    <td>$row->khmer</td>
                                    <td>$row->moral</td>
                                    <td>$row->total</td>
                                </tr>
                            ";
                        }
                    $output .= "</tbody>
                </table>
            ";
            return ['output'=>$output];
        }
    }
}
