@extends('dashboard.core.app')
@section('title', __('dashboard.Edit') . ' ' . __('dashboard.package'))

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
                    <h1>@lang('dashboard.packages')</h1>
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
                        <form action="{{ route('packages.update', $package) }}" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.Edit') @lang('dashboard.package')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="exampleInputFile">@lang('dashboard.Image')</label>
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="image" type="file" class="custom-file-input"
                                                        id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2"><img src="{{ $package->image }}" width="100px" /></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.Name')</label>
                                            <input name="name_ar" type="text" class="form-control" id="exampleInputName1"
                                                value="{{ old('name_ar') ?? $package->name_ar }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.Name')</label>
                                            <input name="name_en" type="text" class="form-control" id="exampleInputName1"
                                                value="{{ old('name_en') ?? $package->name_en }}" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.Description') @lang('dashboard.ar')</label>
                                            <textarea name="description_ar" type="text" class="form-control" id="exampleInputName1" placeholder="" required>{{ old('description_ar') ?? $package->description_ar }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.Description') @lang('dashboard.en')</label>
                                            <textarea name="description_en" type="text" class="form-control" id="exampleInputEmail1" placeholder="" required> {{ old('description_en') ?? $package->description_en }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.package_category')</label>
                                            <select name="package_category_id" class="form-control" required>
                                                <option value="">@lang('dashboard.select')</option>
                                                @foreach ($package_categories as $package_category)
                                                    <option
                                                        value="{{ $package_category->id }}"{{ old('package_category_id') ?? $package->package_category_id == $package_category->id ? 'selected' : '' }}>
                                                        {{ $package_category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.educational_stage')</label>
                                            <select name="educational_stage_id" class="form-control" required>
                                                <option value="">@lang('dashboard.select')</option>

                                                @foreach ($educational_stages as $educational_stage)
                                                    <option
                                                        {{ old('educational_stage_id') ?? $package->educational_stage_id == $educational_stage->id ? 'selected' : '' }}
                                                        value="{{ $educational_stage->id }}">
                                                        {{ $educational_stage->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.subject')</label>
                                            <select name="subject_id" class="form-control" required>
                                                <option value="">@lang('dashboard.select')</option>
                                                @foreach ($subjects as $subject)
                                                    <option
                                                        {{ (old('subject_id') ?? $package->subject_id) == $subject->id ? 'selected' : '' }}
                                                        value="{{ $subject->id }}">
                                                        {{ $subject->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.start_at')</label>
                                            <input name="start_at" type="date" class="form-control"
                                                id="exampleInputName1" value="{{ old('start_at') ?? $package->start_at }}"
                                                placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.default_seats')</label>
                                            <input name="default_seats" type="number" class="form-control"
                                                id="exampleInputEmail1"
                                                value="{{ old('default_seats') ?? $package->default_seats }}"
                                                placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.hours')</label>
                                            <input name="hours" type="number" min="0.5" step="0.5" class="form-control"
                                                id="exampleInputName1" value="{{ old('hours') ?? $package->hours }}"
                                                placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.price')</label>
                                            <input name="price" type="number" min="1" step="0.5" class="form-control"
                                                id="exampleInputEmail1"
                                                value="{{ old('price') ?? $package->price }}"
                                                placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.duration_days')</label>
                                            <input name="duration_days" type="number" min="1" class="form-control"
                                                id="exampleInputEmail1"
                                                value="{{ old('duration_days') ?? $package->duration_days }}"
                                                placeholder="" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <input name="is_active" type="hidden" value="off">
                                    <div class="icheck-dark d-inline">
                                        <input name="is_active" type="checkbox" id="checkboxPrimary1"
                                            {{ old('is_active') == 'on' ? 'checked' : ($package->is_active ? 'checked' : '') }}>
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
