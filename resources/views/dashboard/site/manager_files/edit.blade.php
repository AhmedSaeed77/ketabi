@extends('dashboard.core.app')
@section('title', __('titles.Edit file'))

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
                    <h1>@lang('dashboard.files')</h1>
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
                        <form action="{{ route('manager-files.update', $file) }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('titles.Edit file')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.Name')</label>
                                            <input name="name_ar" type="text" class="form-control" id="exampleInputName1" value="{{ old('name_ar') ?? $file->name_ar }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.Name')</label>
                                            <input name="name_en" type="text" class="form-control" id="exampleInputName1" value="{{  old('name_en') ?? $file->name_en }}" placeholder="">
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.Description') @lang('dashboard.ar')</label>
                                            <textarea name="description_ar" type="text" class="form-control" id="exampleInputName1" placeholder="" required>{{ $file->description_ar }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.Description') @lang('dashboard.en')</label>
                                            <textarea name="description_en" type="text" class="form-control" id="exampleInputEmail1" placeholder="" required>{{ $file->description_en }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.pages_count')</label>
                                            <input name="pages_count" type="number" class="form-control"
                                                id="exampleInputName1" value="{{ $file->pages_count }}" placeholder=""
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.price')</label>
                                            <input name="price" type="number" class="form-control"
                                                id="exampleInputEmail1" value="{{ $file->price }}"
                                                placeholder="{{ __('dashboard.if_not_free_put_price') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input name="show_in_profile" type="checkbox" id="checkboxPrimary2"
                                                    {{ $file->show_in_profile == 'on' ? 'checked' : '' }}>
                                                <label for="checkboxPrimary2">@lang('dashboard.show_in_profile')</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input name="show_in_package" type="checkbox" id="show_in_package"
                                                    {{ $file->show_in_package == 'on' ? 'checked' : '' }}>
                                                <label for="show_in_package">@lang('dashboard.show_in_package')</label>
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
        $(function () {
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
                                                        {{ old('package_id') == $package->id ? 'selected' : '' }}>
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
