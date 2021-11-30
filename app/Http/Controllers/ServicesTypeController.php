<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Datatables;
use App\Models\ServicesType;

class ServicesTypeController extends Controller
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
            return datatables()->of(ServicesType::select('*'))
            ->addIndexColumn()
            ->addColumn('action', function($discount) {
                return '<a onclick="editForm('. $discount->id .')" class="btn btn-primary btn-xs text-white"><i class="fa fa-edit"></i> Edit</a>' . ' <a onclick="deleteData('. $discount->id .')" class="btn btn-danger btn-xs text-white"><i class="fa fa-trash"></i> Delete</a>';
            })->make(true);
        }
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
            'service_type' => $request['type']
        ];

        return ServicesType::create($data);
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
        $servicestype = ServicesType::find($id);
        return $servicestype;
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
        $servicestype = ServicesType::find($id);
        $servicestype->service_type = $request['type'];
        $servicestype->update();
        return $servicestype;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ServicesType::destroy($id);
    }
}
