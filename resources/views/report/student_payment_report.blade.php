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
            <li class="breadcrumb-item active">Student Payment Report</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <div class="card">
        <div class="card-header bg-gradient-success py-3">
            <h4 class="m-0 font-weight-bold text-center text-light float-left">Student Payment Report</h4>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="form-inline justify-content-center mt-3">
                        <input type="hidden" value="{{ Auth::user()->campus_id }}" name="branches" id="branches">
                        <label class="mr-sm-2">Start Date: </label>
                        <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="startdate" id="startdate">
                        <label class="mr-sm-2">End Date: </label>
                        <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="enddate" id="enddate">
                        <button type="button" class="btn btn-success btn-sm mb-2 mr-2" id="btnshow"><i class="fas fa-search"></i> Show</button>
                    </div>
                </div>
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')

@endsection