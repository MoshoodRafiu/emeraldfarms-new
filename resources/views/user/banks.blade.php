@php
use App\Http\Controllers\Globals as Util;
@endphp

@extends("layouts.user")

@section('title') Banks @endsection

@section('settings') active @endsection


@section('head')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="section-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4>Banks</h4>
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
