@php
    use App\Http\Controllers\Globals as Util;
    $lastDate = null;
    $nextDate = null;
    $cur = strtotime(date('Y-m-d H:i:s'));
    $mat = strtotime($investment->maturity_date);
    $diff = $mat - $cur;
    $farmlist = Util::getFarmlist($investment->farmlist);
    $interest = $investment->amount_invested*($farmlist->interest/100);
    $add = $investment->amount_invested+$interest;
@endphp

@extends("layouts.user")

@section('title') Investments @endsection

@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>General</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Number of Units</td>
                                        <td>
                                            {{$investment->units}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Farmlist</td>
                                        <td>
                                            {{$investment->farm->title}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Investment Status</td>
                                        <td>
                                            <div class="badge @if($investment->status == 'active' || $investment->status == 'approve') badge-primary @elseif($investment->status == 'pending') badge-warning @elseif($investment->status == 'decline' || $investment->status == 'closed') badge-danger @endif py-2 px-2">{{ucwords($investment->status) }}</div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Maturity Status</td>
                                        <td>
                                            <div class="badge @if($investment->maturity_status == 'matured') badge-primary @elseif($investment->maturity_status == 'pending') badge-warning @endif py-2 px-2">{{ucwords($investment->maturity_status) }}</div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Rollover</td>
                                        <td>
                                            {{$investment->rollover ? 'Yes' : 'No'}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Funds</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Amount Invested</td>
                                        <td>
                                            NGN {{ number_format(implode("", explode(',',$investment->amount_invested))) .'.00'}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>ROI</td>
                                        <td>
                                            {{$investment->farm->interest}}%
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Expected returns</td>
                                        <td>
                                            NGN {{number_format($add,2)}}
                                            
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Calendar</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Date Created</td>
                                    <td>
                                        {{$investment->created_at->format('D M Y')}}
                                    </td>
                                </tr>

                                <tr>
                                    <td>Days Remaining</td>
                                    <td>
                                        @if($investment->maturity_date == null)
                                            0
                                        @elseif($investment->maturity_status == 'pending')
                                            {{ round((($diff/24)/60)/60) }}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
