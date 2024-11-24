@extends('dashboard.core.app')
@section('title', __('dashboard.structure') . ' ' . __('dashboard.home'))

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
                    <h1>@lang('dashboard.structures')</h1>
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
                        <form action="{{ route('home-content.store') }}" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.structure') @lang('dashboard.home')</h3>
                            </div>
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('dashboard.structure') @lang('dashboard.home')</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputFile">@lang('dashboard.image')</label>
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input name="section1['image']" type="file"
                                                            class="custom-file-input" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputName1">@lang('dashboard.title1')</label>
                                                <input name="section1['title1_ar']" type="text" class="form-control"
                                                    id="exampleInputName1" value="{{ $structure->section1['title1_ar'] }}"
                                                    placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">@lang('dashboard.title2')</label>
                                                <input name="section1['title1_en']" type="text" class="form-control"
                                                    id="exampleInputEmail1" value="{{ $structure->section1['title1_en'] }}"
                                                    placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputName1">@lang('dashboard.title2')</label>
                                                <input name="section1['title2_ar']" type="text" class="form-control"
                                                    id="exampleInputName1" value="{{ $structure->section1['title2_ar'] }}"
                                                    placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">@lang('dashboard.title2')</label>
                                                <input name="section1['title2_en']" type="text" class="form-control"
                                                    id="exampleInputEmail1" value="{{ $structure->section1['title2_en'] }}"
                                                    placeholder="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputName1">@lang('dashboard.Description') @lang('dashboard.ar')</label>
                                                <textarea name="description_ar" type="text" class="form-control" id="exampleInputName1" placeholder="" required>{{ old('description_ar') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">@lang('dashboard.Description')
                                                    @lang('dashboard.en')</label>
                                                <textarea name="description_en" type="text" class="form-control" id="exampleInputEmail1" placeholder="" required>{{ old('description_en') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputName1">@lang('dashboard.title1')</label>
                                                <input name="section1['button_text_ar']" type="text"
                                                    class="form-control" id="exampleInputName1"
                                                    value="{{ $structure->section1['button_text_ar'] }}" placeholder=""
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">@lang('dashboard.title2')</label>
                                                <input name="section1['button_text_en']" type="text"
                                                    class="form-control" id="exampleInputEmail1"
                                                    value="{{ $structure->section1['button_text_en'] }}" placeholder=""
                                                    required>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputName1">@lang('dashboard.title1')</label>
                                                <input name="section1['title2_ar']" type="text" class="form-control"
                                                    id="exampleInputName1"
                                                    value="{{ $structure->section1['title2_ar'] }}" placeholder=""
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">@lang('dashboard.title2')</label>
                                                <input name="section1['title2_en']" type="text" class="form-control"
                                                    id="exampleInputEmail1"
                                                    value="{{ $structure->section1['title2_en'] }}" placeholder=""
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputName1">@lang('dashboard.title2')</label>
                                                <input name="section2['title2_ar']" type="text" class="form-control"
                                                    id="exampleInputName1"
                                                    value="{{ $structure->section2['title2_ar'] }}" placeholder=""
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">@lang('dashboard.title2')</label>
                                                <input name="section2['title2_en']" type="text" class="form-control"
                                                    id="exampleInputEmail1"
                                                    value="{{ $structure->section2['title2_en'] }}" placeholder=""
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputName1">@lang('dashboard.Description')
                                                    @lang('dashboard.ar')</label>
                                                <textarea name="description_ar" type="text" class="form-control" id="exampleInputName1" placeholder="" required>{{ old('description_ar') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">@lang('dashboard.Description')
                                                    @lang('dashboard.en')</label>
                                                <textarea name="description_en" type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                                    required>{{ old('description_en') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputName1">@lang('dashboard.title1')</label>
                                                <input name="section2['button_text_ar']" type="text"
                                                    class="form-control" id="exampleInputName1"
                                                    value="{{ $structure->section2['button_text_ar'] }}" placeholder=""
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">@lang('dashboard.title2')</label>
                                                <input name="section2['button_text_en']" type="text"
                                                    class="form-control" id="exampleInputEmail1"
                                                    value="{{ $structure->section2['button_text_en'] }}" placeholder=""
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
@endsection
