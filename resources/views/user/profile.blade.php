@php
use App\Http\Controllers\Globals as Util;
@endphp

@extends("layouts.user")

@section('title') Profile @endsection

@section('settings') active @endsection

@section('content')
    @if(Util::completeProfile(auth()->user()) || Util::completeProfileKin(auth()->user()))
        <div class="row">
        <div class="col-12">
            <div class="alert alert-info show fade alert-has-icon">
                <div class="alert-icon">
                    <i class="far fa-lightbulb"></i>
                </div>
                <div class="alert-body">
                    <p>
                        Kindly provide the following information to complete your registration:
                    </p>
                    <ul>
                        <li>Address</li>
                        <li>State</li>
                        <li>Country</li>
                        <li>City</li>
                        <li>Date of Birth</li>
                        <li>Bank Details</li>
                        <li>Next of Kin Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="row mt-sm-4">
	<div class="col-12 col-md-12 col-lg-4">
		<div class="card author-box">
			<div class="card-body">
				<div class="author-box-center">
					<img alt="image" src="{{ Util::getPassport($user) }}" class="rounded-circle author-box-picture">
					<div class="clearfix"></div>
					<div class="author-box-name">
						<a href="#">{{ ucwords($user->name) }}</a>
					</div>
					<div class="author-box-job">{{ strtolower($user->email) }}</div>
				</div>
				<div class="text-center">
					<div class="author-box-description">
						<p>
							{{ ucfirst($user->address) }}
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<h4>Personal Details</h4>
			</div>
			<div class="card-body">
				<div class="py-4">
					<p class="clearfix">
						<span class="float-left">
						Address
						</span>
						<span class="float-right text-muted">
						{{ $user->address }}
						</span>
					</p>
					<p class="clearfix">
						<span class="float-left">
						State
						</span>
						<span class="float-right text-muted">
						{{ $user->state }}
						</span>
					</p>
					<p class="clearfix">
						<span class="float-left">
						City
						</span>
						<span class="float-right text-muted">
						{{ $user->city }}
						</span>
					</p>
					<p class="clearfix">
						<span class="float-left">
						Country
						</span>
						<span class="float-right text-muted">
						<a href="#">{{ $user->country }}</a>
						</span>
					</p>
					<p class="clearfix">
						<span class="float-left">
						Zip Code
						</span>
						<span class="float-right text-muted">
						<a href="#"> {{ $user->zip }}</a>
						</span>
					</p>
      <!--              <p class="clearfix">-->
						<!--<span class="float-left">-->
						<!--Referral Code-->
						<!--</span>-->
      <!--                  <span class="float-right text-muted">-->
						<!--<a href="#">{{ auth()->user()->code }}</a>-->
						<!--</span>-->
      <!--              </p>-->
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-12 col-lg-8">
		<div class="card">
			<div class="padding-20">
				<ul class="nav nav-tabs" id="myTab2" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
							aria-selected="false">Profile</a>
					</li>

                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#kin" role="tab"
                           aria-selected="false">Next Of Kin</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="bank-details" data-toggle="tab" href="#bank" role="tab"
                           aria-selected="false">Bank Details</a>
                    </li>

				</ul>
				<div class="tab-content tab-bordered" id="myTab3Content">
					<div class="tab-pane fade show active" id="settings" role="tabpanel" aria-labelledby="profile-tab1">
						<form method="post" action="{{ route('profile.edit') }}" enctype="multipart/form-data">
							@csrf
							<div class="card-header">
								<h4>Edit Profile</h4>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="form-group col-md-12 col-12">
										<label>Name</label>
										<input type="text" class="form-control" value="{{ $user->name }}" name="name">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-7 col-12">
										<label>Email</label>
										<input type="email" class="form-control" value="{{ $user->email }}" name="email" readonly="">
									</div>
									<div class="form-group col-md-5 col-12">
										<label>Phone</label>
										<input type="tel" class="form-control" value="{{ $user->phone }}" name="phone" >
									</div>
								</div>

								<div class="row">
									<div class="form-group col-12 col-md-4">
										<label>Address</label>
										<input type="text" name="address" class="form-control" value='{{ $user->address }}'>
									</div>
									<div class="form-group col-12 col-md-4">
										<label>City</label>
										<input type="text" name="city" class="form-control" value='{{ $user->city }}'>
									</div>
                                    <div class="form-group col-12 col-md-4">
                                        <label>DOB</label>
                                        <input type="date" name="dob" class="form-control {{$user->dob == null ?  'border-danger' : ''}}" value='{{ $user->dob }}'>
                                    </div>
								</div>

								<div class="row">
									<div class="form-group col-12 col-md-4">
										<label>State</label>
										<input type="text" name="state" class="form-control" value='{{ $user->state }}'>
									</div>
									<div class="form-group col-12 col-md-4">
										<label>Country</label>
										<input type="text" name="country" class="form-control" value='{{ $user->country }}'>
									</div>
									<div class="form-group col-12 col-md-4">
										<label>ZIP Code</label>
										<input type="text" name="zip" class="form-control" value='{{ $user->zip }}'>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-12 col-md-12">
										<label>Passport</label>
										<input type="file" name="passport" class="form-control">
									</div>
								</div>
							</div>
							<div class="card-footer text-right">
								<button type="submit" class="btn btn-success">Save Changes</button>
							</div>
						</form>
					</div>

					<div class="tab-pane fade show" id="kin" role="tabpanel" aria-labelledby="profile-tab2">
						<form method="post" action="{{ route('profile.edit.kin') }}" enctype="multipart/form-data">
							@csrf
							<div class="card-header">
								<h4>Edit Next of Kin</h4>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="form-group col-md-12 col-12">
										<label>Name</label>
										<input type="text" class="form-control" value="{{ $user->nk_Name }}" name="name">
									</div>
								</div>
								<div class="row">
									<div class="form-group col-md-7 col-12">
										<label>Email</label>
										<input type="email" class="form-control" value="{{ $user->nk_Email }}" name="email" >
									</div>
									<div class="form-group col-md-5 col-12">
										<label>Phone</label>
										<input type="tel" class="form-control" value="{{ $user->nk_Phone }}" name="phone" >
									</div>
								</div>

								<div class="row">
									<div class="form-group col-12">
										<label>Address</label>
										<input type="text" name="address" class="form-control" value='{{ $user->nk_Address }}'>
									</div>

								</div>

							</div>
							<div class="card-footer text-right">
								<button type="submit" class="btn btn-success">Save Changes</button>
							</div>
						</form>
					</div>

                    <div class="tab-pane fade show" id="bank" role="tabpanel" aria-labelledby="bank-details">
                        <form method="post" action="{{ route('profile.edit.kin') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-header">
                                <h4>Bank Details</h4>
                            </div>

                            <div class="card-body">
                                <a class="btn btn-success float-right" href="/banks/add"> Add bank details</a><br><br>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th>Bank Name</th>
                                            <th>Account Name</th>
                                            <th>Account Number</th>
                                            <th>Account Information</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach($banks as $bank)
                                            <tr>
                                                <td>
                                                    {{ $i++ }}
                                                </td>
                                                <td> {{ ucwords($bank->bank_name) }}</td>
                                                <td>{{ ucwords($bank->account_name) }}</td>
                                                <td>{{ $bank->account_number }}</td>
                                                <td>{{ $bank->account_information }}</td>
                                                <td><a href="/banks/delete/{{ $bank->id }}" onclick="return confirm('Are you sure you want to delete this bank?');" class="btn btn-danger">Delete</a><a href="/bank/edit/{{ $bank->id }}" class="btn btn-warning">Edit</a></td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('foot')
<script src="{{ asset('assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/page/datatables.js') }}"></script>
@endsection
