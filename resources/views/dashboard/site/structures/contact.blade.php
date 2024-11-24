@extends('dashboard.core.app')
@section('title', __('dashboard.content') . ' ' . __('dashboard.about'))

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
                    <h1>@lang('dashboard.info_control')</h1>
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
                        <form action="{{ route('contact-content.store') }}" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.content') @lang('dashboard.contact')</h3>
                            </div>
                            @csrf
                            <div class="card-body">
                                <!-- Hero Section -->
                                <div class="form-group">
                                    <label for="heroImage">@lang('dashboard.image') @lang('dashboard.contact')</label>
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="en[hero][image]" type="hidden" value="file_100">
                                                    <input name="ar[hero][image]" type="hidden" value="file_100">
                                                    <input name="file[100]" type="file" class="custom-file-input"
                                                        id="heroImage">
                                                    <input name="old_file[100]" type="hidden"
                                                        value="{{ $content['ar']['hero']['image'] ?? '' }}">
                                                    <label class="custom-file-label" for="heroImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <img src="{{ $content['ar']['hero']['image'] ?? '' }}" style="width: 60%"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.title') @lang('dashboard.hero_section')
                                                @lang('dashboard.ar')</label>
                                            <input name="ar[hero][title]" type="text" class="form-control"
                                                id="exampleInputName1" value="{{ $content['ar']['hero']['title'] ?? '' }}"
                                                placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title') @lang('dashboard.hero_section')
                                                @lang('dashboard.en')</label>
                                            <input name="en[hero][title]" type="text" class="form-control"
                                                id="exampleInputEmail1" value="{{ $content['en']['hero']['title'] ?? '' }}"
                                                placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent2">@lang('dashboard.description') @lang('dashboard.hero_section')
                                                @lang('dashboard.ar')</label>
                                            <input required name="ar[hero][description]"
                                                value="{{ $content['ar']['hero']['description'] ?? '' }}" type="text"
                                                class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.description') @lang('dashboard.hero_section')
                                                @lang('dashboard.en')</label>
                                            <input name="en[hero][description]"
                                                value="{{ $content['en']['hero']['description'] ?? '' }}" type="text"
                                                class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <!-- Hero Section -->


                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-dark">@lang('dashboard.Publish')</button>
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
