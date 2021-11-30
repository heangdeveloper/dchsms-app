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
              <li class="breadcrumb-item active">Student Report</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="card">
    	<div class="card-header bg-gradient-success py-3">
    		<h4 class="m-0 font-weight-bold text-center text-light float-left">Student Report Management</h4>
    	</div>
    	<div class="card-body">
    		<nav>
                <div class="nav nav-tabs nav-fill profile-tab" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#new" role="tab" aria-selected="true">New Student</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#stop" role="tab" aria-selected="false">Stop Student</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#suspension" role="tab" aria-selected="false">Suspension Student</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="new" role="tabpanel">
						        <div class="form-inline mt-3 justify-content-center">
                      <label for="new_start_date" class="mr-sm-2">Start Date:</label>
                      <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" id="new_start_date" name="new_start_date">
                      <label for="new_end_date" class="mr-sm-2">End Date:</label>
                      <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" id="new_end_date" name="new_end_date">
                      <button type="button" class="btn btn-primary btn-sm mb-2 mr-2" id="btnshow"><i class="fas fa-search"></i> Search</button>
                  </div>
                  <div class="row">
                    <div class="container-fluid">
                      <div id="new_report"></div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="stop" role="tabpanel">
                    <div class="form-inline mt-3 justify-content-center">
                      <label for="stop_start_date" class="mr-sm-2">Start Date:</label>
                      <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" id="stop_start_date" name="stop_start_date">
                      <label for="stop_end_date" class="mr-sm-2">End Date:</label>
                      <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" id="stop_end_date" name="stop_end_date">
                      <button type="button" class="btn btn-primary btn-sm mb-2 mr-2" id="btnstopshow"><i class="fas fa-search"></i> Search</button>
                    </div>
                    <div class="row">
                      <div class="container-fluid">
                        <div id="stop_report"></div>
                      </div>
                    </div>
                  </div>
                <div class="tab-pane fade" id="suspension" role="tabpanel">
                	<div class="form-inline mt-3 justify-content-center">
                      <label for="skip_start_date" class="mr-sm-2">Start Date:</label>
                      <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" id="skip_start_date" name="skip_start_date">
                      <label for="skip_end_date" class="mr-sm-2">End Date:</label>
                      <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" id="skip_end_date" name="skip_end_date">
                      <button type="button" class="btn btn-primary btn-sm mb-2 mr-2" id="btnskipshow"><i class="fas fa-search"></i> Search</button>
                    </div>
                    <div class="row">
                      <div class="container-fluid">
                        <div id="skip_report"></div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
	<script type="text/javascript">
		function dataTable() {
	   	var table1 = $('#student_new').DataTable({
        responsive: true,
				autoWidth: false,
        lengthChange: false,
        buttons: [
          {extend: 'copy', text: '<i class="fa fa-copy"></i>&nbsp; Copy'},
          {extend: 'csv', text: '<i class="fas fa-file-csv"></i>&nbsp; Excel'},
          {extend: 'pdf', text: '<i class="fas fa-file-pdf"></i>&nbsp; PDF'},
          {extend: 'print', text: '<i class="fa fa-print"></i>&nbsp; Print'},   
        ],
      });
      table1.buttons().container()
        .appendTo( '#student_new_wrapper .col-md-6:eq(0)' );
	  }

    function studentStop() {
      var table2 = $('#student_stop').DataTable({
        responsive: true,
				autoWidth: false,
        lengthChange: false,
        buttons: [
          {extend: 'copy', text: '<i class="fa fa-copy"></i>&nbsp; Copy'},
          {extend: 'csv', text: '<i class="fas fa-file-csv"></i>&nbsp; Excel'},
          {extend: 'pdf', text: '<i class="fas fa-file-pdf"></i>&nbsp; PDF'},
          {extend: 'print', text: '<i class="fa fa-print"></i>&nbsp; Print'},   
        ],
      });
      table2.buttons().container()
        .appendTo( '#student_stop_wrapper .col-md-6:eq(0)' );
    }

    function studentSkip() {
      var table3 = $('#student_skip').DataTable({
        responsive: true,
				autoWidth: false,
        lengthChange: false,
        buttons: [
          {extend: 'copy', text: '<i class="fa fa-copy"></i>&nbsp; Copy'},
          {extend: 'csv', text: '<i class="fas fa-file-csv"></i>&nbsp; Excel'},
          {extend: 'pdf', text: '<i class="fas fa-file-pdf"></i>&nbsp; PDF'},
          {extend: 'print', text: '<i class="fa fa-print"></i>&nbsp; Print'},   
        ],
      });
      table3.buttons().container()
        .appendTo( '#student_stop_wrapper .col-md-6:eq(0)' );
    }

		$('#btnshow').click(function(){
			var new_start_date = $('#new_start_date').val();
      var new_end_date = $('#new_end_date').val();
			if (new_start_date == '') {
  				swal({
  	        'type':'warning',
  	        'text':'Start Date must not be empty!',
  	        'title':'Oops...',
  	        'timer': 1500
  	      })
			} else if(new_end_date == '') {
          swal({
            'type':'warning',
            'text':'End Date must not be empty!',
            'title':'Oops...',
            'timer': 1500
          })
      } else {
				$.ajax({
	        method:'GET',
	        url:'{{ route('listnewstudent') }}',
	        data:{'_token':'{{ @csrf_token() }}','new_start_date':new_start_date, 'new_end_date':new_end_date},
	        success:function (data) {
	        $('#new_report').html(data);
	        dataTable();
	        },
          error: function (data) {
            console.log(data)
          }
	      });
			}
		});

    $('#btnstopshow').click(function(){
      var stop_start_date = $('#stop_start_date').val();
      var stop_end_date = $('#stop_end_date').val();
      if (stop_start_date == '') {
          swal({
            'type':'warning',
            'text':'Start Date must not be empty!',
            'title':'Oops...',
            'timer': 1500
          })
      } else if(stop_end_date == '') {
          swal({
            'type':'warning',
            'text':'End Date must not be empty!',
            'title':'Oops...',
            'timer': 1500
          })
      } else {
        $.ajax({
          method:'GET',
          url:'{{ route('liststopstudent') }}',
          data:{'_token':'{{ @csrf_token() }}','stop_start_date':stop_start_date, 'stop_end_date':stop_end_date},
          success:function (data) {
          $('#stop_report').html(data);
          studentStop();
          }
        });
      }
    });

    $('#btnskipshow').click(function(){
      var skip_start_date = $('#skip_start_date').val();
      var skip_end_date = $('#skip_end_date').val();
      if (skip_start_date == '') {
          swal({
            'type':'warning',
            'text':'Start Date must not be empty!',
            'title':'Oops...',
            'timer': 1500
          })
      } else if(skip_end_date == '') {
          swal({
            'type':'warning',
            'text':'End Date must not be empty!',
            'title':'Oops...',
            'timer': 1500
          })
      } else {
        $.ajax({
          method:'GET',
          url:'{{ route('listskipstudent') }}',
          data:{'_token':'{{ @csrf_token() }}','skip_start_date':skip_start_date, 'skip_end_date':skip_end_date},
          success:function (data) {
          $('#skip_report').html(data);
          studentSkip();
          }
        });
      }
    });
	</script>
@endsection