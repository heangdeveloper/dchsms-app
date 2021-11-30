<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Datatables;
use App\Models\AcademicYear;

class SchoolYearController extends Controller
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
            return datatables()->of(AcademicYear::select('*'))
            ->addIndexColumn()
            ->addColumn('action', function($schoolyear) {
                return '<a onclick="editForm('. $schoolyear->id .')" class="btn btn-primary btn-xs text-white"><i class="fa fa-edit"></i> Edit</a>' . ' <a onclick="deleteData('. $schoolyear->id .')" class="btn btn-danger btn-xs text-white"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }
        
        return view('schoolyear/schoolyear');
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
        $data = [
            'year' => $request['schoolyear']
        ];

        return AcademicYear::create($data);
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
        $schoolyear = AcademicYear::find($id);
        return $schoolyear;
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
        $schoolyear = AcademicYear::find($id);
        $schoolyear->year = $request['schoolyear'];
        $schoolyear->update();

        return $schoolyear;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AcademicYear::destroy($id);
    }
}
