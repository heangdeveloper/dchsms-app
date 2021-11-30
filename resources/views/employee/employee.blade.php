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
              <li class="breadcrumb-item active">Employee</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="card mb-4">
        <div class="card-header py-3 bg-gradient-success">
          <h4 class="m-0 font-weight-bold text-center text-light float-left">Employee List</h4>
          <a href="#" class="btn btn-info btn-sm shadow-sm float-right"><i class="fas fa-file-import"></i> Import</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="employee">
                <thead>
                  <tr>
                  	<th>#</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Tel</th>
                    <th>DOB</th>
                    <th>Option</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach($employee as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{ $row->fname }} {{ $row->lname }}</td>
                            <td>{{ $row->gender }}</td>
                            <td>{{ $row->tel }}</td>
                            <td>{{ $row->dob }}</td>
                            <td>
                                <a href="{{ route('employee.edit', $row->id) }}" class="btn btn-primary btn-xs text-white"><i class="fa fa-edit"></i> Edit</a>
                                <a onclick="deleteData({{ $row->id }})" class="btn btn-danger btn-xs text-white"><i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
@endsection

@section('footer')
	<script type="text/javascript">
    var table = $('#employee').DataTable({
        responsive: true,
		autoWidth: false,
		processing: false,
		serverSide: false,
    });

    function deleteData(id) {
            // var popup = confirm("Are you sure for delete this data ?");
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
                    url: "{{ url('employee') }}" + '/' + id,
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