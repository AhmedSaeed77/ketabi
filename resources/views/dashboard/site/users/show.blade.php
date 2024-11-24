@extends('dashboard.core.app')
@section('title', __('titles.Student Details'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.Students')</h1>
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
                            <h3 class="card-title">@lang('titles.Student Details')</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 mt-3 row">


                                    <div class="card card-dark col-12">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('dashboard.details')</h3>
                                        </div>

                                        <div class="card-body row">

                                            @if($student->image)
                                                <div class="col-1 mt-3">
                                                    <img class='img-fluid img-thumbnail' src="{{ $student->image ?? '' }}" />
                                                </div>
                                            @endif
                                            <div class="col-10 row mt-3">
                                                <div class="col-6">
                                                    <strong><i class="fas fa-user ml-1 mr-1"></i>{{$student->name}}</strong>
                                                </div>
                                                <div class="col-6">
                                                    <strong><i class="fas fa-envelope ml-1 mr-1"></i>{{$student->email}}</strong>
                                                </div>
                                                <div class="col-6">
                                                    <strong><i class="fas fa-phone ml-1 mr-1"></i>{{$student->phone ?? __('dashboard.none')}}</strong>
                                                </div>
                                                <div class="col-6">
                                                    <strong><i class="fas fa-address-card ml-1 mr-1"></i>{{$student->comminucation_code ?? __('dashboard.none')}}</strong>
                                                </div>
                                            </div>



                                        </div>

                                    </div>

                                </div>

                                @if(auth()->user()->hasPermission('payments-read'))
                                    <h2>@lang('dashboard.courses_subscriptions')</h2>

                                    <div class="col-12 mt-5">
                                        <div class="card">
                                            <form action="{{route('subscription.addTrial')}}" method="post" autocomplete="off"
                                                  enctype="multipart/form-data">
                                                <div class="card-header">
                                                    <h3 class="card-title">@lang('dashboard.add_free_subscription')</h3>
                                                </div>
                                                <input type="hidden" name="student_id" value="{{$student['id']}}">
                                                <div class="card-body">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="form-group col-6">
                                                            <label for="course">@lang('dashboard.course')</label>
                                                            <select id="course" required name="course_id" class="form-control">
                                                                @foreach($unSubscribedCourses as $course)
                                                                    <option value="{{$course['id']}}">{{$course->t('name')}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-dark">@lang('dashboard.add')</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    <div class="col-12 mt-5">
                                        <table class="table table-bordered">
                                            <thead class="table-dark">


                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>@lang('dashboard.course')</th>
                                                <th>@lang('dashboard.subscription type')</th>
                                                <th>@lang('dashboard.Activation')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($student->subscriptions as $key => $subscription)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{$subscription->course->t('name')}}</td>
                                                    <td>{{$subscription->payment_id !== null ? __('dashboard.paid') : __('dashboard.free_subscription')}}</td>
                                                    <td>
                                                        @if($subscription->is_active)
                                                            <button class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$key}}">@lang('dashboard.deActivate')</button>
                                                            <div id="delete-modal{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content float-left">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">@lang('dashboard.deActivate')</h5>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>@lang('dashboard.Are You Sure You Want To De Activate This Subscription')</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                @lang('dashboard.close')
                                                                            </button>
                                                                            <form action="{{route('subscription.toggle' , $subscription['id'])}}" method="post">
                                                                                @csrf
                                                                                {{method_field('PUT')}}
                                                                                <button type="submit" class="btn btn-danger">@lang('dashboard.deActivate')</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$key}}">@lang('dashboard.Activate')</button>
                                                            <div id="delete-modal{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content float-left">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">@lang('dashboard.Activate')</h5>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>@lang('dashboard.Are You Sure You Want To Activate This Subscription')</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                @lang('dashboard.close')
                                                                            </button>
                                                                            <form action="{{route('subscription.toggle' , $subscription['id'])}}" method="post">
                                                                                @csrf
                                                                                {{method_field('PUT')}}
                                                                                <button type="submit" class="btn btn-danger">@lang('dashboard.Activate')</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    </td>

                                                </tr>
                                            @empty
                                                @include('dashboard.core.includes.no-entries', ['columns' => 6])
                                            @endforelse
                                            </tbody>
                                        </table>

                                    </div>


                                @endif

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
