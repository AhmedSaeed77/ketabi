@extends('dashboard.core.app')
@section('title', __('titles.Home'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>@lang('dashboard.Home')</h1>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-dark">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center">@lang('dashboard.teachers')</span>
                                        <span class="info-box-number text-center mb-0">{{$teachers}}</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-dark">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center">@lang('dashboard.students')</span>
                                        <span class="info-box-number text-center mb-0">{{$students}}</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-dark">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center">@lang('dashboard.educational_stages')</span>
                                        <span class="info-box-number text-center mb-0">{{$educationalStage}}</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-dark">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center">@lang('dashboard.subjects')</span>
                                        <span class="info-box-number text-center mb-0">{{$subjects}}</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-dark">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center">@lang('dashboard.packages')</span>
                                        <span class="info-box-number text-center mb-0">{{$packages}}</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-dark">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center">@lang('dashboard.subscriptions')</span>
                                        <span class="info-box-number text-center mb-0">{{$subscriptions}}</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-dark">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center">@lang('dashboard.payments')</span>
                                        <span class="info-box-number text-center mb-0">{{$payments}}</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-dark">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center">@lang('dashboard.banks')</span>
                                        <span class="info-box-number text-center mb-0">{{$banks}}</span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-dark">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center">@lang('dashboard.contacts')</span>
                                        <span class="info-box-number text-center mb-0">{{$contacts}}</span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
