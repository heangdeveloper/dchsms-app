<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Parents;
use DB;

class StudentController extends Controller
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
        $student = DB::table('students')
        ->where('status', '=', 'Studying')
        ->get();

        $stustop = DB::table('students')
        ->where('status', '=', 'Stop')
        ->get();

        $stuskip = DB::table('students')
        ->where('status', '=', 'Suspension')
        ->get();
        return view('student/student', [
            'student' => $student,
            'stustop' => $stustop,
            'stuskip' => $stuskip
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $curriculum = DB::table('curricula')->get();
        $sid = DB::table('students')->orderBy('id', 'desc')->limit(1)->get();
        return view('student/student_add', [
            'curriculum' => $curriculum,
            'sid' => $sid
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('photo');
        
        if(isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('student'))
            {
                Storage::disk('public')->makeDirectory('student');
            }

            $postImage = Image::make($image)->resize(180,180)->stream();
            Storage::disk('public')->put('student/'.$imageName, $postImage);
        } else{
            $imageName = "default.png";
        }

        $students = new Student;
        $students->stuno = $request->input('txtstuid');
        $students->sunamekh = $request->input('txtsunamekh');
        $students->finamekh = $request->input('txtfinamekh');
        $students->sunameen = $request->input('txtsunameen');
        $students->finameen = $request->input('txtfinameen');
        $students->gender = $request->input('txtgender');
        $students->dob = $request->input('txtdob');
        $students->img = $imageName;
        $students->race = $request->input('txtrace');
        $students->tel = $request->input('txttel');
        $students->national = $request->input('txtnational');
        $students->village = $request->input('txtvill');
        $students->commune = $request->input('txtcomm');
        $students->district = $request->input('txtdist');
        $students->province = $request->input('txtpro');
        $students->from_school = $request->input('txtfrom');
        $students->level = $request->input('txtlevel');
        $students->date_admission = $request->input('txtdate');
        $students->status = 'Studying';
        $students->farther_name = $request->input('fname');
        $students->mother_name = $request->input('mname');
        $students->farther_address = $request->input('fa');
        $students->mother_address = $request->input('ma');
        $students->father_job = $request->input('fj');
        $students->mother_job = $request->input('mj');
        $students->father_status = $request->input('fs');
        $students->mother_status = $request->input('ms');
        $students->father_race = $request->input('fr');
        $students->mother_race = $request->input('mr');
        $students->father_national = $request->input('fn');
        $students->mother_national = $request->input('mn');
        $students->branch_id = $request->input('branches');

        $students->save();
        return redirect()->route('student.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = DB::table('students')
        ->where('id', '=' , $id)
        ->where('branch_id', Auth::user()->campus_id)
        ->get();

        $fa = DB::table('parents')->where(["ralated"=>"Father","stuno"=>$id])->get();
        $ma = DB::table('parents')->where(["ralated"=>"Mother","stuno"=>$id])->get();
        return view('student/student_detail', [
            'student' => $student,
            'fa' => $fa,
            'ma' => $ma
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
        $data = Student::findorfail($id);

        return view('student/student_edit', [
            'd' => $data
        ]);
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
        $students = Student::findorfail($id);
        $image = $request->file('photo');

        if (isset($image)) {

            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('student'))
            {
                Storage::disk('public')->makeDirectory('student');
            }

            if(Storage::disk('public')->exists('student/'.$students->img))
            {
                Storage::disk('public')->delete('student/'.$students->img);
            }

            $postImage = Image::make($image)->stream();
            $upload = Storage::disk('public')->put('student/'.$imageName, $postImage);

            if ($upload) {
                $students->img = $imageName;
                $students->save();

                return redirect()->route('student.index');
            }

        } else {
            $students->stuno = $request->input('txtstuid');
            $students->sunamekh = $request->input('txtsunamekh');
            $students->finamekh = $request->input('txtfinamekh');
            $students->sunameen = $request->input('txtsunameen');
            $students->finameen = $request->input('txtfinameen');
            $students->gender = $request->input('txtgender');
            $students->dob = $request->input('txtdob');
            $students->race = $request->input('txtrace');
            $students->tel = $request->input('txttel');
            $students->national = $request->input('txtnational');
            $students->village = $request->input('txtvill');
            $students->commune = $request->input('txtcomm');
            $students->district = $request->input('txtdist');
            $students->province = $request->input('txtpro');
            $students->from_school = $request->input('txtfrom');
            $students->level = $request->input('txtlevel');
            $students->date_admission = $request->input('txtdate');
            $students->status = $request->input('txtstatus');
            $students->farther_name = $request->input('fname');
            $students->mother_name = $request->input('mname');
            $students->farther_address = $request->input('fa');
            $students->mother_address = $request->input('ma');
            $students->father_job = $request->input('fj');
            $students->mother_job = $request->input('mj');
            $students->father_status = $request->input('fs');
            $students->mother_status = $request->input('ms');
            $students->father_race = $request->input('fr');
            $students->mother_race = $request->input('mr');
            $students->father_national = $request->input('fn');
            $students->mother_national = $request->input('mn');
            $students->branch_id = $request->input('branches');

            $students->save();
            return redirect()->route('student.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        Storage::delete('public/student' . '/' . $student->img);
        $student->delete();

        return redirect()->route('student.index');
    }

    public function getstuid(Request $r)
    {
        $stuid = Student::where('id', $r->stuid)->get();
        return count($stuid);
    }
}
