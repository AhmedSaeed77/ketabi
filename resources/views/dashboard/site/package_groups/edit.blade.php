@extends('dashboard.core.app')
@section('title', __('dashboard.Edit') . ' ' . __('dashboard.package group'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

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
                        <form action="{{ route('groups.update', [$package_id, $package_group->id]) }}" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Edit') @lang('dashboard.package group')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.Name Ar')</label>
                                            <input name="name_ar" type="text" class="form-control" id="exampleInputName1"
                                                value="{{ old('name_ar') ?? $package_group->name_ar }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.Name En')</label>
                                            <input name="name_en" type="text" class="form-control"
                                                id="exampleInputEmail1" value="{{ old('name_en') ?? $package_group->name_en }}" placeholder=""
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.package')</label>
                                            <select name="package_id" class="form-control" required>
                                                <option value="">@lang('dashboard.select')</option>
                                                @foreach ($packages as $package)
                                                    <option
                                                        value="{{ $package->id }}"{{ old('package_id') ?? $package_id == $package->id ? 'selected' : '' }}>
                                                        {{ $package->t('name') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.seats')</label>
                                            <input name="seats" type="number" class="form-control"
                                                   id="exampleInputEmail1" value="{{ old('seats') ?? $package_group->seats ?? $package->default_seats }}"
                                                   placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.whatsapp_group')</label>
                                            <input name="whatsapp_group" type="url" class="form-control"
                                                   id="exampleInputEmail1" value="{{ old('whatsapp_group') ?? $package_group->whatsapp_group }}"
                                                   placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="icheck-dark d-inline">
                                        <input name="is_active" type="checkbox" id="checkboxPrimary1"
                                            {{ old('is_active') == 'on' || $package_group->is_active ? 'checked' : '' }}>
                                        <label for="checkboxPrimary1">@lang('dashboard.Activate')</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Edit')</button>
                            </div>
                        </form>
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

@section('js_addons')
    <script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
            $('.select2').select2({
                language: {
                    searching: function() {}
                },
            });
        });
    </script>
@endsection
