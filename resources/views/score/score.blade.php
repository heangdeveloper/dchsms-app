@extends('layout.app');
@section('content')
	<style type="text/css">
        .intsc {
            width: 40px;
            text-align: center;
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
        }
    </style>
	<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Score</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <div class="card">
        <div class="card-header bg-gradient-success">
            <h4 class="m-0 font-weight-bold text-center text-light">Score Form</h4>
        </div>
        <div class="card-body">
            <input type="hidden" class="branches" value="{{ Auth::user()->campus_id }}" name="branches" id="branches">
            <div class="row">
            	<div class="col-xl-3 col-sm-3 col-12">
                        <div class="form-group">
                            <select class="form-control form-control-sm teaname" name="teaname" id="teaname">
                                <option>Choose Teacher</option>
                                @foreach($teacher as $row)
                                    <option value="{{ $row->id }}">{{ $row->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-4 col-12">
                        <div class="form-group">
                            <select class="form-control form-control-sm classs" name="classs" id="classs">
                                <option>Choose Class</option>
                            </select>
                        </div>
                    </div>
                <div class="col-xl-2 col-sm-2 col-12">
                    <div class="form-group">
                        <select class="form-control form-control-sm terms" name="terms" id="terms">
                            @foreach($term as $row)
                                <option value="{{ $row->id }}">{{ $row->term_title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-2 col-sm-2 col-12">
                    <button type="button" class="btn btn-primary btn-sm" name="btnsearch" id="btnsearch"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="container-fluid">
                    <div id="show-score-list"></div>
                </div>
            </div>
            <input type="hidden" id="con">
            <button type="button" class="btn btn-info btn-sm" id="btnsave"><i class="fa fa-save"></i> Save</button>
        </div>
    </div>

@endsection
@section('footer')
	<script type="text/javascript">
		$('#btnsave').hide();
    	$('#btnsearch').click(function() {
            var classs = $('#classs').val();
            var terms = $('#terms').val();
            var teaname = $('#teaname').val();
            $.ajax({
                method:'GET',
                url:'{{ route('listscore') }}',
                data:{'_token':'{{ @csrf_token() }}','classs':classs, 'terms':terms, 'teaname':teaname},
                success:function (data) {
                    $('#show-score-list').html(data.output)
                    $('#btnsave').show();
                    $('#con').val(data.con)
                }
            })
        });

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
                    },
                    error: function(data) {
                        console.log(data)
                    }
                });
            } else {
                $('select[name="classs"]').empty();
            }
        });

        $('#btnsave').click(function() {
            var stuid = [];
            var la = [];
            var ma = [];
            var sc = [];
            var ar = [];
            var mu = [];
            var kh = [];
            var mo = [];
            var score_id = [];

            $('.stuid').each(function () {
                stuid.push($(this).val())
            })
            $('.la').each(function () {
                la.push($(this).val())
            })
            $('.ma').each(function () {
                ma.push($(this).val())
            })
            $('.sc').each(function () {
                sc.push($(this).val())
            })
            $('.ar').each(function () {
                ar.push($(this).val())
            })
            $('.mu').each(function () {
                mu.push($(this).val())
            })
            $('.kh').each(function () {
                kh.push($(this).val())
            })
            $('.mo').each(function () {
                mo.push($(this).val())
            })

            var terms = $('.terms').val();
            var teaname = $('.teaname').val();
            var classs = $('.classs').val();
            var branches = $('.branches').val();
            var con = $('#con').val();
            var score_id = $('.score_id').val();

            $.ajax({
                type: 'POST',
                url: '{{route("score.store")}}',
                data: {'_token': '{{csrf_token()}}', 'stuid': stuid, 'la': la, 'ma': ma, 'sc': sc, 'ar': ar, 'mu': mu, 'kh': kh, 'mo': mo, 'teaname': teaname, 'terms': terms, 'classs':classs, 'branches': branches, 'con':con, 'score_id':score_id},
                success:function ($data) {
                    swal({
                        title: 'Success!',
                        text: "Score has been add!",
                        type: "success",
                    }).then(function () {
                        location.reload().delay(200)
                    })
                },
                error: function (data) {
                    console.log(data)
                }
            })
        });
	</script>
@endsection