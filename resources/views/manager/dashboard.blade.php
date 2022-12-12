@php
    $dashboard_active = true;
@endphp
@extends('layouts.app')
@section('main-content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Dashboard </h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="ecommerce-widget">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body bg-success">
                        <h5 class="text-muted mb-4">Total Orders</h5>
                        <div class="d-flex justify-content-between">
                            <div class="metric-value">
                                <h1 class="font-weight-bold">{{ $figers->total_order }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body bg-warning">
                        <h5 class="text-muted mb-4">New Order</h5>
                        <div class="d-flex justify-content-between">
                            <div class="metric-value">
                                <h1 class="font-weight-bold">{{ $figers->new_order }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body"  style="background: #059BFF">
                        <h5 class="text-muted mb-4">Total Customer</h5>
                        <div class="d-flex justify-content-between">
                            <div class="metric-value">
                                <h1 class="font-weight-bold">{{ $figers->total_customer }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body"  style="background: #22CFCF">
                        <h5 class="text-muted mb-4">New Customer</h5>
                        <div class="d-flex justify-content-between">
                            <div class="metric-value">
                                <h1 class="font-weight-bold">{{ $figers->new_customer }}</h1>
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
                                <h5 class="mb-0"> Top Seles Executive</h5>
                            </div>
                            <div>
                                <select onchange="topSalesExecutiveChart();" id='shortSalesExecutiveChart'
                                    class="custom-form">
                                    <option value="1">This Year</option>
                                    <option value="2">This Month</option>
                                    <option value="3">This week</option>
                                </select>
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
        var salesExecutiveChart, oldAmountChart;

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
            if (salesExecutiveChart) {
                salesExecutiveChart.destroy();
            }
            ajaxSetup();
            let shortBy = $('#shorttopSalesExecutiveChart').val();
            $.ajax({
                type: "post",
                url: '{{ route('chart.salesman_perfomance') }}',
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
            let shortBy = $('#shortAmountChart').val();
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
