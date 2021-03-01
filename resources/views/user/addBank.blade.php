@php
use App\Http\Controllers\Globals as Util;
@endphp

@extends("layouts.user")

@section('title') Add Banks @endsection

@section('content')
<div class="section-body">
	<div class="row">
		<div class="col-12 col-md-6 col-lg-6">
			<div class="card">
				<div class="card-header">
					<h4>Add Banks</h4>
				</div>
				<div class="card-body">
					<form action="{{ route('bank.add') }}" method="post">
						@csrf
						<div class="form-group">
							<label>Bank Name</label>
							<input type="text" name="bank" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Account Name</label>
							<input type="text" name="account_name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Account Number</label>
							<input type="text" name="account_number" class="form-control" required>
						</div>
						 <div class="form-group">
                            <label>Account Information - For International Investors (optional)</label>
                            <textarea  name="account_information" class="form-control"></textarea>
                        </div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
