@php
    $dashboard_active = true;
@endphp
@extends('layouts.app')
@section('main-content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                @if ($figers->name)
                    <h2 class="pageheader-title"> Dashboard OF <span class="text-primary"> {{$figers->name}}</span></h2>
                @else
                    <h2 class="pageheader-title"> Dashboard </h2>
                @endif
            </div>
        </div>
    </div>
    <input value="{{ $figers->user_id }}" type="hidden" id="user_id">
    <div class="ecommerce-widget">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body bg-success">
                        <h5 class="text-muted mb-4">Orders</h5>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h2 class="font-weight-bold">৳{{ $figers->total_order }}</h2>
                            </div>
                            <div>
                                <h6><span class="text-danger">Paid:</span>  ৳{{ $figers->total_paid }}</h6>
                                <h6><span class="text-danger">Due:</span> ৳{{ $figers->total_order - $figers->total_paid }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body bg-warning">
                        <h5 class="text-muted mb-4">Orders <span style="font-size: 9px;color:#ff056d">(This Month)</span></h5>
                        <div class="d-flex justify-content-between">
                            <div>
                                <h2 class="font-weight-bold">৳{{ $figers->new_order }}</h2>
                            </div>
                            <div>
                                <h6><span class="text-danger">Paid:</span>  ৳{{ $figers->new_paid_amount }}</h6>
                                <h6><span class="text-danger">Due:</span> ৳{{ $figers->new_order - $figers->new_paid_amount }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body" style="background: #059BFF">
                        <h5 class="text-muted mb-4">Commission</h5>
                        <div class="d-flex justify-content-between">
                            <div class="metric-value">
                                <h1 class="font-weight-bold">৳{{ $figers->total_commission }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body" style="background: #22CFCF">
                        <h5 class="text-muted mb-4">Commission <span style="font-size: 9px;color:#ff056d">(This Month)</span></h5>
                        <div class="d-flex justify-content-between">
                            <div class="metric-value">
                                <h1 class="font-weight-bold">৳{{ $figers->new_commission }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12 col-12 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0">Orders</h5>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="selfPerformance" height="300"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-12 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0">Amount</h5>
                            </div>
                            <div>
                                <select onchange="amountChart();" id='shortAmountChart' class="custom-form">
                                    <option value="1">This Year</option>
                                    <option value="2">This Month</option>
                                    <option value="3">This week</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="amountChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    <script>
        var oldAmountChart;
        var user_id = $('#user_id').val();
        function ajaxSetup() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
        topSalesExecutiveChart();
        amountChart();

        function topSalesExecutiveChart() {
            ajaxSetup();
            $.ajax({
                type: "post",
                url: '{{ route('chart.selfPerfomance') }}',
                data: {
                    user_id: user_id,
                },
                success: function(results) {
                    let month = results.month;
                    let sum = results.sum;
                    showChart('#selfPerformance', 'bar', 'Total Sales', month, sum);
                },
            });
        }

        function amountChart() {
            if (oldAmountChart) {
                oldAmountChart.destroy();
            }
            ajaxSetup();
            let shortBy = $('#shortAmountChart').val();
            $.ajax({
                type: "post",
                url: '{{ route('chart.amount') }}',
                data: {
                    shortBy: shortBy,
                    user_id: user_id,
                },
                success: function(results) {
                    let categories = results.categories;
                    let amounts = results.amounts;
                    oldAmountChart = showChart('#amountChart', 'pie', 'Amount', categories, amounts);

                },
            });
        }
    </script>
@endsection
