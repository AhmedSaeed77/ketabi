@extends('dashboard.core.app')
@section('title', __('titles.Student Details'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.student')</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.student') @lang('dashboard.details')</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 mt-3 row">


                                    <div class="card card-dark col-12">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('dashboard.details')</h3>
                                        </div>

                                        <div class="card-body row">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.Name'):</th>
                                                    <td>{{$user->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.Email'):</th>
                                                    <td>{{$user->email}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.Phone'):</th>
                                                    <td>{{$user->phone}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.Image'):</th>
                                                    <td>
                                                        @if($user->image)
                                                            <div class="col-1 mt-3">
                                                                <img  src="{{$user->image?url( $user->image) : '' }}" width="100px" height="auto"/>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.educational_stage'):</th>
                                                    <td> {{$user->studentStage->name}}
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
