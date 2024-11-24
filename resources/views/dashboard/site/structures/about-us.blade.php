@extends('dashboard.core.app')
@section('title', __('dashboard.content') . ' ' . __('dashboard.About Us'))

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
                    <h1>@lang('dashboard.About Us')</h1>
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
                        <form action="{{ route('about-us-content.store') }}" method="post" autocomplete="off"
                              enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.About Us')</h3>
                            </div>
                            @csrf
                            <div class="card-body" id="about">
                                <!-- Hero Section -->
                                @if(isset($content['en']))
                                    @foreach($content['en'] as $index => $item)
                                        <div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputName1">@lang('dashboard.title')
                                                            @lang('dashboard.ar')</label>
                                                        <input name="ar[{{$index}}][title]" type="text"
                                                               class="form-control"
                                                               id="exampleInputName1"
                                                               value="{{ $content['ar'][$index]['title'] ?? '' }}"
                                                               placeholder="" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">@lang('dashboard.title')
                                                            @lang('dashboard.en')</label>
                                                        <input name="en[{{$index}}][title]" type="text"
                                                               class="form-control"
                                                               id="exampleInputEmail1"
                                                               value="{{ $content['en'][$index]['title'] ?? '' }}"
                                                               placeholder="" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent2">@lang('dashboard.description') @lang('dashboard.ar')</label>
                                                        <textarea required name="ar[{{$index}}][description]" class="form-control summernote"
                                                                  placeholder="">{{ $content['ar'][$index]['description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputContent1">@lang('dashboard.description') @lang('dashboard.en')</label>
                                                        <textarea required name="en[{{$index}}][description]" class="form-control summernote"
                                                                  placeholder="">{{ $content['en'][$index]['description'] ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="delete_content" style="cursor: pointer;"><i
                                                        style="color:red" class="nav-icon fas fa-minus-circle"></i>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-1">
                                <div id="add_about" style="cursor: pointer;"><i style="color: green"
                                                                                class="nav-icon fas fa-plus-circle"></i>
                                </div>
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
        $(function () {

            // $('#summernote').summernote();
            $(document).ready(function() {
                $('.summernote').each(function() {
                    $(this).summernote();
                });
            });
            bsCustomFileInput.init();
        });
        $('.row').on('click', '.delete_content', function (e) {
            $(this).parent().parent().remove();
        });
        let index = {{ isset($content['en']) ? max(array_keys($content['en'])) : 0 }};
        $(document).ready(function () {
            $('#add_about').click(function () {
                index++
                var newAchievement = ` <div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputName1">@lang('dashboard.title')
                @lang('dashboard.ar')</label>
                                                    <input name="ar[${index}][title]" type="text" class="form-control"
                                                           id="exampleInputName1" value=""
                                                           placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">@lang('dashboard.title')
                @lang('dashboard.en')</label>
                                                    <input name="en[${index}][title]" type="text" class="form-control"
                                                           id="exampleInputEmail1" value=""
                                                           placeholder="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputContent2">@lang('dashboard.description')
                @lang('dashboard.ar')</label>
                                                    <textarea required name="ar[${index}][description]" class="form-control" id="summernote${index}"
                                                              placeholder=""></textarea>

                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="exampleInputContent1">@lang('dashboard.description')
                @lang('dashboard.en')</label>
                                                    <textarea required name="en[${index}][description]" class="form-control" id="summernote${index+1000}"
                                                              placeholder=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-1">
                                            <div class="delete_content" style="cursor: pointer;"><i
                                                    style="color:red" class="nav-icon fas fa-minus-circle"></i>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>`;
                $('#about').append(newAchievement);
                $(`#summernote${index}`).summernote();
                $(`#summernote${index+1000}`).summernote();

            });
        });
    </script>
@endsection
