<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\Invoice;
use DB;

class PaymentController extends Controller
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
        //
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
        if($request->ajax()){
            $frm_payment = [
                'student_id' => $request->student_id,
                'payment_date' => $request->payment_date,
                'due_date' => $request->due_date,
                'payment_method' => $request->payment_method,
                'invoice_des' => $request->invoice_des,
                'deposit' => $request->txtdeposit,
                'year_academic' => $request->txtacademic,
                'branch_id' => Auth::user()->campus_id
            ];
            $p = Payment::create($frm_payment);
            if($p == true){
                $invoice = Invoice::create(['invoice_number' => $request->txt_text_invoice, 'branch_id' => Auth::user()->campus_id]);
                if($invoice == true){
                    $payment_id = Payment::latest('id')->first();
                    for($i = 0; $i < count($request->qty); $i++){
                        $form_pay = [
                            'id_invoice' => $request->invoice_id,
                            'id_payment' => $payment_id->id,
                            'id_inovice_type' => $request->id_invoice_type,
                            'id_pro_service' => $request->id_pro_service[$i],
                            'id_payterm' => $request->id_payterm[$i],
                            'branch_id' => $request->branch_id,
                            'user_id_pay' => $request->user_id_pay,
                            'description' => $request->description[$i],
                            'qty'=> $request->qty[$i],
                            'ori_price' => $request->ori_price[$i],
                            'disccount' => $request->disccount[$i],
                            'total_amount' => $request->amount[$i],
                            'Volidty_of_payment' => $request->Volidty_of_payment[$i],
                            'expired_date' => $request->expired_date[$i],
                            'school_year' => $request->school_year[$i],
                            'remark' => $request->remark
                        ];
                        $insert[] = $form_pay;
                    }
                }
                PaymentDetail::insert($insert);
            }
        }
        return response()->json("success insert",200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pay_type = DB::table('pay_type')->get();
        $payment_methods = DB::table('payment_methods')->get();
        $year = DB::table('academic_years')->orderBy('id', 'desc')->get();
        $discount = DB::table('discount_types')->get();
        $student = Student::where('branch_id', Auth::user()->campus_id)->where('id', $id)->get();
        $compuse = DB::table('compuses')->where('id', Auth::user()->campus_id)->first();

        return view('payment.payment')
        ->with('student', $student)
        ->with('year', $year)
        ->with('payment_methods', $payment_methods)
        ->with('discount', $discount)
        ->with('pay_type', $pay_type)
        ->with('compuse', $compuse);
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

    public function selectTypePay(Request $request)
    {
        $pro_sevice = DB::table('product_services')
        ->join('academic_years', 'product_services.id_academic', '=', 'academic_years.id')
        ->join('services_types', 'product_services.id_service_type', '=', 'services_types.id')
        ->select('product_services.*', 'academic_years.year', 'services_types.service_type')
        ->where('pay_month', $request->txtterm)
        ->where('id_academic', $request->id_acedemic)
        ->get();

        //$pro_sevice=DB::Table('product_services')->where('pay_month', $request->txtterm)->where('id_academic', $request->id_acedemic)->get();
        return json_encode($pro_sevice);
    }

    public function getinvoice()
    {
        $invoice = DB::Table('invoices')->where('branch_id', auth()->user()->campus_id)->latest('id')->first();
        if(is_null($invoice))
        {
            $id_two = 1;
            $num_invoice = 1000;

        }else{
            $id_two = $invoice->id+1;
            $num_invoice = $invoice->invoice_number+1;
        }
        return response()->json([
            'num_invoice' => $num_invoice,
            'id_invoice' => $id_two
        ]);
    }

    public function save_payment(Request $request)
    {
        if($request->ajax()){
            $frm_payment = [
                'student_id' => $request->student_id,
                'payment_date' => $request->payment_date,
                'due_date' => $request->due_date,
                'payment_method' => $request->payment_method,
                'invoice_des' => $request->invoice_des,
                'deposit' => $request->txtdeposit,
                'year_academic' => $request->txtacademic,
                'branch_id' => Auth::user()->campus_id
            ];

            $p = Payment::create($frm_payment);

            if($p == true){

                $invoice = Invoice::create(['invoice_number' => $request->txt_text_invoice, 'branch_id' => Auth::user()->campus_id]);

                if($invoice == true){
                    $payment_id = Payment::latest('id')->first();
                    for($i = 0; $i < count($request->qty); $i++){
                        $form_pay = [
                            'id_invoice' => $request->invoice_id,
                            'id_payment' => $payment_id->id,
                            'id_inovice_type' => $request->id_invoice_type,
                            'id_pro_service' => $request->id_pro_service[$i],
                            'id_payterm' => $request->id_payterm[$i],
                            'branch_id' => $request->branch_id,
                            'user_id_pay' => $request->user_id_pay,
                            'description' => $request->description[$i],
                            'qty' => $request->qty[$i],
                            'ori_price' => $request->ori_price[$i],
                            'disccount' => $request->disccount[$i],
                            'total_amount' => $request->amount[$i],
                            'Volidty_of_payment' => $request->Volidty_of_payment[$i],
                            'expired_date' => $request->expired_date[$i],
                            'school_year' => $request->school_year[$i],
                            'remark' => $request->remark,
                        ];
                        $insert[] = $form_pay;
                    }
                }

                PaymentDetail::insert($insert);
            }
            return response()->json("Data save paid successfully ",200);
        }else{
            return response()->json("Data save pay Not successfully",501);

        }
    }
}
