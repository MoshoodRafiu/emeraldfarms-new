@php
use App\Http\Controllers\Globals as Util;
@endphp

@extends("layouts.user")

@section('title') Investments @endsection

@section('head')
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('investments') active @endsection

@section('content')
<div class="section-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4>Investments</h4>
                    <a href="{{route('download.user.transactions','investments')}}" class="badge badge-success">Download Statement</a>

                </div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped" id="table-1">
							<thead>
								<tr>
									<th class="text-center">
										#
									</th>
                                    <th>Date created</th>
                                    <th>Farmlist</th>
									<th>Amount</th>
                                    <th>Days Remaining</th>
									<th>Status</th>
									<th>Action</th>
 								</tr>
							</thead>
							<tbody>
								@php
								$i = 1;
								@endphp
								@foreach($investments as $invest)
                                    @php
                                        $cur = strtotime(date('Y-m-d H:i:s'));
                                        $mat = strtotime($invest->maturity_date);
                                        $diff = $mat - $cur;
                                        $farmlist = Util::getFarmlist($invest->farmlist);
                                        $interest = $invest->amount_invested*($farmlist->interest/100);
                                        $add = $invest->amount_invested+$interest;
                                    @endphp
								    <tr>
                                        <td>
                                            {{ $i++ }}
                                        </td>
                                        <td>{{$invest->created_at->format('M d, Y')}}</td>
                                        <td>{{ ucwords(Util::getFarmlist($invest->farmlist)->title) }}</td>
                                        <td>
                                            ₦{{ number_format($invest->amount_invested,2) }}
                                        </td>
                                        <td>
                                            @if($invest->maturity_date == null)
                                                0
                                            @elseif($invest->maturity_status == 'pending')
                                                {{ round((($diff/24)/60)/60) }}
                                            @else
                                                0
                                            @endif
                                        </td>
                                        <td>
                                            <div class="badge @if($invest->maturity_status == 'matured') badge-primary @elseif($invest->maturity_status == 'pending') badge-warning @endif py-2 px-2">{{ucwords($invest->maturity_status) }}</div>
                                        </td>
                                        <td>
                                            <a href="{{route('short-investment.show', $invest->id)}}" class="btn btn-success">View Investment</a>
                                        </td>
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
