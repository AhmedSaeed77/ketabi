@extends('dashboard.core.app')
@section('title', __('titles.Student Details'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.teacher')</h1>
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
                            <h3 class="card-title">@lang('dashboard.teacher') @lang('dashboard.details')</h3>
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
                                                    <th style="width:50%">@lang('dashboard.cv_pdf'):</th>
                                                    <td>
                                                        @if($user->cv)
                                                            <div class="col-1 mt-3">
                                                                <iframe  src="{{$user->cv?url( $user->cv) : '' }}" width="auto" height="auto"></iframe>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.cv_description'):</th>
                                                    <td>{{$user->bio}}</td>
                                                </tr>
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.subjects'):</th>
                                                    <td>@php($output='')
                                                        @forelse($user->subjects as $subject)
                                                            @php($output.=$subject->name.' , ')
                                                        @empty
                                                            ' '
                                                        @endforelse
                                                    {{$output}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.educational_stages'):</th>
                                                    <td>@php($output='')
                                                        @forelse($user->educationalStages as $educational_stage)
                                                            @php($output.=$educational_stage->name.' , ')
                                                        @empty
                                                            ' '
                                                    @endforelse
                                                    {{$output}}
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
