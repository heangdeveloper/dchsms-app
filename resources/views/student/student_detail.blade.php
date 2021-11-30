@extends('layout.app')
@section('header')
    <style>
        .profile-banner {
            width: 100%;
            height: 300px;
            background-position: center center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
            position: relative;
            background-color: #252932;
            border-bottom: 4px solid #fff;
            box-shadow: 2px 0px 4px rgba(0,0,0,0.1);
        }

        .avatar-container {
            height: 300px;
            text-align: center;
        }

        .profile-avatar {
            width: 200px;
            position: relative;
            margin: 0px auto;
            margin-top: 196px;
            border: 4px solid #f3f3f3;
        }

        .profile-actions {
            position: absolute;
            bottom: 20px;
        }

        .user-profile-2 {
            margin-top: 50px;
        }

        .user-profile-sidebar {
            margin: 0 0 20px 0;
        }

        .user-profile-sidebar .user-identity {
            margin: 20px 0 0 0;
        }

        .user-profile-sidebar img {
            width: 90px;
        }

        .account-status-data {
            text-align: center;
            padding: 10px 0;
            border-top: 1px dashed #ddd;
            border-bottom: 1px dashed #ddd;
            margin: 10px 0 20px 0;
        }

        .tab-pane{
            padding-top:20px;    
        }
    </style>
@endsection
@section('content')
<div class="container-fluid bootdey">
    @foreach($student as $st)
    <div class="content-page">
        <div class="profile-banner" style="background:url(https://wallpaperaccess.com/full/251776.png);">
            <div class="col-sm-3 avatar-container">
                @if ($st->img == 'default.png')
                    <img src="{{ asset('dist/img/default.svg') }}" alt="{{ $st->sunameen }} {{ $st->finameen }}" class="img-circle img-fluid profile-avatar"/>
                @else
                    <img src="{{ asset("storage/student/") . '/' . $st->img }}" alt="{{ $st->sunameen }} {{ $st->finameen }}" class="img-circle img-fluid profile-avatar"/>
                @endif
            </div>
            <div class="col-sm-12 profile-actions text-right">
                <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Setting</button>
                <div class="dropdown-menu">
                    <a href="{{ URL::to('student/' . $st->id . '/edit') }}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                    <a onclick="deleteData({{$st->id}})" class="dropdown-item text-dark"><i class="fa fa-trash"></i> Delete</a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <div class="widget widget-tabbed">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item"><a href="#about" data-toggle="tab" class="nav-link active"><i class="fas fa-id-card"></i> អំពីសិស្ស</a></li>
                            <li class="nav-item"><a href="#school" data-toggle="tab" class="nav-link"><i class="fas fa-school"></i> សាលា</a></li>
                            <li class="nav-item"><a href="#parent" data-toggle="tab" class="nav-link"><i class="fas fa-users"></i> ឪពុកម្តាយ</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane container active" id="about">
                                <div class="user-profile-content">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5>Information</h5>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Student ID: </strong>
                                                <div class="col-sm-8">{{ $st->stuno }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">English Name: </strong>
                                                <div class="col-sm-8">{{ $st->sunameen }} {{ $st->finameen }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Khmer Name: </strong>
                                                <div class="col-sm-8">{{ $st->sunamekh }} {{ $st->finamekh }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Gender: </strong>
                                                <div class="col-sm-8">{{ $st->gender }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Date of Birth: </strong>
                                                <div class="col-sm-8">{{ $st->dob }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Phone Number: </strong>
                                                <div class="col-sm-8">{{ $st->tel }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Race: </strong>
                                                <div class="col-sm-8">{{ $st->race }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">National: </strong>
                                                <div class="col-sm-8">{{ $st->national }}</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5>Current Address</h5>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Village: </strong>
                                                <div class="col-sm-8">{{ $st->village }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Commune: </strong>
                                                <div class="col-sm-8">{{ $st->commune }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">District: </strong>
                                                <div class="col-sm-8">{{ $st->district }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Province: </strong>
                                                <div class="col-sm-8">{{ $st->province }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane container" id="school">
                                <div class="user-profile-content">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5>School</h5>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">From School: </strong>
                                                <div class="col-sm-8">{{ $st->from_school }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Level: </strong>
                                                <div class="col-sm-8">{{ $st->level }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane container" id="parent">
                                <div class="user-profile-content">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h5>Information Father</h5>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Name: </strong>
                                                <div class="col-sm-8">{{ $st->farther_name }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Address: </strong>
                                                <div class="col-sm-8">{{ $st->farther_address }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Job: </strong>
                                                <div class="col-sm-8">{{ $st->father_job }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Status: </strong>
                                                <div class="col-sm-8">{{ $st->father_status }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Race: </strong>
                                                <div class="col-sm-8">{{ $st->father_race }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">National: </strong>
                                                <div class="col-sm-8">{{ $st->father_national }}</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h5>Information Mother</h5>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Name: </strong>
                                                <div class="col-sm-8">{{ $st->mother_name }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Address: </strong>
                                                <div class="col-sm-8">{{ $st->mother_address }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Job: </strong>
                                                <div class="col-sm-8">{{ $st->mother_job }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Status: </strong>
                                                <div class="col-sm-8">{{ $st->mother_status }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">Race: </strong>
                                                <div class="col-sm-8">{{ $st->mother_race }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <strong class="col-sm-4">National: </strong>
                                                <div class="col-sm-8">{{ $st->mother_national }}</div>
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
        @endforeach
    </div>
@endsection
@section('footer')
	<script type="text/javascript">
        function pageRedirect() {
            window.location.href = "{{route('student.index')}}";
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
                    url: "{{ url('student') }}" + '/' + id,
                    type: "POST",
                    data: {'_method' : 'DELETE', '_token' : csrf_token},
                    success: function(data) {
                        setTimeout("pageRedirect()", 1500);
                        swal({
                            title: 'Success!',
                            text: "Data has been deleted!",
                            type: "success",
                            timer: '1500'
                        })
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
	</script>
@endsection