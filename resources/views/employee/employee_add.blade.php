@extends('layout.app')
@section('content')
	<style type="text/css">
	    #idst {
	        font-weight: bold;
	        font-size: 10px;
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
              <li class="breadcrumb-item active">Employee</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-gradient-success">
          <h4 class="m-0 font-weight-bold text-center text-light float-left">Add Employee</h4>
        </div>
        <div class="card-body">
          <form action="{{ route('employee.store') }}" method="POST" data-toggle="validator" enctype="multipart/form-data" autocomplete="off" id="form-employee">
				{{ csrf_field() }} {{ method_field('POST') }}
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">Company Information</legend>
					<input type="hidden" value="{{ Auth::user()->campus_id }}" name="branches">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>First Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control form-control-sm @error('fname') is-invalid @enderror" name="fname">
								@error('fname')
                                    <span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                @enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Last Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control form-control-sm @error('lname') is-invalid @enderror" name="lname">
								@error('lname')
                                    <span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                @enderror
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Gender</label>
								<select class="form-control form-control-sm" name="gender">
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Marital Status</label>
								<select class="form-control form-control-sm" name="marital">
									<option value="Married">Married</option>
									<option value="Unmarried">Unmarried</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Position</label>
								<select class="form-control form-control-sm" name="career">
									@foreach($type as $row)
										<option value="{{ $row->id }}">{{ $row->name }}</option>
									@endforeach
		                      	</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Hire Date <span class="text-danger">*</span></label>
                      			<input type="date" class="form-control form-control-sm @error('hire') is-invalid @enderror" name="hire">
								@error('hire')
                                    <span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                @enderror
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Email <span class="text-danger">*</span></label>
								<input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email">
								@error('email')
                                    <span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                @enderror
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Time In <span class="text-danger">*</span></label>
								<input type="time" class="form-control form-control-sm @error('stime') is-invalid @enderror" name="stime">
								@error('stime')
                                    <span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                @enderror
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Time Out <span class="text-danger">*</span></label>
								<input type="time" class="form-control form-control-sm @error('ltime') is-invalid @enderror" name="ltime">
								@error('ltime')
                                    <span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                @enderror
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Type of Employee</label>
								<select class="form-control form-control-sm" name="type">
									<option value="Full Time">Full Time</option>
									<option value="Part Time">Part Time</option>
								</select>
							</div>
						</div>
					</div>
				</fieldset>
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">Personal Information</legend>
					
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Date of Birth <span class="text-danger">*</span></label>
								<input type="date" class="form-control form-control-sm @error('dob') is-invalid @enderror" name="dob">
								@error('dob')
                                    <span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                @enderror
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Phone Number <span class="text-danger">*</span></label>
								<input type="text" class="form-control form-control-sm @error('tel') is-invalid @enderror" name="tel">
								@error('tel')
                                    <span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                @enderror
                    		</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Photo</label>
								<div class="custom-file m-n1">
								    <input type="file" class="custom-file-input form-control-sm @error('photo') is-invalid @enderror" name="photo">
								    <label class="custom-file-label" for="photo">Choose file</label>
								</div>
								@error('photo')
                                    <span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                @enderror
                    		</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Nattionality <span class="text-danger">*</span></label>
								<input type="text" class="form-control form-control-sm @error('national') is-invalid @enderror" name="national">
								@error('national')
                                    <span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                @enderror
                    		</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Province <span class="text-danger">*</span></label>
								<input type="text" class="form-control form-control-sm @error('province') is-invalid @enderror" name="province">
								@error('province')
                                    <span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                @enderror
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>District <span class="text-danger">*</span></label>
								<input type="text" class="form-control form-control-sm @error('district') is-invalid @enderror" name="district">
								@error('district')
                                    <span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                @enderror
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Commune <span class="text-danger">*</span></label>
								<input type="text" class="form-control form-control-sm @error('commune') is-invalid @enderror" name="commune">
								@error('commune')
                                    <span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                @enderror
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Village <span class="text-danger">*</span></label>
								<input type="text" class="form-control form-control-sm @error('village') is-invalid @enderror" name="village">
								@error('village')
                                    <span style="color: #df4759; font-size: 80%; margin-top: .25rem;">{{ $message }}</span>
                                @enderror
							</div>
						</div>
					</div>
				</fieldset>

				<button type="submit" class="btn btn-primary btn-sm btn-save"><i class="far fa-save"></i> Save</button>
			</form>
        </div>
      </div>
    </div>

@endsection

@section('footer')
	<script type="text/javascript">
		$(".custom-file-input").on("change", function() {
  			var fileName = $(this).val().split("\\").pop();
  			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	</script>
@endsection