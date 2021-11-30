<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\Models\ProductServices;
use DB;

class ProductServicesController extends Controller
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
        if ($request->ajax()) {
            $frm_service_1 = [
                "pro_service" => "Tuition Fee - Half Day 1.5 years old to under 2.5 years old",
                "price_service" => $request->per_term_1year_to_2year_half_day,
                "id_service_type" => 1,
                'id_academic' => $request->year,
                'pay_month' => 3,
                'branch_id' => Auth::user()->campus_id
            ];
            $insert1[] = $frm_service_1;
            $result1 = DB::Table('product_services')->insert($insert1);

            if ($result1)
            {
                $frm_service_2 = [
                    "pro_service" => "Tuition Fee - Half Day 1.5 years old to under 2.5 years old",
                    "price_service" => $request->per_semester_1year_to_2year_half_day,
                    "id_service_type" => 1,
                    'id_academic' => $request->year,
                    'pay_month' => 6,
                    'branch_id' => Auth::user()->campus_id
                ];
                $insert2[] = $frm_service_2;
                $result2= DB::Table('product_services')->insert($insert2);
            }

            if ($result2)
            {
                $frm_service_3 = [
                    "pro_service" => "Tuition Fee - Half Day 1.5 years old to under 2.5 years old",
                    "price_service" => $request->per_year_1year_to_2year_half_day,
                    "id_service_type" => 1,
                    'id_academic' => $request->year,
                    'pay_month' => 12,
                    'branch_id' => Auth::user()->campus_id
                ];
                $insert3[] = $frm_service_3;
                $result3 = DB::Table('product_services')->insert($insert3);
            }

            if ($result3)
            {
                $frm_service_4 = [
                    "pro_service" => "Tuition Fee - Full Day 1.5 years old to under 2.5 years old",
                    "price_service" => $request->per_term_1year_to_2year_full_day,
                    "id_service_type" => 1,
                    'id_academic' => $request->year,
                    'pay_month' => 3,
                    'branch_id' => Auth::user()->campus_id
                ];
                $insert4[] = $frm_service_4;
                $result4 = DB::Table('product_services')->insert($insert4);
            }

            if ($result4)
            {
                $frm_service_5 = [
                    "pro_service" => "Tuition Fee - Full Day 1.5 years old to under 2.5 years old",
                    "price_service" => $request->per_semester_1year_to_2year_full_day,
                    "id_service_type" => 1,
                    'id_academic' => $request->year,
                    'pay_month' => 6,
                    'branch_id' => Auth::user()->campus_id
                ];
                $insert5[] = $frm_service_5;
                $result5 = DB::Table('product_services')->insert($insert5);
            }

            if ($result5)
            {
                $frm_service_6 = [
                    "pro_service" => "Tuition Fee - Full Day 1.5 years old to under 2.5 years old",
                    "price_service" => $request->per_year_1year_to_2year_full_day,
                    "id_service_type" => 1,
                    'id_academic' => $request->year,
                    'pay_month' => 12,
                    'branch_id' => Auth::user()->campus_id
                ];
                $insert6[] = $frm_service_6;
                $result6 = DB::Table('product_services')->insert($insert6);
            }

            $frm_service_7 = [
                "pro_service" => "Tuition Fee - Half Day 2.5 years old to under 6 years old",
                "price_service" => $request->per_term_2year_to_6year_half_day,
                "id_service_type" => 1,
                'id_academic' => $request->year,
                'pay_month' => 3,
                'branch_id' => Auth::user()->campus_id
            ];
            $insert7[] = $frm_service_7;
            $result7 = DB::Table('product_services')->insert($insert7);

            if ($result7)
            {
                $frm_service_8 = [
                    "pro_service" => "Tuition Fee - Half Day 2.5 years old to under 6 years old",
                    "price_service" => $request->per_semester_2year_to_6year_half_day,
                    "id_service_type" => 1,
                    'id_academic' => $request->year,
                    'pay_month' => 6,
                    'branch_id' => Auth::user()->campus_id
                ];
                $insert8[] = $frm_service_8;
                $result8 = DB::Table('product_services')->insert($insert8);
            }

            if ($result8)
            {
                $frm_service_9 = [
                    "pro_service" => "Tuition Fee - Half Day 2.5 years old to under 6 years old",
                    "price_service" => $request->per_year_2year_to_6year_half_day,
                    "id_service_type" => 1,
                    'id_academic' => $request->year,
                    'pay_month' => 12,
                    'branch_id' => Auth::user()->campus_id
                ];
                $insert9[] = $frm_service_9;
                $result9 = DB::Table('product_services')->insert($insert9);
            }

            if ($result9)
            {
                $frm_service_10 = [
                    "pro_service" => "Tuition Fee - Half Day 2.5 years old to under 6 years old",
                    "price_service" => $request->per_term_2year_to_6year_full_day,
                    "id_service_type" => 1,
                    'id_academic' => $request->year,
                    'pay_month' => 3,
                    'branch_id' => Auth::user()->campus_id
                ];
                $insert10[] = $frm_service_10;
                $result10 = DB::Table('product_services')->insert($insert10);
            }

            if ($result10)
            {
                $frm_service_11 = [
                    "pro_service" => "Tuition Fee - Half Day 2.5 years old to under 6 years old",
                    "price_service" => $request->per_semester_2year_to_6year_full_day,
                    "id_service_type" => 1,
                    'id_academic' => $request->year,
                    'pay_month' => 6,
                    'branch_id' => Auth::user()->campus_id
                ];
                $insert11[] = $frm_service_11;
                $result11 = DB::Table('product_services')->insert($insert11);
            }

            if ($result11)
            {
                $frm_service_12 = [
                    "pro_service" => "Tuition Fee - Half Day 2.5 years old to under 6 years old",
                    "price_service" => $request->per_year_2year_to_6year_full_day,
                    "id_service_type" => 1,
                    'id_academic' => $request->year,
                    'pay_month' => 12,
                    'branch_id' => Auth::user()->campus_id
                ];
                $insert12[] = $frm_service_12;
                $result12 = DB::Table('product_services')->insert($insert12);
            }
        } else {
            // return redirect()->back();
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
        $pro_services = ProductServices::find($id);
        return $pro_services;
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
        $pro_services = ProductServices::find($id);
        $pro_services->id_academic = $request['year_edit'];
        $pro_services->pro_service = $request['services_edit'];
        $pro_services->price_service = $request['price_edit'];
        $pro_services->pay_month = $request['month_edit'];
        $pro_services->branch_id = Auth::user()->campus_id;
        $pro_services->update();
        return $pro_services;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductServices::destroy($id);
    }

    public function show_proservice($idpaid, $idyear)
    {
        if(request()->ajax()) {
            $pro_services = DB::table('product_services')
            ->join('services_types', 'product_services.id_service_type', '=', 'services_types.id')
            ->join('academic_years', 'product_services.id_academic', '=', 'academic_years.id')
            ->select('product_services.*', 'services_types.service_type', 'academic_years.year')
            ->where('product_services.pay_month', $idpaid)
            ->where('product_services.id_academic', $idyear)
            ->get();
            return Datatables::of($pro_services)
                ->addIndexColumn()
                ->addColumn('action', function($pro_services) {
                    return '<a onclick="editServices('. $pro_services->id .')" class="btn btn-primary btn-xs text-white"><i class="fa fa-edit"></i> Edit</a>' . ' <a onclick="deleteServices('. $pro_services->id .')" class="btn btn-danger btn-xs text-white"><i class="fa fa-trash"></i> Delete</a>';
                })->make(true);
        }
    }
}
