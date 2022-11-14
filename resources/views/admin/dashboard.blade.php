@extends('layouts.app')
@section('main-content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title">Admin Dashboard </h2>
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
                    <h5 class="text-muted mb-4">Total Users</h5>
                    <div class="d-flex justify-content-between">
                        <div class="metric-value">
                            <h1 class="font-weight-bold">{{$figers->total_user}}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
            <div class="card border-top-primary shadow-sm h-100">
                <div class="card-body">
                    <h5 class="text-muted mb-4">Total Comapany</h5>
                    <div class="d-flex justify-content-between">
                        <div class="metric-value">
                            <h1 class="font-weight-bold">{{$figers->total_company}}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
            <div class="card border-top-primary shadow-sm h-100">
                <div class="card-body">
                    <h5 class="text-muted mb-4">Total Manager</h5>
                    <div class="d-flex justify-content-between">
                        <div class="metric-value">
                            <h1 class="font-weight-bold">{{$figers->total_manager}}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-4">
            <div class="card border-top-primary shadow-sm h-100">
                <div class="card-body">
                    <h5 class="text-muted mb-4">Total Sales Executive</h5>
                    <div class="d-flex justify-content-between">
                        <div class="metric-value">
                            <h1 class="font-weight-bold">{{$figers->total_sales_executive}}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
