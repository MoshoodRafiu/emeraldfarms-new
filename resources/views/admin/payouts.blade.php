@php
use App\Http\Controllers\Globals as Util;
@endphp

@extends("layouts.admin")

@section('title') Payouts @endsection

@section('head')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('transactions') active @endsection

@section('content')
<div class="section-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4>Payouts</h4>
                    <a href="{{route('download.transactions','payouts')}}" class="badge badge-success">Export Excel</a>

                </div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped" id="table-1">
							<thead>
								<tr>
									<th class="text-center">
										#
									</th>
									<th>User</th>
									<th>Amount</th>
									<th>Bank</th>
									<th> Date </th>
									<th>Status</th>
 								</tr>
							</thead>

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
<script>
    $(document).ready(function () {

        $('#table-1').DataTable({
            "processing": true,
            "serverSide": true,
            "searching": true,
            "ajax":{
                "url": "{{ url('loadPayouts') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "sn" },
                { "data": "name" },
                { "data": "amount" },
                { "data": "bank" },
                { "data": "date" },
                { "data": "status" },
            ],
            "lengthMenu": [[100, 200, 300, 400], [100, 200, 300, 400]]
        });
    });
</script>
@endsection
