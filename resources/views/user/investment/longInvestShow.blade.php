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
                        <h4>Long Term Package Investments</h4>
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
                                    <th>Amount invested</th>
                                    <th>Maturity Date</th>
                                    <th>Maturity Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($investments as $invest)
                                        <tr>
                                            <td>
                                                {{ $i++ }}
                                            </td>
                                            <td>{{  $invest->created_at->format('d M, Y h:i A') }}</td>
                                            <td>{{ ucwords($invest->farm->title) }}</td>
                                            <td>
                                                ₦{{ number_format($invest->amount_invested,2) }}
                                            </td>
                                            <td>
                                                @if($invest->maturity_date != null)
                                                    {{ date('M d, Y h:i A', strtotime($invest->maturity_date)) }}
                                                @else
                                                    <div class="badge badge-warning py-2 px-2">pending</div>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="badge @if($invest->maturity_status == 'matured') badge-primary @elseif($invest->maturity_status == 'pending') badge-warning @endif py-2 px-2">{{ucwords($invest->maturity_status) }}</div>
                                            </td>
                                            <td>
                                                <a href="{{route('long-investment.show', $invest->id)}}" class="btn btn-success">View Investment</a>
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
