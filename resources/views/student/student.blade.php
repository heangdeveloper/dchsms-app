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
              <li class="breadcrumb-item active">Student Manage</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

  <div class="card mb-4 border-bottom-success">
        <div class="card-header bg-gradient-success py-3">
          <h4 class="m-0 font-weight-bold text-center text-light float-left">All Student List</h4>
        </div>
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#studying"><i class="fas fa-graduation-cap"></i> Studying</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#stop"><i class="far fa-stop-circle"></i> Stop</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#skip"><i class="fas fa-sync-alt"></i> Suspension</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active mt-3" id="studying" role="tabpanel" aria-labelledby="nav-home-tab">
                    <table class="table table-bordered table-striped" id="student-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Date of Birth</th>
                                <th>Race</th>
                                <th>National</th>
                                <th>Province</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach($student as $student)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$student->stuno}}</td>
                                    <td>{{$student->sunameen}} {{$student->finameen}}</td>
                                    @if ($student->gender === 'Male')
                                      <td>M</td>
                                    @else
                                      <td>F</td>
                                    @endif
                                    <td>{{$student->dob}}</td>
                                    <td>{{$student->race}}</td>
                                    <td>{{$student->national}}</td>
                                    <td>{{$student->province}}</td>
                                    <td>
                                        <a href="{{ route('student.show',$student->id) }}" class="btn btn-primary btn-xs text-white"><i class="fas fa-search"></i> View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade show mt-3" id="stop" role="tabpanel" aria-labelledby="nav-home-tab">
                    <table class="table table-bordered table-striped" id="student-stop">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Date of Birth</th>
                                <th>Race</th>
                                <th>National</th>
                                <th>Province</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach($stustop as $stustop)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$student->stuno}}</td>
                                    <td>{{$stustop->sunameen}} {{$stustop->finameen}}</td>
                                    @if ($student->gender === 'Male')
                                      <td>M</td>
                                    @else
                                      <td>F</td>
                                    @endif
                                    <td>{{$stustop->dob}}</td>
                                    <td>{{$stustop->race}}</td>
                                    <td>{{$stustop->national}}</td>
                                    <td>{{$stustop->province}}</td>
                                    <td>
                                        <a href="{{ route('student.show',$stustop->id) }}" class="btn btn-primary btn-xs text-white"><i class="fas fa-search"></i> View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade show mt-3" id="skip" role="tabpanel" aria-labelledby="nav-home-tab">
                    <table class="table table-bordered table-striped" id="student-skip">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Date of Birth</th>
                                <th>Race</th>
                                <th>National</th>
                                <th>Province</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach($stuskip as $stuskip)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$student->stuno}}</td>
                                    <td>{{$stuskip->sunameen}} {{$stuskip->finameen}}</td>
                                    @if ($student->gender === 'Male')
                                      <td>M</td>
                                    @else
                                      <td>F</td>
                                    @endif
                                    <td>{{$stuskip->dob}}</td>
                                    <td>{{$stuskip->race}}</td>
                                    <td>{{$stuskip->national}}</td>
                                    <td>{{$stuskip->province}}</td>
                                    <td>
                                        <a href="{{ route('student.show',$stuskip->id) }}" class="btn btn-primary btn-xs text-white"><i class="fas fa-search"></i> View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_import_data">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h4 class="modal-title"></h4>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label>File</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file">
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-file-upload"></i> Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('footer')
  <script type="text/javascript">
    var table = $('#student-table').DataTable({
        responsive: true,
		autoWidth: false,
    });
    $('#student-stop').DataTable({
        responsive: true,
		autoWidth: false,
    });
    $('#student-skip').DataTable({
        responsive: true,
		autoWidth: false,
    });

    $('#import_data').click(function() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#add_import_data').modal('show');
        $('#add_import_data form')[0].reset();
        $('.modal-title').text('Import File');
    });

    $('add_import_data').on('submit', function(e) {
        e.preventDefault()
        $.ajax({
            url: '',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            success: function() {
            $('#modal-form-class').modal('hide');
            table.ajax.reload();
                swal({
                    title: 'Success!',
                    text: "File has been upload!",
                    type: "success"
                })
            },
            error: function() {
                swal({
                    title: 'Oops...',
                    text: "Something went wrong!",
                    type: "warning"
                })
            },
        });
    });
  </script>
@endsection