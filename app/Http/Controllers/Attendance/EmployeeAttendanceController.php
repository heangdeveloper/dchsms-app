<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Datatables;
use App\Models\EmployeeAttendance;
use DB;

class EmployeeAttendanceController extends Controller
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
        $type = DB::table('employee_positions')->get();
        return view('attendance/employee_attendance', [
            'type' => $type
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
        $txtid = $request->id;
        $txtbid = $request->bid;
        $getstatus = $request->getstatus;
        $date = $request->date;
        for ($i = 0; $i < count($request->id); $i++)
        {
            $form_arr = array(
                "emp_id" => $txtid[$i],
                "branch_id" => $txtbid[$i],
                "status" => $getstatus[$i],
                "date" => $date[$i],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );
            $insert[] = $form_arr;
        }
        EmployeeAttendance::insert($insert);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = EmployeeAttendance::find($id);
        return $employee;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function searchEmployee(Request $request)
    {
        $employee=DB::Table('employees')
            ->whereRaw('employees.type_id = '. $request->emp_type .' AND employees.id NOT IN (SELECT employee_attendances.emp_id FROM employee_attendances WHERE employees.type_id = '. $request->emp_type .' AND employee_attendances.date = CURDATE())')
            ->where('employees.branch_id', Auth::user()->campus_id)
            ->get();
        $date=date('Y-m-d');
        if (count($employee) > 0) {
            $i=0;
            $ouput="
                   <table class='table table-bordered' id='chkatten'>
                    <thead>
                            <tr class='bg-gradient-primary text-light'>
                                <th>No</th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden ></th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Phone Number</th>
                                <th class='text-center'>Attendance</th>
                            </tr>

                    </thead>
                   <tbody>
            ";
            foreach ($employee as $row)
            {
                $i++;
                $ouput.="
                    <tr>
                        <td>$i</td>
                        <td hidden><input type='text' value='".Auth::user()->campus_id."' class='txtbid'></td>
                        <td hidden><input type='text' value=$row->id class='txtid'></td>
                        <td hidden><input type='text' class='txtdate' value=$date></td>
                        <td>$row->fname $row->lname</td>";
                        if ($row->gender == 'Male') {
                            $ouput .= "<td>M</td>";
                        } else {
                            $ouput .= "<td>F</td>";
                        }
                        $ouput .= "
                        <td>$row->tel</td>
                        <td class='text-center'>
                            <label class=\"css-input css-radio css-radio-lg  css-radio-success m-r-sm\">
                                    <input type=\"radio\" class='get test' value=1 name='ch$i' checked><span></span>Present
                            </label>
                            <label class=\"css-input css-radio css-radio-lg  css-radio-danger m-r-sm\">
                                    <input type=\"radio\" class='get test' value=2 name='ch$i'><span></span> Absent
                            </label>
                            <label class=\"css-input css-radio css-radio-lg css-radio-warning m-r-sm\">
                                    <input type=\"radio\" class='get test' value=3 name='ch$i'><span></span> Permission
                            </label>
                        </td>
                    </tr>
               ";
            }
            $ouput.="
                            </tbody>
                        </table>

                    ";

            return $ouput;
        } else {
            return "<h4 style='text-align: center'>Attendance Already Taken !</h4>";
        }
        
    }

    public function editEmpAttendance(Request $request)
    {
        $upemployee = DB::table('employee_attendances')
            ->join('employees', 'employee_attendances.emp_id', '=', 'employees.id')
            ->select('employee_attendances.date', 'employee_attendances.id', 'employees.gender', 'employees.type_id', 'employee_attendances.status', DB::raw("CONCAT(employees.fname,' ',employees.lname) AS full_name"))
            ->where('employees.type_id', '=', $request->upemp)
            ->where('employee_attendances.date', '=', $request->date)
            ->where('employee_attendances.branch_id', '=', Auth::user()->campus_id)
            ->get();

        $date = date('Y-m-d');
        $check = '';
        if (count($upemployee) > 0) {
            $i = 0;
            $ouput ="
                <div class='table-responsive'>
                   <table class='table table-bordered' id='editatten'>
                    <thead>
                            <tr class='bg-gradient-primary text-light'>
                                <th>No</th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden ></th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Date</th>
                                <th class='text-center'>Attendance</th>
                            </tr>

                    </thead>
                   <tbody>
            ";
            foreach ($upemployee as $row) {
                $i++;
                $ouput.="
                    <tr>
                        <td>$i</td>
                        <td hidden><input type='text' value='".Auth::user()->campus_id."' class='txtbid'></td>
                        <td hidden><input type='text' value=$row->id class='txtid'></td>
                        <td hidden><input type='text' class='txtdate' value=$date></td>
                        <td>$row->full_name</td>";
                        if ($row->gender == 'Male') {
                            $ouput .= "<td>M</td>";
                        } else {
                            $ouput .= "<td>F</td>";
                        }
                        $ouput .= "<td>$row->date</td>
                    ";
                        
                    if ($row->status == 'Present') {
                        $ouput .= "
                            <td class='text-center'>
                                <label class=\"css-input css-radio css-radio-lg  css-radio-success m-r-sm\">
                                    <input type=\"radio\" class='get test' value=1 name='ch$i' checked><span></span>Present
                                </label>
                                <label class=\"css-input css-radio css-radio-lg  css-radio-danger m-r-sm\">
                                    <input type=\"radio\" class='get test' value=2 name='ch$i'><span></span> Absent
                                </label>
                                <label class=\"css-input css-radio css-radio-lg css-radio-warning m-r-sm\">
                                    <input type=\"radio\" class='get test' value=3 name='ch$i'><span></span> Permission
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
                                <label class=\"css-input css-radio css-radio-lg  css-radio-danger m-r-sm\">
                                    <input type=\"radio\" class='get test' value=2 name='ch$i'><span></span> Absent
                                </label>
                                <label class=\"css-input css-radio css-radio-lg css-radio-warning m-r-sm\">
                                    <input type=\"radio\" class='get test' value=3 name='ch$i' checked><span></span> Permission
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
                                <label class=\"css-input css-radio css-radio-lg  css-radio-danger m-r-sm\">
                                    <input type=\"radio\" class='get test' value=2 name='ch$i' checked><span></span> Absent
                                </label>
                                <label class=\"css-input css-radio css-radio-lg css-radio-warning m-r-sm\">
                                    <input type=\"radio\" class='get test' value=3 name='ch$i'><span></span> Permission
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
            return "<h4 class='text-center'>No Data!</h4>";
        }
            
    }

    public function Updateem(Request $r){
        for ($i = 0; $i < count($r->id); $i++ ) {
            $attendance = EmployeeAttendance::find($r->id[$i]);
            $attendance->update([
                    "status" => $r->getstatus[$i],
                ]
            );
        }
        return $r->getstatus;
    }

    public function listEmpAttendance(Request $request)
    {

        $employee = DB::select("
                        SELECT employee_attendances.id, employees.gender, CONCAT(employees.fname,' ',employees.lname) AS full_name, employees.tel,
                        SUM(IF(employee_attendances.status = 'permission',1,0)) AS permission,
                        SUM(IF(employee_attendances.status = 'absent',1,0)) AS absent,
                        SUM(IF(employee_attendances.status = 'present',1,0)) AS present
                        FROM employee_attendances
                        INNER JOIN employees ON employee_attendances.emp_id = employees.id
                        WHERE employees.type_id = '".$request->ltype."' AND employee_attendances.date BETWEEN '".$request->lsdate."' AND '".$request->ledate."' AND employee_attendances.branch_id = '".Auth::user()->campus_id."'
                        GROUP BY employee_attendances.emp_id
                    ");
        if (count($employee) > 0) {
            $i = 0;
            $ouput ="
                    <table class='table table-bordered listattendance'>
                        <thead>
                            <tr class='bg-gradient-primary text-light'>
                                <td>#</td>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Persent</th>
                                <th>Permission</th>
                                <th>Absent</th>
                            </tr>
                        </thead>
                        <tbody>
            ";
            foreach ($employee as $row)
            {
                $i++;
                $ouput.="
                    <tr>
                        <td>$i</td>
                        <td>$row->full_name</td>";
                        if ($row->gender == "Male") {
                            $ouput .= "<td>M</td>";
                        } else {
                            $ouput .="<td>F</td>";
                        }
                        $ouput .= "<td>$row->present</td>
                        <td>$row->permission</td>
                        <td>$row->absent</td>
                    </tr>
               ";
            }
            $ouput.="
                            </tbody>
                        </table>

                    ";

            return $ouput;
        }

    }
}
