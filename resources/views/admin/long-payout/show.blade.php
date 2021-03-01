@php
    use App\Http\Controllers\Globals as Util;
    $lastDate = null;
    $nextDate = null;
@endphp

@extends("layouts.admin")

@section('title') Investments @endsection

@section('content')

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Milestone</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                <tr>
                                    <th>Milestone</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($investment->milestoneDates() as $key => $date)

                                    @if($nextDate == null && $date->gt(now()))
                                        @php $nextDate = $date @endphp
                                    @endif
                                    <tr>
                                        <td>
                                            {{$date}}
                                        </td>
                                        <td>
                                            @if ($loop->last)
                                                NGN {{number_format(implode("", explode(',',$investment->amount_invested))+implode("", explode(',',$investment->milestoneReturns())))}}
                                                @php $lastDate = $date @endphp
                                            @else
                                                NGN{{number_format(implode("", explode(',',$investment->milestoneReturns())),2)}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($date->gt(now()))
                                            <span class="badge badge-warning">Pending</span> 
                                            @else
                                                @if($investment->payments()->where('milestone', $key+1)->first())
                                                <span class="badge badge-success">Paid</span> 
                                                @else
                                                    @if($key == 0)
                                                    <a href="/investments/payout/approveNow/{{ $investment->id }}" class="btn btn-success" onclick="confirm('Are you sure you want to pay this milestone?');">Pay now</a> 
                                                    @else
                                                        @if($investment->payments()->where('milestone', $key)->first())
                                                        <a href="/investments/payout/approveNow/{{ $investment->id }}" class="btn btn-success" onclick="confirm('Are you sure you want to pay this milestone?');">Pay now</a> 
                                                        @else
                                                        <a href="#" class="btn btn-success disabled">Pay now</a> 
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
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
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>General</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                <tr>
                                    <th>Number of Units</th>
                                    <th>Farmlist</th>
                                    <th>Investment Status</th>
                                    <th>Maturity Status</th>
                                    <th>Number of Milestones</th>
                                    <th>Rollover</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        {{$investment->units}}
                                    </td>

                                    <td>
                                        {{$investment->farm->title}}
                                    </td>

                                    <td>
                                        {{$investment->investmentStatus()}}
                                    </td>

                                    <td>
                                        {{$investment->maturity_status}}
                                    </td>

                                    <td>
                                        {{$investment->farm->milestone}}
                                    </td>

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
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Funds</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                <tr>
                                    <th>Amount Invested</th>
                                    <th>ROI</th>
                                    <th>Expected returns</th>
                                </tr>
                                </thead>
                                <tbody>
                                <td>
                                    NGN {{number_format(implode("", explode(',',$investment->amount_invested)),2)}}
                                </td>

                                <td>
                                    {{$investment->farm->interest}}%
                                </td>
                                <td>
                                    NGN {{number_format(implode("", explode(',',$investment->amount_invested))+implode("", explode(',',$investment->milestoneReturns())))}}
                                </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Calendar</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                <tr>
                                    <th>Date Created</th>
                                    <th>Next Payment Date</th>
                                    <th>Days Remaining</th>
                                    <th>Total Number of Days</th>
                                    <th>Final Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        {{$investment->created_at->format('D M Y')}}
                                    </td>
                                    <td>
                                        {{$nextDate}}
                                    </td>
                                    <td>
                                        {{$lastDate->diffInDays(now())}}
                                    </td>
                                    <td>
                                        {{$investment->getPaymentDurationInDays()}}
                                    </td>
                                    <td>
                                        {{$lastDate}}
                                    </td>
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
