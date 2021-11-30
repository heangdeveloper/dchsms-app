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
              <li class="breadcrumb-item active">Employee Attendance</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="card">
        <div class="card-header bg-gradient-success py-3">
          	<h4 class="m-0 font-weight-bold text-center text-light float-left">Employee Attendance Management</h4>
        </div>
        <div class="card-body">
        	<nav>
                <div class="nav nav-tabs nav-fill profile-tab" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#check-employee" role="tab" aria-controls="nav-home" aria-selected="true">Check Attendance</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#edit-employee" role="tab" aria-controls="nav-parents" aria-selected="false">Edit Attendance</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#count-employee" role="tab" aria-controls="nav-parents" aria-selected="false">Attendance Count</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="check-employee" role="tabpanel">
                	<div class="mt-3">
                		<div class="row">
                            <input type="hidden" value="{{ Auth::user()->campus_id }}" name="branches" id="branches">
                			<div class="col-xl-3 col-sm-3 col-12">
                				<div class="form-group">
									<select class="form-control form-control-sm" name="emp_type" id="emp_type">
										<option value="">Select Type</option>
										@foreach($type as $row)
	                                    	<option value="{{ $row->id }}">{{ $row->name }}</option>
	                                    @endforeach
									</select>
								</div>
                			</div>
                			<div class="col-xl-3 col-sm-3 col-12">
                				<button class="btn btn-primary btn-sm" id="btn_search"><i class="fa fa-search"></i> Search</button>
                			</div>
                            <div class="col-xl-3 col-sm-3 col-12">
                                <button type="button" class="btn btn-info btn-sm float-right" id="btn_add"><i class="fa fa-plus-circle" aria-hidden="true"></i> Save</button>
                            </div>
                		</div>
                	</div>
                	<div class="row">
                        <div class="container-fluid">
                    		<div id="att_content">
                                
                            </div>
                        </div>
                	</div>
                </div>
                <div class="tab-pane fade show" id="edit-employee" role="tabpane2">
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-xl-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <select class="form-control form-control-sm js-type js-states" name="uptype" id="uptype">
                                        <option value="">Select Type</option>
                                        @foreach($type as $row)
                                    		<option value="{{ $row->id }}">{{ $row->name }}</option>
                                    	@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-12">
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-sm" name="update" id="update">
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-12">
                                <button class="btn btn-primary btn-sm" id="btn_upsearch"><i class="fa fa-search"></i> Search</button>
                            </div>
                            <div class="col-xl-3 col-sm-3 col-12">
                                <button type="button" class="btn btn-info btn-sm float-right" name="btn_up" id="btn_up"><i class="fa fa-plus-circle" aria-hidden="true"></i> Update</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container-fluid">
                            <div id="att_update">
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show" id="count-employee" role="tabpane2">
                    <div class="row mt-3">
                        <div class="col-xl-3 col-sm-3 col-12">
                            <div class="form-group">
                                <select class="form-control form-control-sm js-type js-states" name="ltype" id="ltype">
                                    <option value="">Select Type</option>
                                    @foreach($type as $row)
                                    	<option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3 col-12">
                            <div class="form-group">
                                <input type="date" class="form-control form-control-sm" name="lsdate" id="lsdate" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3 col-12">
                            <div class="form-group">
                                <input type="date" class="form-control form-control-sm" name="ledate" id="ledate" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-3 col-12">
                            <button class="btn btn-primary btn-sm" id="btn_lsearch"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                    <div class="row">
						<div class="container-fluid">
                        	<div id="listattendance"></div>
						</div>
                    </div>
                </div>
            </div>
        </div>	
    </div>

@endsection

@section('footer')
	<script type="text/javascript">
        function editAttendanceData() {
            $('#editatten').DataTable({
                responsive: true,
				autoWidth: false,
            });
        }

		// Add Attendance

		$('#btn_add').hide();
		$('#btn_search').click(function () {
	        var emp_type = $('#emp_type').val()
	        if (emp_type == "") {
	            swal({
	                'type':'error',
	                'text':'Nothing Data!',
	                'title':'Oops...',
	                'timer': 1500
	            })
	        } else {
	            $.ajax({
	                method:'GET',
	                url:'{{ route('search_employee') }}',
	                data:{'_token':'{{ @csrf_token() }}','emp_type':emp_type},
	                success:function (data) {
	                    $('#att_content').html(data)
	                    $('#btn_add').show();
	                    dataTable();
	                },
					error: function(data) {
						console.log(data)
					}
	            })
	        }
	        
	    })

	    $('#btn_add').click(function () {
	        var id=[]
	        var bid = [];
	        var date=[]
	        var getstatus=[]
	        $('.get').each(function () {
	            if ($(this).is(":checked")) {
	                getstatus.push($(this).val());
	            }
	        })
	        $('.txtbid').each(function () {
	            bid.push($(this).val())
	        })
	        $('.txtid').each(function () {
	            id.push($(this).val())
	        })
	        $('.txtdate').each(function () {
	            date.push($(this).val())
	        })
	        $.ajax({
	            method: 'POST',
	            url:'{{ route('employee_attendance.store') }}',
	            data:{'_token':'{{ @csrf_token() }}','id':id, 'bid':bid, 'date':date,'getstatus':getstatus},
	            success:function (data) {
	                swal({
	                    'type':'success',
	                    'text':'Completed ',
	                    'title':'Employee Attendance',
	                }).then(function () {
	                  location.reload()
	                })
	            },
				error: function(data) {
					console.log(data)
				}
	        })
	    })

	    // Update Attendance

	    $('#btn_up').hide();

	    $('#btn_upsearch').click(function() {
	        var upemp = $('#uptype').val();
	        var date = $('#update').val();
	        if ( upemp == '') {
	            swal({
	                'type':'warning',
	                'text':'Column type must not be empty!',
	                'title':'Oops...',
	                'timer': 1500
	            })
	        } else if(date == '') {
	            swal({
	                'type':'warning',
	                'text':'Column date must not be empty!',
	                'title':'Oops...',
	                'timer': 1500
	            })
	        } else {
	            $.ajax({
	                method:'GET',
	                url:'{{ route('edit_employee_attendance') }}',
	                data:{'_token':'{{ @csrf_token() }}','upemp':upemp, 'date':date},
	                success:function (data) {
	                    $('#att_update').html(data)
	                    $('#btn_up').show();
	                    editAttendanceData();
	                },
					error:function (data) {
						console.log(data)
					}
	            });
	        }
	    });

	    $('#btn_up').click(function () {
	        var id=[]
	        var bid = [];
	        var date=[]
	        var getstatus=[]
	        $('.get').each(function () {
	            if ($(this).is(":checked")) {
	                getstatus.push($(this).val());
	            }
	        })
	        $('.txtbid').each(function () {
	            bid.push($(this).val())
	        })
	        $('.txtid').each(function () {
	            id.push($(this).val())
	        })
	        $('.txtdate').each(function () {
	            date.push($(this).val())
	        })
	        $.ajax({
	            type:'POST',
	            url:'{{ route('Updateem') }}',
	            data:{'_token':'{{ @csrf_token() }}','id':id, 'bid':bid, 'getstatus':getstatus,'date':date},
	            success:function(){
	                 swal({
	                    title: 'Success!',
	                    text: "Data has been Update!",
	                    type: "success",
	                }).then(function(){
	                   location.reload()
	                   $('#uptype').val('');
	                   $('#update').val('');   
	                })
	            },
				error: function(data) {
					console.log(data)
				}
	        }) 
	    })

	    function dataTable() {
	    	$('#chkatten').DataTable({
                responsive: true,
				autoWidth: false
            });
	    }

	    // List Attendance

            $('#btn_lsearch').click(function() {
                var ltype = $('#ltype').val();
                var lsdate = $('#lsdate').val();
                var ledate = $('#ledate').val();
                if (ltype == '') {
                    swal({
                        title: 'Oops...',
                        text: "Please Choose Position!",
                        type: "warning",
                        timer: '1500'
                    })
                } else {
                    $.ajax({
		                method:'GET',
		                url:'{{ route('listempattendance') }}',
		                data:{'_token':'{{ @csrf_token() }}','ltype':ltype, 'lsdate':lsdate, 'ledate':ledate},
		                success:function (data) {
		                    $('#listattendance').html(data);
		                    listDatatable();
		                },
						error: function (data) {
							console.log(data)
						}
		            })
                }
            });

            function listDatatable() {
            	$('.listattendance').DataTable({
                     responsive: true,
					 autoWidth: false
            	});
            }
	</script>
@endsection