<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CashCollectionReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reportCashCollection(Request $request)
    {
        $report = DB::table('payments')
        ->join('payment_details', 'payments.id', '=', 'payment_details.id_payment')
        ->join('invoices', 'payment_details.id_invoice', '=', 'invoices.id')
        ->join('students', 'payments.student_id', '=', 'students.id')
        ->join('payment_methods', 'payments.payment_method', '=', 'payment_methods.id')
        ->join('users','payment_details.user_id_pay','=','users.id')
        ->select(DB::raw("CONCAT(students.sunameen,' ',students.finameen) AS en_name"), 'users.fullname', 'invoices.invoice_number', 'payments.payment_date', 'payment_details.description','payment_details.total_amount','payment_details.total_payment')
        ->whereBetween('payments.payment_date', array($request->start_date, $request->from_date))
        ->where('payment_details.branch_id', Auth::user()->campus_id)
        ->get();

        return response()->json([
        	'report' => $report
        ]);
    }

    public function report()
    {
        
    }
}
