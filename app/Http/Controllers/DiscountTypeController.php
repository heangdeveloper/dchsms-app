<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Datatables;
use App\Models\DiscountType;

class DiscountTypeController extends Controller
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
            return datatables()->of(DiscountType::select('*'))
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
            'discount_name' => $request['description'],
            'percent_dis' => $request['discount'],
            'from_date' => $request['fdate'],
            'exp_date' => $request['edate'],
            'note' => $request['note'],
            'status' => $request['status']
        ];

        return DiscountType::create($data);
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
        $discount = DiscountType::find($id);
        return $discount;
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
        $discount = DiscountType::find($id);
        $discount->discount_name = $request['description'];
        $discount->percent_dis = $request['discount'];
        $discount->from_date = $request['fdate'];
        $discount->exp_date = $request['edate'];
        $discount->note = $request['note'];
        $discount->status = $request['status'];
        $discount->update();
        return $discount;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DiscountType::destroy($id);
    }
}
