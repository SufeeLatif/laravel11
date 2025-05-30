@extends('layouts.master')
@section('css')
<!-- INTERNAL Notifications  Css -->
<link href="{{asset('assets/plugins/notify/css/jquery.growl.css')}}" rel="stylesheet" />

@endsection

@section('page-header')
<!--Page header-->
<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">Hi! Welcome Back</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fe fe-home mr-2 fs-14"></i>Dashboard</a></li>
            {{-- <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/' . $page='#')}}">Sales
                    Dashboard</a></li> --}}
        </ol>
    </div>
    <div class="page-rightheader">
        <div class="btn btn-list">
            <a href="" class="btn btn-info"><i class="fe fe-settings mr-1"></i> General
                Settings </a>
            <a href="" class="btn btn-danger"><i class="fe fe-printer mr-1"></i> Print
            </a>
            <a href="" class="btn btn-warning"><i class="fe fe-shopping-cart mr-1"></i>
                Buy Now </a>
        </div>
    </div>
</div>
<!--End Page header-->
@endsection
@section('content')
<!-- Row-1 -->
<div class="row">
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden dash1-card border-0">
            <div class="card-body">
                <p class=" mb-1 ">Total Sales</p>
                <h2 class="mb-1 number-font">$3,257</h2>
                <small class="fs-12 text-muted">Compared to Last Month</small>
                <span class="ratio bg-warning">76%</span>
                <span class="ratio-text text-muted">Goals Reached</span>
            </div>
            <div id="spark1"></div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden dash1-card border-0">
            <div class="card-body">
                <p class=" mb-1 ">Total User</p>
                <h2 class="mb-1 number-font">1,678</h2>
                <small class="fs-12 text-muted">Compared to Last Month</small>
                <span class="ratio bg-info">85%</span>
                <span class="ratio-text text-muted">Goals Reached</span>
            </div>
            <div id="spark2"></div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden dash1-card border-0">
            <div class="card-body">
                <p class=" mb-1 ">Total Income</p>
                <h2 class="mb-1 number-font">$2,590</h2>
                <small class="fs-12 text-muted">Compared to Last Month</small>
                <span class="ratio bg-danger">62%</span>
                <span class="ratio-text text-muted">Goals Reached</span>
            </div>
            <div id="spark3"></div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
        <div class="card overflow-hidden dash1-card border-0">
            <div class="card-body">
                <p class=" mb-1">Total Tax</p>
                <h2 class="mb-1 number-font">$1,954</h2>
                <small class="fs-12 text-muted">Compared to Last Month</small>
                <span class="ratio bg-success">53%</span>
                <span class="ratio-text text-muted">Goals Reached</span>
            </div>
            <div id="spark4"></div>
        </div>
    </div>
</div>
<!-- End Row-1 -->

<!-- Row-2 -->
<div class="row">
    <div class="col-xl-8 col-lg-8 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Sales Analysis</h3>
                <div class="card-options">
                    <div class="btn-group p-0">
                        <button class="btn btn-outline-light btn-sm" type="button">Week</button>
                        <button class="btn btn-light btn-sm" type="button">Month</button>
                        <button class="btn btn-outline-light btn-sm" type="button">Year</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-xl-3 col-6">
                        <p class="mb-1">Total Sales</p>
                        <h3 class="mb-0 fs-20 number-font1">$52,618</h3>
                        <p class="fs-12 text-muted"><span class="text-danger mr-1"><i
                                    class="fe fe-arrow-down"></i>0.9%</span>this month</p>
                    </div>
                    <div class="col-xl-3 col-6 ">
                        <p class=" mb-1">Maximum Sales</p>
                        <h3 class="mb-0 fs-20 number-font1">$26,197</h3>
                        <p class="fs-12 text-muted"><span class="text-success mr-1"><i
                                    class="fe fe-arrow-up"></i>0.15%</span>this month</p>
                    </div>
                    <div class="col-xl-3 col-6">
                        <p class=" mb-1">Total Units Sold</p>
                        <h3 class="mb-0 fs-20 number-font1">13,876</h3>
                        <p class="fs-12 text-muted"><span class="text-danger mr-1"><i
                                    class="fe fe-arrow-down"></i>0.8%</span>this month</p>
                    </div>
                    <div class="col-xl-3 col-6">
                        <p class=" mb-1">Maximum Units Sold</p>
                        <h3 class="mb-0 fs-20 number-font1">5,876</h3>
                        <p class="fs-12 text-muted"><span class="text-success mr-1"><i
                                    class="fe fe-arrow-up"></i>0.06%</span>this month</p>
                    </div>
                </div>
                <div id="echart1" class="chart-tasks chart-dropshadow text-center"></div>
                <div class="text-center mt-2">
                    <span class="mr-4"><span class="dot-label bg-primary"></span>Total Sales</span>
                    <span><span class="dot-label bg-secondary"></span>Total Units Sold</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-4 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Activity</h3>
                <div class="card-options">
                    <a href="" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            class="fe fe-more-horizontal fs-20"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="">Today</a>
                        <a class="dropdown-item" href="">Last Week</a>
                        <a class="dropdown-item" href="">Last Month</a>
                        <a class="dropdown-item" href="">Last Year</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="latest-timeline scrollbar3" id="scrollbar3">
                    <ul class="timeline mb-0">
                        <li class="mt-0">
                            <div class="d-flex"><span class="time-data">Task Finished</span><span
                                    class="ml-auto text-muted fs-11">09 June 2020</span></div>
                            <p class="text-muted fs-12"><span class="text-info">Joseph Ellison</span> finished
                                task on<a href="" class="font-weight-semibold">
                                    Project Management</a></p>
                        </li>
                        <li>
                            <div class="d-flex"><span class="time-data">New Comment</span><span
                                    class="ml-auto text-muted fs-11">05 June 2020</span></div>
                            <p class="text-muted fs-12"><span class="text-info">Elizabeth Scott</span> Product
                                delivered<a href="" class="font-weight-semibold">
                                    Service Management</a></p>
                        </li>
                        <li>
                            <div class="d-flex"><span class="time-data">Target Completed</span><span
                                    class="ml-auto text-muted fs-11">01 June 2020</span></div>
                            <p class="text-muted fs-12"><span class="text-info">Sonia Peters</span> finished
                                target on<a href="" class="font-weight-semibold">
                                    this month Sales</a></p>
                        </li>
                        <li>
                            <div class="d-flex"><span class="time-data">Revenue Sources</span><span
                                    class="ml-auto text-muted fs-11">26 May 2020</span></div>
                            <p class="text-muted fs-12"><span class="text-info">Justin Nash</span> source report
                                on<a href="" class="font-weight-semibold">
                                    Generated</a></p>
                        </li>
                        <li>
                            <div class="d-flex"><span class="time-data">Dispatched Order</span><span
                                    class="ml-auto text-muted fs-11">22 May 2020</span></div>
                            <p class="text-muted fs-12"><span class="text-info">Ella Lambert</span> ontime order
                                delivery <a href="" class="font-weight-semibold">Service
                                    Management</a></p>
                        </li>
                        <li>
                            <div class="d-flex"><span class="time-data">New User Added</span><span
                                    class="ml-auto text-muted fs-11">19 May 2020</span></div>
                            <p class="text-muted fs-12"><span class="text-info">Nicola Blake</span> visit the
                                site<a href="" class="font-weight-semibold">
                                    Membership allocated</a></p>
                        </li>
                        <li>
                            <div class="d-flex"><span class="time-data">Revenue Sources</span><span
                                    class="ml-auto text-muted fs-11">15 May 2020</span></div>
                            <p class="text-muted fs-12"><span class="text-info">Richard Mills</span> source
                                report on<a href="" class="font-weight-semibold">
                                    Generated</a></p>
                        </li>
                        <li class="mb-0">
                            <div class="d-flex"><span class="time-data">New Order Placed</span><span
                                    class="ml-auto text-muted fs-11">11 May 2020</span></div>
                            <p class="text-muted fs-12"><span class="text-info">Steven Hart</span> is proces the
                                order<a href="" class="font-weight-semibold">
                                    #987</a></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row-2 -->

<!-- Row-3 -->
<div class="row">
    <div class="col-xl-4 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Recent Customers</h3>
                <div class="card-options">
                    <a href="" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            class="fe fe-more-horizontal fs-20"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="">Today</a>
                        <a class="dropdown-item" href="">Last Week</a>
                        <a class="dropdown-item" href="">Last Month</a>
                        <a class="dropdown-item" href="">Last Year</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="list-card">
                    <span class="bg-warning list-bar"></span>
                    <div class="row align-items-center">
                        <div class="col-9 col-sm-9">
                            <div class="media mt-0">
                                <img src="{{ asset('assets/images/users/1.jpg') }}" alt="img"
                                    class="avatar brround avatar-md mr-3">
                                <div class="media-body">
                                    <div class="d-md-flex align-items-center mt-1">
                                        <h6 class="mb-1">Lisa Marshall</h6>
                                    </div>
                                    <span class="mb-0 fs-13 text-muted">User ID:#2342<span
                                            class="ml-2 text-success fs-13 font-weight-semibold">Paid</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-sm-3">
                            <div class="text-right">
                                <span class="font-weight-semibold fs-16 number-font">$558</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-card">
                    <span class="bg-info list-bar"></span>
                    <div class="row align-items-center">
                        <div class="col-9 col-sm-9">
                            <div class="media mt-0">
                                <img src="{{ asset('assets/images/users/9.jpg') }}" alt="img"
                                    class="avatar brround avatar-md mr-3">
                                <div class="media-body">
                                    <div class="d-md-flex align-items-center mt-1">
                                        <h6 class="mb-1">John Chapman</h6>
                                    </div>
                                    <span class="mb-0 fs-13 text-muted">User ID:#6720<span
                                            class="ml-2 text-danger fs-13 font-weight-semibold">Pending</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-sm-3">
                            <div class="text-right">
                                <span class="font-weight-semibold fs-16 number-font">$458</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-card">
                    <span class="bg-danger list-bar"></span>
                    <div class="row align-items-center">
                        <div class="col-9 col-sm-9">
                            <div class="media mt-0">
                                <img src="{{ asset('assets/images/users/2.jpg') }}" alt="img"
                                    class="avatar brround avatar-md mr-3">
                                <div class="media-body">
                                    <div class="d-md-flex align-items-center mt-1">
                                        <h6 class="mb-1">Sonia Smith </h6>
                                    </div>
                                    <span class="mb-0 fs-13 text-muted">User ID:#8763<span
                                            class="ml-2 text-success fs-13 font-weight-semibold">Paid</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-sm-3">
                            <div class="text-right">
                                <span class="font-weight-semibold fs-16 number-font">$358</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-card">
                    <span class="bg-success list-bar"></span>
                    <div class="row align-items-center">
                        <div class="col-9 col-sm-9">
                            <div class="media mt-0">
                                <img src="{{ asset('assets/images/users/11.jpg') }}" alt="img"
                                    class="avatar brround avatar-md mr-3">
                                <div class="media-body">
                                    <div class="d-md-flex align-items-center mt-1">
                                        <h6 class="mb-1">Joseph Abraham</h6>
                                    </div>
                                    <span class="mb-0 fs-13 text-muted">User ID:#1076<span
                                            class="ml-2 text-danger fs-13 font-weight-semibold">Pending</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-sm-3">
                            <div class="text-right">
                                <span class="font-weight-semibold fs-16 number-font">$796</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-card">
                    <span class="bg-primary list-bar"></span>
                    <div class="row align-items-center">
                        <div class="col-9 col-sm-9">
                            <div class="media mt-0">
                                <img src="{{ asset('assets/images/users/3.jpg') }}" alt="img"
                                    class="avatar brround avatar-md mr-3">
                                <div class="media-body">
                                    <div class="d-md-flex align-items-center mt-1">
                                        <h6 class="mb-1">Joseph Abraham</h6>
                                    </div>
                                    <span class="mb-0 fs-13 text-muted">User ID:#986<span
                                            class="ml-2 text-success fs-13 font-weight-semibold">Paid</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 col-sm-3">
                            <div class="text-right">
                                <span class="font-weight-semibold fs-16 number-font">$867</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4  col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Revenue by customers in Countries</h3>
                <div class="card-options">
                    <a href="" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            class="fe fe-more-horizontal fs-20"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="">Today</a>
                        <a class="dropdown-item" href="">Last Week</a>
                        <a class="dropdown-item" href="">Last Month</a>
                        <a class="dropdown-item" href="">Last Year</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="country-card">
                    <div class="mb-5">
                        <div class="d-flex">
                            <span class=""><img src="{{ asset('assets/images/flags/us.svg') }}" class="w-5 h-5 mr-2"
                                    alt="">United States</span>
                            <div class="ml-auto"><span class="text-success mr-1"><i
                                        class="fe fe-trending-up"></i></span><span class="number-font">$45,870</span>
                                (86%)</div>
                        </div>
                        <div class="progress h-2  mt-1">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary"
                                style="width: 80%"></div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="d-flex">
                            <span class=""><img src="{{ asset('assets/images/flags/in.svg') }}" class="w-5 h-5 mr-2"
                                    alt="">India</span>
                            <div class="ml-auto"><span class="text-danger mr-1"><i
                                        class="fe fe-trending-down"></i></span><span class="number-font">$32,879</span>
                                (65%)</div>
                        </div>
                        <div class="progress h-2  mt-1">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                                style="width: 60%"></div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="d-flex">
                            <span class=""><img src="{{ asset('assets/images/flags/ru.svg') }}" class="w-5 h-5 mr-2"
                                    alt="">Russia</span>
                            <div class="ml-auto"><span class="text-success mr-1"><i
                                        class="fe fe-trending-up"></i></span><span class="number-font">$22,710</span>
                                (55%)</div>
                        </div>
                        <div class="progress h-2  mt-1">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                style="width: 50%"></div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="d-flex">
                            <span class=""><img src="{{ asset('assets/images/flags/ca.svg') }}" class="w-5 h-5 mr-2"
                                    alt="">Canada</span>
                            <div class="ml-auto"><span class="text-danger mr-1"><i
                                        class="fe fe-trending-down"></i></span><span class="number-font">$56,291</span>
                                (69%)</div>
                        </div>
                        <div class="progress h-2  mt-1">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                style="width: 80%"></div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="d-flex">
                            <span class=""><img src="{{ asset('assets/images/flags/ge.svg') }}" class="w-5 h-5 mr-2"
                                    alt="">Germany</span>
                            <div class="ml-auto"><span class="text-success mr-1"><i
                                        class="fe fe-trending-up"></i></span><span class="number-font">$67,357</span>
                                (73%)</div>
                        </div>
                        <div class="progress h-2  mt-1">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-teal"
                                style="width: 70%"></div>
                        </div>
                    </div>
                    <div class="mb-5">
                        <div class="d-flex">
                            <span class=""><img src="{{ asset('assets/images/flags/br.svg') }}" class="w-5 h-5 mr-2"
                                    alt="">Brazil</span>
                            <div class="ml-auto"><span class="text-success mr-1"><i
                                        class="fe fe-trending-up"></i></span><span class="number-font">$34,209</span>
                                (60%)</div>
                        </div>
                        <div class="progress h-2  mt-1">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-indigo"
                                style="width: 60%"></div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="d-flex">
                            <span class=""><img src="{{ asset('assets/images/flags/au.svg') }}" class="w-5 h-5 mr-2"
                                    alt="">Australia</span>
                            <div class="ml-auto"><span class="text-success mr-1"><i
                                        class="fe fe-trending-up"></i></span><span class="number-font">$12,876</span>
                                (46%)</div>
                        </div>
                        <div class="progress h-2  mt-1">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                style="width: 40%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4  col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-end justify-content-between">
                    <div>
                        <p class=" mb-1 fs-14">Users</p>
                        <h2 class="mb-0"><span class="number-font1">12,769</span><span
                                class="ml-2 text-muted fs-11"><span class="text-danger"><i class="fa fa-caret-down"></i>
                                    43.2</span> this month</span></h2>

                    </div>
                    <span class="text-primary fs-35 dash1-iocns bg-primary-transparent border-primary"><i
                            class="las la-users"></i></span>
                </div>
                <div class="d-flex mt-4">
                    <div>
                        <span class="text-muted fs-12 mr-1">Last Month</span>
                        <span class="number-font fs-12"><i class="fa fa-caret-up mr-1 text-success"></i>10,876</span>
                    </div>
                    <div class="ml-auto">
                        <span class="text-muted fs-12 mr-1">Last Year</span>
                        <span class="number-font fs-12"><i class="fa fa-caret-down mr-1 text-danger"></i>88,345</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-end justify-content-between">
                    <div>
                        <p class=" mb-1 fs-14">Sales</p>
                        <h2 class="mb-0"><span class="number-font1">$34,789</span><span
                                class="ml-2 text-muted fs-11"><span class="text-success"><i class="fa fa-caret-up"></i>
                                    19.8</span> this month</span></h2>
                    </div>
                    <span class="text-secondary fs-35 dash1-iocns bg-secondary-transparent border-secondary"><i
                            class="las la-hand-holding-usd"></i></span>
                </div>
                <div class="d-flex mt-4">
                    <div>
                        <span class="text-muted fs-12 mr-1">Last Month</span>
                        <span class="number-font fs-12"><i class="fa fa-caret-up mr-1 text-success"></i>$12,786</span>
                    </div>
                    <div class="ml-auto">
                        <span class="text-muted fs-12 mr-1">Last Year</span>
                        <span class="number-font fs-12"><i class="fa fa-caret-down mr-1 text-danger"></i>$89,987</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-end justify-content-between">
                    <div>
                        <p class=" mb-1 fs-14">Subscribers</p>
                        <h2 class="mb-0"><span class="number-font1">4,876</span><span
                                class="ml-2 text-muted fs-11"><span class="text-success"><i class="fa fa-caret-up"></i>
                                    0.8%</span> this month</span></h2>
                    </div>
                    <span class="text-info fs-35 bg-info-transparent border-info dash1-iocns"><i
                            class="las la-thumbs-up"></i></span>
                </div>
                <div class="d-flex mt-4">
                    <div>
                        <span class="text-muted fs-12 mr-1">Last Month</span>
                        <span class="number-font fs-12"><i class="fa fa-caret-up mr-1 text-success"></i>1,034</span>
                    </div>
                    <div class="ml-auto">
                        <span class="text-muted fs-12 mr-1">Last Year</span>
                        <span class="number-font fs-12"><i class="fa fa-caret-down mr-1 text-danger"></i>8,610</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row-3 -->

<!--Row-->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Top Product Sales Overview</h3>
                <div class="card-options">
                    <a href="" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            class="fe fe-more-horizontal fs-20"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="">Today</a>
                        <a class="dropdown-item" href="">Last Week</a>
                        <a class="dropdown-item" href="">Last Month</a>
                        <a class="dropdown-item" href="">Last Year</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter text-nowrap mb-0 table-striped table-bordered border-top">
                        <thead class="">
                            <tr>
                                <th>Product</th>
                                <th>Sold</th>
                                <th>Record point</th>
                                <th>Stock</th>
                                <th>Amount</th>
                                <th>Stock Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                        src="{{ asset('assets/images/orders/7.jpg') }}" alt="media1"> New
                                    Book</td>
                                <td><span class="badge badge-primary">18</span></td>
                                <td>05</td>
                                <td>112</td>
                                <td class="number-font">$ 2,356</td>
                                <td><i class="fa fa-check mr-1 text-success"></i> In Stock</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                        src="{{ asset('assets/images/orders/8.jpg') }}" alt="media1"> New
                                    Bowl</td>
                                <td><span class="badge badge-info">10</span></td>
                                <td>04</td>
                                <td>210</td>
                                <td class="number-font">$ 3,522</td>
                                <td><i class="fa fa-check text-success"></i> In Stock</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                        src="{{ asset('assets/images/orders/9.jpg') }}" alt="media1"> Modal
                                    Car</td>
                                <td><span class="badge badge-secondary">15</span></td>
                                <td>05</td>
                                <td>215</td>
                                <td class="number-font">$ 5,362</td>
                                <td><i class="fa fa-check text-success"></i> In Stock</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                        src="{{ asset('assets/images/orders/10.jpg') }}" alt="media1">
                                    Headset</td>
                                <td><span class="badge badge-primary">21</span></td>
                                <td>07</td>
                                <td>102</td>
                                <td class="number-font">$ 1,326</td>
                                <td><i class="fa fa-check text-success"></i> In Stock</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                        src="{{ asset('assets/images/orders/12.jpg') }}" alt="media1"> Watch
                                </td>
                                <td><span class="badge badge-danger">34</span></td>
                                <td>10</td>
                                <td>325</td>
                                <td class="number-font">$ 5,234</td>
                                <td><i class="fa fa-check text-success"></i> In Stock</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                        src="{{ asset('assets/images/orders/13.jpg') }}" alt="media1">
                                    Branded Shoes</td>
                                <td><span class="badge badge-success">11</span></td>
                                <td>04</td>
                                <td>0</td>
                                <td class="number-font">$ 3,256</td>
                                <td><i class="fa fa-exclamation-triangle text-warning"></i> Out of stock</td>
                            </tr>
                            <tr class="mb-0">
                                <td class="font-weight-bold"><img class="w-7 h-7 rounded shadow mr-3"
                                        src="{{ asset('assets/images/orders/11.jpg') }}" alt="media1"> New
                                    EarPhones</td>
                                <td><span class="badge badge-warning">60</span></td>
                                <td>10</td>
                                <td>0</td>
                                <td class="number-font">$ 7,652</td>
                                <td><i class="fa fa-exclamation-triangle text-danger"></i> Out of stock</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End row-->

</div>
</div>
<!-- End app-content-->
</div>
@endsection
@section('js')
<!--INTERNAL Peitychart js-->
<script src="{{ asset('assets/plugins/peitychart/jquery.peity.min.js') }}"></script>
<script src="{{ asset('assets/plugins/peitychart/peitychart.init.js') }}"></script>

<!--INTERNAL Apexchart js-->
<script src="{{ asset('assets/js/apexcharts.js') }}"></script>

<!--INTERNAL ECharts js-->
<script src="{{ asset('assets/plugins/echarts/echarts.js') }}"></script>

<!--INTERNAL Chart js -->
<script src="{{ asset('assets/plugins/chart/chart.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/chart/utils.js') }}"></script>

<!-- INTERNAL Select2 js -->
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.js') }}"></script>

<!--INTERNAL Moment js-->
<script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>

<!--INTERNAL Index js-->
<script src="{{ asset('assets/js/index1.js') }}"></script>



<script src="{{asset('assets/plugins/notify/js/jquery.growl.js')}}"></script>


<<script>
    $(document).ready(function () {

        @if (session('success_message'))
            $.growl.notice({
                title: "Success",
                message: "{{ session('success_message') }}" // Wrapped in quotes
            });
        @endif

        @if (session('error_message'))
            $.growl.error({
                title: "Error",
                message: "{{ session('error_message') }}" // Wrapped in quotes
            });
        @endif

    });
</script>

@endsection