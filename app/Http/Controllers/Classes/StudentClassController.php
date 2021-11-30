<?php

namespace App\Http\Controllers\Classes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;
use App\Models\StudentClass;
use DB;

class StudentClassController extends Controller
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
        if(request()->ajax()) {
            $studentclass = DB::table('student_classes')
            ->join('students', 'student_classes.stu_id', '=', 'students.id')
            ->join('classrooms', 'student_classes.class_id', '=', 'classrooms.id')
            ->join('academic_years', 'student_classes.academic_year_id', '=', 'academic_years.id')
            ->join('curricula', 'student_classes.curriculum_id', '=', 'curricula.id')
            ->select('student_classes.*', 'academic_years.year', 'classrooms.classnum', 'classrooms.grade', 'curricula.curriculum_name', 'students.status', DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS full_name"))
            ->where('student_classes.branch_id', Auth::user()->campus_id)
            ->where('students.status', '=', 'Studying')
            ->get();
            return Datatables::of($studentclass)
            ->addIndexColumn()
            ->addColumn('action', function($studentclass) {
                return '<a onclick="editForm('. $studentclass->id .')" class="btn btn-primary btn-xs text-white"><i class="fa fa-edit"></i> Edit</a>' . ' <a onclick="deleteData('. $studentclass->id .')" class="btn btn-danger btn-xs text-white"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }
        
        $curriculum = DB::table('curricula')->get();
        $year = DB::table('academic_years')->get();
        $student = DB::table('students')->select(DB::raw("CONCAT(sunameen,' ',finameen) AS full_name"), 'id')->get();
        $classroom = DB::table('classrooms')->join('teacher_classes', 'teacher_classes.claid', '=', 'classrooms.id')->select('classrooms.*')->get();
        return view('class/studentclass', [
            'curriculum' => $curriculum,
            'year' => $year,
            'student' => $student,
            'classroom' => $classroom
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
        foreach ($request->student as $key => $value) {
            $data = array(
                'branch_id' => $request['branches'],
                'curriculum_id' => $request['curriculum'],
                'academic_year_id' => $request['schoolyear'],
                'stime' => $request['stime'],
                'etime' => $request['etime'],
                'stu_id' => $request->student[$key],
                'class_id' => $request->classnumber[$key]
            );
            StudentClass::create($data);
        }
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
        $studentclass = StudentClass::find($id);
        
        return $studentclass;
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
        $studentclass = StudentClass::find($id);
        $studentclass->stu_id = $request['student'];
        $studentclass->class_id = $request['class'];
        $studentclass->academic_year_id = $request['schoolyear'];
        $studentclass->stime = $request['stime'];
        $studentclass->etime = $request['etime'];
        $studentclass->curriculum_id = $request['curriculum'];
        $studentclass->update();

        return $studentclass;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StudentClass::destroy($id);
    }


}
