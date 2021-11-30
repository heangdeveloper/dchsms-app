@extends('layout.app')
@section('header')
    <style>
        .form-control {
            height: 34px;
            font-size: 13px;
            border: 1px solid #f1f1f1;
            border-radius: 0;
        }
        .box-card {
            width: 100%;
            border-radius: 6px;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 7%), 0 4px 6px -2px rgb(0 0 0 / 5%);
            color: #fff;
            text-align: center;
            padding: 7px 0;
            margin: 10px 0;
        }
        .box-card .icon {
            font-size: 25px;
        }
        .box-card .text p {
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            margin: 3px;
        }
        .box-card .text h3 {
            font-size: 20px;
        }
        .bg-box-blue {
            background-color: #2A629C;
        }
        .bg-box-red {
            background-color: #f93154;
        }
        .bg-box-dark {
            background-color: #4a4a4a;
        }
        .bg-box-green {
            background-color: #3b9e75;
        }
        .table > thead {
            background-color: #48b461;
            color: #fff;
            text-align: center;
            font-size: 14px;
            text-transform: uppercase;
        }
        .table > thead th {
            font-size: 14px;
        }
        table tbody td {
            font-size: 14px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 17px;
            margin-top: 3px;
        }

        .select2-container--default .select2-results>.select2-results__options {
            height: 262px;
            max-height: 300px;
        }

        .select2-selection__arrow {
            display: none
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 17px;
            margin-top: 3px;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #edeeef;
        }

        .select2-container .select2-selection--single {
            padding: 2px 5px;
            font-size: .875rem;
            line-height: 1.5;
        }
        .select2-search--dropdown {
            margin-top: 5px;
            padding: 0;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #edeeef;
            height: calc(1.5em + .5rem + 2px);
            padding: .25rem .5rem;
            font-size: .875rem;
            line-height: 1.5;
        }

        .select2-container .select2-dropdown {
            border-color: #ffffff;
            border-bottom-right-radius: 0px;
            border-bottom-left-radius: 0px;
            z-index: 0;
        }

        .select2-container--default .select2-selection--single {
            border: 1px solid #ececec;
        }

        .select2-results__option {
            font-size: 13px;
        }
        label {
            font-size: 13px !important;
        }
        .btn-default {
            color: #333;
            background-color: #fff;
            border-color: #ccc;
        }
        @page { size: A5 }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-4" style="padding-right: 5px;">
            <div class="card">
                <div class="card-header bg-gradient-success" style="padding: 15px;">
                    <a href="{{ route('student.create') }}" class="btn btn-block btn-sm" style="font-size: 12px; color: #fff; font-weight: bold; text-transform: uppercase;"><i class="fas fa-plus-circle"></i> New Student</a>
                </div>
                <div class="card-body" style="min-height: 400px;">
                    <div class="form-group">
                        <select class="form-control" id="student_name" name="student_name">
                            <option value="" selected></option>
                            @foreach($student as $row)
                                <option value="{{ $row->id }}">{{ $row->sunameen }} {{ $row->finameen }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="data-body">
                        <ul class="list-group">
                            <div id="result"></div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10 col-md-9 col-sm-8" style="padding-left: 5px;">
            <div class="card" style="min-height: 80%">
                <div class="card-header bg-gradient-success">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a href="#dashboard" class="nav-link active" data-toggle="pill" style="font-size: 12px; color: #fff; font-weight: bold; text-transform: uppercase;"><i class="fas fa-cog"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="#setuppayment" class="nav-link" data-toggle="pill" style="font-size: 12px; color: #fff; font-weight: bold; text-transform: uppercase;"><i class="fas fa-server"></i> Set Up Payment</a>
                        </li>
                        <li class="nav-item">
                            <a href="#reportsetting" class="nav-link" data-toggle="pill" style="font-size: 12px; color: #fff; font-weight: bold; text-transform: uppercase;"><i class="far fa-file"></i> Report Setting</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div id="dashboard" class="tab-pane active">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card name_header">
                                                <div class="card-body">
                                                    <h4 id="h_name_en" style="font-size: 15px; font-weight: bold;"></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4" style="padding-right: 5px;">
                                            
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8" style="padding-left: 5px;">
                                            <div class="card card-name" style="padding-left: 5px;">
                                                <div class="card-body">
                                                    <p style="font-size: 14px; font-weight: bold;">Student ID&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<span id="stuid"></span></p>
                                                    <p style="font-size: 14px; font-weight: bold;">Name KH&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<span id="name_kh"></span></p>
                                                    <p style="font-size: 14px; font-weight: bold;">Name EN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<span id="name_en"></span></p>
                                                    <p style="font-size: 14px; font-weight: bold;">Phone&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<span id="tel"></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-right: 5px; padding-bottom: 5px;">
                                            <div class="box-card bg-box-blue">
                                                <div class="icon">
                                                    <i class="far fa-money-bill-alt"></i>
                                                </div>
                                                <div class="text">
                                                    <p>Balance</p>
                                                    <h3 id="balance">$0.00</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-right: 5px; padding-bottom: 5px;">
                                            <div class="box-card bg-box-dark" id="btn_show_modal_deposit" style="cursor: pointer;">
                                                <div class="icon">
                                                    <i class="fas fa-business-time"></i>
                                                </div>
                                                <div class="text">
                                                    <p>Deposit</p>
                                                    <h3 id="deposit">$0.00</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-right: 5px; padding-bottom: 5px;">
                                            <a id="open_invoice">
                                                <div class="box-card bg-box-green">
                                                    <div class="icon">
                                                        <i class="fas fa-file-invoice"></i>
                                                    </div>
                                                    <div class="text">
                                                        <p>Open Invoice</p>
                                                        <h3 id="invoice">0</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-right: 5px; padding-bottom: 5px;">
                                            <div class="box-card bg-box-red" style="cursor: pointer;" id="btn_over_due">
                                                <div class="icon">
                                                    <i class="far fa-clock"></i>
                                                </div>
                                                <div class="text">
                                                    <p>Over Due</p>
                                                    <h3 id="over_due">0</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 d-flex justify-content-center">
                                    <div class="form-inline">
                                        <label class="mr-sm-2">Payment Method: </label>
                                        <select class="form-control form-control-sm mb-2 mr-sm-2" name="pay_method" id="pay_method">
                                            <option value="allpay">Cash & Bank</option>
                                            @foreach($pay_method as $row)
                                                <option value="{{ $row->id }}">{{ $row->payment_method }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" value="{{ Auth::user()->campus_id }}" name="branches" id="branches">
                                        <label class="mr-sm-2">Start Date: </label>
                                        <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="startdate" id="startdate">
                                        <label class="mr-sm-2">End Date: </label>
                                        <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="enddate" id="enddate">
                                        <button type="button" class="btn btn-default btn-sm mb-2 mr-2" id="btn_search_by_date"><i class="fas fa-search"></i> Search</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-bordered table-striped" id="table_invoice">
                                        <thead>
                                            <tr>
                                                <th style="font-size: 11px; text-transform: uppercase;">Date</th>
                                                <th style="font-size: 11px; text-transform: uppercase;">Type</th>
                                                <th style="font-size: 11px; text-transform: uppercase;">Invoice NO.</th>
                                                <th style="font-size: 11px; text-transform: uppercase;">Amount</th>
                                                <th style="font-size: 11px; text-transform: uppercase;">Paid</th>
                                                <th style="font-size: 11px; text-transform: uppercase;">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="setuppayment" class="tab-pane">
                            <div class="row">
                                <div class="col-xl-2">
                                    <ul class="nav nav-pills flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a href="#discount" class="nav-link active" data-toggle="pill" style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Discount</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#services" class="nav-link" data-toggle="pill" style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Pro/Services</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#fee" class="nav-link" data-toggle="pill" style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Service Fee</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xl-10">
                                    <div class="tab-content">
                                        <div id="discount" class="tab-pane active">
                                            <a href="#" id="adddiscount" class="btn btn-sm btn-success font-weight-bold mb-3 mt-3 mt-lg-0">Create Discount</a>
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped" id="table_discount">
                                                    <thead>
                                                        <tr>
                                                            <th style="font-size: 11px; text-transform: uppercase;">#</th>
                                                            <th style="font-size: 11px; text-transform: uppercase;">Description</th>
                                                            <th style="font-size: 11px; text-transform: uppercase;">Discount(%)</th>
                                                            <th style="font-size: 11px; text-transform: uppercase;">From Date</th>
                                                            <th style="font-size: 11px; text-transform: uppercase;">Exp Date</th>
                                                            <th style="font-size: 11px; text-transform: uppercase;">Note</th>
                                                            <th style="font-size: 11px; text-transform: uppercase;">Status</th>
                                                            <th style="font-size: 11px; text-transform: uppercase;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div id="services" class="tab-pane">
                                            <a href="#" id="addservices" class="btn btn-sm btn-success font-weight-bold mb-3 mt-3 mt-lg-0">Create Tuition Fee</a>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <p> Search Service </p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-lg-4 mb-3">
                                                    <select class="form-control" id="select_paid">
                                                        <option selected disabled>Please Select Pay</option>
                                                        <option value="3">Per Term</option>
                                                        <option value="6">Per Semester</option>
                                                        <option value="12">Per Year</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 mb-3">
                                                    <select class="form-control" id="select_academic">
                                                        <option selected disabled>Please Select Academic</option>
                                                        @foreach($year as $row)
                                                            <option value="{{ $row->id }}">{{ $row->year }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <button class="btn btn-primary btn-sm" id="btn_search_service"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                <div class="col-12">
                                                    <div id="div_title_service">
                                                        <p style="text-align: center; font-size: 14px; margin-top: -10px;">តម្លៃសិក្សា <span id="span_permonth" style="color: red">Per Month</span> សម្រាប់ឆ្នាំសិក្សា <span id="span_year_kh" style="color: red"> 2020 - 2021</span> </p>
                                                        <p style="text-align: center; font-size: 12px; margin-top: -10px;">Tuition Fees For School Year  <span id="span_year_en" style="color: red"> 2020 - 2021</span></p>
                                                    </div>
                                                    <table class="table table-bordered table-striped" id="table_pro_service">
                                                        <thead>
                                                            <tr>
                                                                <th style="font-size: 11px; text-transform: uppercase;">#</th>
                                                                <th style="font-size: 11px; text-transform: uppercase;">Product/Services</th>
                                                                <th style="font-size: 11px; text-transform: uppercase;">Pro/Type</th>
                                                                <th style="font-size: 11px; text-transform: uppercase;">Price ($)</th>
                                                                <th style="font-size: 11px; text-transform: uppercase;">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="fee" class="tab-pane">
                                            <a href="#" id="addservicestype" class="btn btn-sm btn-success font-weight-bold mb-3 mt-3 mt-lg-0">Create Services Type</a>
                                            <table class="table table-bordered table-striped" id="table_services_type">
                                                <thead>
                                                    <tr>
                                                        <th style="font-size: 11px; text-transform: uppercase;">#</th>
                                                        <th style="font-size: 11px; text-transform: uppercase;">Services Type</th>
                                                        <th style="font-size: 11px; text-transform: uppercase;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="reportsetting" class="tab-pane fade">
                            <div class="row">
                                <div class="col-xl-2 mb-3">
                                    <ul class="nav nav-pills flex-column" role="tablist">
                                        <li class="nav-item">
                                            <a href="#cash" class="nav-link active" data-toggle="pill" style="font-size: 12px; font-weight: bold; text-transform: uppercase;">ប្រមូលសាច់ប្រាក់</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#student_stop" class="nav-link" data-toggle="pill" style="font-size: 12px; font-weight: bold; text-transform: uppercase;">សិស្សឈប់</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#student_suspend" class="nav-link" data-toggle="pill" style="font-size: 12px; font-weight: bold; text-transform: uppercase;">សិស្សព្យួរការសិក្សា</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xl-10">
                                    <div class="tab-content">
                                        <div id="cash" class="tab-pane active">
                                            <div class="row">
                                                <div class="col-xl-12 d-flex justify-content-center mb-3">
                                                    <div class="form-inline">
                                                        <input type="hidden" value="{{ Auth::user()->campus_id }}" name="branches" id="branches">
                                                        <label class="mr-sm-2">Start Date: </label>
                                                        <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="start_from_date" id="start_from_date">
                                                        <label class="mr-sm-2">End Date: </label>
                                                        <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="from_date" id="from_date">
                                                        <button type="button" class="btn btn-success btn-sm mb-2 mr-2" id="btn_search_cash_collection"><i class="fas fa-search"></i> Search</button>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12" id="report_cash_collection">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <p style="text-align: center; color: #333; font-size: 13px; font-weight: bold; margin-bottom: 2px;">ឌូវី ឆាល់ឃែរ៍​ ហោស៌ ទីតាំង {{ $compuse->name_kh }}</p>
                                                            <p style="text-align: center; color: #333; font-size: 16px; font-weight: bold;">Cash Collection Report</p>
                                                            <p class="header-date" style="text-align: center; font-size: 13px; font-weight: 600; margin-top: -10px;" id="start_date"></p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="invoice_total">
                                                                <p class="text-invoice-total" style="text-align: center; font-size: 12px; font-weight: 600;">Number of Invoices</p>
                                                                <h1 class="number-invoice-total" style="text-align: center; font-size: 15px; font-weight: 600;" id="cash_invoice"></h1>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="total-received">
                                                                <p class="text-total-received" style="text-align: center; font-size: 12px; font-weight: 600;">Total Received</p>
                                                                <h1 class="number-total-received" style="text-align: center; font-size: 15px; font-weight: 600;" id="total_amm"></h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-12">
                                                            <table class="table table-bordered table-striped" id="cash_collection_report">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="font-size: 11px; text-transform: uppercase;">កាលបរិច្ឆេទ</th>
                                                                        <th style="font-size: 11px; text-transform: uppercase;">ឈ្មោះសិស្ស</th>
                                                                        <th style="font-size: 11px; text-transform: uppercase;">លេខ​វិ​ក័​យ​ប័ត្រ</th>
                                                                        <th style="font-size: 11px; text-transform: uppercase;">ការពិពណ៌នា</th>
                                                                        <th style="font-size: 11px; text-transform: uppercase;">និយោជិត</th>
                                                                        <th style="font-size: 11px; text-transform: uppercase;">ចំនួនទឹកប្រាក់</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="student_stop" class="tab-pane fade">
                                            <div class="row">
                                                <div class="col-xl-12 d-flex justify-content-center mb-3">
                                                    <div class="form-inline">
                                                        <input type="hidden" value="{{ Auth::user()->campus_id }}" name="branches" id="branches">
                                                        <label class="mr-sm-2">Start Date: </label>
                                                        <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="startdate" id="startdate">
                                                        <label class="mr-sm-2">End Date: </label>
                                                        <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="enddate" id="enddate">
                                                        <button type="button" class="btn btn-success btn-sm mb-2 mr-2" id="btnshow"><i class="fas fa-search"></i> Search</button>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <p style="text-align: center; color: #333; font-size: 13px; font-weight: bold; margin-bottom: 2px;">ឌូវី ឆាល់ឃែរ៍​ ហោស៌ ទីតាំង {{ $compuse->name_kh }}</p>
                                                    <p style="text-align: center; color: #333; font-size: 16px; font-weight: bold;">របាយការណ៍សិស្សឈប់</p>
                                                    <table class="table table-bordered table-striped" id="payment_report">
                                                        <thead>
                                                            <tr>
                                                                <th style="font-size: 11px;">#</th>
                                                                <th style="font-size: 11px;">ឈ្មោះ</th>
                                                                <th style="font-size: 11px;">ភេទ</th>
                                                                <th style="font-size: 11px;">លេខទូរសព្ទ</th>
                                                                <th style="font-size: 11px;">កាលបរិច្ឆេទ</th>
                                                                <th style="font-size: 11px;">ស្ថានភាព</th>
                                                                <th style="font-size: 11px;">ចំនួនទឹកប្រាក់</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="student_suspend" class="tab-pane fade">
                                            <div class="row">
                                                <div class="col-xl-12 d-flex justify-content-center mb-3">
                                                    <div class="form-inline">
                                                        <input type="hidden" value="{{ Auth::user()->campus_id }}" name="branches" id="branches">
                                                        <label class="mr-sm-2">Start Date: </label>
                                                        <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="startdate" id="startdate">
                                                        <label class="mr-sm-2">End Date: </label>
                                                        <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="enddate" id="enddate">
                                                        <button type="button" class="btn btn-success btn-sm mb-2 mr-2" id="btnshow"><i class="fas fa-search"></i> Search</button>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12">
                                                    <p style="text-align: center; color: #333; font-size: 13px; font-weight: bold; margin-bottom: 2px;">ឌូវី ឆាល់ឃែរ៍​ ហោស៌ ទីតាំង {{ $compuse->name_kh }}</p>
                                                    <p style="text-align: center; color: #333; font-size: 16px; font-weight: bold;">របាយការណ៍សិស្សព្យួរការសិក្សា</p>
                                                    <table class="table table-bordered table-striped" id="payment_report">
                                                        <thead>
                                                            <tr>
                                                                <th style="font-size: 11px;">#</th>
                                                                <th style="font-size: 11px;">ឈ្មោះ</th>
                                                                <th style="font-size: 11px;">ភេទ</th>
                                                                <th style="font-size: 11px;">លេខទូរសព្ទ</th>
                                                                <th style="font-size: 11px;">កាលបរិច្ឆេទ</th>
                                                                <th style="font-size: 11px;">ស្ថានភាព</th>
                                                                <th style="font-size: 11px;">ចំនួនទឹកប្រាក់</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    {{-- modal add discount --}}
    <div class="modal fade" id="modal-form-discount">
        <div class="modal-dialog">
            <form method="POST" autocomplete="off">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control form-control-sm" id="description" name="description" autofocus required>
                        </div>
                        <div class="form-group">
                            <label>Discount %</label>
                            <input type="number" class="form-control form-control-sm" id="discount" name="discount" required>
                        </div>
                        <div class="form-group">
                            <label>From Date</label>
                            <input type="date" class="form-control form-control-sm" id="fdate" name="fdate" required>
                        </div>
                        <div class="form-group">
                            <label>Exp Date</label>
                            <input type="date" class="form-control form-control-sm" id="edate" name="edate" required>
                        </div>
                        <div class="form-group">
                            <label>Note</label>
                            <textarea class="form-control" rows="3" id="note" name="note" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control form-control-sm" id="status" name="status">
                                <option value="active">Active</option>
                                <option value="unactive">Unactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- modal add services fee --}}
    <div class="modal fade" id="modal-form-fee">
        <div class="modal-dialog">
            <form method="POST" autocomplete="off">
                {{ csrf_field() }} {{ method_field('POST') }}
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="type_id" name="type_id">
                        <div class="form-group">
                            <label>Service Type</label>
                            <input type="text" class="form-control form-control-sm" id="type" name="type" autofocus required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- modal add services product --}}
    <div class="modal fade" id="modal-form-product">
        <div class="modal-dialog modal-xl">
            <form autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title"></h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ជ្រើសរើសតម្លៃសិក្សាសម្រាប់ឆ្នាំ</label>
                            <select class="form-control form-control-sm" id="year" name="year" required>
                                <option value="">Select Acdemic</option>
                                @foreach($year as $row)
                                    <option value="{{ $row->id }}">{{ $row->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>សម្រាប់សិស្សអាយុ​ចាប់ពី ១ឆ្នាំកន្លះ ដល់ក្រោម ២ឆ្នាំកន្លះ</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="font-size: 11px !important;">ពេលសិក្សា / Time</th>
                                        <th style="font-size: 11px !important;">មួយត្រីមាស / Per Term</th>
                                        <th style="font-size: 11px !important;">មួយឆមាស / Per Semester</th>
                                        <th style="font-size: 11px !important;">មួយឆ្នាំ / Per Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th style="font-size: 12px; text-align: center; vertical-align: middle !important;">ពេលព្រឹក ឫរសៀល / Half Day</th>
                                        <td><input class="form-control" type="number" id="per_term_1year_to_2year_half_day"  style="text-align: center"/></td>
                                        <td><input class="form-control" type="number" id="per_semester_1year_to_2year_half_day"  style="text-align: center"/></td>
                                        <td><input class="form-control" type="number" id="per_year_1year_to_2year_half_day"  style="text-align: center"/></td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 12px; text-align: center; vertical-align: middle !important;">ពេញមួយថ្ងៃ / Full Day</th>
                                        <td><input class="form-control" type="number" id="per_term_1year_to_2year_full_day"  style="text-align: center"/></td>
                                        <td><input class="form-control" type="number" id="per_semester_1year_to_2year_full_day"  style="text-align: center"/></td>
                                        <td><input class="form-control" type="number" id="per_year_1year_to_2year_full_day"  style="text-align: center"/></td>
                                    </tr>   
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <label>សម្រាប់សិស្សអាយុ​ចាប់ពី ២ឆ្នាំកន្លះ ដល់ក្រោម ៦ឆ្នាំ</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="font-size: 11px !important;">ពេលសិក្សា / Time</th>
                                        <th style="font-size: 11px !important;">មួយត្រីមាស / Per Term</th>
                                        <th style="font-size: 11px !important;">មួយឆមាស / Per Semester</th>
                                        <th style="font-size: 11px !important;">មួយឆ្នាំ / Per Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th style="font-size: 12px; text-align: center; vertical-align: middle !important;">ពេលព្រឹក ឫរសៀល / Half Day</th>
                                        <td><input class="form-control" type="number" id="per_term_2year_to_6year_half_day"  style="text-align: center"/></td>
                                        <td><input class="form-control" type="number" id="per_semester_2year_to_6year_half_day"  style="text-align: center"/></td>
                                        <td><input class="form-control" type="number" id="per_year_2year_to_6year_half_day"  style="text-align: center"/></td>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 12px; text-align: center; vertical-align: middle !important;">ពេញមួយថ្ងៃ / Full Day</th>
                                        <td><input class="form-control" type="number" id="per_term_2year_to_6year_full_day"  style="text-align: center"/></td>
                                        <td><input class="form-control" type="number" id="per_semester_2year_to_6year_full_day"  style="text-align: center"/></td>
                                        <td><input class="form-control" type="number" id="per_year_2year_to_6year_full_day"  style="text-align: center"/></td>
                                    </tr>   
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="far fa-window-close"></i> Close</button>
                        <button type="button" class="btn btn-success btn-sm" id="btn_save_product"><i class="far fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- modal edit services product --}}
    <div class="modal fade" id="modal-form-edit-product">
        <div class="modal-dialog modal-lg">
            <form autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title"></h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_edit" name="id_edit">
                        <div class="form-group">
                            <label>ជ្រើសរើសឆ្នាំសិក្សា</label>
                            <select class="form-control form-control-sm" id="year_edit" name="year_edit">
                                <option value="">Select Acdemic</option>
                                @foreach($year as $row)
                                    <option value="{{ $row->id }}">{{ $row->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>សេវាកម្ម</label>
                            <input type="text" class="form-control form-control-sm" id="services_edit" name="services_edit">
                        </div>
                        <div class="form-group">
                            <label>តម្លៃសិក្សា</label>
                            <input type="number" class="form-control form-control-sm" id="price_edit" name="price_edit">
                        </div>
                        <div class="form-group">
                            <label>រយះពេល</label>
                            <select class="form-control form-control-sm" id="month_edit" name="month_edit">
                                <option value="">Select Month</option>
                                <option value="3">Per Term</option>
                                <option value="6">Per Semester</option>
                                <option value="12">Per Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="far fa-window-close"></i> Close</button>
                        <button type="button" class="btn btn-success btn-sm" id="btn_update_product"><i class="far fa-edit"></i> Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{--modal for show over due--}}
    <div class="modal fade" id="modalOverDue">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold">Student Over Due</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped" id="table_over_due">
                        <thead>
                            <tr>
                                <th style="font-size: 11px; text-transform: uppercase;">Reference Nº</th>
                                <th style="font-size: 11px; text-transform: uppercase;">Description</th>
                                <th style="font-size: 11px; text-transform: uppercase;">Phone</th>
                                <th style="font-size: 11px; text-transform: uppercase;">Paid Date</th>
                                <th style="font-size: 11px; text-transform: uppercase;">Expired Date</th>
                                <th style="font-size: 11px; text-transform: uppercase;">Status</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{--modal for show student deposit--}}
    <div class="modal fade" id="modal_deposit">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold">Student Deposit</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped" id="table_deposit">
                        <thead>
                            <tr>
                                <th style="font-size: 11px; text-transform: uppercase;">Date</th>
                                <th style="font-size: 11px; text-transform: uppercase;">Payment Method</th>
                                <th style="font-size: 11px; text-transform: uppercase;">Reference Nº</th>
                                <th style="font-size: 11px; text-transform: uppercase;">Amount</th>
                                <th style="font-size: 11px; text-transform: uppercase;">Deposit</th>
                                <th style="font-size: 11px; text-transform: uppercase;">Total Deposit</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{--modal for show student invoice--}}
    <div class="modal fade" id="modalViewPay">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title font-weight-bold">View Invoice</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="invoice_student">
                        <section>
                            <div style="text-align: center;font-size: 14px;font-family: 'Khmer OS Muol Light'">
                                <p>វិក្កយបត្រ</p>
                            </div>
                            <table >
                                <tr>
                                    <td><p style="font-size: 12px;font-family: 'Khmer OS Muol Light'">ព័ត៍មានអតិថិជន CUSTOMER INFO:</p></td>
                                    <td><p style="font-size: 12px;margin-left: 130px">លេខ NO: <span id="reciept_custom"></span></p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-size: 12px;margin-top: -17px">ឈ្មោះ Name: <span id="name_custom"></span></p></td>
                                    <td><p style="font-size: 12px;margin-left: 130px;margin-top: -17px">កាលបរិច្ឆេទ Date : <span id="date_pay_custom"></span></p></td>
                                </tr>
                                <tr>
                                    <td><p style="font-size: 10px;margin-top: -17px">អាស័យដ្ឋាន Address : BattamBang</p></td>
                                </tr>
                            </table>
                            <table class="table table-bordered" id="tbl_print_invoice">
                                <thead style="font-size: 10px;" class="test" >
                                    <th width="55%" style="text-align: center;font-size: 10px">មុខទំនិញ</th>
                                    <th width="5%" style="text-align: center;font-size: 10px">បរិមាណ</th>
                                    <th width="20%" style="text-align: center;font-size: 10px">ថ្លៃឯកតា</th>
                                    <th width="20%" style="text-align: center;font-size: 10px">ថ្លៃទំនញ</th>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr style="text-align: center; font-size: 13px;">
                                        <td colspan="3" style="text-align: right;padding: 2px">សរុបរង: Subtotal</td>
                                        <td style="padding: 2px" id="print_sub">0.00</td>
                                    </tr>
                                    <tr style="text-align: center; font-size: 13px;">
                                        <td colspan="3" style="text-align: right;padding: 2px">បញ្ចុះតម្លៃ: Discount</td>
                                        <td style="padding: 2px" id="print_dis">0.00</td>
                                    </tr>
                                    <tr style="text-align: center; font-size: 13px;">
                                        <td colspan="3" style="text-align: right;padding: 2px">ប្រាក់កក់(Deposit)</td>
                                        <td style="padding: 2px" id="label_deposit">0.00</td>
                                    </tr>
                                    <tr style="text-align: center; font-size: 13px;">
                                        <td colspan="3" style="text-align: right;padding: 2px">សាច់ប្រាក់ទូទាត់ Amount Due</td>
                                        <td style="padding: 2px" id="print_amount"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </section>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" id="print_invoice"><i class="fas fa-print"></i> Print Invoice</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer')
    <script>
        var table = $('#table_discount').DataTable({
            responsive: true,
			autoWidth: false,
			processing: true,
			serverSide: true,
            ajax: "{{ route('discount_type.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'discount_name', name: 'discount_name'},
                {data: 'percent_dis', name: 'percent_dis'},
                {data: 'from_date', name: 'from_date'},
                {data: 'exp_date', name: 'exp_date'},
                {data: 'note', name: 'note'},
                {
					data: 'status',
					name: 'status',
					render: function(data, type, full, meta) {
						if (data == 'active') {
								return "<span class='badge badge-pill badge-primary'>" + data + "</span>";
						} else {
							return "<span class='badge badge-pill badge-danger'>" + data + "</span>";
						}
					},
				},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        var numUSD = new Intl.NumberFormat('en-US', {
			style:'currency',
			currency: 'USD'
		})

        $('#adddiscount').click(function() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form-discount').modal('show');
            $('#modal-form-discount form')[0].reset();
            $('.modal-title').text('Add Discount');
        });

        $(function() {
            $('#modal-form-discount form').on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id').val();
                if (save_method == 'add') url = "{{ url('discount_type') }}";
                else url = "{{ url('discount_type') . '/' }}" + id;

                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#modal-form-discount form').serialize(),
                    success: function(data) {
                        $('#modal-form-discount').modal('hide');
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: "Data has been inserted!",
                            type: "success",
                            timer: '1500'
                        })
                    },
                    error: function(data) {
                        swal({
                            title: 'Oops...',
                            text: "Something went wrong!",
                            type: "error",
                            timer: '1500'
                        })
                        console.log(data)
                    }
                });
                return false;
                }
            });
        });

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form-discount form')[0].reset();
            $.ajax({
                url: "{{ url('discount_type') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form-discount').modal('show');
                    $('.modal-title').text('Edit Discount');
                    $('#id').val(data.id);
                    $('#description').val(data.discount_name);
                    $('#discount').val(data.percent_dis);
                    $('#fdate').val(data.from_date);
                    $('#edate').val(data.exp_date);
                    $('#note').val(data.note);
                    $('#status').val(data.status);
                },
                error: function() {
                    swal({
                        title: 'Oops...',
                        text: "Nothing Data",
                        type: "error",
                        timer: '1500'
                    })
                }
            });
        }

        function deleteData(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(function() {
                $.ajax({
                    url: "{{ url('discount_type') }}" + '/' + id,
                    type: "POST",
                    data: {'_method' : 'DELETE', '_token' : csrf_token},
                    success: function(data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: "Data has been deleted!",
                            type: "success",
                            timer: '1500'
                        })
                    },
                    error: function(data) {
                        swal({
                            title: 'Oops...',
                            text: "Something went wrong!",
                            type: "error",
                            timer: '1500'
                        })
                        console.log(data)
                    }
                })
            })
        }

        // add product services
        $('#addservices').click(function() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $("#modal-form-product").modal({backdrop: 'static', keyboard: false})
            $('#modal-form-product form')[0].reset();
            $('.modal-title').text('បញ្ចូលតម្លៃសិក្សា');
        });

        $('#btn_save_product').click(function() {
            var year = $('#year').val();
            var per_term_1year_to_2year_half_day = $('#per_term_1year_to_2year_half_day').val();
            var per_semester_1year_to_2year_half_day = $('#per_semester_1year_to_2year_half_day').val();
            var per_year_1year_to_2year_half_day = $('#per_year_1year_to_2year_half_day').val();
            var per_term_1year_to_2year_full_day = $('#per_term_1year_to_2year_full_day').val();
            var per_semester_1year_to_2year_full_day = $('#per_semester_1year_to_2year_full_day').val();
            var per_year_1year_to_2year_full_day = $('#per_year_1year_to_2year_full_day').val();

            var per_term_2year_to_6year_half_day = $('#per_term_2year_to_6year_half_day').val();
            var per_semester_2year_to_6year_half_day = $('#per_semester_2year_to_6year_half_day').val();
            var per_year_2year_to_6year_half_day = $('#per_year_2year_to_6year_half_day').val();
            var per_term_2year_to_6year_full_day = $('#per_term_2year_to_6year_full_day').val();
            var per_semester_2year_to_6year_full_day = $('#per_semester_2year_to_6year_full_day').val();
            var per_year_2year_to_6year_full_day = $('#per_year_2year_to_6year_full_day').val();

            if (year == '' || per_term_1year_to_2year_half_day == '' || per_semester_1year_to_2year_half_day == '' || per_year_1year_to_2year_half_day == '' || per_term_1year_to_2year_full_day == '' || per_semester_1year_to_2year_full_day == '' || per_year_1year_to_2year_full_day == '' || per_term_2year_to_6year_half_day == '' || per_semester_2year_to_6year_half_day == '' || per_year_2year_to_6year_half_day == '' || per_term_2year_to_6year_full_day == '' || per_semester_2year_to_6year_full_day == '' || per_year_2year_to_6year_full_day == '') {
                swal({
                    title: 'Oops...!',
                    text: "Please Enter Your Value!",
                    type: "error"
                })
            } else {
                $.ajax({
                    type: 'post',
                    url: '{{ route('product_services.store') }}',
                    data: {
                        '_token': '{{ @csrf_token() }}',
                        'year': year,
                        'per_term_1year_to_2year_half_day': per_term_1year_to_2year_half_day,
                        'per_semester_1year_to_2year_half_day': per_semester_1year_to_2year_half_day,
                        'per_year_1year_to_2year_half_day': per_year_1year_to_2year_half_day,
                        'per_term_1year_to_2year_full_day': per_term_1year_to_2year_full_day,
                        'per_semester_1year_to_2year_full_day': per_semester_1year_to_2year_full_day,
                        'per_year_1year_to_2year_full_day': per_year_1year_to_2year_full_day,
                        'per_term_2year_to_6year_half_day': per_term_2year_to_6year_half_day,
                        'per_semester_2year_to_6year_half_day': per_semester_2year_to_6year_half_day,
                        'per_year_2year_to_6year_half_day': per_year_2year_to_6year_half_day,
                        'per_term_2year_to_6year_full_day': per_term_2year_to_6year_full_day,
                        'per_semester_2year_to_6year_full_day': per_semester_2year_to_6year_full_day,
                        'per_year_2year_to_6year_full_day': per_year_2year_to_6year_full_day
                    },
                    success: function(data) {
                        $('#modal-form-product').modal('hide');
                        swal({
                            title: 'Success!',
                            text: "Data has been inserted!",
                            type: "success"
                        })
                        $('#table_pro_service').DataTable({
                            responsive: true,
			                autoWidth: false,
                            data: data.data,
                            "columns": [
                                {"data": 'id'},
                                {"data": "pro_service"},
                                {"data": "service_type"},
                                {
                                    "data": "price_service"
                                },
                                {
                                    sortable: false,
                                    "render": function (data, type, full, meta) {
                                        var value = full.pay_month
                                        if (value == 1) {
                                            return "Per Month"
                                        } else if (value == 3) {
                                            return "Per Term"
                                        } else if (value == 6) {
                                            return "Per Semester"
                                        } else {
                                            return "Per Year"
                                        }
                                    }
                                },
                                {
                                    sortable: false,
                                    "render": function (data, type, full, meta) {
                                        var value = full.id_service_type
                                        var val_del = full.id
                                        return '<button   class="btn btn-app-green btn-xs btn_edit_service"  value=' + value + '><i class="fa fa-edit"></i></button>&nbsp;' +
                                            '<button   class="btn btn-app-red btn-xs btn_delete_service "  value=' + val_del + '><i class="fa fa-trash"></i></button>';
                                    }
                                },
                            ],
                        });
                    },
                    error: function(data) {
                        console.log(data)
                    }
                })
            }
        })

        $('#div_title_service').hide()
        $('#btn_search_service').click(function () {
            var idpaid = $('#select_paid').val()
            var idyear = $('#select_academic').val()
            $('#span_permonth').html($('#select_paid option:selected').text())
            $('#span_year_en').html($('#select_academic option:selected').text())
            $('#span_year_kh').html($('#select_academic option:selected').text())
            $('#div_title_service').show()

            $('#table_pro_service').DataTable({
                destroy: true,
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: "{{ url('show_proservice') }}" + '/' + idpaid + '/' + idyear,
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'pro_service', name: 'pro_service'},
                    {data: 'service_type', name: 'service_type'},
                    {data: 'price_service', name: 'price_service'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            })
        })

        function deleteServices(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(function() {
                $.ajax({
                    url: "{{ url('product_services') }}" + '/' + id,
                    type: "POST",
                    data: {'_method' : 'DELETE', '_token' : csrf_token},
                    success: function(data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: "Data has been deleted!",
                            type: "success"
                        }).then((result) => {
                            location.reload();
                        });
                    },
                    error: function() {
                        swal({
                            title: 'Oops...',
                            text: "Something went wrong!",
                            type: "error",
                            timer: '1500'
                        })
                    }
                })
            })
        }

        function editServices(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $.ajax({
                url: "{{ url('product_services') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $("#modal-form-edit-product").modal({backdrop: 'static', keyboard: false})
                    $('.modal-title').text('កែប្រែតម្លៃសិក្សា');
                    $('#id_edit').val(data.id);
                    $('#year_edit').val(data.id_academic);
                    $('#services_edit').val(data.pro_service);
                    $('#price_edit').val(data.price_service);
                    $('#month_edit').val(data.pay_month);
                },
                error: function(data) {
                    console.log(data)
                    swal({
                        title: 'Oops...',
                        text: "Nothing Data",
                        type: "error",
                        timer: '1500'
                    })
                }
            });
        }

        // update product services
        $('#btn_update_product').click(function() {
            var id = $('#id_edit').val();
            var year_edit = $('#year_edit').val();
            var services_edit = $('#services_edit').val();
            var price_edit = $('#price_edit').val();
            var month_edit = $('#month_edit').val();
            console.log(id)
            $.ajax({
                type: 'PATCH',
                url: "{{ url('product_services') . '/' }}" + id,
                data: {
                    '_token': '{{ @csrf_token() }}',
                    'year_edit': year_edit,
                    'services_edit': services_edit,
                    'price_edit': price_edit,
                    'month_edit': month_edit
                },
                success: function() {
                    $('#modal-form-edit-product').modal('hide');
                    swal({
                        title: 'Success!',
                        text: "Data has been updated!",
                        type: "success"
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(data) {
                    console.log(data)
                }
            })
        });

        // add services type
        $('#addservicestype').click(function() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form-fee').modal('show');
            $('#modal-form-fee form')[0].reset();
            $('.modal-title').text('Add Services Type');
        });

        var table = $('#table_services_type').DataTable({
            responsive: true,
			autoWidth: false,
			processing: true,
			serverSide: true,
            ajax: "{{ route('services_type.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'service_type', name: 'service_type'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

        $(function() {
            $('#modal-form-fee form').on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                var type_id = $('#type_id').val();
                if (save_method == 'add') url = "{{ url('services_type') }}";
                else url = "{{ url('services_type') . '/' }}" + type_id;

                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#modal-form-fee form').serialize(),
                    success: function(data) {
                        $('#modal-form-fee').modal('hide');
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: "Data has been inserted!",
                            type: "success",
                            timer: '1500'
                        })
                    },
                    error: function(data) {
                        swal({
                            title: 'Oops...',
                            text: "Something went wrong!",
                            type: "error",
                            timer: '1500'
                        })
                        console.log(data)
                    }
                });
                return false;
                }
            });
        });

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form-fee form')[0].reset();
            $.ajax({
                url: "{{ url('services_type') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form-fee').modal('show');
                    $('.modal-title').text('Edit Services Type');
                    $('#type_id').val(data.id);
                    $('#type').val(data.service_type);
                },
                error: function() {
                    swal({
                        title: 'Oops...',
                        text: "Nothing Data",
                        type: "error",
                        timer: '1500'
                    })
                }
            });
        }

        function deleteData(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(function() {
                $.ajax({
                    url: "{{ url('services_type') }}" + '/' + id,
                    type: "POST",
                    data: {'_method' : 'DELETE', '_token' : csrf_token},
                    success: function(data) {
                        swal({
                            title: 'Success!',
                            text: "Data has been deleted!",
                            type: "success"
                        })
                    },
                    error: function(data) {
                        swal({
                            title: 'Oops...',
                            text: "Something went wrong!",
                            type: "error",
                            timer: '1500'
                        })
                        console.log(data)
                    }
                })
            })
        }

        $(document).ready(function() {
			$('#stuid').html("Not selection");
			$('#name_kh').html("Not selection");
			$('#name_en').html("Not selection");
			$('#tel').html("Not selection");
			$('#h_name_en').html("Not selection")


            var tbl = $('#table_invoice').DataTable({
                responsive: true,
                autoWidth: false,
                destroy: true,
                pageLength : 5,
                "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
            });

            var list = $('#student_name').select2({
                placeholder: "Select a Student",
                width: '100%',
                allowClear: true,
                closeOnSelect: false
            }).on("select2:closing", function(event) {
                event.preventDefault();
            }).on("select2:closed", function(event) {
                list.select2("open");
            });
                list.select2("open");

            // select info by id
            function selectStudentInfo() {
                var id = $('#student_name').val();
                $.ajax({
                    url: "{{ url('select_info_by_iD') }}" + '/' + id,
		    		method: 'get',
		    		data: {id: JSON.stringify(id)},
		    		processData: false,
		    		dataType: 'json',
		    		contentType: "application/json; charset=utf-8",
		    		traditional: true,
                    success: function(data) {
                        var link = '{{ route('payment.show', 'id_student') }}'
						var link2 = link.replace("id_student", data.student.id)

                        $('#h_name_en').html(data.student.sunameen + ' ' + data.student.finameen);
						$('#stuid').html(data.student.stuno);
						$('#name_kh').html(data.student.sunamekh + ' ' + data.student.finamekh);
						$('#name_en').html(data.student.sunameen + ' ' + data.student.finameen);
						$('#tel').html(data.student.tel);
                        $('#open_invoice').attr("href", link2)
                        $('#balance').html(numUSD.format(data.data_payment.balance));
						$('#invoice').html(data.data_payment.invoice);
						$('#deposit').html(numUSD.format(data.deposit.deposit))
                        $('#over_due').html(data.count_over_due.over_due);

                        $('#table_invoice').DataTable({
                            responsive: true,
                            autoWidth: false,
                            destroy: true,
                            pageLength : 5,
                            "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
                            data: data.data,
                            "columns": [
                                { "data": "payment_date" },
                                { "data": "payment_method" },
                                { "data": "invoice_number" },
                                { "data": "total_pay"},
                                { "data": "fullname" },
                                {
                                    data: null,
                                    sortable: false,
                                    render: function (data, type, row) {
                                        return '<button class="btn btn-info btn-xs text-white btn_open_detail" value=' + data.Invoice_id + '><i class="fa fa-eye"></i> View</button>';
                                    }
                                },
                            ],
                            columnDefs:[
                                {
                                    targets:0,
                                    render:function(data){
                                        return moment(data).format('MMMM-D-YYYY');
                                    }
                                },
                                {
                                    targets:3,
                                    render:function(data) {
                                        return numUSD.format(data)
                                    }
                                },
                                {
                                    targets:2,
                                    render:function(data) {
                                        return "CIN" + data
                                    }
                                },
                                {
                                    targets:4,
                                    render:function(data) {
                                        return "Paid By [ " + data + " ]"
                                    }
                                }
                            ],
                        });
                    },
                    error: function(data) {
                        console.log(data)
                    }
                })
            }

            $('#btn_search_by_date').click(function() {
                var from_date = $("#startdate").val()
                var to_date = $('#enddate').val()
                var id = $('#student_name').val();
                var student_name = $('#h_name_en').html()
                var pay_method = $('#pay_method').val()

                if (student_name == 'Not selection') {
                    swal({
                        title: 'Oops...!',
                        text: "Please Select a Student First!",
                        type: "warning"
                    })
                } else if (from_date == '') {
                    swal({
                        title: 'Oops...!',
                        text: "Please choose start date!",
                        type: "warning"
                    })
                } else if (to_date == '') {
                    swal({
                        title: 'Oops...!',
                        text: "Please choose end date!",
                        type: "warning"
                    })
                } else {
                    $('#table_invoice').DataTable({
                        responsive: true,
                        autoWidth: false,
                        destroy: true,
                        pageLength : 5,
                        "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]],
                        "ajax":{
                            'type': 'POST',
                            'url': '{{ route('searhByDate') }}',
                            data:{'_token': '{{ @csrf_token() }}', 'from_date': from_date, 'to_date': to_date, 'id': id, 'pay_method': pay_method}
                        },
                        "columns": [
                            { "data": "payment_date" },
                            { "data": "payment_method" },
                            { "data": "invoice_number" },
                            { "data": "total_pay"},
                            { "data": "fullname" },
                            {
                                data: null,
                                sortable: false,
                                render: function (data, type, row) {
                                    return '<button class="btn btn-info btn-xs text-white btn_open_detail" value=' + data.Invoice_id + '><i class="fa fa-eye"></i> View</button>';
                                }
                            },

                        ],
                        columnDefs:[
                            {
                                targets:0,
                                render:function(data){
                                    return moment(data).format('MMMM-D-YYYY');
                                }
                            },
                            {
                                targets:3,
                                render:function(data) {
                                    return numUSD.format(data)
                                }
                            },
                            {
                                targets:2,
                                render:function(data) {
                                    return "CIN" + data
                                }
                            },
                            {
                                targets:4,
                                render:function(data) {
                                    return "Paid By [ " + data +" ]"
                                }
                            }
                        ],
                    })
                }
            })

            // view invoice student
            $('#table_invoice').on('click','.btn_open_detail',function () {
                var id = $('#student_name').val()
                var id_payment = $(this).val()
                $.ajax({
                    url: "{{ url('viewinvoice') }}" + '/' + id + '/' +id_payment,
                    method: 'GET',
                    processData: false,
                    dataType: 'json',
                    contentType: "application/json; charset=utf-8",
                    traditional: true,
                    success:function (data) {
                        $('#name_custom').html($('#name_en').text())
                        $('#reciept_custom').html('CIN'+data.header.invoice_number)
                        $('#due_date_custom').html(formatDateForPint(data.header.due_date))
                        $('#date_pay_custom').html(formatDateForPint(data.header.payment_date))
                        $('#print_dis').html(numUSD.format(data.header.total_discount))
                        $('#print_sub').html(numUSD.format(data.header.total_subtotal))
                        $('#print_amount').html(numUSD.format(parseFloat(data.header.total_subtotal-data.header.total_discount)))
                        $('#label_deposit').html(numUSD.format(data.header.deposit))
                        $('#tbl_print_invoice tbody').html(data.descriptions)
                    },
                    error: function(data) {
                        console.log(data)
                    }
                })
                $("#modalViewPay").modal({backdrop: 'static', keyboard: false})
            })

            // select student name
            $('#student_name').on('change', function() {
		    	if ($('#student_name').val() == '') {
		    		$('#open_invoice').removeAttr('href');
		    	} else {
		    		selectStudentInfo();
		    	}
		    });

            // open invoice
            $('#open_invoice').click(function () {
                if ($('#h_name_en').text() == "Not selection") {
                    swal({
                        title: 'Warning!',
                        text: "Please Select a Student First!",
                        type: "warning",
                    })
                }
            });

            // open over due
            $('#btn_over_due').click(function () {
                if ($('#h_name_en').text() == "Not selection") {
                    swal({
                        title: 'Warning!',
                        text: "Please Select a Student First!",
                        type: "warning",
                    })
                } else {
                    var id = $('#student_name').val()
                    $.ajax({
                        url: "{{ url('searchoverdue') }}" + '/' + id,
                        type:'GET',
                        data: {id: JSON.stringify(id)},
                        processData: false,
                        dataType: 'json',
                        contentType: "application/json; charset=utf-8",
                        traditional: true,
                        success: function(data) {
                            $('#table_over_due').DataTable({
                                responsive: true,
                                autoWidth: false,
                                destroy:true,
                                data:data.data,
                                columnDefs: [
                                    {
                                        targets:3,
                                        render:function(data){
                                            return formatDateForPint(data)
                                        }
                                    }
                                    ,
                                    {targets:4, render:function(data){
                                            return formatDateForPint(data)
                                        }
                                    }
                                    ,
                                    {targets:0, render:function(data){
                                            return "CIN" + data
                                        }
                                    },
                                ],
                                fixedColumns: true,
                                "columns": [
                                    { "data": "invoice_number" },
                                    { "data": "description" ,className:"font_style"},
                                    { "data": "tel" },
                                    { "data": "Volidty_of_payment"},
                                    { "data": "expired_date" },
                                    {
                                        sortable: false,
                                        "render": function (data, type, full, meta) {
                                            return '<button class="btn btn-danger btn-xs" style="font-size: 10px">CALL NOW &nbsp;<i class="fa fa-phone" ></i></button>';
                                        }
                                    },
                                ],
                            });
                            $('#modalOverDue').modal({backdrop: 'static', keyboard:false})
                        },
                        error: function(data) {
                            console.log(data)
                        }
                    })
                }
            });
        })

        function formatDateForPint(date) {
            //function formation date
            var date=new Date(date)
            return ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate()))+'-' +((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '-' + date.getFullYear()
        }

        // Report Setting
        $(document).ready(function() {
            $('#report_cash_collection').hide();

            var numUSD = new Intl.NumberFormat('en-US', {
				style:'currency',
				currency: 'USD'
			})

            $('#btn_search_cash_collection').click(function() {
                var start_date = $('#start_from_date').val();
                var from_date = $('#from_date').val();

                var d = new Date();

                var month = d.getMonth()+1;
                var day = d.getDate();

                var output = d.getFullYear() + '/' +
                    ((''+month).length<2 ? '0' : '') + month + '/' +
                    ((''+day).length<2 ? '0' : '') + day

                if (start_date == '') {
					swal({
			            title: 'Warning!',
			            text: "Please Choose Start Date!",
			            type: "warning"
			        })
				} else if(from_date == '') {
                    swal({
                        title: 'Oops...',
                        text: "Please Choose From Date!",
                        type: "warning"
                    })
				} else {
                    $.ajax({
                        url: "{{ url('search_cash_collection_report') }}",
						type: 'get',
						data: {'_token':'{{ @csrf_token() }}', 'start_date': start_date, 'from_date': from_date},
						dataType: 'json',
						success: function(data) {
                            $('#report_cash_collection').show();
                            var total_amount = 0;
							var total_invoice = 0;
                            var count=1
							for (var i = 0; i < data.report.length; i++) {
						        total_amount += data.report[i].total_payment;
						    }
                            var lists=data.report
                            var browsers = []
                            for (var i = 0; i < lists.length; i++) {
                                var currentBrowser = lists[i].invoice_number;
                                if (undefined != browsers[currentBrowser]) {
                                    browsers[currentBrowser]++;
                                }
                                else {
                                    browsers[currentBrowser] = 1;
                                }
                            }

                            browsers.forEach(element => {
                                count++
                            });

                            $('.header-date').html('From' + ' ' + moment(start_date).format('MMMM-DD-YYYY') + ' ' + 'To' + ' ' + moment(from_date).format('MMMM-DD-YYYY'));
							$('#cash_invoice').html(data.report.length)
							$('#total_amm').html(numUSD.format(total_amount))

                            var table_cash = $('#cash_collection_report').DataTable({
                                responsive: true,
			                    autoWidth: false,
                              	processing: true,
						        ordering: false,
						        destroy: true,
                                lengthChange: false,
                                buttons: [
                                    {
                                        text: '<i class="fas fa-print"></i> Print',
                                        className: 'btn btn-default btn-sm',
                                        action: function ( e, dt, node, config ) {
                                            $("#cash_collection_report").printThis({
                                                importCSS: false,
	                                            importStyle: true,
                                                loadCSS: ["{{asset('dist/css/report_cash.css')}}"],
                                                header: (
                                                    '<div class="header-area">'+
                                                        '<div class="logo">'+
                                                            '<img src="{{ asset('dist/img/logo.png') }}">'+
                                                        '</div>'+
                                                        '<div class="top-title">'+
                                                            '<h1>ឌូវី ឆាល់ឃែរ៍​ ហោស៌</h1>'+
                                                            '<h3>Dewey Childcare House</h3>'+
                                                        '</div>'+
                                                    '</div>'
                                                ),
                                            });
                                        }
                                    },
                                    {
                                        text: '<i class="far fa-file-excel"></i> Excel',
                                        className: 'btn btn-default btn-sm',
                                        extend: 'excel'
                                    }
                                ],
						        data: data.report,
						        columns: [
						        	{ "data": "payment_date" },
                                    { "data": "en_name" },
                                    { "data": "invoice_number" },
                                    { "data": "description" },
                                    { "data": "fullname"},
                                    { "data": "total_payment" },
                                ],
                                columnDefs:[
                                    {
                                        targets:0,
                                        render:function(data){
                                            return moment(data).format('MMMM-D-YYYY');
                                        }
                                    },
                                    {
                                        targets:2,
                                        render:function(data) {
                                            return "CIN" + data
                                        }
                                    },
                                    {
                                        targets:5,
                                        render:function(data){
                                            return numUSD.format(data)
                                        }
                                    },
                                    { 
                                        "visible": false, 
                                        "targets": 2 
                                    },
                                ],
						        order: [[2, 'asc'], [3, 'asc']],
							    rowsGroup:[2],
						        rowGroup: {
                                	dataSrc: ['invoice_number'],
                                	startRender: function (rows, group) {

								        if (group == group) {
								        	return 'Invoice Number: ' + 'CIN' + group;
								        }
                                	},
						            endRender: function ( rows, group ) {
						                var total = rows
						                    .data()
						                    .pluck('total_payment')
						                    .reduce( function (a, b) {
						                        return a + b;
						                    }, 0) + rows;
						                total = $.fn.dataTable.render.number(',', '.', 2, '$').display( total )
						                return $('<tr/>')
						                    .append( '<td colspan="4" style="background-color:#ffffff;text-align:right">Total : </td>' )
						                    .append( '<td  style="background-color: #ffffff; font-weight: normal;text-align:center">'+total+'</td>' );
						            },
						        }
							})
                            table_cash.buttons().container()
                                .appendTo( '#cash_collection_report_wrapper .col-md-6:eq(0)' );
                        },
                        error: function(data) {
                            console.log(data)
                        }
                    });
                }
            })

            // show modal student deposit
            $('#btn_show_modal_deposit').click(function() {
                var id = $('#student_name').val()
                if ($('#h_name_en').text() == "Not selection") {
                    swal({
                        title: 'Warning!',
                        text: "Please Select a Student First!",
                        type: "warning",
                    })
                } else {
                    $('#modal_deposit').modal({backdrop: 'static', keyboard: false})
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('viewDeposit_View') }}',
                        data: {
                            '_token': '{{ @csrf_token() }}',
                            'id': id
                        },
                        success: function(data) {
                            console.log(data)
                            $('#table_deposit').DataTable({
                                responsive: true,
                                autoWidth: false,
                                searching:true,
                                destroy:true,
                                data: data.data,
                                "columns": [
                                    { "data": "payment_date" },
                                    { "data": "payment_method" },
                                    { "data": "invoice_number" },
                                    { "data": "total_pay"},
                                    { "data": "deposit" },
                                    {
                                        data: null,
                                        sortable: false,
                                        render: function (data, type, row) {
                                            return '<p style="color:red">'+numUSD.format(data.total_pay-data.deposit)+'</p>';
                                        }
                                    }
                                ],
                                columnDefs:[
                                    {
                                        targets:3,
                                        render:function(data) {
                                            return numUSD.format(data)
                                        }
                                    },
                                    {
                                        targets:0,
                                        render:function(data) {
                                            return formatDateForPint(data)
                                        }
                                    },
                                    {
                                        targets:2,
                                        render:function(data) {
                                            return "CIN" + data
                                        }
                                    },
                                    {
                                        targets:4,
                                        render:function(data) {
                                            return numUSD.format(data)
                                        }
                                    }
                                ],
                            })
                        },
                        error: function(data) {
                            console.log(data)
                        }
                    });
                }
            });

            // Print Invoice
            $('#print_invoice').click(function() {
                $('#invoice_student').printThis({
                    importCSS: true,
	                importStyle: true,
                    header: (
                        '<div class="row">' +
                            '<div class="col-2">' +
                                '<img src="{{ asset('dist/img/logo.png') }}" class="img-fluid">'+
                            '</div>' +
                            '<div class="col-9">' +
                                '<h4 style="font-size: 14px; font-weight: 900; margin: 0;">ឌូវី ឆាល់ឃែរ៏ ហោស៏ ទីតាំង </h4>' +
                                '<h4 style="font-size: 14px; font-weight: 900; text-transform: uppercase; margin: 0;">Dewey Childcare House, </h4>' +
                                '<p style="font-size: 12px; margin: 0;">ទូរស័ព្ទលេខ HP: 054 555 5451</p>' +
                                '<p style="font-size: 12px; margin: 0;">អាស័យដ្ឋាន Address: ភូមិព្រែកព្រះសេ្តច សង្កាត់ព្រែកព្រះស្តេច ក្រុងបាត់ដំបង ខេត្តបាត់ដំបង (ខាងកើតស្ពានថ្មចាស់ប្រហែល ១៥០មែ៉ត្រ)</p>' +
                                '<p style="font-size: 12px; margin: 0;">Preaek Preah Sdach Villages, Preaek Preah Sdach Communes, Battambang City, Battambang Province, Cambodia</p>' +
                            '</div>' +
                        '</div>'
                    ),
                    footer: (
                        '<div class="row" style="margin-top: 100px;">' +
                            '<div class="col-4">' +
                                '<div>' +
                                    '<p style="font-size: 10px; font-weight: bold; text-align: center;">____________________________</p>' +
                                    '<p style="font-size: 12px; margin-top: -10px; font-weight: bold; text-align: center;">ហត្ថលេខា និង ឈ្មោះអ្នកទិញ</p>' +
                                    '<p style="font-size: 12px; margin-top: -15px; font-weight: bold; text-align: center;">Customer Signature & Name</p>' +
                                '</div>' +
                            '</div>' +
                            '<div class="col-4"></div>' +
                            '<div class="col-4">' +
                                '<div>' +
                                    '<p style="font-size: 10px; font-weight: bold; text-align: center;">____________________________</p>' +
                                    '<p style="font-size: 12px; margin-top: -10px; font-weight: bold; text-align: center;">ហត្ថលេខា និង ឈ្មោះបេឡាករ</p>' +
                                    '<p style="font-size: 12px; margin-top: -15px; font-weight: bold; text-align: center;">Seller Signature & Name</p>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="row">' +
                            '<div class="col-12">' +
                                '<div>' +
                                    '<p style="font-size: 12px; margin-top: 50px;">' +
                                        '<span class="font-weight-bold">សំគាល់:</span> ប្រាក់បង់រួចមិនអាចដកវិញបានទេ <br>' +
                                        '<span class="font-weight-bold">Note:</span> Not Refundeble</span>' +
                                    '</p>' +
                                '</div>' +
                            '</div>' +
                        '</div>'
                    ),
                })
            })
            
        })
    </script>
@endsection