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
					<h4>Add investment</h4>
				</div>

				<div class="card-body">
					<form action="{{ route('invest.add') }}" method="post">
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

                        <div class="form-check">
                            <input type="checkbox" name="rollover" class="form-check-input" id="rollover">
                            <label class="form-check-label" for="rollover">Rollover Investment</label>
                        </div>
                        <br>
                        <!--<div class="form-group">-->
                        <!--    <label>Referrer's Code (optional)</label>-->
                        <!--    <input type="text" class="form-control" name="referrer" value="{{request('ref') ?? ''}}">-->
                        <!--</div>-->

                        <!--<div class="form-group">-->
                        <!--    <a href="{{route('refer.example', ['slug' => Str::slug($farmlist->title)])}}">-->
                        <!--        Refer this farm to someone? Click here to learn more.-->
                        <!--    </a>-->
                        <!--</div>-->

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
