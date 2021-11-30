<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Datatables;
use Carbon\Carbon;
use App\Models\Curriculum;
use App\Models\Studentclass;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\Classes;
use DB;


class StudentAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curriculum = DB::table('curricula')->get();
        return view('attendance.student_attendance', [
            'curriculum' => $curriculum
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $txtbid = $request->bid;
        $txtsid = $request->sid;
        $txtcid = $request->cid;
        $getstatus = $request->getstatus;
        $date = $request->date;
        $reason = $request->reason;
        for ($i = 0; $i < count($request->cid); $i++)
        {
            $form_arr = array(
                "stu_id" => $txtsid[$i],
                "branch_id" => $txtbid[$i],
                "class_id" => $txtcid[$i],
                "status" => $getstatus[$i],
                "date" => $date[$i],
                'reason' => $reason[$i],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $insert[] = $form_arr;
        }
        StudentAttendance::insert($insert);
        return $date[0];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Carbon::setWeekStartsAt(Carbon::SUNDAY);

        $totalpresent = DB::table('stuattendance')
        ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->where('status', '=', 'Present')->where('branch_id', '=', Auth::user()->branches_id)->where('stu_id', $id)->count();

        $totalabsent = DB::table('stuattendance')
        ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->where('status', '=', 'Absent')->where('branch_id', '=', Auth::user()->branches_id)->where('stu_id', $id)->count();

        $totalpermission = DB::table('stuattendance')
        ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->where('status', '=', 'Permission')->where('branch_id', '=', Auth::user()->branches_id)->where('stu_id', $id)->count();

        $attendetail = DB::table('stuattendance')->where('stu_id', $id)->get();

        $monthlypresent = StudentAttendance::select(DB::raw("COUNT(status) as count"))
        ->where('status', '=', 'Present')->where('stu_id', $id)
        ->orderBy("date")
        ->groupBy(DB::raw("month(date)"))
        ->get()->toArray();
        $monthlypresent = array_column($monthlypresent, 'count');

        $monthlypermission = StudentAttendance::select(DB::raw("COUNT(status) as count"))
        ->where('status', '=', 'Permission')->where('stu_id', $id)
        ->orderBy("date")
        ->groupBy(DB::raw("month(date)"))
        ->get()->toArray();
        $monthlypermission = array_column($monthlypermission, 'count');

        $monthlyabsent = StudentAttendance::select(DB::raw("COUNT(status) as count"))
        ->where('status', '=', 'Absent')->where('stu_id', $id)
        ->orderBy("date")
        ->groupBy(DB::raw("month(date)"))
        ->get()->toArray();
        $monthlyabsent = array_column($monthlyabsent, 'count');

        $getmonth = DB::table('stuattendance')->select('date')->whereMonth('date', \Carbon\Carbon::now()->format('m') )->get();

        $showstuatten = DB::table('stuattendance')->where('stu_id', $id)->get();
        return view('attendance/student_attendance_detail', [
            'showstuatten' => $showstuatten,
            'totalpresent' => $totalpresent,
            'totalabsent' => $totalabsent,
            'totalpermission' => $totalpermission,
            'attendetail' => $attendetail,
            'monthlypresent' => json_encode($monthlypresent, JSON_NUMERIC_CHECK),
            'monthlypermission' => json_encode($monthlypermission, JSON_NUMERIC_CHECK),
            'monthlyabsent' => json_encode($monthlyabsent, JSON_NUMERIC_CHECK),
            'getmonth' => json_encode($getmonth, JSON_NUMERIC_CHECK)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        for ($i = 0; $i < count($request->id); $i++ ) {
            $attendance = StudentAttendance::find($request->id[$i]);
            $attendance->update([
                    "status" => $request->getstatus[$i],
                    "reason" => $request->reason[$i],
                ]
            );
        }
        return $request->getstatus;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getclass($id)
    {
        $class = DB::table('student_classes')
            ->join('classrooms', 'student_classes.class_id', '=', 'classrooms.id')
            ->join('academic_years', 'student_classes.academic_year_id', '=', 'academic_years.id')
            ->select('student_classes.*', 'classrooms.classnum', 'classrooms.grade', 'academic_years.year')
            ->where('student_classes.curriculum_id', '=', $id)
            ->limit(1)
            ->get();
        return response()->json($class);
    }

    public function searchstudent(Request $request)
    {
        $students = DB::table('student_classes')
            ->join('students', 'student_classes.stu_id', '=', 'students.id')
            ->join('classrooms', 'student_classes.class_id', '=', 'classrooms.id')
            ->select('student_classes.*', 'students.finameen', 'students.sunameen', 'students.gender', 'classrooms.id')
            ->whereRaw('classrooms.id = '. $request->class .' AND students.id NOT IN(SELECT student_attendances.stu_id FROM student_attendances WHERE classrooms.id = '. $request->class .' AND student_attendances.date = CURDATE())')
            ->where('student_classes.branch_id', Auth::user()->campus_id)
            ->get();
        $date=date('Y-m-d');
        if (count($students) > 0) {
            $i=0;
            $ouput="
                <div class='table-responsive'>
                   <table class='table table-bordered' id='chkattendance'>
                    <thead>
                            <tr class='bg-info text-light'>
                                <th>N<sup>o</sup></th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden ></th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th class='text-center'>Attendance</th>
                                <th class='text-center'>Reason</th>
                            </tr>

                    </thead>
                   <tbody>
            ";
            foreach ($students as $row)
            {
                $i++;
                $ouput.="
                    <tr>
                        <td>$i</td>
                        <td hidden><input type='text' value='".Auth::user()->campus_id."' class='txtbid'></td>
                        <td hidden><input type='text' value=$row->class_id class='txtcid'></td>
                        <td hidden><input type='text' value=$row->stu_id class='txtsid'></td>
                        <td hidden><input type='text' class='txtdate' value=$date></td>
                        <td>$row->sunameen $row->finameen</td>
                        <td>$row->gender</td>
                        <td class='text-center'>
                            <label class=\"css-input css-radio css-radio-lg  css-radio-success m-r-sm\">
                                    <input type=\"radio\" class='get test' value=1 name='ch$i' checked><span></span>Present
                            </label>
                            <label class=\"css-input css-radio css-radio-lg  css-radio-danger m-r-sm\">
                                    <input type=\"radio\" class='get test' value=2 name='ch$i'><span></span> Permission
                            </label>
                            <label class=\"css-input css-radio css-radio-lg css-radio-warning m-r-sm\">
                                    <input type=\"radio\" class='get test' value=3 name='ch$i'><span></span> Absent
                            </label>
                        </td>
                        <td class='text-center'>
                            <input type='text' class='form-control form-control-sm reason' name='reason'>
                        </td>
                    </tr>
               ";
            }
            $ouput.="</tbody></table></div>";

            return $ouput;
        } else {
            return "<h4 style='text-align: center'>Attendance Already Taken !</h4>";
        }
    }

    public function editattendance(Request $request)
    {
        $upstuatten = DB::table('student_attendances')
            ->join('students', 'student_attendances.stu_id', '=', 'students.id')
            ->join('classrooms', 'student_attendances.class_id', '=', 'classrooms.id')
            ->select('student_attendances.*', 'students.sunameen', 'students.finameen', 'students.gender', 'classrooms.classnum', 'classrooms.grade')
            ->where('classrooms.id', '=', $request->upclass)
            ->where('student_attendances.date', '=', $request->date)
            ->get();

        $date = date('Y-m-d');
        $check = '';
        if (count($upstuatten) > 0) {
            $i = 0;
            $ouput ="
                <div class='table-responsive'>
                   <table class='table table-bordered' id='update_attendance'>
                    <thead>
                            <tr class='bg-info text-light'>
                                <th>No</th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden></th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th class='text-center'>Reason</th>
                                <th class='text-center'>Attendance</th>
                            </tr>

                    </thead>
                   <tbody>
            ";
            foreach ($upstuatten as $row) {
                $i++;
                $ouput.="
                    <tr>
                        <td>$i</td>
                        <td hidden><input type='text' value='".Auth::user()->campus_id."' class='txtbid'></td>
                        <td hidden><input type='text' value=$row->id class='txtid'></td>
                        <td hidden><input type='text' value=$row->class_id class='txtcid'></td>
                        <td hidden><input type='text' value=$row->stu_id class='txtsid'></td>
                        <td hidden><input type='text' class='txtdate' value=$date></td>
                        <td>$row->sunameen $row->finameen</td>
                        <td>$row->gender</td>
                        <td class='text-center'>
                            <input type='text' class='form-control form-control-sm reason' name='reason' value='".$row->reason."'>
                        </td>
                    ";
                        
                    if ($row->status == 'Present') {
                        $ouput .= "
                            <td class='text-center'>
                                <label class=\"css-input css-radio css-radio-lg  css-radio-success m-r-sm\">
                                        <input type=\"radio\" class='get test' value=1 name='ch$i' checked><span></span>Present
                                </label>
                                 <label class=\"css-input css-radio css-radio-lg css-radio-warning m-r-sm\">
                                        <input type=\"radio\" class='get test' value=2 name='ch$i'><span></span> Permission
                                </label>
                                <label class=\"css-input css-radio css-radio-lg  css-radio-danger m-r-sm\">
                                        <input type=\"radio\" class='get test' value=3 name='ch$i'><span></span> Absent
                                </label>
                            </td>
                        </tr>
                        ";
                    }

                    if ($row->status == 'Permission') {
                        $ouput .= "
                            <td class='text-center'>
                                <label class=\"css-input css-radio css-radio-lg  css-radio-success m-r-sm\">
                                        <input type=\"radio\" class='get test' value=1 name='ch$i'><span></span>Present
                                </label>
                                 <label class=\"css-input css-radio css-radio-lg css-radio-warning m-r-sm\">
                                        <input type=\"radio\" class='get test' value=2 name='ch$i' checked><span></span> Permission
                                </label>
                                <label class=\"css-input css-radio css-radio-lg  css-radio-danger m-r-sm\">
                                        <input type=\"radio\" class='get test' value=3 name='ch$i'><span></span> Absent
                                </label>
                            </td>
                        </tr>
                        ";
                    }

                    if ($row->status == 'Absent') {
                        $ouput .= "
                            <td class='text-center'>
                                <label class=\"css-input css-radio css-radio-lg  css-radio-success m-r-sm\">
                                        <input type=\"radio\" class='get test' value=1 name='ch$i'><span></span>Present
                                </label>
                                 <label class=\"css-input css-radio css-radio-lg css-radio-warning m-r-sm\">
                                        <input type=\"radio\" class='get test' value=2 name='ch$i'><span></span> Permission
                                </label>
                                <label class=\"css-input css-radio css-radio-lg  css-radio-danger m-r-sm\">
                                        <input type=\"radio\" class='get test' value=3 name='ch$i' checked><span></span> Absent
                                </label>
                            </td>
                        </tr>
                        ";
                    }
            }
            $ouput.="
                            </tbody>
                        </table>
                   </div>
                ";
            return $ouput;
        } else {
            return "<h4 class='text-center'>No Data Found!</h4>";
        }
    }

    public function liststuattendance(Request $request)
    {
        $listatt = DB::select("
        SELECT student_attendances.id, student_attendances.stu_id, students.gender, classrooms.classnum, classrooms.grade, CONCAT(students.sunameen,' ',students.finameen) AS full_name,
        SUM(IF(student_attendances.status = 'Permission',1,0)) AS permission ,
        SUM(IF(student_attendances.status = 'Absent',1,0)) AS absent,
        SUM(IF(student_attendances.status = 'Present',1,0)) AS present
        FROM ((student_attendances 
        INNER JOIN students ON student_attendances.stu_id = students.id)
        INNER JOIN classrooms ON student_attendances.class_id = classrooms.id)
        WHERE student_attendances.date BETWEEN '".$request->sdate."' AND '".$request->edate."' AND student_attendances.class_id = '".$request->lclass."' AND student_attendances.branch_id = '" . Auth::user()->campus_id . "'
        GROUP BY student_attendances.stu_id");
        if (count($listatt) > 0) {
            $i = 0;
            $output = "
                <table class='table table-bordered' id='count_attendance'>
                    <thead class='bg-gradient-primary text-light'>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Persent</th>
                            <th>Permission</th>
                            <th>Absent</th>
                        </tr>
                    </thead>
                    <tbody>";
                        foreach($listatt as $row) {
                            $i++;
                            $output .= "
                                <tr>
                                    <td>$i</td>
                                    <td>$row->full_name</td>";
                                    if ($row->gender == 'Male') {
                                       $output .= '<td>M</td>'; 
                                    } else {
                                        $output .= '<td>F</td>';
                                    }
                                    $output .= "<td>$row->present</td>
                                    <td>$row->permission</td>
                                    <td>$row->absent</td>
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
