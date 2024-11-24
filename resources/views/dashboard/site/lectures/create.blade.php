@extends('dashboard.core.app')
@section('title', __('titles.Create lecture'))

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
                    <h1>@lang('dashboard.lectures')</h1>
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
                        <form action="{{ route('lectures.store') }}" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('titles.Create lecture')</h3>
                            </div>
                            <div class="card-body">
                                @csrf

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="exampleInputFile">@lang('dashboard.Image')</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="image" type="file" class="custom-file-input"
                                                        id="exampleInputFile">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">@lang('dashboard.minutes')</label>
                                                <input name="minutes" type="number" class="form-control"
                                                    id="exampleInputEmail1" value="{{ old('minutes') }}" placeholder=""
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.Name Ar')</label>
                                            <input name="name_ar" type="text" class="form-control" id="exampleInputName1"
                                                value="{{ old('name_ar') }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.Name En')</label>
                                            <input name="name_en" type="text" class="form-control"
                                                id="exampleInputEmail1" value="{{ old('name_en') }}" placeholder=""
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.platform')</label>
                                            <select name="platform" class="form-control" required>
                                                <option selected>@lang('dashboard.select')</option>
                                                <option {{ old('platform') == 'youtube' ? 'selected' : '' }} value="youtube">
                                                    @lang('dashboard.youtube')</option>
                                                <option {{ old('platform') == 'vimeo' ? 'selected' : '' }} value="vimeo">
                                                    @lang('dashboard.vimeo')</option>
                                                <option {{ old('platform') == 'zoom' ? 'selected' : '' }} value="zoom">
                                                    @lang('dashboard.zoom')</option>
                                                <option {{ old('platform') == 'swarmify' ? 'selected' : '' }}
                                                    value="swarmify">@lang('dashboard.swarmify')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.link')</label>
                                            <input name="link" type="text" class="form-control" id="exampleInputName1"
                                                value="{{ old('link') }}" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <div class="form-group clearfix mb-0">
                                            <div class="icheck-primary d-flex">
                                                <input name="is_live" type="checkbox" id="checkboxPrimary1"
                                                    {{ old('is_live') == 'on' ? 'checked' : '' }}>
                                                <label for="checkboxPrimary1">@lang('dashboard.live')</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input name="show_in_profile" type="checkbox" id="checkboxPrimary2"
                                                    {{ old('show_in_profile') == 'on' ? 'checked' : '' }}>
                                                <label for="checkboxPrimary2">@lang('dashboard.show_in_profile')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input name="show_in_package" type="checkbox" id="show_in_package"
                                                    {{ request('package_id') != null || old('show_in_package') == 'on' ? 'checked' : '' }}>
                                                <label for="show_in_package">@lang('dashboard.show_in_package')</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input name="is_active" type="checkbox" id="checkboxPrimary4"
                                                    {{ old('is_active') == 'on' ? 'checked' : '' }}>
                                                <label for="checkboxPrimary4">@lang('dashboard.Activate')</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row" id="package_inputs">

                                    {{-- Package Inputs Shows Here --}}

                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Create')</button>
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

    {{-- ================= Package Inputs Shows When Check Show In Pacage ============== --}}
    <script>
        $(document).ready(function() {
            var package_inputs = $('#package_inputs');

            // Function to append the HTML content
            function appendPackageInputs() {
                package_inputs.html(`
        <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.package')</label>
                                            <select name="package_id" class="form-control">
                                                <option>@lang('dashboard.select')</option>
                                                @foreach ($packages as $package)
                                                    <option value="{{ $package->id }}"
                                                        {{ request('package_id') == $package->id || old('package_id') == $package->id ? 'selected' : '' }}>
                                                        {{ $package->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.sort_in_package')</label>
                                            <input name="sort_in_package" type="number" class="form-control"
                                                id="exampleInputName1" value="{{ old('sort_in_package') }}"
                                                placeholder="" >
                                        </div>
                                    </div>
        `);
            }

            // Function to clear the appended content
            function clearPackageInputs() {
                package_inputs.empty();
            }

            // Initial check when the page loads
            if ($('#show_in_package').prop('checked')) {
                appendPackageInputs();
            }

            // Listen for changes in the "show_in_package" checkbox
            $('#show_in_package').on('change', function() {
                if ($(this).prop('checked')) {
                    appendPackageInputs();
                } else {
                    // Clear the appended content when unchecked
                    clearPackageInputs();
                }
            });
        });
    </script>
    {{-- ================================================================================ --}}

@endsection
