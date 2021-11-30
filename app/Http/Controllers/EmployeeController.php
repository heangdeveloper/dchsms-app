<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use App\Models\Employee;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = DB::table('employees')->get();
        $type = DB::table('employee_positions')->get();
        return view('employee/employee', [
            'employee' => $employee,
            'type' => $type,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $type = DB::table('employee_positions')->get();
        $eid = Employee::orderBy('id','desc')->limit(1)->get();
        return view('employee/employee_add', [
            'type' => $type,
            'eid' => $eid
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
        $request->validate([
            'fname' => 'required|string|min:3',
            'lname' => 'required|string|min:3',
            'dob' => 'required',
            'hire' => 'required',
            'email' => 'required',
            'stime' => 'required',
            'ltime' => 'required',
            'tel' => 'required',
            'photo' => 'image|mimes:jpeg,jpg,png|max:1024',
            'national' => 'required',
            'village' => 'required|string|min:3',
            'commune' => 'required|string|min:3',
            'district' => 'required|string|min:3',
            'province' => 'required|string|min:3'
        ]);

        $image = $request->file('photo');
        
        if(isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName  = $currentDate.'-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('employee'))
            {
                Storage::disk('public')->makeDirectory('employee');
            }

            $postImage = Image::make($image)->resize(180,180)->stream();
            Storage::disk('public')->put('employee/'.$imageName, $postImage);
        } else{
            $imageName = "default.png";
        }

        $employee = new Employee;
        $employee->fname = $request->input('fname');
        $employee->lname = $request->input('lname');
        $employee->gender = $request->input('gender');
        $employee->dob = $request->input('dob');
        $employee->type_id = $request->input('career');
        $employee->tel = $request->input('tel');
        $employee->hire = $request->input('hire');
        $employee->stime = $request->input('stime');
        $employee->ltime = $request->input('ltime');
        $employee->email = $request->input('email');
        $employee->national = $request->input('national');
        $employee->photo = $imageName;
        $employee->employee_type = $request->input('type');
        $employee->marital_status = $request->input('marital');
        $employee->village = $request->input('village');
        $employee->commune = $request->input('commune');
        $employee->district = $request->input('district');
        $employee->province = $request->input('province');
        $employee->branch_id = $request->input('branches');

        $employee->save();
        return redirect()->route('employee.create');
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
        $type = DB::table('employee_positions')->get();
        $employee = Employee::find($id);
        return view('employee.employee_edit', [
            'employee' => $employee,
            'type' => $type
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
        $request->validate([
            'fname' => 'required|string|min:3',
            'lname' => 'required|string|min:3',
            'dob' => 'required',
            'hire' => 'required',
            'email' => 'required',
            'stime' => 'required',
            'ltime' => 'required',
            'tel' => 'required',
            'photo' => 'image|mimes:jpeg,jpg,png|max:1024',
            'national' => 'required',
            'village' => 'required|string|min:3',
            'commune' => 'required|string|min:3',
            'district' => 'required|string|min:3',
            'province' => 'required|string|min:3'
        ]);

        $employes = Employee::find($id);
        $image = $request->file('photo');

        if (isset($image)) {

            $currentDate = Carbon::now()->toDateString();
            $imageName  =  $slugen .'-' .$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            if(!Storage::disk('public')->exists('employee'))
            {
                Storage::disk('public')->makeDirectory('employee');
            }

            if(Storage::disk('public')->exists('employee/'.$employes->photo))
            {
                Storage::disk('public')->delete('employee/'.$employes->photo);
            }

            $postImage = Image::make($image)->stream();
            $upload = Storage::disk('public')->put('employee/'.$imageName, $postImage);

            if ($upload) {
                $employes->photo = $imageName;
                $employes->save();

                return redirect()->route('employee.index');
            }

        } else {
            $employes->fname = $request->fname;
            $employes->lname = $request->lname;
            $employes->gender = $request->gender;
            $employes->dob = $request->dob;
            $employes->marital_status = $request->marital;
            $employes->type_id = $request->type;
            $employes->tel = $request->tel;
            $employes->hire = $request->hire;
            $employes->working = $request->working;
            $employes->stime = $request->stime;
            $employes->ltime = $request->ltime;
            $employes->email = $request->email;
            $employes->national = $request->national;
            $employes->vill_id = $request->village;
            $employes->com_id = $request->commune;
            $employes->dist_id = $request->district;
            $employes->pro_id = $request->province;
            $employes->branch_id = $request->branches;
            $employes->save();

            return redirect()->route('employee.index');
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
        $employee = Employee::findOrFail($id);
        Storage::delete('public/employee' . '/' . $employee->photo);

        return redirect()->route('employee.index');
    }
}
