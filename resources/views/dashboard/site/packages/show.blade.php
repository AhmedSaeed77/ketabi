@extends('dashboard.core.app')
@section('title', __('dashboard.Show') . ' ' . __('dashboard.package'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.package')</h1>
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
                            <h3 class="card-title">@lang('dashboard.package') @lang('dashboard.details')</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 mt-3 row">


                                    <div class="card card-dark col-12">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('dashboard.package') @lang('dashboard.details')</h3>
                                        </div>

                                        <div class="card-body row">
                                            <table class="table">
                                                <tbody>
                                                @if($package->t('name'))
                                                    <tr>
                                                    <th style="width:50%">@lang('dashboard.Name'):</th>
                                                    <td>{{$package->t('name')}}</td>
                                                </tr>
                                                @endif
                                                @if($package->t('description'))
                                                    <tr>
                                                    <th style="width:50%">@lang('dashboard.description'):</th>
                                                    <td>{{$package->t('description')}}</td>
                                                </tr>
                                                @endif
                                                @if($package->teacher->name)
                                                    <tr>
                                                    <th style="width:50%">@lang('dashboard.teacher'):</th>
                                                    <td>{{$package->teacher->name}}</td>
                                                </tr>
                                                @endif
                                                @if($package->type_name)
                                                    <tr>
                                                    <th style="width:50%">@lang('dashboard.type'):</th>
                                                    <td>{{$package->type_name}}</td>
                                                </tr>
                                                @endif
                                                @if($package->educationalStage->name)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.educational_stage'):</th>
                                                    <td>{{$package->educationalStage->name}}</td>
                                                </tr>
                                                @endif
                                                @if($package->subject->name)
                                                    <tr>
                                                    <th style="width:50%">@lang('dashboard.subject'):</th>
                                                    <td>{{$package->subject->name}}</td>
                                                </tr>
                                                @endif
                                                @if($package->price)
                                                    <tr>
                                                    <th style="width:50%">@lang('dashboard.price'):</th>
                                                    <td>{{$package->price}}</td>
                                                </tr>
                                                @endif
                                                @if($package->introduction_platform)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.introduction_platform'):</th>
                                                    <td>{{$package->introduction_platform}}</td>
                                                </tr>
                                                @endif
                                                @if($package->introduction_url)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.introduction_url'):</th>
                                                    <td><a href="{{$package->introduction_url}}">@lang('dashboard.url')</a></td>
                                                </tr>
                                                @endif
                                                @if($package->duration_in_hours)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.duration_in_hours'):</th>
                                                    <td>{{$package->duration_in_hours}}</td>
                                                </tr>
                                                @endif
                                                @if($package->duration_in_days)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.duration_in_days'):</th>
                                                    <td>{{$package->duration_in_days}}</td>
                                                </tr>
                                                @endif
                                                @if($package->subscription_days)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.subscription_days'):</th>
                                                    <td>{{$package->subscription_days}}</td>
                                                </tr>
                                                @endif
                                                @if($package->from)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.from'):</th>
                                                    <td>{{$package->from}}</td>
                                                </tr>
                                                @endif
                                                @if($package->to)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.to'):</th>
                                                    <td>{{$package->to}}</td>
                                                </tr>
                                                @endif
                                                @if($package->source_platform)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.source_platform'):</th>
                                                    <td>{{$package->source_platform}}</td>
                                                </tr>
                                                @endif
                                                @if($package->source_url)
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.source_url'):</th>
                                                    <td><a href="{{$package->source_url}}">@lang('dashboard.url')</a></td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <th style="width:50%">@lang('dashboard.Image'):</th>
                                                    <td>
                                                        @if($package->image)
                                                            <div class="col-1 mt-3">
                                                                <img  src="{{$package->image?url( $package->image) : '' }}" width="100px" height="auto"/>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                    @if(!empty($package->categories))
                                        <div class="card card-dark col-12">
                                            <div class="card-header">
                                                <h3 class="card-title">@lang('dashboard.categories') @lang('dashboard.details')</h3>
                                            </div>
                                            @foreach($package->categories as $category)
                                                <div class="card-body row">
                                                <h3>{{$loop->iteration}}</h3>
                                                    <table class="table">
                                                        <tbody>
                                                        @if($category->t('name'))
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.Name'):</th>
                                                                <td>{{$category->t('name')}}</td>
                                                            </tr>
                                                        @endif
                                                        @if($category->t('description'))
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.description'):</th>
                                                                <td>{{$category->t('description')}}</td>
                                                            </tr>
                                                        @endif
                                                        @if(!empty($category->teacher->name))
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.teacher'):</th>
                                                                <td>{{$category->teacher->name}}</td>
                                                            </tr>
                                                        @endif
                                                        @if($category->type_name)
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.type'):</th>
                                                                <td>{{$category->type_name}}</td>
                                                            </tr>
                                                        @endif
                                                        @if(!empty($category->educationalStage->name))
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.educational_stage'):</th>
                                                                <td>{{$category->educationalStage->name}}</td>
                                                            </tr>
                                                        @endif
                                                        @if(!empty($category->subject->name))
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.subject'):</th>
                                                                <td>{{$category->subject->name}}</td>
                                                            </tr>
                                                        @endif
                                                        @if($category->price)
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.price'):</th>
                                                                <td>{{$category->price}}</td>
                                                            </tr>
                                                        @endif
                                                        @if($category->introduction_platform)
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.introduction_platform'):</th>
                                                                <td>{{$category->introduction_platform}}</td>
                                                            </tr>
                                                        @endif
                                                        @if($category->introduction_url)
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.introduction_url'):</th>
                                                                <td><a href="{{$category->introduction_url}}">@lang('dashboard.url')</a></td>
                                                            </tr>
                                                        @endif
                                                        @if($category->duration_in_hours)
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.duration_in_hours'):</th>
                                                                <td>{{$category->duration_in_hours}}</td>
                                                            </tr>
                                                        @endif
                                                        @if($category->duration_in_days)
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.duration_in_days'):</th>
                                                                <td>{{$category->duration_in_days}}</td>
                                                            </tr>
                                                        @endif
                                                        @if($category->subscription_days)
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.subscription_days'):</th>
                                                                <td>{{$category->subscription_days}}</td>
                                                            </tr>
                                                        @endif
                                                        @if($category->from)
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.from'):</th>
                                                                <td>{{$category->from}}</td>
                                                            </tr>
                                                        @endif
                                                        @if($category->to)
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.to'):</th>
                                                                <td>{{$category->to}}</td>
                                                            </tr>
                                                        @endif
                                                        @if($category->source_platform)
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.source_platform'):</th>
                                                                <td>{{$package->source_platform}}</td>
                                                            </tr>
                                                        @endif
                                                        @if($category->source_url)
                                                            <tr>
                                                                <th style="width:50%">@lang('dashboard.source_url'):</th>
                                                                <td><a href="{{$category->source_url}}">@lang('dashboard.url')</a></td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <th>@lang('dashboard.Operations')</th>
                                                            <td>
                                                                <button class="btn btn-danger waves-effect waves-light"
                                                                        data-toggle="modal"
                                                                        data-target="#delete-modal{{ $loop->iteration }}">@lang('dashboard.delete')</button>
                                                                <div id="delete-modal{{ $loop->iteration }}"
                                                                     class="modal fade modal2 " tabindex="-1" role="dialog"
                                                                     aria-labelledby="myModalLabel" aria-hidden="true"
                                                                     style="display: none;">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content float-left">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title">@lang('dashboard.confirm_delete')</h5>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <p>@lang('dashboard.sure_delete')</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" data-dismiss="modal"
                                                                                        class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                    @lang('dashboard.close')
                                                                                </button>
                                                                                <form
                                                                                    action="{{ route('packages.destroy', $category->id) }}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    {{ method_field('delete') }}
                                                                                    <button type="submit"
                                                                                            class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                    @if(!empty($category->lectures))
                                                        <h6>@lang('dashboard.lectures')</h6>
                                                        <table class="table table-bordered" id="myTable">
                                                            <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>@lang('dashboard.Name')</th>
                                                                <th>@lang('dashboard.type')</th>
                                                                <th>@lang('dashboard.sort')</th>
                                                                <th>@lang('dashboard.duration_in_hours')</th>
                                                                <th>@lang('dashboard.from')</th>
                                                                <th>@lang('dashboard.to')</th>
                                                                <th>@lang('dashboard.source_platform')</th>
                                                                <th>@lang('dashboard.source_url')</th>
                                                                <th>@lang('dashboard.Operations')</th>

                                                            </tr>
                                                            </thead>
                                                                @foreach($category->lectures as $lecture)
                                                            <tbody>
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $lecture->t('name') }}</td>
                                                                <td>{{ $lecture->type_name }}</td>
                                                                <td>{{ $lecture->sort }}</td>
                                                                <td>{{ $lecture->duration_in_hours }}</td>
                                                                <td>{{ $lecture->from }}</td>
                                                                <td>{{ $lecture->to }}</td>
                                                                <td>{{ $lecture->source_platform }}</td>
                                                                <td>@if($lecture->source_url)<a href="{{ $lecture->source_url }}">@lang('dashboard.url')</a> @endif</td>
                                                                <td>
                                                                    <button class="btn btn-danger waves-effect waves-light"
                                                                            data-toggle="modal"
                                                                            data-target="#delete-modal{{ $loop->iteration }}">@lang('dashboard.delete')</button>
                                                                    <div id="delete-modal{{ $loop->iteration }}"
                                                                         class="modal fade modal2 " tabindex="-1" role="dialog"
                                                                         aria-labelledby="myModalLabel" aria-hidden="true"
                                                                         style="display: none;">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content float-left">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">@lang('dashboard.confirm_delete')</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>@lang('dashboard.sure_delete')</p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" data-dismiss="modal"
                                                                                            class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                        @lang('dashboard.close')
                                                                                    </button>
                                                                                    <form
                                                                                        action="{{ route('packages.destroy', $lecture->id) }}"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        {{ method_field('delete') }}
                                                                                        <button type="submit"
                                                                                                class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                                @endforeach
                                                        </table>
                                                    @endif
                                                </div>
                                            @endforeach

                                        </div>
                                    @endif
                                    @if(!empty($package->lectures))
                                        <div class="card card-dark col-12">
                                            <div class="card-header">
                                                <h3 class="card-title">@lang('dashboard.lectures') @lang('dashboard.details')</h3>
                                            </div>
                                                    @if(!empty($package->lectures))
                                                        <table class="table table-bordered" id="myTable">
                                                            <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>@lang('dashboard.Name')</th>
                                                                <th>@lang('dashboard.type')</th>
                                                                <th>@lang('dashboard.sort')</th>
                                                                <th>@lang('dashboard.duration_in_hours')</th>
                                                                <th>@lang('dashboard.from')</th>
                                                                <th>@lang('dashboard.to')</th>
                                                                <th>@lang('dashboard.source_platform')</th>
                                                                <th>@lang('dashboard.source_url')</th>
                                                                <th>@lang('dashboard.Operations')</th>

                                                            </tr>
                                                            </thead>
                                                                @foreach($package->lectures as $lecture)
                                                            <tbody>
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $lecture->t('name') }}</td>
                                                                <td>{{ $lecture->type_name }}</td>
                                                                <td>{{ $lecture->sort }}</td>
                                                                <td>{{ $lecture->duration_in_hours }}</td>
                                                                <td>{{ $lecture->from }}</td>
                                                                <td>{{ $lecture->to }}</td>
                                                                <td>{{ $lecture->source_platform }}</td>
                                                                <td>@if($lecture->source_url)<a href="{{ $lecture->source_url }}">@lang('dashboard.url')</a> @endif</td>
                                                                <td>
                                                                    <button class="btn btn-danger waves-effect waves-light"
                                                                            data-toggle="modal"
                                                                            data-target="#delete-modal{{ $loop->iteration }}">@lang('dashboard.delete')</button>
                                                                    <div id="delete-modal{{ $loop->iteration }}"
                                                                         class="modal fade modal2 " tabindex="-1" role="dialog"
                                                                         aria-labelledby="myModalLabel" aria-hidden="true"
                                                                         style="display: none;">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content float-left">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">@lang('dashboard.confirm_delete')</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>@lang('dashboard.sure_delete')</p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" data-dismiss="modal"
                                                                                            class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                        @lang('dashboard.close')
                                                                                    </button>
                                                                                    <form
                                                                                        action="{{ route('packages.destroy', $lecture->id) }}"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        {{ method_field('delete') }}
                                                                                        <button type="submit"
                                                                                                class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                                @endforeach
                                                        </table>
                                        </div>
                                                    @endif
                                            @if(!empty($package->attachments))
                                                <div class="card card-dark col-12">
                                                    <div class="card-header">
                                                        <h3 class="card-title">@lang('dashboard.attachments') @lang('dashboard.details')</h3>
                                                    </div>
                                                        <table class="table table-bordered" id="myTable">
                                                            <thead>
                                                            <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>@lang('dashboard.Name')</th>
                                                                <th>@lang('dashboard.sort')</th>
                                                                <th>@lang('dashboard.price')</th>
                                                                <th>@lang('dashboard.image')</th>
                                                                <th>@lang('dashboard.is_individually_sellable')</th>
                                                                <th>@lang('dashboard.source_url')</th>
                                                                <th>@lang('dashboard.Operations')</th>
                                                            </tr>
                                                            </thead>
                                                                @foreach($package->attachments as $attachment)
                                                            <tbody>
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $attachment->t('name') }}</td>
                                                                <td>{{ $attachment->sort }}</td>
                                                                <td>{{ $attachment->price }}</td>
                                                                <td>  @if($attachment->image)
                                                                        <div class="col-1 mt-3">
                                                                            <img  src="{{$attachment->image?url( $attachment->image) : '' }}" width="100px" height="auto"/>
                                                                        </div>
                                                                    @endif</td>
                                                                <td>{{ $attachment->sellable }}</td>
                                                                <td>@if($attachment->source_url)<a href="{{ $attachment->source_url }}">@lang('dashboard.url')</a> @endif</td>
                                                                <td>
                                                                    <button class="btn btn-danger waves-effect waves-light"
                                                                            data-toggle="modal"
                                                                            data-target="#delete-modal{{ $loop->iteration }}">@lang('dashboard.delete')</button>
                                                                    <div id="delete-modal{{ $loop->iteration }}"
                                                                         class="modal fade modal2 " tabindex="-1" role="dialog"
                                                                         aria-labelledby="myModalLabel" aria-hidden="true"
                                                                         style="display: none;">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content float-left">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">@lang('dashboard.confirm_delete')</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p>@lang('dashboard.sure_delete')</p>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" data-dismiss="modal"
                                                                                            class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                                        @lang('dashboard.close')
                                                                                    </button>
                                                                                    <form
                                                                                        action="{{ route('packages.destroy', $attachment->id) }}"
                                                                                        method="post">
                                                                                        @csrf
                                                                                        {{ method_field('delete') }}
                                                                                        <button type="submit"
                                                                                                class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                                @endforeach
                                                        </table>
                                                </div>
                                                    @endif
                                                </div>

                                        </div>
                                    @endif

                                </div>

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
        <!-- /.container-fluid -->
    </section>
@endsection
