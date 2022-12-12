@php
    $dashboard_active = true;
@endphp
@extends('layouts.app')
@section('main-content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Dashboard </h2>
            </div>
        </div>
    </div>
    <div class="ecommerce-widget">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body bg-success">
                        <h5 class="mb-4">Total Sales</h5>
                        <div class="d-flex justify-content-center">
                            <div class="metric-value">
                                <h6 class="font-weight-bold">৳{{ $figers->total_sales }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body bg-warning">
                        <h5 class="mb-4">Total Payment</h5>
                        <div class="d-flex justify-content-center">
                            <div class="metric-value">
                                <h6 class="font-weight-bold">৳{{ $figers->total_payment }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body" style="background: #059BFF">
                        <h5 class="mb-4">Total Due</h5>
                        <div class="d-flex justify-content-center">
                            <div class="metric-value">
                                <h6 class="font-weight-bold">৳{{ $figers->total_due }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body" style="background: #22CFCF">
                        <h5 class="mb-4">Total Expanse</h5>
                        <div class="d-flex justify-content-center">
                            <div class="metric-value">
                                <h6 class="font-weight-bold">৳{{ $figers->total_expanse }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body" style="background: #FF5D7F">
                        <h5 class="mb-4">Total Profit</h5>
                        <div class="d-flex justify-content-center">
                            <div class="metric-value">
                                <h6 class="font-weight-bold">৳{{ $figers->total_profit }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body bg-warning">
                        <h5 class="mb-4">Net Profit (%) </h5>
                        <div class="d-flex justify-content-center">
                            <div class="metric-value">
                                <h6 class="font-weight-bold">{{ $figers->net_profit }}%</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12 col-12 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0"> Top salling product</h5>
                            </div>
                            <div>
                                <select onchange="shortChart();" id='shortForTopSell' class="custom-form">
                                    <option value="1">This Year</option>
                                    <option value="2">This Month</option>
                                    <option value="3">This week</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="topSalesChart" height="300"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-12 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0"> Expanse</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="expanseChart" height="300"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-12 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0"> Progress </h5>
                            </div>
                            <div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="progressChart" height="300"></canvas>
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
                                <h5 class="mb-0"> Top Seles Executive</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="SalesExecutiveChart" height="300"></canvas>
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
        var topSalesChart, expanseChart, progressChart, salesExecutiveChart, oldAmountChart;

        function ajaxSetup() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }

        shortChart();
        function shortChart() {
            topSallingProduct();
            getExpanseChart();
            getProgressChart();
            topSalesExecutiveChart();
            amountChart();
        }

        function topSallingProduct() {

            if (topSalesChart) {
                topSalesChart.destroy();
            }
            ajaxSetup();
            let shortBy = $('#shortForTopSell').val();
            $.ajax({
                type: "post",
                url: '{{ route('chart.topsell') }}',
                data: {
                    shortBy: shortBy
                },
                success: function(results) {
                    let productName = results.product_name;
                    let totalSell = results.total_sell;
                    topSalesChart = showChart('#topSalesChart', 'bar', 'Total Sale:', productName, totalSell);

                },
            });
        }

        function getExpanseChart() {
            if (expanseChart) {
                expanseChart.destroy();
            }
            ajaxSetup();
            let shortBy = $('#shortForTopSell').val();
            $.ajax({
                type: "post",
                url: '{{ route('chart.expanse') }}',
                data: {
                    shortBy: shortBy
                },
                success: function(results) {
                    let categories = results.categories;
                    let amounts = results.amounts;
                    expanseChart = showChart('#expanseChart', 'pie', 'Total', categories, amounts);
                },
            });
        }

        function getProgressChart() {
            if (progressChart) {
                progressChart.destroy();
                console.log(progressChart);
            }
            ajaxSetup();
            let shortBy = $('#shortForTopSell').val();
            $.ajax({
                type: "post",
                url: '{{ route('chart.progress') }}',
                data: {
                    shortBy: shortBy
                },
                success: function(results) {
                    let categories = results.categories;
                    let values = results.values;
                    progressChart = showChart('#progressChart', 'doughnut', 'Total', categories, values);

                },
            });
        }

        function topSalesExecutiveChart() {
            if (salesExecutiveChart) {
                salesExecutiveChart.destroy();
            }
            ajaxSetup();
            let shortBy = $('#shortForTopSell').val();
            $.ajax({
                type: "post",
                url: '{{ route('chart.salesman') }}',
                data: {
                    shortBy: shortBy
                },
                success: function(results) {
                    let user_name = results.user_name;
                    let total_order = results.total_order;
                    salesExecutiveChart = showChart('#SalesExecutiveChart', 'bar', 'Total Sales', user_name,
                        total_order);
                },
            });
        }

        function amountChart() {
            if (oldAmountChart) {
                oldAmountChart.destroy();
            }
            ajaxSetup();
            let shortBy = $('#shortForTopSell').val();
            $.ajax({
                type: "post",
                url: '{{ route('chart.amount') }}',
                data: {
                    shortBy: shortBy
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
