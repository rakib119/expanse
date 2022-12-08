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
                    <div class="card-body">
                        <h5 class="text-muted mb-4">Total Employee</h5>
                        <div class="d-flex justify-content-between">
                            <div class="metric-value">
                                <h1 class="font-weight-bold">{{ $figers->total_employee }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="text-muted mb-4">Total Product</h5>
                        <div class="d-flex justify-content-between">
                            <div class="metric-value">
                                <h1 class="font-weight-bold">{{ $figers->total_product }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
                <div class="card border-top-primary shadow-sm h-100">
                    <div class="card-body">
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
                    <div class="card-body">
                        <h5 class="text-muted mb-4">Order<span style='font-size:9px'>(Current month)</span></h5>
                        <div class="d-flex justify-content-between">
                            <div class="metric-value">
                                <h1 class="font-weight-bold">{{ $figers->total_order }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- ============================================================== -->
            <!-- product sales  -->
            <!-- ============================================================== -->

            <div class="col-md-4 col-sm-12 col-12 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0"> Top salling product</h5>
                            </div>
                            <div>
                                <select onchange="topSallingProduct();" id='shortForTopSell' name="" id=""
                                    class="custom-form">
                                    <option value="1">This Year</option>
                                    <option value="2">This Month</option>
                                    <option value="3">This week</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="Chart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    <script>
        var chart;

        function ajaxSetup() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
        topSallingProduct();


        function topSallingProduct() {
            if (chart) {
                chart.destroy();
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
                    console.log(results);
                    let productName = results.product_name;
                    let totalSell = results.total_sell;
                    chart = showChart('#Chart', 'bar', 'Total Sale:', productName, totalSell);

                },
            });
        }
    </script>
@endsection
