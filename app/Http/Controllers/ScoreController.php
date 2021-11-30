<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Datatables;
use App\Models\Score;
use DB;

class ScoreController extends Controller
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
        $class = DB::table('student_classes')
            ->join('classrooms', 'student_classes.class_id', '=', 'classrooms.id')
            ->join('academic_years', 'student_classes.academic_year_id', '=', 'academic_years.id')
            ->select('student_classes.*', 'classrooms.classnum', 'classrooms.grade', 'academic_years.year')
            ->where('student_classes.branch_id', Auth::user()->campus_id)
            ->limit(1)
            ->get();

        $teacher = DB::table('employees')
            ->select('employees.*', DB::raw("CONCAT(employees.fname,' ',employees.lname) AS full_name"))
            ->where('type_id', '=', '1')
            ->where('branch_id', Auth::user()->campus_id)
            ->get();

        $term = DB::table('terms')->get();

        $student = DB::table('students')->get();
        return view('score/score', [
            'class' => $class,
            'teacher' => $teacher,
            'term' => $term,
            'student' => $student
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
        if ($request->con == 1) {
            $dataSet = [];
            for ($i = 0; $i < count($request->stuid); $i++)
            {
                $dataSet[] = [
                    'teacher_id' => $request->teaname,
                    'class_id' => $request->classs,
                    'term_id' => $request->terms,
                    'branch_id' => $request->branches,
                    'student_id' => $request->stuid[$i],
                    'lart' => $request->la[$i],
                    'math' => $request->ma[$i],
                    'science' => $request->sc[$i],
                    'art' => $request->ar[$i],
                    'music' => $request->mu[$i],
                    'khmer' => $request->kh[$i],
                    'moral' => $request->mo[$i],
                ];
            }
            DB::table('scores')->insert($dataSet);
        } else {
            for ($i = 0; $i < count($request->score_id); $i++)
            { 
                DB::table('scores')
                ->where('id', $request->score_id)
                ->where('teacher_id', $request->teaname)
                ->where('class_id', $request->classs)
                ->where('term_id', $request->terms)
                ->update([
                    'teacher_id' => $request->teaname,
                    'class_id' => $request->classs,
                    'term_id' => $request->terms,
                    'branch_id' => $request->branches,
                    'student_id' => $request->stuid[$i],
                    'lart' => $request->la[$i],
                    'math' => $request->ma[$i],
                    'science' => $request->sc[$i],
                    'art' => $request->ar[$i],
                    'music' => $request->mu[$i],
                    'khmer' => $request->kh[$i],
                    'moral' => $request->mo[$i],
                ]);
            }
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
        //
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
        $score = Score::find($id);
        $score->stuid = $request['tstudent'];
        $score->subid = $request['subject'];
        $score->class_id = $request['class'];
        $score->empid = $request['teacher'];
        $score->term_id = $request['term'];
        $score->score_number = $request['tscore'];
        $score->rate = $request['rate'];
        $score->update();

        return $score;
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

    public function getTeacherClass($id)
    {
        $teacherclass = DB::table('teacher_classes')
        ->join('classrooms', 'teacher_classes.claid', '=', 'classrooms.id')
        ->select('teacher_classes.*', 'classrooms.classnum', 'classrooms.grade')
        ->where('teacher_classes.teaid','=' , $id)
        ->get();
        return json_encode($teacherclass);
    }

    public function getStudentClass(Request $request)
    {
        $db = DB::table('scores')->where('scores.teacher_id', $request->teaname)->where('class_id', $request->classs)->where('scores.term_id', $request->terms)->count();
        
        if ($db == 0) {
            $getscore = DB::table('student_classes')
                ->join('students', 'student_classes.stu_id', '=', 'students.id')
                ->select('student_classes.*', DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS full_name"), 'students.gender', 'students.id AS stuid')
                ->where('student_classes.class_id', '=', $request->classs)
                ->get();
            $i=0;
            $output="
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>N<sup>o</sup></th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Language Arts</th>
                            <th>Mathematics</th>
                            <th>Science</th>
                            <th>Arts</th>
                            <th>Music</th>
                            <th>Khmer</th>
                            <th>Moral Education</th>
                            <th hidden></th>
                            <th hidden></th>
                        </tr>
                    </thead>
            ";

            foreach ($getscore as $row)
            {
                $i++;
                $output.="
                    <tbody>
                    <tr>
                        <td>$i</td>
                        <td>$row->full_name</td>";
                        if ($row->gender == 'Male') {
                            $output .= "<td class='text-center'>M</td>";
                        } else {
                            $output .= "<td class='text-center'>F</td>";
                        }
                        $output .= "<td><input type='number' class='form-control form-control-sm intsc la' style='text-align: center;font-size: 14px; margin: 0 auto;'></td>
                        <td><input type='number' class='form-control form-control-sm intsc ma' style='text-align: center;font-size: 14px; margin: 0 auto;'></td>
                        <td><input type='number' class='form-control form-control-sm intsc sc' style='text-align: center;font-size: 14px; margin: 0 auto;'></td>
                        <td><input type='number' class='form-control form-control-sm intsc ar' style='text-align: center;font-size: 14px; margin: 0 auto;'></td>
                        <td><input type='number' class='form-control form-control-sm intsc mu' style='text-align: center;font-size: 14px; margin: 0 auto;'></td>
                        <td><input type='number' class='form-control form-control-sm intsc kh' style='text-align: center;font-size: 14px; margin: 0 auto;'></td>
                        <td><input type='number' class='form-control form-control-sm intsc mo' style='text-align: center;font-size: 14px; margin: 0 auto;'></td>
                        <td hidden><input type='text' class='stuid' value='" . $row->stu_id . "'></td>
                        <td hidden><input type='text' class='terms' value='" . $request->terms . "'></td>
                        <td hidden><input type='text' class='teaname' value='" . $request->teaname . "'></td>
                        <td hidden><input type='text' class='branches' value='" . $request->branches . "'></td>
                    </tr>
               ";
            }
            $output.="</tbody></table></div>";

            return response(['output' => $output, 'con' => 1]);
        } else {
            $getscore = DB::table('scores')
                ->join('students', 'scores.student_id', '=', 'students.id')
                ->select('scores.*', DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS full_name"), 'students.gender', 'students.id AS stuid')
                ->where('scores.class_id', '=', $request->classs)
                ->where('scores.term_id', '=', $request->terms)
                ->get();

            $i=0;
                $output="
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th class='text-center'>N<sup>o</sup></th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Language Arts</th>
                                <th>Mathematics</th>
                                <th>Science</th>
                                <th>Arts</th>
                                <th>Music</th>
                                <th>Khmer</th>
                                <th>Moral Education</th>
                                <th hidden></th>
                                <th hidden></th>
                            </tr>
                        </thead>
                ";

                foreach ($getscore as $row)
                {
                    $i++;
                    $output.="
                        <tbody>
                        <tr>
                            <td class='text-center'>$i</td>
                            <td>$row->full_name</td>";
                            if ($row->gender == 'Male') {
                                $output .= "<td class='text-center'>M</td>";
                            } else {
                                $output .= "<td class='text-center'>F</td>";
                            }
                            $output .= "<td><input type='number' class='form-control form-control-sm intsc la' style='text-align: center;font-size: 14px; margin: 0 auto;' value='" . $row->lart . "'></td>
                            <td><input type='number' class='form-control form-control-sm intsc ma' style='text-align: center;font-size: 14px; margin: 0 auto;' value='" . $row->math . "'></td>
                            <td><input type='number' class='form-control form-control-sm intsc sc' style='text-align: center;font-size: 14px; margin: 0 auto;' value='" . $row->science . "'></td>
                            <td><input type='number' class='form-control form-control-sm intsc ar' style='text-align: center;font-size: 14px; margin: 0 auto;' value='" . $row->art . "'></td>
                            <td><input type='number' class='form-control form-control-sm intsc mu' style='text-align: center;font-size: 14px; margin: 0 auto;' value='" . $row->music . "'></td>
                            <td><input type='number' class='form-control form-control-sm intsc kh' style='text-align: center;font-size: 14px; margin: 0 auto;' value='" . $row->khmer . "'></td>
                            <td><input type='number' class='form-control form-control-sm intsc mo' style='text-align: center;font-size: 14px; margin: 0 auto;' value='" . $row->moral . "'></td>
                            <td hidden><input type='text' class='stuid' value='" . $row->student_id . "'></td>
                            <td hidden><input type='text' class='terms' value='" . $row->term_id . "'></td>
                            <td hidden><input type='text' class='teaname' value='" . $row->teacher_id . "'></td>
                            <td hidden><input type='text' class='branches' value='" . $row->branch_id . "'></td>
                            <td hidden><input type='text' class='score_id' value='" . $row->id . "'></td>
                        </tr>
                   ";
                }
                $output.="</tbody></table></div>";

                return response(['output' => $output, 'con' => 2]);
        }
    }
}
