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
            <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header">
                        <h5 class="mb-0"> Top salling product</h5>
                    </div>
                    <div class="card-body">
                        {{-- <div class="ct-chart-product ct-golden-section"></div> --}}
                        <canvas id="myChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {

            type: 'bar',
            data: {
                labels: [<?= '"' . implode('","', $product_name) . '"' ?>],
                datasets: [{
                    label: 'Total Sale:',
                    data: [<?= '"' . implode('","', $total_sell) . '"' ?>],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 206, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 159, 64)'
                    ],
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
