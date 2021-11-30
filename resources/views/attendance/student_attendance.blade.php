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
              <li class="breadcrumb-item active">Student Attendance</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="card">
    	<div class="card-header bg-gradient-success">
			<h5 class="text-center text-light font-weight-bold">Student Attendance Management</h5>
		</div>
		<div class="card-body">
			<nav>
                <div class="nav nav-tabs nav-fill profile-tab" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-student-tab" data-toggle="tab" href="#nav-student" role="tab" aria-controls="nav-home" aria-selected="true">Check Attendance</a>
                    <a class="nav-item nav-link" id="nav-student-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="nav-home" aria-selected="true">Edit Attendance</a>
                    <a class="nav-item nav-link" id="nav-teacher-tab" data-toggle="tab" href="#list" role="tab" aria-controls="nav-parents" aria-selected="false">Attendance Count</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-student" role="tabpanel" aria-labelledby="nav-home-tab">
                	<div class="mt-3">
                		<div class="row mb-2">
                            <div class="col-xl-3 col-md-3 col-sm-3">
                                <select class="form-control form-control-sm" id="curriculum" name="curriculum">
                                    <option value="">Choose Curriculum</option>
                                    @foreach($curriculum as $row)
                                    	<option value="{{ $row->id }}">{{ $row->curriculum_name }}</option>
                                    @endforeach
                                </select>
                            </div>
							<div class="col-xl-6 col-md-6 col-sm-6">
								<div class="form-group">
									<select class="form-control form-control-sm" name="class" id="class">
                                        <option value="">Choose Class</option>
									</select>
								</div>
							</div>
							<div class="col-xl-3 col-md-3 col-sm-3">
								<button type="button" class="btn btn-primary btn-sm" name="btnsearch" id="btnsearch"><i class="fa fa-search"></i> Search</button>
                                <button class="btn btn-success btn-sm float-right" name="btn_add" id="btn_add"><i class="fa fa-save"></i> Save</button>
							</div>
						</div>
                	</div>

                	<div class="row">
                        <div class="container-fluid">
                            <div id="check_attendance">
                                
                            </div>
                        </div>
                	</div>
                </div>
                <div class="tab-pane fade show" id="edit" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="mt-3">
                        <div class="row mb-2">
                            <div class="col-xl-2 col-md-2 col-sm-2">
                                <select class="form-control form-control-sm" id="upcurriculum" name="upcurriculum">
                                    <option value="">Choose Curriculum</option>
                                    @foreach($curriculum as $row)
                                    	<option value="{{ $row->id }}">{{ $row->curriculum_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xl-5 col-md-5 col-sm-5">
                                <div class="form-group">
                                    <select class="form-control form-control-sm" name="upclass" id="upclass">
                                        <option value="">Choose Class</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-2 col-md-2 col-sm-2">
                                <input type="date" class="form-control form-control-sm" name="date" id="date">
                            </div>
                            <div class="col-xl-3 col-md-3 col-sm-3">
                                <button type="button" class="btn btn-primary btn-sm" name="btnupsearch" id="btnupsearch"><i class="fa fa-search"></i> Search</button>
                                <button type="button" class="btn btn-success btn-sm" name="btnup" id="btnup"><i class="fa fa-plus-circle" aria-hidden="true"></i> Update</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container-fluid">
                                <div id="att_update">
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="list" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row mt-3 mb-3">
                        <div class="col-xl-2 col-md-2 col-sm-2">
                            <label>Curriculum: </label>
                            <select class="form-control form-control-sm" id="listcurriculum" name="listcurriculum">
                                <option value="">Choose Curriculum</option>
                                @foreach($curriculum as $row)
                                  	<option value="{{ $row->id }}">{{ $row->curriculum_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-md-4 col-sm-4">
                            <label>Classroom: </label>
                            <select class="form-control form-control-sm" name="lclass" id="lclass">
                                <option value="">Choose Class</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-md-2 col-sm-2">
                            <label>Start Date: </label>
                            <input type="date" class="form-control form-control-sm" name="sdate" id="sdate"autocomplete="off">
                        </div>
                        <div class="col-md-2 col-md-2 col-sm-2">
                            <label>End Date: </label>
                            <input type="date" class="form-control form-control-sm" name="edate" id="edate" autocomplete="off">
                        </div>
                        <div class="col-md-2 col-md-2 col-sm-2">
                            <button type="button" class="btn btn-success btn-sm mt-4" name="lsearch" id="lsearch"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container-fluid">
                            <div id="attendance_count"></div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
    </div>
@endsection

@section('footer')
	
	<script type="text/javascript">
        function chkAttendance() {
            $('#chkattendance').DataTable({
                responsive: true,
				autoWidth: false,
            });
        }

        function upAttendance() {
            $('#update_attendance').DataTable({
                responsive: true,
				autoWidth: false,
            });
        }

        function countAttendance() {
            $('#count_attendance').dataTable({
                responsive: true,
				autoWidth: false,
            });
        }

		$('#btnsearch').click(function() {
            var classs = $('#class').val();
            if ($('#curriculum').val() == '') {
                swal({
                    title: 'Warning!',
                    text: "Input field must not be empty",
                    type: "warning",
                    timer: '1500'
                })
            } else if ($('#class').val() == '') {
                 swal({
                    title: 'Warning!',
                    text: "Input field must not be empty",
                    type: "warning",
                    timer: '1500'
                })
            } else {
                $.ajax({
                    method:'GET',
                    url:'{{ route('search_student') }}',
                    data:{'_token':'{{ @csrf_token() }}','class':classs},
                    success:function (data) {
                        $('#check_attendance').html(data)
                        $('#btn_add').show();
                        chkAttendance();
                    },
                    error: function (data) {
                        console.log(data)
                    }
                })
            }
        });

        $('#curriculum').on('change', function() {
            var curid = $(this).val();
            if (curid) {
                $.ajax({
                    url: 'student-attendance/' + curid,
                    type: 'GET',
                    data: {"_token":"{{ csrf_token() }}"},
                    dataType: 'json', 
                    success: function(data) {
                        if (data) {
                            $('#class').show();
                            $('#btnsearch').show();
                            $('select[name="class"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="class"]').append('<option value="'+ value.class_id +'">'+ "Classroom: "+ value.classnum + " Grade: " + value.grade + " Time: " + value.stime + " - " + value.etime + " School Year: " + value.year +'</option>');
                            });
                        } else {
                            $('select[name="class"]').empty();
                        }
                    },
                    error: function(data) {
                        console.log(data)
                    }
                });
            } else {
                $('select[name="class"]').empty();
            }
        });

        // Save Data

        $('#btn_add').click(function () {
            var bid = []
            var sid = []
            var cid = []
            var date = []
            var getstatus = []
            var reason = []
            $('.get').each(function () {
                if ($(this).is(":checked")) {
                    getstatus.push($(this).val());
                }
            })
            $('.txtbid').each(function () {
                bid.push($(this).val())
            })
            $('.txtsid').each(function () {
                sid.push($(this).val())
            })
            $('.txtcid').each(function () {
                cid.push($(this).val())
            })
            $('.txtdate').each(function () {
                date.push($(this).val())
            })
            $('.reason').each(function () {
                reason.push($(this).val())
            })
            $.ajax({
                method: 'POST',
                url:'{{ route('student_attendance.store') }}',
                data:{'_token':'{{ @csrf_token() }}','sid':sid, 'cid':cid, 'bid':bid, 'date':date,'getstatus':getstatus, 'reason':reason},
                success:function (data) {
                    var r = swal({
                        'type':'success',
                        'text':'Completed ',
                        'title':'Student Attendance',
                    }).then(()=>{
                        location.reload()
                    })
                    
                },
                error: function (data) {
                    console.log(data)
                }
            })
        })

        // Update code

        $('#btnup').hide();
        $('#btnupsearch').click(function() {
            var upcurriculum = $('#upcurriculum').val();
            var upclass = $('#upclass').val();
            var date = $('#date').val();

            if (upcurriculum == '') {
                swal({
                    title: 'Warning!',
                    text: "Column curriculm must not be empty!",
                    type: "warning",
                    timer: '1500'
                })
            } else if(upclass == '') {
                swal({
                    title: 'Warning!',
                    text: "Column class must not be empty!",
                    type: "warning",
                    timer: '1500'
                })
            } else if(date == '') {
                swal({
                    title: 'Warning!',
                    text: "Column date must not be empty!",
                    type: "warning",
                    timer: '1500'
                })
            } else {
                $.ajax({
                    method:'GET',
                    url:'{{ route('stueditattendance') }}',
                    data:{'_token':'{{ @csrf_token() }}','upclass':upclass, 'date':date},
                    success:function (data) {
                        $('#att_update').html(data)
                        $('#btnup').show();
                        upAttendance()
                    }
                })
            }
        })

        $('#upcurriculum').on('change', function() {
            var curid = $(this).val();
            if (curid) {
                $.ajax({
                    url: 'student-attendance/' + curid,
                    type: 'GET',
                    data: {"_token":"{{ csrf_token() }}"},
                    dataType: 'json', 
                    success: function(data) {
                        if (data) {
                            $('#upclass').empty();
                            $.each(data, function(key, value) {
                                $('#upclass').append('<option value="'+ value.class_id +'">'+ "Room: "+ value.classnum + " Grade: " + value.grade + " Time: " + value.stime + " - " + value.etime + " School Year: " + value.year +'</option>');
                            });
                        } else {
                            $('#upclass').empty();
                        }
                    }
                });
            } else {
                $('#upclass').empty();
            }
        });

        $('#btnup').click(function () {
            var id = []
            var bid = []
            var sid = []
            var cid = []
            var date = []
            var getstatus = []
            var reason = []
            $('.get').each(function () {
                if ($(this).is(":checked")) {
                    getstatus.push($(this).val());
                }
            })
            $('.txtid').each(function () {
                id.push($(this).val())
            })
            $('.txtbid').each(function () {
                bid.push($(this).val())
            })
            $('.txtsid').each(function () {
                sid.push($(this).val())
            })
            $('.txtcid').each(function () {
                cid.push($(this).val())
            })
            $('.txtdate').each(function () {
                date.push($(this).val())
            })
            $('.reason').each(function () {
                reason.push($(this).val())
            })
            $.ajax({
                type:'POST',
                url:'{{ route('stuattenup') }}',
                data:{'_token':'{{ @csrf_token() }}', 'id':id, 'bid':bid, 'sid':sid, 'cid':cid, 'date':date, 'getstatus':getstatus, 'reason':reason},
                success:function(){
                     var r = swal({
                        title: 'Success!',
                        text: "Data has been Update!",
                        type: "success",
                    }).then(()=>{
                        location.reload()
                    })

                },
                error: function(data) {
                    console.log(data)
                }
            }) 

        })

        // List Data

        $('#listcurriculum').on('change', function() {
            var lcurid = $(this).val();
            if (lcurid) {
                $.ajax({
                    url: 'student-attendance-list/' + lcurid,
                    type: 'GET',
                    data: {"_token":"{{ csrf_token() }}"},
                    dataType: 'json', 
                    success: function(data) {
                        if (data) {
                            $('#lclass').show();
                            $('#lsearch').show();
                            $('select[name="lclass"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="lclass"]').append('<option value="'+ value.class_id +'">'+ "Room: "+ value.classnum + " Grade: " + value.grade + " Time: " + value.stime + " - " + value.etime + " School Year: " + value.year +'</option>');
                            });
                        } else {
                            $('select[name="lclass"]').empty();
                        }
                    },
                    error: function(data) {
                        console.log(data)
                    }
                });
            } else {
                $('select[name="lclass"]').empty();
            }
        });

        $('#lsearch').click(function() {
            var listcurriculum = $('#listcurriculum').val();
            var lclass = $('#lclass').val();
            var sdate = $('#sdate').val();
            var edate = $('#edate').val();
            if (listcurriculum == '') {
                swal({
                    title: 'Oops...',
                    text: "Curriculum not be empty!",
                    type: "warning",
                    timer: '1500'
                })
            } else {
                $.ajax({
                    method:'GET',
                    url:'{{route('search_student_list')}}',
                    data:{'_token':'{{ @csrf_token() }}', listcurriculum:listcurriculum, lclass:lclass, sdate:sdate, edate:edate},
                    success:function (data) {
                        $('#attendance_count').html(data);
                        countAttendance();
                    },
                    error: function(data) {
                        console.log(data)
                    }
                }) 
            }   
        });
	</script>

@endsection