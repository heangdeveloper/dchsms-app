@extends('layout.app')
@section('header')
    <style>
        .form-control {
            height: 34px;
            font-size: 13px;
            border: 1px solid #f1f1f1;
            border-radius: 0;
        }
        .table > thead {
            background-color: #2A629C;
            color: #fff;
            text-align: center;
            font-size: 14px;
            text-transform: uppercase;
        }
        label {
            font-size: 13px !important;
        }
        #tbl_print_invoice > tbody > tr > td{
            font-size: 7pt;
        }
    </style>
    <style>@page { size: A5 }</style>
@endsection
@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-gradient-success">
                <h6 class="text-left font-weight-bold" style="font-size: 18px;">Invoice\Enrollment</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    {{--for hide value sub_total--}}
                    <input type="hidden" id="value_subtotal" value="0">
                    {{--for hide value discount--}}
                    <input type="hidden" id="value_discount" value="0">
                    
                    <div class="col-12 col-xl-4 bg-light py-4 px-4">
                        <div class="form-horizontal">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Nº </label>
                                <div class="col-sm-10">
                                    <input type="text" id="txtinvoice"  hidden="" value="">
                                    <input type="text" class="form-control" id="txt_text_invoice" placeholder="Receipt ID" value="" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Date </label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="txtdatepay">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Type </label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="txtinvoice_type">
                                        <option value="1">Commercial Invoice</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Student </label>
                                <div class="col-sm-10">
                                    <select class="form-control js-states" id="txtstudent">
                                        @foreach($student as $row)
                                            <option value="{{ $row->id }}">{{ $row->sunameen }} {{ $row->finameen }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" style="border: 2px solid white; width: 100%; background-color: #f1f4f7; padding: 20px;">
                                <div class="col-sm-12">
                                    <p style="text-align: left;font-size: 16px;font-weight: bold;color: #358ED7">Amount Due :</p>
                                    <p style="text-align: right;font-size: 20px;font-weight: bold;color:#358ED7" id="label_amount_due"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#invoice"><i class="fas fa-cog"></i> Invoice</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane container active" id="invoice">
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="form-horizontal">
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label">Paid for </label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control js-states" id="txtterm">
                                                                <option value="">Select Paid</option>
                                                                <option value="12">Per Year</option>
                                                                <option value="6">Per Semester</option>
                                                                <option value="3">Per Term </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label">Year </label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control class_pro" id="txtacademic_year">
                                                                @foreach($year as $row)
                                                                    <option value="{{ $row->id }}">{{ $row->year }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="form-horizontal">
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label">Validity Pay </label>
                                                        <div class="col-sm-8">
                                                            <input type="date" class="form-control" id="txtvali" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="form-group row">
                                                        <label for="" class="col-sm-4 col-form-label">To </label>
                                                        <div class="col-sm-8">
                                                            <input type="date" class="form-control " id="txtexpired" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4 col-form-label">Payment Method </label>
                                                <div class="col-sm-8">
                                                    <select class="form-control " id="txtpayment_method">
                                                        @foreach($payment_methods as $row)
                                                            <option value="{{ $row->id }}">{{ $row->payment_method }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="" class="col-sm-4 col-form-label">Discount </label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="txtdiscount">
                                                        <option>No Discount</option>
                                                        @forelse($discount as $row)
                                                            <option value="{{ $row->percent_dis }}">{{ $row->percent_dis }}% {{ $row->discount_name }}</option>
                                                        @empty
                                                            <option value="0">0% No Discount</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table_payment">
                            <thead>
                                <tr>
                                    <th width="5%" style="text-align: center;font-size: 10px;">
                                        Nº
                                    </th>
                                    <th width="30%" style="text-align: center;font-size: 10px;">
                                        PRODUCT/SERVICE
                                    </th>
                                    <th width="30%" style="text-align: center;font-size: 10px;">
                                        DESCRIPTION
                                    </th>
                                    <th width="5%" style="text-align: center;font-size: 10px;">
                                    QTY
                                    </th>
                                    <th width="5%" style="text-align: center;font-size: 10px;">
                                    UDM
                                    </th>
                                    <th width="10%" style="text-align: center;font-size: 10px;">
                                        PRICE
                                    </th>
                                    <th width="10%" style="text-align: center;font-size: 10px;">
                                    AMOUNT
                                    </th>
                                    <th  style="text-align: center;font-size: 10px;" hidden>
                                        Discount
                                    </th>
                                    <th  style="text-align: center;font-size: 10px;" hidden>
                                        Proservice_ID
                                    </th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-light btn-sm mt-3" style="font-size: 12px" id="btn_add_new"><i class="fa fa-plus"></i>  New Item</button>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 mb-3">
                        <label for="">Note :</label>
                        <textarea style="margin-top: 10px" rows="4" cols="50" placeholder="Note....." class="form-control" id="txtremark"></textarea>
                    </div>
                    <div class="col-xl-5 col-lg-3 col-md-3 col-sm-12 col-12"></div>
                    <div class="col-xl-3 col-lg-5 col-md-5 col-sm-12 col-12">
                        <div class="form-group row" style="background-color: #F4F5F9;">
                            <label class="col-4 col-sm-4 col-form-label">SubTotal :</label>
                            <div class="col-8 col-sm-8">
                                <label id="label_subtotal" style="font-weight: 300">0.00$</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-sm-4 col-form-label">Total Discount :</label>
                            <div class="col-8 col-sm-8">
                                <label id="label_discount" class="text-right" style="font-weight: 300;">0.00$</label>
                            </div>
                        </div>
                        <div class="form-group row" style="background-color: #F4F5F9;">
                            <label class="col-4 col-sm-4 col-form-label">Total :</label>
                            <div class="col-8 col-sm-8">
                                <label id="label_total" style="font-weight: 300">0.00$</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4 col-sm-4 col-form-label">Deposit :</label>
                            <div class="col-8 col-sm-8">
                                <input type="number" class="form-control form-control-sm" id="txtdeposit" placeholder="0.00$">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row justify-content-end">
                    <button class="btn btn-outline-dark btn-sm mr-2" id="btn_payment"><i class="fas fa-print"></i> Payment Now</button>
                    <button class="btn btn-outline-dark btn-sm mr-2" id="btn_save_payment"><i class="fas fa-save"></i> Save Invoice</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">វិក្កយបត្របង់ប្រាក់</h6>
                </div>
                <div class="modal-body" >
                      <div id="div_pri" class="A5" >
                        <section class="sheet padding-10mm">
                            <div class="row">
                                <div class="col-2">
                                    <img src="{{ asset('dist/img/logo.png') }}" class="img-fluid">
                                </div>
                                <div class="col-9">
                                    <h4 style="font-size: 14px; font-weight: 900; margin: 0;">ឌូវី ឆាល់ឃែរ៏ ហោស៏ ទីតាំង {{ $compuse->name_kh }}</h4>
                                    <h4 style="font-size: 14px; font-weight: 900; text-transform: uppercase; margin: 0;">Dewey Childcare House, {{ $compuse->name_en }}</h4>
                                    <p style="font-size: 12px; margin: 0;">ទូរស័ព្ទលេខ HP: 054 555 5451</p>
                                    <p style="font-size: 12px; margin: 0;">អាស័យដ្ឋាន Address: ភូមិព្រែកព្រះសេ្តច សង្កាត់ព្រែកព្រះស្តេច ក្រុងបាត់ដំបង ខេត្តបាត់ដំបង (ខាងកើតស្ពានថ្មចាស់ប្រហែល ១៥០មែ៉ត្រ)</p>
                                    <p style="font-size: 12px; margin: 0;">Preaek Preah Sdach Villages, Preaek Preah Sdach Communes, Battambang City, Battambang Province, Cambodia</p>
                                </div>
                            </div>
                            <div style="text-align: center; font-size: 20px; font-family: 'Khmer OS Muol Light'; margin-top: 20px;">
                                <p>វិក្កយបត្រ</p>
                            </div>
                            <table>
                                <tr>
                                    <td><p style="font-size: 11px; font-family: 'Khmer OS Muol Light'; font-weight: 900;">ពត៍មានអតិថិជន CUSTOMER INFO:</p></td>
                                    <td><p style="font-size: 12px; margin-left: 130px;">លេខ NO: <span id="reciept_custom"></span></p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-size: 12px; margin-top: -17px;">ឈ្មោះ Name: <span id="name_custom"></span></p></td>
                                    <td><p style="font-size: 12px; margin-left: 130px;margin-top: -17px;">កាលបរិច្ឆេទ Date: <span id="date_pay_custom"></span></p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-size: 12px; margin-top: -17px;">អាស័យដ្ឋាន Address: <span id="address"></span></p></td>
                                    <td><p style="font-size: 12px; margin-left: 130px;margin-top: -17px;">ថ្ងៃផុតកំណត់ Due Date: <span id="due_date"></span></p></td>
                                </tr>
                            </table>
                            <table class="table table-bordered" id="tbl_print_invoice">
                                <thead style="font-size: 9px;" class="test">
                                    <th width="60%" style="text-align: center; font-size: 8pt;">
                                        <p style=" margin: 0;">មុខទំនិញ</p>
                                        <span>Description</span>
                                    </th>
                                    <th width="10%" style="text-align: center;font-size: 8pt">
                                        <p style=" margin: 0;">បរិមាណ</p>
                                        <span>Quality</span>
                                    </th>
                                    <th width="20%" style="text-align: center;font-size: 8pt">
                                        <p style=" margin: 0;">ថ្លៃឯកតា</p>
                                        <span>Limit Price</span>
                                    </th>
                                    <th width="20%" style="text-align: center;font-size: 8pt">
                                        <p style=" margin: 0;">ថ្លៃទំនិញ</p>
                                        <span>Amount</span>
                                    </th>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr style="font-size: 13px; text-align: center">
                                        <td colspan="3" style="text-align: right;padding: 2px;">សរុបរង : Subtotal</td>
                                        <td style="padding: 2px" id="print_sub">0.00</td>
                                    </tr>
                                    <tr style="font-size: 13px; text-align: center">
                                        <td colspan="3" style="text-align: right;padding: 2px;">បញ្ចុះតម្លៃ : Discount</td>
                                        <td style="padding: 2px" id="print_dis">0.00</td>
                                    </tr>
                                    <tr style="font-size: 13px; text-align: center">
                                        <td colspan="3" style="text-align: right;padding: 2px;">ប្រាក់កក់ (Deposit)</td>
                                        <td style="padding: 2px" id="label_deposit">0.00</td>
                                    </tr>
                                    <tr style="font-size: 13px; text-align: center">
                                        <td colspan="3" style="text-align: right;padding: 2px;">សាច់ប្រាក់ទូទាត់ Amount Due</td>
                                        <td style="padding: 2px" id="print_amount"></td>
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="row" style="margin-top: 100px;">
                                <div class="col-4">
                                    <div>
                                        <p style="font-size: 10px; font-weight: bold; text-align: center;">____________________________</p>
                                        <p style="font-size: 12px; margin-top: -10px; font-weight: bold; text-align: center;">ហត្ថលេខា និង ឈ្មោះអ្នកទិញ</p>
                                        <p style="font-size: 12px; margin-top: -15px; font-weight: bold; text-align: center;">Customer's Signature & Name</p>
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <div>
                                        <p style="font-size: 10px; font-weight: bold; text-align: center;">____________________________</p>
                                        <p style="font-size: 12px; margin-top: -10px; font-weight: bold; text-align: center;">ហត្ថលេខា និង ឈ្មោះបេឡាករ</p>
                                        <p style="font-size: 12px; margin-top: -15px; font-weight: bold; text-align: center;">Seller's Signature & Name</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <p style="font-size: 12px; margin-top: 50px;">
                                            <span class="font-weight-bold">សំគាល់:</span> ប្រាក់បង់រួចមិនអាចដកវិញបានទេ <br>
                                            <span class="font-weight-bold">Note:</span> Not Refundeble
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-app-blue btn-sm" id="printer"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;PRINT </button>
                    <button type="button" class="btn btn-app-blue btn-sm" id="btn_payment_last"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;PAYMENT & PRINT </button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"  id="btn_close">CLOSE</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script>
        var count = 0;
        var num = 1;
        var count_btn = 0;
        if(count_btn == 0) {
            $('#btn_payment').prop('disabled', true)
        }

        var numUSD = new Intl.NumberFormat('en-US', {
            style:'currency',
            currency: 'USD'
        })

        getinvoice()
        function getinvoice(){
            setInterval(function(){
                $.ajax({
                    url: '{{ route('getinvoice') }}',
                    type: 'GET',
                    success:function (data) {
                        $('#txt_text_invoice').val(data.num_invoice)
                        $('#txtinvoice').val(data.id_invoice)
                    }
                })
            },2500)
        }

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;
            if (date=="")
            {
                return "";
            }
            else{
                return [year, month, day].join('-');
            }
        }
        $(document).ready(function() {
            var date_now = new Date()
            var due_date=$('#txtduedate').val()
            var date_pay=$('#txtdatepay').val(formatDate(date_now))
            var result=moment(date_pay).add(7, 'days').calendar();
            $('#txtduedate').val(formatDate(result))
            $('#txtdatepay').val(formatDate(date_now))

            $("#txtvali").on('change',function () {
                var startdate = $(this).val()
                var selecterm = $('#txtterm').val()
                var start = moment(startdate).add(selecterm, 'month').calendar();
                var test;
                d = formatDate(start)
                $('#txtexpired').val(d)
            })

            var appen_select=''
            $("#txtterm").on('change',function () {
                var txtterm = $(this).val();
                var id_acedemic = $('#txtacademic_year').val()
                $.ajax({
                    'url':'{{ route('selectTypePay') }}',
                    'type':'POST',
                    'data':{'_token':'{{ @csrf_token() }}','txtterm':txtterm,'id_acedemic':id_acedemic},
                    success:function (data) {
                        // console.log(data)
                        var iteam=''
                        $.each(JSON.parse(data),function(index,value) {
                            iteam+=('<option value="' + value.price_service + ','+value.id+'">' + value.pro_service + '</option>');
                        });
                        appen_select=iteam
                    },
                    error: function(data) {
                        console.log(data)
                    }
                })
            })

            $('#txtacademic').on('change',function () {
                var id_acedemic = $('#txtacademic').val()
                $.ajax({
                    'url':'{{ route('selectTypePay') }}',
                    'type':'POST',
                    'data':{'_token':'{{ @csrf_token() }}','txtterm':$('#txtterm').val(),'id_acedemic':id_acedemic},
                    success:function (data) {
                        var iteam=''
                        $.each(JSON.parse(data),function(index,value) {
                            iteam+=('<option value="' + value.price_service + ','+value.id+'">' + value.pro_service + '</option>');
                        });
                        appen_select=iteam
                    }
                })
            })

            // add new item
            $('#btn_add_new').click(function() {
                if(appen_select == '') {
                    swal({
                        title: 'Oops...',
                        text: "No product service for pay",
                        type: "warning"
                    })
                } else {
                    // console.log(appen_select)
                    $('#btn_payment').prop('disabled', false);
                    if ($('#txtvali').val() == '') {
                        swal({
                            title: 'Oops...',
                            text: "Please input Validity Pay",
                            type: "warning"
                        })
                    } else {
                        var check_vali = $('#txtvali').val()
                        var check_expired_date = $('#txtexpired').val()
                        count = count + 1;
                        var acedemic = $('#txtacademic_year').val()
                        var term = $('#txtterm').val()
                        var html_code = "<tr style='text-align: center;font-size: 12px;padding: 2px' id='row" + count + "' >";
                        html_code += "<td style='vertical-align: middle;padding: 2px' ><button  class=\"btn btn-danger btn-sm remove \" style='padding: 2px'   data-row=" + count + "><i class='fa fa-trash'></i></button ></td>";
                        html_code += "<td style='vertical-align: middle'><select class='form-control class_pro select_detail' data-row=" + count + " id='test'> <option selected  disabled>Select Service</option>" + appen_select + " </select></td>";
                        html_code += "<td contenteditable='true' style=\"text-align: left;vertical-align: middle;padding: 2px; outline: none; font-size: 13px;\" class='txtdescription' data-row=" + count + " id='select" + count + "'>" + " " + "</td>";
                        html_code += "<td style=\"vertical-align: middle;padding: 2px; font-size: 13px;\" id='qty" + count + "'   class='qty'></td>";
                        html_code += "<td style=\"vertical-align: middle;padding: 2px\" id='udm" + count + "' class='udm'  data-row=" + count + "></td>";
                        html_code += "<td contenteditable='true' style=\"vertical-align: middle;padding: 2px; outline: none; font-size: 13px;\"  class='price' id='price" + count + "' data-row=" + count + "></td>";
                        html_code += "<td style=\"vertical-align: middle;padding: 2px; font-size: 13px;\" class='ammount' id='ammount" + count + "'>0</td>";
                        html_code += "<td style=\"vertical-align: middle;padding: 2px\" class='discount' id='discount" + count + "' hidden >0</td>";
                        html_code += "<td style=\"vertical-align: middle;padding: 2px\" class='pro_service_id' id='pro_service_id" + count + "' hidden ></td>";
                        html_code += "<td style=\"vertical-align: middle;padding: 2px\" hidden><input type='text' class='vali_date' value='" + check_vali + "' /> </td>";
                        html_code += "<td style=\"vertical-align: middle;padding: 2px\" hidden><input type='text'  class='expired_date' value='" + check_expired_date + "' /> </td>";
                        html_code += "<td style=\"vertical-align: middle;padding: 2px\" hidden><input type='text'  class='academic' value='" + acedemic + "' /> </td>";
                        html_code += "<td style=\"vertical-align: middle;padding: 2px\" hidden><input type='text'  class='termpay' value='" + term + "' /> </td>";
                        html_code += "<td style=\"vertical-align: middle;padding: 2px\" class='original_price' id='original_price" + count + "' hidden></td>";
                        html_code += "</tr>";
                        $('#table_payment').append(html_code)
                    }
                }
            })

            $('#table_payment').on('change', '.select_detail', function(){
                var delete_row = $(this).data("row");
                var selectProSeriveText = $(this).children("option:selected").text();
                var selectPrsoerviceID = $(this).val().split(',')[1]
                var selectProSerivevalue = $(this).children("option:selected").val().split(',')[0];
                var payterm = $('#txtterm').children("option:selected").text();
                var selectdiscountText = $('#txtdiscount').children("option:selected").text()
                var searchTextDisIndes = searchDiscountinDes("::,"+selectdiscountText+"");
                var payterm_val = $('#txtterm').val()
                var qty=1
                var total_pay=parseFloat(selectProSerivevalue)
                var total_last=total_pay;
                var ammount=qty*total_last
                var total_dis=parseFloat(ammount)*parseFloat(searchTextDisIndes)/100;
                var year_school=$('#txtacademic_year').children("option:selected").text();
                var startdate=$('#txtvali').val()
                var expireddate=$('#txtexpired').val()
                var format_unit_price=parseFloat(selectProSerivevalue)
                $('#select'+delete_row).html(selectProSeriveText + "::School Year" + " " + year_school + "::Paid for " + payterm + " from(" + formatDate(startdate) + "-" + formatDate(expireddate) + "), " + selectdiscountText + ".")
                $('#udm'+delete_row).html(payterm)
                $('#pri_service'+delete_row).html(format_unit_price)
                $('#qty'+delete_row).html(qty)
                $('#pro_service_id'+delete_row).html(selectPrsoerviceID)
                $('#discount'+delete_row).html(total_dis)
                $('#ammount'+delete_row).html(numUSD.format(parseFloat(ammount-total_dis)))
                $('#price'+delete_row).html(ammount)
                $('#original_price'+delete_row).html(ammount)
                var sum = 0;
                var sumDiscount = 0;
                $('.ammount').each(function(){
                    if($(this).text() == ""){
                        $(this).text("0")
                    }
                    sum += parseFloat($(this).text());
                });
                $('.discount').each(function(){
                    if($(this).text() == ""){
                        $(this).text("0")
                    }
                    sumDiscount += parseFloat($(this).text());
                });
                var subtotal = 0
                $('.original_price').each(function(){
                    if($(this).text() == ""){
                        $(this).text("0")
                    }
                    subtotal += parseFloat($(this).text());
                });

                $('#value_discount').val(sumDiscount)
                $('#value_subtotal').val(subtotal)
                $('#label_discount').html(numUSD.format(sumDiscount))
                $("#label_subtotal").html(numUSD.format(subtotal))
                $('#label_amount_due').html(numUSD.format(parseFloat(subtotal-sumDiscount)))
                $('#label_total').html(numUSD.format(parseFloat(subtotal-sumDiscount)))
            });

            $('#table_payment').on('click', '.remove', function(){
                var delete_row = $(this).data("row");
                var ammount=$('#value_subtotal').val();
                var label_dis=$('#value_discount').val();
                var delammount=$('#price'+delete_row).text();
                var deldiscount=$('#discount'+delete_row).text();
                var totalammount;
                var disafterdelete;
                var total_pay=0;
                num--;
                if(delammount==""){
                    delammount=0
                }
                totalammount=parseFloat(ammount)-parseFloat(delammount)
                disafterdelete=parseFloat(label_dis)-parseFloat(deldiscount);
                total_pay=parseFloat(totalammount)-parseFloat(disafterdelete)
                $('#row' + delete_row).remove();
                $('#value_subtotal').val(totalammount)
                $('#value_discount').val(disafterdelete)
                $('#label_subtotal').text(numUSD.format(totalammount))
                $('#label_discount').text(numUSD.format(disafterdelete))
                $('#label_total').html(numUSD.format(total_pay))
                $('#label_amount_due').text(numUSD.format(total_pay))
            });

            $('#table_payment').on('keyup','.price',function () {
                var num_row = $(this).data("row");
                var id_des = $('#select'+num_row).text()
                var search = searchDiscountinDes(id_des)
                var price = $('#price'+num_row).text();
                if(price == ""){
                    price = 0
                }
                var qty = 1
                var ammount = qty * parseFloat(price)
                var total_dis = parseFloat(ammount)*parseFloat(search)/100;//for find disccount
                $('#ammount'+num_row).html(numUSD.format(parseFloat(ammount-total_dis)))
                $('#original_price'+num_row).html(ammount)
                $('#discount'+num_row).html(total_dis)
                var sum = 0;
                var sumDiscount = 0;
                $('.ammount').each(function(){

                    if($(this).text() == ""){
                        $(this).text("0")
                    }
                    sum += parseFloat($(this).text());
                });
                var subtotal=0
                $('.original_price').each(function(){

                    if($(this).text()==""){
                        $(this).text("0")
                    }
                    subtotal += parseFloat($(this).text());
                });
                $('.discount').each(function(){
                    if($(this).text()==""){
                        $(this).text("0")
                    }
                    sumDiscount += parseFloat($(this).text());
                });
                $('#value_discount').val(sumDiscount)
                $('#value_subtotal').val(subtotal)
                $('#label_discount').html(numUSD.format(sumDiscount))
                $("#label_subtotal").html(numUSD.format(subtotal))
                $('#label_amount_due').html(numUSD.format(parseFloat(subtotal-sumDiscount)))
                $('#label_total').html(numUSD.format(parseFloat(subtotal-sumDiscount)))
            });

            $('#table_payment').on('keyup','.txtdescription',function () {
                var num_row=$(this).data("row");
                var id_des=$('#select'+num_row).text()
                var search=searchDiscountinDes(id_des)
                var price=$('#price'+num_row).text()
                if(price==""){
                    price=0
                }
                var payterm_val=$('#txtterm').val()
                var qty=1
                var ammount=qty*price
                var total_dis=parseFloat(ammount)*parseFloat(search)/100;//for find disccount
                $('#ammount'+num_row).html(numUSD.format(parseFloat(ammount-total_dis)))
                $('#price'+num_row).html(ammount)
                $('#original_price'+num_row).html(ammount)
                $('#discount'+num_row).html(total_dis)
                var sum=0;
                var sumDiscount=0;
                var subtotal=0
                $('.original_price').each(function(){
                    subtotal += parseFloat($(this).text());
                });
                $('.ammount').each(function(){
                    sum += parseFloat($(this).text());
                });
                $('.discount').each(function(){
                    sumDiscount += parseFloat($(this).text());
                });
                $('#value_discount').val(sumDiscount)
                $('#value_subtotal').val(subtotal)
                $('#label_discount').html(numUSD.format(sumDiscount))
                $("#label_subtotal").html(numUSD.format(subtotal))
                $('#label_amount_due').html(numUSD.format(parseFloat(subtotal-sumDiscount)))
                $('#label_total').html(numUSD.format(parseFloat(subtotal-sumDiscount)))
            })

            $('#table_payment').on('focusin','.txtdescription',function () {
                var num_row=$(this).data("row");
                var id_des=$('#select'+num_row).text()
                var search=searchDiscountinDes(id_des)
                var price=$('#price'+num_row).text()
                if(price==""){
                    price=0
                }
                var payterm_val=$('#txtterm').val()
                var qty=1
                var ammount=qty*price
                var total_dis=parseFloat(ammount)*parseFloat(search)/100;//for find disccount
                $('#ammount'+num_row).html(numUSD.format(parseFloat(ammount-total_dis)))
                $('#price'+num_row).html(ammount)
                $('#original_price'+num_row).html(ammount)
                $('#discount'+num_row).html(total_dis)
                var sum=0;
                var sumDiscount=0;
                var subtotal=0
                $('.original_price').each(function(){
                    subtotal += parseFloat($(this).text());
                });
                $('.ammount').each(function(){
                    sum += parseFloat($(this).text());
                });
                $('.discount').each(function(){
                    sumDiscount += parseFloat($(this).text());
                });
                $('#value_discount').val(sumDiscount)
                $('#value_subtotal').val(subtotal)
                $('#label_discount').html(numUSD.format(sumDiscount))
                $("#label_subtotal").html(numUSD.format(subtotal))
                $('#label_amount_due').html(numUSD.format(parseFloat(subtotal-sumDiscount)))
                $('#label_total').html(numUSD.format(parseFloat(subtotal-sumDiscount)))
            })

            $('#table_payment').on('focusout','.txtdescription',function () {
                var num_row=$(this).data("row");
                var id_des=$('#select'+num_row).text()
                var search=searchDiscountinDes(id_des)
                var price=$('#price'+num_row).text()
                if(price==""){
                    price=0
                }
                var payterm_val=$('#txtterm').val()
                var qty=1
                var ammount=qty*price
                var total_dis=parseFloat(ammount)*parseFloat(search)/100;//for find disccount
                $('#ammount'+num_row).html(numUSD.format(parseFloat(ammount-total_dis)))
                $('#price'+num_row).html(ammount)
                $('#original_price'+num_row).html(ammount)
                $('#discount'+num_row).html(total_dis)
                var sum=0;
                var sumDiscount=0;
                var subtotal=0
                $('.original_price').each(function(){
                    subtotal += parseFloat($(this).text());
                });
                $('.ammount').each(function(){
                    sum += parseFloat($(this).text());
                });
                $('.discount').each(function(){
                    sumDiscount += parseFloat($(this).text());
                });
                $('#value_discount').val(sumDiscount)
                $('#value_subtotal').val(subtotal)

                $('#label_discount').html(numUSD.format(sumDiscount))
                $("#label_subtotal").html(numUSD.format(subtotal))
                $('#label_amount_due').html(numUSD.format(parseFloat(subtotal-sumDiscount)))
                $('#label_total').html(numUSD.format(parseFloat(subtotal-sumDiscount)))
            })
        });

        function formatDateForPint(date) {
            //function formation date
            var date=new Date(date)
            return ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate()))+'-' +((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '-' + date.getFullYear()
        }

        function searchDiscountinDes(discount = '') {
            if(discount.indexOf('%') < 0 ){
                return 0;
            }else{
                var dis_new=discount;
                var dis_last = dis_new.split(',')[1];
                var ampersandPosition = dis_last.indexOf('%');
                if(ampersandPosition != -1) {
                    dis_last = dis_last.substring(0, ampersandPosition);
                }else{
                    dis_last='0'
                }
                if(ampersandPosition==""){
                    dis_last=0
                    console.log(dis_last)
                }else{
                    dis_last = dis_last.substring(0, ampersandPosition);
                }
                return parseFloat(dis_last);
            }
        }

        $('#btn_payment').click(function () {
            var subtotal = $('#label_subtotal').text()
            var dis = $('#label_discount').text()
            var vat = $('#label_amount_due').text()
            var amount = $('#label_amount_due').text()
            var name = $('#txtstudent').children("option:selected").text()
            var due_date = $('#txtduedate').val()
            var invoice = $('#txt_text_invoice').val()
            var date_pay = $('#txtdatepay').val()
            $('#name_custom').html(name)
            $('#due_date_custom').html(formatDateForPint(due_date))
            $('#reciept_custom').html("CIN"+invoice)
            $('#date_pay_custom').html(formatDateForPint(date_pay))
            $('#print_sub').html(subtotal)
            $('#print_dis').html(dis)
            $('#print_vat').html(vat)
            $('#print_amount').html(amount)
            $("#myModal").modal({backdrop: 'static', keyboard: false})
            copyColumns("table_payment", "tbl_print_invoice",2,3,6,6);
        })

        $('#btn_close').click(function () {
            $("#tbl_print_invoice tbody tr").detach();
        })

        function copyColumns(srcTableId, targetTableId) {
            var colNos = [].slice.call(arguments,2),
            $target = $("#" + targetTableId);
            $("#" + srcTableId + " tbody tr").each(function() {
                var $tds = $(this).children(),
                    $row = $("<tr style='text-align: center; font-size: 12px !important;'></tr>");
                for (var i = 0; i < colNos.length; i++){
                    $row.append($tds.eq(colNos[i]).clone());
                }
                $row.appendTo($target);
            });
        }

        function printDiv(tagid) {
            var hashid = "#"+ tagid;
            var tagname =  $(hashid).prop("tagName").toLowerCase();
            var attributes = "";
            var divToPrint= $(hashid).html() ;
            var head = "<html><head>"+ $("head").html() + "</head>" ;
            var allcontent = head + "<body onload='window.print()' style='font-family: 'Kh Battambang''>"+ "<" + tagname + attributes + ">" +  divToPrint + "</" + tagname + ">" +  " </body></html>" ;
            var allcontent2 = head +"<body onload='window.print()' style='font-family: 'Kh Battambang'>"+ "<" + tagname + attributes + ">" +  divToPrint + "</" + tagname + ">" +  " </body></html>" ;
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write(allcontent,allcontent2);
            newWin.document.close();
        }

        $("#printer").click(function () {
            $('#div_pri').printThis({
                importCSS: true,
                loadCSS: "{{asset('dist/css/payment_invoice.css')}}",
                removeInline: false, 
            });
        });

        $('#btn_reciept').click(function () {
            printDiv('div_receipt')
        })

        $('#btn_payment_last').click(function () {
            var descript = []
            var qty = []
            var pro_service = []
            var price = []
            var discounts = []
            var vali_date = []
            var expired_date = []
            var academic = []
            var termpay = []
            var amount = []
            var number_invoice = $('#txtinvoice').val()
            var date_pay = $('#txtdatepay').val()
            var invoice_type = $('#txtinvoice_type').val()
            var student_id = $('#txtstudent').val()
            var payment_method = $('#txtpayment_method').val()
            var discount = $('#txtdiscount').val()
            var txtpayterm = $('#txtterm').val()
            var txtremark = $('#txtremark').val()
            var txt_text_invoice = $("#txt_text_invoice").val()
            var txtdeposit = $('#txtdeposit').val()
            var txtacademic = $('#txtacademic_year').val()
            $('#table_payment .txtdescription').each(function () {
                descript.push($(this).text())
            })
            $('#table_payment .qty').each(function () {
                qty.push(parseFloat($(this).text()).toFixed())
            })
            $('#table_payment .pro_service_id').each(function () {
                pro_service.push($(this).text())
            })
            $('#table_payment .price').each(function () {
                price.push(parseFloat($(this).text()).toFixed())
            })
            $('#table_payment .txtdescription').each(function () {
                discounts.push(searchDiscountinDes($(this).text()))
            })
            $('#table_payment .vali_date').each(function () {
                vali_date.push($(this).val())
            })
            $('#table_payment .expired_date').each(function () {
                expired_date.push($(this).val())
            })
            $('#table_payment .academic').each(function () {
                academic.push($(this).val())
            })
            $('#table_payment .termpay').each(function () {
                termpay.push($(this).val())
            })
            $('#table_payment .original_price').each(function () {
                amount.push($(this).text())
            })
            $.ajax({
                type: 'POST',
                url: '{{ route('payment.store') }}',
                data: {
                    '_token':'{{ @csrf_token() }}',
                    'student_id': student_id,
                    'payment_date': date_pay,
                    'payment_method': payment_method,
                    'invoice_des': descript.join(','),
                    'invoice_id': number_invoice,
                    'id_payment':payment_method,
                    'id_invoice_type': invoice_type,
                    'id_pro_service':pro_service,
                    'id_payterm': txtpayterm,
                    'branch_id': '{{ \Illuminate\Support\Facades\Auth::user()->campus_id }}',
                    'user_id_pay': '{{ \Illuminate\Support\Facades\Auth::user()->id }}',
                    'description': descript,
                    'qty': qty,
                    'ori_price': price,
                    'disccount': discounts,
                    'Volidty_of_payment': vali_date,
                    'expired_date': expired_date,
                    'school_year': academic,
                    "remark": txtremark,
                    'id_payterm': termpay,
                    "txt_text_invoice": txt_text_invoice,
                    "txtdeposit": txtdeposit,
                    'amount': amount,
                    'txtacademic':txtacademic
                },
                success:function (data) {
                    $("#btn_payment_last").prop('disabled', true);
                    printDiv('div_pri')
                    window.location.reload()
                },
                error: function (data) {
                    console.log(data)
                }
            })
        })

        $('#txtdeposit').keyup(function () {
            var deposit = $('#label_deposit').html(numUSD.format($(this).val()))
        })

        $('#tbl_pro_service').on('click','.btn_add_pro_service',function () {
            $('#modal_service').modal({backdrop: 'static', keyboard: false})
        })

        $('#tbl_pro_service').on('click','.btn_edit_pro_service',function () {
            $('#modal_service').modal({backdrop: 'static', keyboard: false})
        })

        $('#btn_save_payment').click(function () {
            var descript = []
            var qty = []
            var pro_service = []
            var price = []
            var discounts = []
            var vali_date = []
            var expired_date = []
            var academic = []
            var termpay = []
            var amount = []
            var number_invoice = $('#txtinvoice').val()
            var date_pay = $('#txtdatepay').val()
            var invoice_type = $('#txtinvoice_type').val()
            var student_id = $('#txtstudent').val()
            var payment_method = $('#txtpayment_method').val()
            var discount = $('#txtdiscount').val()
            var txtpayterm = $('#txtterm').val()
            var txtremark = $('#txtremark').val()
            var txt_text_invoice = $("#txt_text_invoice").val()
            var txtdeposit = $('#txtdeposit').val()
            var txtacademic = $('#txtacademic_year').val()
            $('#table_payment .txtdescription').each(function () {
                descript.push($(this).text())
            })
            $('#table_payment .qty').each(function () {
                qty.push(parseFloat($(this).text()).toFixed())
            })
            $('#table_payment .pro_service_id').each(function () {
                pro_service.push($(this).text())
            })
            $('#table_payment .price').each(function () {
                price.push(parseFloat($(this).text()).toFixed())
            })
            $('#table_payment .txtdescription').each(function () {
                discounts.push(searchDiscountinDes($(this).text()))
            })
            $('#table_payment .vali_date').each(function () {
                vali_date.push($(this).val())
            })
            $('#table_payment .expired_date').each(function () {
                expired_date.push($(this).val())
            })
            $('#table_payment .academic').each(function () {
                academic.push($(this).val())
            })
            $('#table_payment .termpay').each(function () {
                termpay.push($(this).val())
            })
            $('#table_payment .original_price').each(function () {
                amount.push($(this).text())
            })
            $.ajax({
                type: 'POST',
                url: "{{ route('save_payment') }}",
                data: {
                    '_token': '{{ @csrf_token() }}',
                    'student_id': student_id,
                    'payment_date': date_pay,
                    'payment_method': payment_method,
                    'invoice_des': descript.join(','),
                    'invoice_id': number_invoice,
                    'id_payment': payment_method,
                    'id_invoice_type': invoice_type,
                    'id_pro_service': pro_service,
                    'id_payterm': txtpayterm,
                    'branch_id': '{{ \Illuminate\Support\Facades\Auth::user()->campus_id }}',
                    'user_id_pay': '{{ \Illuminate\Support\Facades\Auth::user()->id }}',
                    'description': descript,
                    'qty': qty,
                    'ori_price': price,
                    'disccount': discounts,
                    'Volidty_of_payment': vali_date,
                    'expired_date': expired_date,
                    'school_year':academic,
                    "remark": txtremark,
                    'id_payterm': termpay,
                    "txt_text_invoice": txt_text_invoice,
                    "txtdeposit": txtdeposit,
                    'amount': amount,
                    'txtacademic': txtacademic
                },
                success:function (data) {
                    console.log(data)
                    window.location.reload()
                },
                error: function (data) {
                    console.log(data)
                }
            })
        })
    </script>
@endsection