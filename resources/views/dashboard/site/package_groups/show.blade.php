@php use Carbon\Carbon; @endphp
@extends('dashboard.core.app')
@section('title', __('dashboard.Show') . ' ' . __('dashboard.package group'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.package groups')</h1>
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
                            <h3 class="card-title">@lang('dashboard.Show') @lang('dashboard.package group')</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12 order-2 order-md-1">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.Name')</span>
                                                    <span
                                                        class="info-box-number text-center mb-0">{{ $group->t('name') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.package')</span>
                                                    <span
                                                        class="info-box-number text-center mb-0">{{ $group->package->t('name') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.seats')</span>
                                                    <span
                                                        class="info-box-number text-center mb-0">{{ $group->seats }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.whatsapp_link')</span>
                                                    <span class="info-box-number text-center mb-0"><a target="_blank"
                                                            href="{{ $group->whatsapp_group }}">@lang('dashboard.WhatsApp') <i
                                                                class="fas fa-link"></i></a></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center">@lang('dashboard.Activation')</span>
                                                    <p class="info-box-number text-center mb-0">
                                                        {{ $group->is_active_title }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.package group schedules')</h3>
                            <div class="card-tools">
                                <button class="btn btn-dark" data-toggle="modal"
                                    data-target="#create-schedule">@lang('dashboard.Create')</button>
                                @permission('package_group_schedules-create')
                                    <div id="create-schedule" class="modal fade modal2 " tabindex="-1" role="dialog"
                                        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <form action="{{ route('schedules.store', [$group->package_id, $group->id]) }}"
                                            method="post">
                                            @csrf
                                            <div class="modal-dialog">
                                                <div class="modal-content float-left">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">@lang('dashboard.Create') @lang('dashboard.package group schedule')</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="exampleInputName1">@lang('dashboard.day')</label>
                                                                    <select name="day" class="form-control" required>
                                                                        <option value="">@lang('dashboard.select')</option>
                                                                        <option @selected(old('day') == '6') value="6">
                                                                            @lang('dashboard.Saturday')</option>
                                                                        <option @selected(old('day') == '0') value="0">
                                                                            @lang('dashboard.Sunday')</option>
                                                                        <option @selected(old('day') == '1') value="1">
                                                                            @lang('dashboard.Monday')</option>
                                                                        <option @selected(old('day') == '2') value="2">
                                                                            @lang('dashboard.Tuesday')</option>
                                                                        <option @selected(old('day') == '3') value="3">
                                                                            @lang('dashboard.Wednesday')</option>
                                                                        <option @selected(old('day') == '4') value="4">
                                                                            @lang('dashboard.Thursday')</option>
                                                                        <option @selected(old('day') == '5') value="5">
                                                                            @lang('dashboard.Friday')</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputName1">@lang('dashboard.from')</label>
                                                                    <input name="start_at" type="time" class="form-control"
                                                                        id="exampleInputEmail1" value="{{ old('start_at') }}"
                                                                        placeholder="" required
                                                                        pattern="[0-2][0-9]:[0-5][0-9]:[0-5][0-9]">
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="exampleInputName1">@lang('dashboard.to')</label>
                                                                    <input name="end_at" type="time" class="form-control"
                                                                        id="exampleInputEmail1" value="{{ old('end_at') }}"
                                                                        placeholder="" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" data-dismiss="modal"
                                                            class="btn btn-light waves-effect waves-light m-l-5 mr-1 ml-1">
                                                            @lang('dashboard.close')
                                                        </button>
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-dark">@lang('dashboard.Create')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endpermission
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>@lang('dashboard.day')</th>
                                        <th>@lang('dashboard.from')</th>
                                        <th>@lang('dashboard.to')</th>
                                        <th>@lang('dashboard.Operations')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($group->schedules as $key => $schedule)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $schedule->day_title }}</td>
                                            <td>{{ Carbon::parse($schedule->start_at)->format('h:ia') }}</td>
                                            <td>{{ Carbon::parse($schedule->end_at)->format('h:ia') }}</td>
                                            <td>
                                                <div class="operations-btns" style="">

                                                    @permission('package_group_schedules-update')

                                                    <button class="btn btn-dark waves-effect waves-light"
                                                        data-toggle="modal"
                                                        data-target="#edit-schedule-{{ $key }}">@lang('dashboard.Edit')</button>
                                                    <div id="edit-schedule-{{ $key }}"
                                                        class="modal fade modal2 " tabindex="-1" role="dialog"
                                                        aria-labelledby="myModalLabel" aria-hidden="true"
                                                        style="display: none;">
                                                        <form
                                                            action="{{ route('schedules.update', [$group->package_id, $group->id, $schedule->id]) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-dialog">
                                                                <div class="modal-content float-left">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">@lang('dashboard.Edit')
                                                                            @lang('dashboard.package group schedule')</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="exampleInputName1">@lang('dashboard.day')</label>
                                                                                    <select name="day"
                                                                                        class="form-control" required>
                                                                                        <option value="">
                                                                                            @lang('dashboard.select')</option>
                                                                                        <option @selected($schedule->day == '6')
                                                                                            value="6">
                                                                                            @lang('dashboard.Saturday')</option>
                                                                                        <option @selected($schedule->day == '0')
                                                                                            value="0">
                                                                                            @lang('dashboard.Sunday')</option>
                                                                                        <option @selected($schedule->day == '1')
                                                                                            value="1">
                                                                                            @lang('dashboard.Monday')</option>
                                                                                        <option
                                                                                            @selected($schedule->day == '2')
                                                                                            value="2">
                                                                                            @lang('dashboard.Tuesday')</option>
                                                                                        <option
                                                                                            @selected($schedule->day == '3')
                                                                                            value="3">
                                                                                            @lang('dashboard.Wednesday')</option>
                                                                                        <option
                                                                                            @selected($schedule->day == '4')
                                                                                            value="4">
                                                                                            @lang('dashboard.Thursday')</option>
                                                                                        <option
                                                                                            @selected($schedule->day == '5')
                                                                                            value="5">
                                                                                            @lang('dashboard.Friday')</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="exampleInputName1">@lang('dashboard.from')</label>
                                                                                    <input name="start_at" type="time"
                                                                                        class="form-control"
                                                                                        id="exampleInputEmail1"
                                                                                        value="{{ $schedule->start_at }}"
                                                                                        placeholder="" required>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <div class="form-group">
                                                                                    <label
                                                                                        for="exampleInputName1">@lang('dashboard.to')</label>
                                                                                    <input name="end_at" type="time"
                                                                                        class="form-control"
                                                                                        id="exampleInputEmail1"
                                                                                        value="{{ $schedule->end_at }}"
                                                                                        placeholder="" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" data-dismiss="modal"
                                                                            class="btn btn-light waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                            @lang('dashboard.close')
                                                                        </button>
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-dark">@lang('dashboard.Edit')</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    @endpermission
                                                    @permission('package_group_schedules-delete')

                                                    <button class="btn btn-dark waves-effect waves-light"
                                                        data-toggle="modal"
                                                        data-target="#delete-modal{{ $key }}">@lang('dashboard.Delete')</button>
                                                    <div id="delete-modal{{ $key }}" class="modal fade modal2 "
                                                        tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                        aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content float-left">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">@lang('dashboard.Delete')
                                                                        @lang('dashboard.package group schedule')</h5>
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
                                                                        action="{{ route('schedules.destroy', [$group->package_id, $group->id, $schedule->id]) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        {{ method_field('DELETE') }}
                                                                        <button type="submit"
                                                                            class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endpermission

                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        @include('dashboard.core.includes.no-entries', ['columns' => 6])
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

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
