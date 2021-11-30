<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\ProductServices;
use DB;

class StudentRegisterController extends Controller
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
        $year = DB::table('academic_years')->orderBy('id', 'desc')->get();
        $student = DB::table('students')->orderBy('id', 'desc')->get();
        $pay_method = DB::table('payment_methods')->get();
        $compuse = DB::table('compuses')->where('id', Auth::user()->campus_id)->first();
        return view('register.register_view', [
            'student' => $student,
            'year' => $year,
            'pay_method' => $pay_method,
            'compuse' => $compuse
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
        //
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

    public function selectInfoByID($id)
    {
        $student = Student::where('id', $id)->first();

        $balance = DB::table('payments')
        ->join('students', 'payments.student_id', '=', 'students.id')
        ->join('payment_details', 'payment_details.id_payment', '=', 'payments.id')
        ->join('invoices', 'payment_details.id_invoice', '=', 'invoices.id')
        ->select(DB::raw("SUM(payment_details.total_payment) as balance"), DB::raw("COUNT(payment_details.id_invoice) as invoice"))
        ->where('students.id', $id)
        ->where('payment_details.branch_id', Auth::user()->campus_id)
        ->first();

        $deposit = DB::table('payments')
        ->select(DB::raw('SUM(payments.deposit) as deposit'))
        ->where('student_id', $id)
        ->where('payments.branch_id', Auth::user()->campus_id)
        ->first();

        $payment = DB::table('payments')
        ->join('payment_details', 'payments.id', '=', 'payment_details.id_payment')
        ->join('students', 'payments.student_id', '=', 'students.id')
        ->join('payment_methods', 'payments.payment_method', '=', 'payment_methods.id')
        ->join('invoices', 'payment_details.id_invoice', '=', 'invoices.id')
        ->join('users','payment_details.user_id_pay','=','users.id')
        ->select('invoices.invoice_number','users.fullname','invoices.id as Invoice_id','students.id', DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS en_name"), 'payments.invoice_des', 'payments.payment_date', 'payments.due_date', 'payments.deposit', DB::raw('SUM(payment_details.total_payment) as total_pay'), 'payment_methods.payment_method')
        ->where('students.id', $id)
        ->where('payment_details.branch_id', Auth::user()->campus_id)
        ->groupBy('payment_details.id_payment')
        ->get();

        $count_expired_date = DB::table('payments')
        ->join('payment_details', 'payments.id', '=', 'payment_details.id_payment')
        ->join('invoices', 'payment_details.id_invoice', '=', 'invoices.id')
        ->join('students', 'payments.student_id', '=', 'students.id')
        ->join('payment_methods', 'payments.payment_method', '=', 'payment_methods.id')
        ->join('users','payment_details.user_id_pay','=','users.id')
        ->select(DB::raw('COUNT(expired_date) as over_due'),'students.id')
        ->where('students.id', $id)
        ->where('payment_details.expired_date','<=', Carbon::today())
        ->where('payment_details.branch_id', Auth::user()->campus_id)
        ->first();

        return response()->json([
            "student" => $student,
            "data_payment" => $balance,
            "deposit" => $deposit,
            "data" => $payment,
            "count_over_due" => $count_expired_date,
        ]);
    }

    public function searchOverdue($id)
    {
        $payment = DB::table('payments')
        ->join('payment_details', 'payments.id', '=', 'payment_details.id_payment')
        ->join('invoices', 'payment_details.id_invoice', '=', 'invoices.id')
        ->join('students', 'payments.student_id', '=', 'students.id')
        ->join('payment_methods', 'payments.payment_method', '=', 'payment_methods.id')
        ->join('users','payment_details.user_id_pay','=','users.id')
        ->select('invoices.invoice_number','users.fullname','payment_details.Volidty_of_payment','payment_details.expired_date','invoices.id as Invoice_id','students.id', DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS en_name"), 'payment_details.description', 'payments.payment_date', 'payments.due_date', 'payments.deposit',  'payment_methods.payment_method')
        ->where('students.id', $id)
        ->where('payment_details.expired_date','<=', Carbon::today())
        ->get();
        return response()->json([
            "data" => $payment
        ]);
    }

    public function save_prosevice(Request $request)
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
                    return '<a onclick="editForm('. $pro_services->id .')" class="btn btn-primary btn-xs text-white"><i class="fa fa-edit"></i> Edit</a>' . ' <a onclick="deleteServices('. $pro_services->id .')" class="btn btn-danger btn-xs text-white"><i class="fa fa-trash"></i> Delete</a>';
                })->make(true);
        }
    }

    public function delete_service($id)
    {
        ProductServices::destroy($id);
    }

    public function searhByDate(Request $request)
    {
        $from = date($request->from_date);
        $to = date($request->to_date);
        $pay_method = $request->pay_method;

        if($request->ajax()){
            if($pay_method == "allpay") {
                $payment = DB::table('payments')
                ->join('payment_details', 'payments.id', '=', 'payment_details.id_payment')
                ->join('invoices', 'payment_details.id_invoice', '=', 'invoices.id')
                ->join('students', 'payments.student_id', '=', 'students.id')
                ->join('payment_methods', 'payments.payment_method', '=', 'payment_methods.id')
                ->join('users','payment_details.user_id_pay','=','users.id')
                ->select('invoices.invoice_number','users.fullname','invoices.id as Invoice_id','students.id', DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS en_name"), 'payments.invoice_des', 'payments.payment_date', 'payments.due_date', 'payments.deposit', DB::raw('SUM(payment_details.total_payment) as total_pay'), 'payment_methods.payment_method')
                ->where('students.id', $request->id)
                ->whereBetween('payments.payment_date', [$from, $to])
                ->groupBy('payment_details.id_payment')
                ->get();
            } elseif ($pay_method == 1) {
                $payment = DB::table('payments')
                ->join('payment_details', 'payments.id', '=', 'payment_details.id_payment')
                ->join('invoices', 'payment_details.id_invoice', '=', 'invoices.id')
                ->join('students', 'payments.student_id', '=', 'students.id')
                ->join('payment_methods', 'payments.payment_method', '=', 'payment_methods.id')
                ->join('users','payment_details.user_id_pay','=','users.id')
                ->select('invoices.invoice_number','users.fullname','invoices.id as Invoice_id','students.id', DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS en_name"), 'payments.invoice_des', 'payments.payment_date', 'payments.due_date', 'payments.deposit', DB::raw('SUM(payment_details.total_payment) as total_pay'), 'payment_methods.payment_method')
                ->where('students.id', $request->id)
                ->where('payments.payment_method', $request->pay_method)
                ->whereBetween('payments.payment_date', [$from, $to])
                ->groupBy('payment_details.id_payment')
                ->get();
            } else {
                $payment = DB::table('payments')
                ->join('payment_details', 'payments.id', '=', 'payment_details.id_payment')
                ->join('invoices', 'payment_details.id_invoice', '=', 'invoices.id')
                ->join('students', 'payments.student_id', '=', 'students.id')
                ->join('payment_methods', 'payments.payment_method', '=', 'payment_methods.id')
                ->join('users','payment_details.user_id_pay','=','users.id')
                ->select('invoices.invoice_number','users.fullname','invoices.id as Invoice_id','students.id', DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS en_name"), 'payments.invoice_des', 'payments.payment_date', 'payments.due_date', 'payments.deposit', DB::raw('SUM(payment_details.total_payment) as total_pay'), 'payment_methods.payment_method')
                ->where('students.id', $request->id)
                ->where('payments.payment_method', $request->pay_method)
                ->whereBetween('payments.payment_date', [$from, $to])
                ->groupBy('payment_details.id_payment')
                ->get();
            }
        }

        return response()->json([
            "data" => $payment
        ]);
    }

    public function viewDeposit_View(Request $request)
    {
        $payment = DB::table('payments')
        ->join('payment_details', 'payments.id', '=', 'payment_details.id_payment')
        ->join('invoices', 'payment_details.id_invoice', '=', 'invoices.id')
        ->join('students', 'payments.student_id', '=', 'students.id')
        ->join('payment_methods', 'payments.payment_method', '=', 'payment_methods.id')
        ->join('users','payment_details.user_id_pay','=','users.id')
        ->select('invoices.invoice_number','users.fullname','invoices.id as Invoice_id','students.id', DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS en_name"), 'payments.invoice_des', 'payments.payment_date', 'payments.due_date', 'payments.deposit', DB::raw('SUM(payment_details.total_payment) as total_pay'), 'payment_methods.payment_method')
        ->where('students.id', $request->id)
        ->where('payments.deposit', '!=', 'null')
        ->where('payment_details.branch_id', Auth::user()->campus_id)
        ->groupBy('payment_details.id_payment')
        ->get();

        return response()->json([
            'data' => $payment
        ]);
    }

    public function viewInvoice($id_student, $id_payment)
    {
        $output = '';

        $payment = DB::table('payments')
        ->join('payment_details', 'payments.id', '=', 'payment_details.id_payment')
        ->join('invoices', 'payment_details.id_invoice', '=', 'invoices.id')
        ->join('students', 'payments.student_id', '=', 'students.id')
        ->join('payment_methods', 'payments.payment_method', '=', 'payment_methods.id')
        ->join('users','payment_details.user_id_pay','=','users.id')
        ->select('invoices.invoice_number','payment_details.total_amount as original_price' ,'invoices.id as Invoice_id','students.id', DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS en_name"), 'payment_details.description', 'payments.payment_date', 'payments.due_date', 'payments.deposit', 'payment_methods.payment_method')
        ->where('students.id', $id_student)
        ->where('invoices.id', $id_payment)
        ->get();

        $header = DB::table('payments')
        ->join('payment_details', 'payments.id', '=', 'payment_details.id_payment')
        ->join('invoices', 'payment_details.id_invoice', '=', 'invoices.id')
        ->join('students', 'payments.student_id', '=', 'students.id')
        ->join('payment_methods', 'payments.payment_method', '=', 'payment_methods.id')
        ->join('users','payment_details.user_id_pay','=','users.id')
        ->select('invoices.invoice_number','payment_details.total_amount as original_price' ,'invoices.id as Invoice_id','students.id', DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS en_name"), 'payment_details.description', 'payments.payment_date', 'payments.due_date', 'payments.deposit', 'payment_methods.payment_method', DB::raw('SUM(payment_details.lose_piad) as total_discount'), DB::raw('SUM(payment_details.total_amount) as total_subtotal'))
        ->where('students.id', $id_student)
        ->where('invoices.id', $id_payment)
        ->first();

        $total_row = $payment->count();
        if($total_row > 0) {
            foreach($payment as $row) {
                $output .= '
                    <tr>
                        <td style="text-align: left;font-size: 12px">' . $row->description . '</td>
                        <td style="vertical-align: middle;text-align: center;font-size: 12px">1.00</td>
                        <td style="vertical-align: middle;text-align: center;font-size: 12px">$ ' . number_format( $row->original_price, 2) . '</td>
                        <td style="vertical-align: middle;text-align: center;font-size: 12px">$ ' . number_format( $row->original_price, 2) . '</td>
                    </tr>';
            }
        }

        return response()->json([
            "descriptions" => $output,
            "header" => $header
        ]);
    }
}
