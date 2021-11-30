@extends('layout.app')
@section('content')
    <style>
        th {
            text-transform: uppercase;
            font-size: 12px;
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
            background-color: #1266f1;
        }
        .bg-box-red {
            background-color: #f93154;
        }
        .bg-box-dark {
            background-color: #262626;
        }
        .search-card {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            padding: 5px;
        }
        .list-group-item {
            padding: 6px 13px !important;
        }
        .student-list {
            overflow-y: scroll;
        }
        .student-count {
            background-color: #1266f1;
            color: #fff;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
        }
    </style>
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
                <li class="breadcrumb-item active">Student Register</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 col-sm-3">
                <div class="search-card">
                    <div class="box-search">
                        <input type="text" class="form-control" placeholder="Search Student"/>
                    </div>
                    <div class="student-count">255</div>
                    <div class="student-list">
                        <div class="list-group">
                            @foreach($student as $row)
                                <a class="list-group-item list-group-item-action" href="#">{{ $row->sunameen }} {{ $row->finameen }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-10 col-sm-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 col-12">
                                <div class="box-card bg-box-blue">
                                    <div class="icon">
                                        <i class="far fa-money-bill-alt"></i>
                                    </div>
                                    <div class="text">
                                        <p>Balance</p>
                                        <h3>$0.00</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-12">
                                <div class="box-card bg-box-dark">
                                    <div class="icon">
                                        <i class="fas fa-business-time"></i>
                                    </div>
                                    <div class="text">
                                        <p>Deposit</p>
                                        <h3>$0.00</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-12">
                                <a href="">
                                    <div class="box-card bg-box-red">
                                        <div class="icon">
                                            <i class="far fa-clock"></i>
                                        </div>
                                        <div class="text">
                                            <p>Over Due</p>
                                            <h3>0</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-3 col-md-3 col-xl-2">
                                        <select class="form-control form-control-sm mt-2 mr-sm-2" name="type" id="type">
                                            <option value="">All</option>
                                            <option value="">Today</option>
                                            <option value="">Week</option>
                                            <option value="">Month</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-xl-2">
                                        <input type="date" class="form-control form-control-sm mt-2 mr-sm-2" id="from"/>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-xl-2">
                                        <input type="date" class="form-control form-control-sm mt-2 mr-sm-2" id="to"/>
                                    </div>
                                    <div class="col-sm-3 col-md-3 col-xl-3">
                                        <button type="button" class="btn btn-default btn-sm mt-2 mr-2 btn-show" id="btnshow"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <table class="table table-bordered table-striped" id="student_invoice">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Invoice NO.</th>
                                            <th>Amount</th>
                                            <th>Paid</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        var table = $('#student_invoice').DataTable({
            responsive: true,
			autoWidth: false,
        });
    </script>
@endsection