@extends('layout.app')
@section('content')
	<div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Add User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
	<div class="card">
		<div class="card-header bg-gradient-success py-3">
          	<h4 class="font-weight-bold text-center text-light">Create New User Form</h4>
        </div>
        <div class="card-body" id="form-user">
        	<div class="row">
        		<div class="col-md-12">
        			<form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data" autocomplete="off" id="form-user">
        				{{ csrf_field() }}
	        			<fieldset class="scheduler-border">
			          		<legend class="scheduler-border">User Information</legend>
			          		<div class="row">
			          			<div class="col-xl-4">
		                            <div class="form-group">
		                                <label>Fullname <span style="color: red;">*</span></label>
		                                <input type="text" class="form-control form-control-sm @error('fullname') is-invalid @enderror" name="fullname">
										@error('fullname')
                                        	<span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                        @enderror
		                            </div>
		                        </div>
								<div class="col-xl-4">
		                            <div class="form-group">
		                            	<label>Email <span style="color: red;">*</span></label>
		                                <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email">
										@error('email')
                                        	<span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                        @enderror
		                            </div>
		                        </div>
								<div class="col-xl-4">
		                        	<div class="form-group">
		                            	<label>Username <span style="color: red;">*</span></label>
		                                <input id="name" type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name">
										@error('name')
                                        	<span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                        @enderror
		                            </div>
		                        </div>
			          		</div>
			          		<div class="row">
								<div class="col-xl-4">
		                            <div class="form-group">
		                                <label>Password <span style="color: red;">*</span></label>
		                                <input id="pass" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password">
										@error('password')
                                        	<span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                        @enderror
		                            </div>
		                        </div>
			          			<div class="col-xl-4">
		                            <div class="form-group">
		                            	<label>Campus</label>
		                                <select class="form-control form-control-sm" name="campus_id" id="branch">
		                                    @foreach($compuses as $row)
		                                    	<option value="{{ $row->id }}">{{ $row->name_en }}</option>
		                                    @endforeach
		                                </select>
		                            </div>
		                        </div>
								<div class="col-xl-4">
									<label>Select Role</label>
									<select class="form-control form-control-sm" name="role_id" id="role">
										@foreach($role as $row)
											<option value="{{ $row->id }}">{{ $row->name }}</option>
										@endforeach
									</select>
								</div>
			          		</div>
			          		<div class="row">
								<div class="col-xl-4">	
		                        	<label>Avatar</label>
									<input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" id="avatar">
									@error('avatar')
                                    	<span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                    @enderror
									<div class="img-holder"></div>
		                        </div>
			          		</div>
			          	</fieldset>
			          	<button type="submit" class="btn btn-primary btn-sm btn-radius" id="save" name="save"><i class="far fa-save"></i> Save</button>
		          	</form>
        		</div>
        	</div>
        </div>
	</div>

@endsection
@section('script')

    <script type="text/javascript">
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        //Reset input file
        $('input[type="file"][name="avatar"]').val('');
        //Image preview
        $('input[type="file"][name="avatar"]').on('change', function(){
            var img_path = $(this)[0].value;
            var img_holder = $('.img-holder');
            var extension = img_path.substring(img_path.lastIndexOf('.')+1).toLowerCase();
            if(extension == 'jpeg' || extension == 'jpg' || extension == 'png'){
                if(typeof(FileReader) != 'undefined'){
                    img_holder.empty();
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('<img/>',{'src':e.target.result, 'width': '100', 'class':'img-thumbnail mt-1 mb-2'}).appendTo(img_holder);
                    }
                    img_holder.show();
                    reader.readAsDataURL($(this)[0].files[0]);
                }else{
                    $(img_holder).html('This browser does not support FileReader');
                }
            }else{
                $(img_holder).empty();
            }
        });
    </script>

@endsection