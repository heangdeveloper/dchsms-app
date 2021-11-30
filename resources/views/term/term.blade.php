@extends('layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Term</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Term</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="card">
        <div class="card-header bg-gradient-success">
            <a class="btn btn-info btn-sm float-left shadow-sm" id="addterm">Add Term</a>
            <h4 class="m-0 font-weight-bold text-center text-light">Term List</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="term-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    
<div id="modal-form-term" class="modal fade">
    <div class="modal-dialog" role="document">
        <form method="POST" autocomplete="off">
            {{ csrf_field() }} {{ method_field('POST') }}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title"></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="term_id" name="term_id">
                <div class="form-group">
                    <label>Term</label>
                    <input type="text" class="form-control form-control-sm" name="term" id="term" autofocus required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-sm btn-save">Save</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
@section('footer')
    <script>
        var table = $('#term-table').DataTable({
            responsive: true,
			autoWidth: false,
			processing: true,
			serverSide: true,
            ajax: "{{ route('term.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'term_title', name: 'term_title'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });

    $('#addterm').click(function() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form-term').modal('show');
        $('#modal-form-term form')[0].reset();
        $('.modal-title').text('Add Term');
    });

    function editForm(id) {
        save_method = 'edit';
        $('input[name=_method]').val('PATCH');
        $('#modal-form-term form')[0].reset();
        $.ajax({
            url: "{{ url('term') }}" + '/' + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#modal-form-term').modal('show');
                $('.modal-title').text('Edit Term');
                $('#term_id').val(data.id);
                $('#term').val(data.term_title);
            },
            error: function() {
                swal({
                    title: 'Oops...',
                    text: "Nothing Data",
                    type: "error",
                    timer: '1500'
                })
            }
        });
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
                url: "{{ url('term') }}" + '/' + id,
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

    $(function() {
        $('#modal-form-term form').on('submit', function(e) {
        if (!e.isDefaultPrevented()) {
            var id = $('#term_id').val();
            if (save_method == 'add') url = "{{ url('term') }}";
            else url = "{{ url('term') . '/' }}" + id;

            $.ajax({
                url: url,
                type: "POST",
                data: $('#modal-form-term form').serialize(),
                success: function(data) {
                    $('#modal-form-term').modal('hide');
                    table.ajax.reload();
                    swal({
                        title: 'Success!',
                        text: "Data has been inserted!",
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
            });
            return false;
            }
        });
    });
    </script>
@endsection