@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
            <li class="breadcrumb-item active">Cash Collection Report</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <div class="card">
        <div class="card-header bg-gradient-success py-3">
            <h4 class="m-0 font-weight-bold text-center text-light float-left">Cash Collection Report</h4>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row justify-content-center mb-3">
                    <div class="form-inline">
                        <input type="hidden" value="{{ Auth::user()->campus_id }}" name="branches" id="branches">
                        <label class="mr-sm-2">Start Date: </label>
                        <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="startdate" id="startdate">
                        <label class="mr-sm-2">End Date: </label>
                        <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="enddate" id="enddate">
                        <button type="button" class="btn btn-success btn-sm mb-2 mr-2" id="btnshow"><i class="fas fa-search"></i> Show</button>
                    </div>
                </div>
            </div>

            <h6 class="mt-2 font-weight-bold text-center text-dark">ឌូវី ឆាល់ឃែរ៍​ ហោស៌ ទីតាំងសួនយុវ័ន</h6>
            <h5 class="my-1 font-weight-bold text-center text-dark">Cash Collection Report</h5>
            <p class="text-center text-dark">From 17-10-2021 To 23-10-2021</p>
            
            <div class="container-fluid">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Student Name</th>
                            <th>Invoice Number</th>
                            <th>Receipt Number</th>
                            <th>Amount Number</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection