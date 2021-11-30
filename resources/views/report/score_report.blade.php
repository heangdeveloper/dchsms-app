@extends('layout.app')
@section('content')
	<style type="text/css">
		th .rotate {
	        display: flex;
	        justify-content: center;
	        transform: rotate(-90deg);
	        transform-origin: center center;
	    }

	    th div {
        	font-size: 12px;
	    }

	    table.report.dataTable.table-condensed>thead>tr>th {
	        padding-right: 0px;
	        padding-top: 25px;
	        padding-bottom: 25px;
	        padding-left: 0px;
	    }
	    
		
	</style>
	<div class="card shadow-sm">
		<div class="card-header bg-gradient-success py-3">
			<h4 class="text-center text-light">Student Score Report</h4>
		</div>
		<div class="card-body">
			<div class="container-fluid">
				<div class="form-inline mt-3">
                    <label class="mr-sm-2">Teacher :</label>
                    <select class="form-control form-control-sm mr-2 mb-2 mr-sm-2" name="teaname" id="teaname">
                        <option value="">Choose Teacher</option>
                        @foreach($teacher as $row)
                            <option value="{{ $row->id }}">{{ $row->full_name }}</option>
                        @endforeach
                    </select>
                    <label class="mr-sm-2">Class:</label>
                    <select class="form-control form-control-sm mb-2 mr-sm-2" name="classs" id="classs">
                        <option value="">Choose Class</option>
                    </select>
                    <label class="mr-sm-2">Term:</label>
                    <select class="form-control form-control-sm mb-2 mr-sm-2" class="term" id="term">
                        @foreach($term as $row)
                            <option value="{{ $row->id }}">{{ $row->term_title }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-success btn-sm mb-2 mr-2" id="btnshow"><i class="fas fa-search"></i> Show</button>
                </div>
			</div>
			<div class="row mt-3">
				<div class="container-fluid">
					<div id="listscorestudent"></div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer')
	<script type="text/javascript">
		function dataTable() {
            var table = $('#listscore').dataTable({
            	responsive: true,
                autoWidth: false,
                lengthChange: false,
                buttons: [
                  {extend: 'copy', text: '<i class="fa fa-copy"></i>&nbsp; Copy'},
                  {extend: 'excel', text: '<i class="fas fa-file-excel"></i>&nbsp; Excel'},
                  {extend: 'pdf', text: '<i class="fas fa-file-pdf"></i>&nbsp; PDF'},
                  {extend: 'print', text: '<i class="fa fa-print"></i>&nbsp; Print'},   
                ],
            });
            table.buttons().container()
            .appendTo( '#listscore_wrapper .col-md-6:eq(0)' );
        }

		$('#teaname').on('change', function() {
            var teaid = $(this).val();
            if (teaid) {
                $.ajax({
                    url: '{{url('getteacherclass')}}/' + teaid,
                    type: 'GET',
                    data: {"_token":"{{ csrf_token() }}"},
                    dataType: 'json', 
                    success: function(data) {
                        if (data) {
                            $('select[name="classs"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="classs"]').append('<option value="'+ value.claid +'">'+ "Room: "+ value.classnum + " Grade: " + value.grade + '</option>');
                                });
                        } else {
                            $('select[name="classs"]').empty();
                        }
                    }
                });
            } else {
                $('select[name="classs"]').empty();
            }
        });

        $('#btnsave').hide();
    	$('#btnshow').click(function() {
            var classs = $('#classs').val();
            var terms = $('#term').val();
            var teaname = $('#teaname').val();
            $.ajax({
                method:'GET',
                url:'{{ route('seachliststudentscore') }}',
                data:{'_token':'{{ @csrf_token() }}','classs':classs, 'terms':terms, 'teaname':teaname},
                success:function (data) {
                    $('#listscorestudent').html(data.output)
                    dataTable();
                }
            })
        });
	</script>
@endsection