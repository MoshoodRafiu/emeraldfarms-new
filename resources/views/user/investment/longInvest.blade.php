@php
use App\Http\Controllers\Globals as Util;
@endphp

@extends("layouts.user")

@section('title') Add Investment @endsection

@section('farmlist') active @endsection

@section('content')

    <div class="section-body">
	<div class="row">
		<div class="col-12 col-md-6 col-lg-6">
			<div class="card">
				<div class="card-header">
					<h4>Add long investment</h4>
				</div>

				<div class="card-body">
					<form action="{{ route('invest.long.add') }}" method="post">
						@csrf

                        <p> <strong>Farm Name:</strong> {{$farmlist->title}} <br>
                            <strong>Price Per Unit:</strong> {{$farmlist->price}} <br>
                            <strong>Current Available Units:</strong> <span style="">{{$farmlist->available_units}} Units</span>
                        </p>

                        <br>
                        <strong>Enter your units to invest</strong>
						<div class="form-group">
							<input type="number" class="form-control" name="unit" required placeholder="">
                            <input type="hidden" name="id" value="{{ $farmlist->id }}">

                        </div>
                        <br>
						<div class="form-group">
							<button onclick="return confirm('You won\'t be able to cancel this once started. Are you sure you want to proceed?');" type="submit" class="btn btn-success btn-block btn-lg">Make Investment</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
