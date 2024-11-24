@extends('dashboard.core.app')
@section('title', __('dashboard.content') . ' ' . __('dashboard.home'))

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
                        <form action="{{ route('home-content.store') }}" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.content') @lang('dashboard.home')</h3>
                            </div>
                            @csrf
                            <div class="card-body">
                                <!-- Hero Section -->
                                <div class="form-group">
                                    <label for="heroImage">@lang('dashboard.image') @lang('dashboard.hero_section')</label>
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="en[hero][image]" type="hidden" value="file_100">
                                                    <input name="ar[hero][image]" type="hidden" value="file_100">
                                                    <input name="file[100]" type="file" class="custom-file-input" id="heroImage">
                                                    <input name="old_file[100]" type="hidden" value="{{ $content['ar']['hero']['image'] ?? '' }}">
                                                    <label class="custom-file-label" for="heroImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <img src="{{ $content['ar']['hero']['image'] ?? '' }}" style="width: 60%" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.title1') @lang('dashboard.hero_section') @lang('dashboard.ar')</label>
                                            <input name="ar[hero][title1]" type="text" class="form-control" id="exampleInputName1"
                                                value="{{ $content['ar']['hero']['title1'] ?? ''  }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title1') @lang('dashboard.hero_section') @lang('dashboard.en')</label>
                                            <input name="en[hero][title1]" type="text" class="form-control"
                                                id="exampleInputEmail1" value="{{$content['en']['hero']['title1'] ?? '' }}" placeholder=""
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.title2') @lang('dashboard.hero_section') @lang('dashboard.ar')</label>
                                            <input name="ar[hero][title2]" type="text" class="form-control" id="exampleInputName1"
                                                value="{{ $content['ar']['hero']['title2'] ?? ''  }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title2') @lang('dashboard.hero_section') @lang('dashboard.en')</label>
                                            <input name="en[hero][title2]" type="text" class="form-control"
                                                id="exampleInputEmail1" value="{{$content['en']['hero']['title2'] ?? '' }}" placeholder=""
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent2">@lang('dashboard.description') @lang('dashboard.hero_section') @lang('dashboard.ar')</label>
                                            <input required name="ar[hero][description]" value="{{$content['ar']['hero']['description'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.description') @lang('dashboard.hero_section') @lang('dashboard.en')</label>
                                            <input name="en[hero][description]" value="{{$content['en']['hero']['description'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.button') @lang('dashboard.hero_section') @lang('dashboard.ar')</label>
                                            <input name="ar[hero][button]" type="text" class="form-control" id="exampleInputName1"
                                                   value="{{ $content['ar']['hero']['button'] ?? ''  }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.button') @lang('dashboard.hero_section') @lang('dashboard.en')</label>
                                            <input name="en[hero][button]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['en']['hero']['button'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <!-- Hero Section -->

                                <hr>

                                <!-- About Section -->
                                <div class="form-group">
                                    <label for="aboutImage">@lang('dashboard.image') @lang('dashboard.about_section')</label>
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="en[about][image]" type="hidden" value="file_200">
                                                    <input name="ar[about][image]" type="hidden" value="file_200">
                                                    <input name="file[200]" type="file" class="custom-file-input" id="aboutImage">
                                                    <input name="old_file[200]" type="hidden" value="{{ $content['ar']['about']['image'] ?? '' }}">
                                                    <label class="custom-file-label" for="aboutImage">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <img src="{{ $content['ar']['about']['image'] ?? '' }}" style="width: 60%" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.title1') @lang('dashboard.about_section') @lang('dashboard.ar')</label>
                                            <input name="ar[about][title1]" type="text" class="form-control" id="exampleInputName1"
                                                   value="{{ $content['ar']['about']['title1'] ?? ''  }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title1') @lang('dashboard.about_section') @lang('dashboard.en')</label>
                                            <input name="en[about][title1]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['en']['about']['title1'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent2">@lang('dashboard.description') @lang('dashboard.about_section') @lang('dashboard.ar')</label>
                                            <input required name="ar[about][description]" value="{{$content['ar']['about']['description'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputContent1">@lang('dashboard.description') @lang('dashboard.about_section') @lang('dashboard.en')</label>
                                            <input name="en[about][description]" value="{{$content['en']['about']['description'] ?? ''}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.button') @lang('dashboard.about_section') @lang('dashboard.ar')</label>
                                            <input name="ar[about][button]" type="text" class="form-control" id="exampleInputName1"
                                                   value="{{ $content['ar']['about']['button'] ?? ''  }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.button') @lang('dashboard.about_section') @lang('dashboard.en')</label>
                                            <input name="en[about][button]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['en']['about']['button'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <!-- About Section -->

                                <hr>

                                <!-- Services Section -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.title1') @lang('dashboard.services_section') @lang('dashboard.ar')</label>
                                            <input name="ar[services][title1]" type="text" class="form-control" id="exampleInputName1"
                                                   value="{{ $content['ar']['services']['title1'] ?? ''  }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title1') @lang('dashboard.services_section') @lang('dashboard.en')</label>
                                            <input name="en[services][title1]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['en']['services']['title1'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.title2') @lang('dashboard.services_section') @lang('dashboard.ar')</label>
                                            <input name="ar[services][title2]" type="text" class="form-control" id="exampleInputName1"
                                                   value="{{ $content['ar']['services']['title2'] ?? ''  }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title2') @lang('dashboard.services_section') @lang('dashboard.en')</label>
                                            <input name="en[services][title2]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['en']['services']['title2'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div id="services">
                                    @foreach($content['ar']['services']['content'] ?? [] as $key => $service)
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input name="en[services][content][{{$key}}][icon]" type="hidden" value="file_{{ 500 + $key }}">
                                                    <input name="ar[services][content][{{$key}}][icon]" type="hidden" value="file_{{ 500 + $key }}">
                                                    <input name="file[{{ 500 + $key }}]" type="file" class="custom-file-input" id="exampleInputFile">
                                                    <input name="old_file[{{ 500 + $key }}]" type="hidden" value="{{$service['icon'] ?? ''}}">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <input required name="ar[services][content][{{$key}}][title]" value="{{$service['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                            </div>
                                            <div class="col-3">
                                                <input required name="en[services][content][{{$key}}][title]" value="{{$content['en']['services']['content'][$key]['title']}}" type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">
                                            </div>
                                            <div class="col-1">
                                                <img src="{{$service['icon'] ?? ''}}" style="width: 60%">
                                            </div>
                                            <div class="col-1">
                                                <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                                <div class="col-1">
                                    <div id="add_service" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
                                </div>
                                <!-- Services Section -->

                                <hr>

                                <!-- Packages Section -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.title') @lang('dashboard.packages_section') @lang('dashboard.ar')</label>
                                            <input name="ar[packages][title]" type="text" class="form-control" id="exampleInputName1"
                                                   value="{{ $content['ar']['packages']['title'] ?? ''  }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title') @lang('dashboard.packages_section') @lang('dashboard.en')</label>
                                            <input name="en[packages][title]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['en']['packages']['title'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.button') @lang('dashboard.packages_section') @lang('dashboard.ar')</label>
                                            <input name="ar[packages][button]" type="text" class="form-control" id="exampleInputName1"
                                                   value="{{ $content['ar']['packages']['button'] ?? ''  }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.button') @lang('dashboard.packages_section') @lang('dashboard.en')</label>
                                            <input name="en[packages][button]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['en']['packages']['button'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <!-- Packages Section -->

                                <hr>

                                <!-- Best Teachers Section -->
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.title') @lang('dashboard.best_teachers_section') @lang('dashboard.ar')</label>
                                            <input name="ar[best_teachers][title]" type="text" class="form-control" id="exampleInputName1"
                                                   value="{{ $content['ar']['best_teachers']['title'] ?? ''  }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.title') @lang('dashboard.best_teachers_section') @lang('dashboard.en')</label>
                                            <input name="en[best_teachers][title]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['en']['best_teachers']['title'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.button') @lang('dashboard.best_teachers_section') @lang('dashboard.ar')</label>
                                            <input name="ar[best_teachers][button]" type="text" class="form-control" id="exampleInputName1"
                                                   value="{{ $content['ar']['best_teachers']['button'] ?? ''  }}" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.button') @lang('dashboard.best_teachers_section') @lang('dashboard.en')</label>
                                            <input name="en[best_teachers][button]" type="text" class="form-control"
                                                   id="exampleInputEmail1" value="{{$content['en']['best_teachers']['button'] ?? '' }}" placeholder=""
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <!-- Best Teachers Section -->
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
    <script>
        $('.row').on('click', '.delete_content', function (e) {
            $(this).parent().parent().remove();
        });

        let key = {{ max(array_keys($content['ar']['services']['content'] ?? [0])) ?? 0 }} + 900;
        $('#add_service').on('click', function () {
            key++;
            const content = '' +
                '<div class="row">' +
                '<div class="col-4">' +
                '<div class="form-group">' +
                '<input name="en[services][content][' + key + '][icon]" type="hidden" value="file_' + key + '">' +
                '<input name="ar[services][content][' + key + '][icon]" type="hidden" value="file_' + key + '">' +
                '<input name="file[' + key + ']" type="file" class="custom-file-input" id="exampleInputFile">' +
                '<input name="old_file[' + key + ']" type="hidden">' +
                '<label class="custom-file-label" for="exampleInputFile">Choose file</label>' +'</div>' +
                '</div>' +
                '<div class="col-3">' +
                '<input required name="ar[services][content][' + key + '][title]"  type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '</div>' +
                '<div class="col-3">' +
                '<input required name="en[services][content][' + key + '][title]"  type="text" class="form-control" id="exampleInputMainTitle2" placeholder="">' +
                '</div>' +
                '<div class="col-1"></div>' +
                '<div class="col-1">' +
                '<div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                '</div>' +
                '</div>';

            $('#services').append(content);

        });
    </script>
@endsection
