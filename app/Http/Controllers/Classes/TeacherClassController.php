<?php

namespace App\Http\Controllers\Classes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;
use App\Models\TeacherClass;
use DB;

class TeacherClassController extends Controller
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
            $teaclass = DB::table('teacher_classes')
            ->join('employees', 'teacher_classes.teaid', '=', 'employees.id')
            ->join('classrooms', 'teacher_classes.claid', '=', 'classrooms.id')
            ->join('subjects', 'teacher_classes.subid', '=', 'subjects.id')
            ->select(DB::raw("CONCAT(employees.fname,' ',employees.lname) AS full_name"), 'employees.gender', 'classrooms.classnum', 'teacher_classes.id', 'classrooms.grade', 'subjects.name')
            ->orderBy('teacher_classes.id', 'desc')
            ->get();
            return Datatables::of($teaclass)
                ->addIndexColumn()
                ->addColumn('action', function($teaclass) {
                    return '<a onclick="editForm('. $teaclass->id .')" class="btn btn-primary btn-xs text-white"><i class="fa fa-edit"></i> Edit</a>' . ' <a onclick="deleteData('. $teaclass->id .')" class="btn btn-danger btn-xs text-white"><i class="fa fa-trash"></i> Delete</a>';
                })->make(true);
        }

        $classroom = DB::table('classrooms')->get();
        $teacher = DB::table('employees')->where('type_id', 1)->get();
        $subject = DB::table('subjects')->get();
        return view('class/teacherclass', [
            'classroom' => $classroom,
            'teacher' => $teacher,
            'subject' => $subject
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
        foreach ($request->class as $key => $value) {
            $data = array(
                'branch_id' => $request['branches'],
                'teaid' => $request['teacher'],
                'claid' => $request->class[$key],
                'subid' => $request->subject[$key]
            );
            TeacherClass::create($data);
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
        $teaclass = TeacherClass::find($id);
        return $teaclass;
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
        $teaclass = TeacherClass::find($id);
        $teaclass->teaid = $request['teacher'];
        $teaclass->claid = $request['class'];
        $teaclass->subid = $request['subject'];
        $teaclass->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TeacherClass::destroy($id);
    }
}
