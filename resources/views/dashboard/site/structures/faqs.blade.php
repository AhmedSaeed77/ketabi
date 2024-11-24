@extends('dashboard.core.app')
@section('title', __('dashboard.content') . ' ' . __('dashboard.faqs'))

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
                        <form action="{{ route('faqs-content.store') }}" method="post" autocomplete="off"
                            enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('dashboard.content') @lang('dashboard.faqs')</h3>
                            </div>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image">@lang('dashboard.image')</label>
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="en[image]" type="hidden" value="file_1">
                                                    <input name="ar[image]" type="hidden" value="file_1">
                                                    <input name="file[1]" type="file" class="custom-file-input" id="image">
                                                    <input name="old_file[1]" type="hidden" value="{{ $content['ar']['image'] ?? '' }}">
                                                    <label class="custom-file-label" for="image">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <img src="{{ $content['ar']['image'] ?? '' }}" style="width: 60%" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div id="questions">
                                    @foreach($content['ar']['questions'] ?? [] as $key => $question)
                                        <div class="row">
                                            <div class="col-11 row">
                                                <div class="col-6">
                                                    <label for="faqsQuestionAr{{$loop->iteration}}">{{ __('dashboard.Faqs Question') }} @lang('dashboard.ar')</label>
                                                    <input required name="ar[questions][{{$key}}][question]" value="{{$content['ar']['questions'][$key]['question']}}" type="text" class="form-control" id="faqsQuestionAr{{$loop->iteration}}" placeholder="">
                                                </div>
                                                <div class="col-6">
                                                    <label for="faqsQuestionEn{{$loop->iteration}}">{{ __('dashboard.Faqs Question') }} @lang('dashboard.en')</label>
                                                    <input required name="en[questions][{{$key}}][question]" value="{{$content['en']['questions'][$key]['question']}}" type="text" class="form-control" id="faqsQuestionEn{{$loop->iteration}}" placeholder="">
                                                </div>
                                                <div class="col-6">
                                                    <label for="faqsAnswerAr{{$loop->iteration}}">{{ __('dashboard.Faqs Answer') }} @lang('dashboard.ar')</label>
                                                    <textarea name="ar[questions][{{$key}}][answer]" class="form-control" id="faqsAnswerAr{{$loop->iteration}}" rows="2">{{$content['ar']['questions'][$key]['answer']}}</textarea>
                                                </div>
                                                <div class="col-6">
                                                    <label for="faqsAnswerEn{{$loop->iteration}}">{{ __('dashboard.Faqs Answer') }} @lang('dashboard.en')</label>
                                                    <textarea name="en[questions][{{$key}}][answer]" class="form-control" id="faqsAnswerEn{{$loop->iteration}}" rows="2">{{$content['en']['questions'][$key]['answer']}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach

                                </div>
                                <div class="col-1">
                                    <div id="add_question" style="cursor: pointer;"><i style="color: green" class="nav-icon fas fa-plus-circle"></i></div>
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

        let key = {{ max(array_keys($content['ar']['questions'] ?? [0])) ?? 0 }} + 900;
        $('#add_question').on('click', function () {
            key++;
            const content = '' +
                '<div class="row">' +
                '    <div class="col-11 row">' +
                '        <div class="col-6">' +
                '            <label for="faqsQuestionAr' + key + '">{{ __('dashboard.Faqs Question') }} @lang('dashboard.ar')</label>' +
                '            <input required name="ar[questions][' + key + '][question]" type="text" class="form-control" id="faqsQuestionAr' + key + '" placeholder="">' +
                '        </div>' +
                '        <div class="col-6">' +
                '            <label for="faqsQuestionEn' + key + '">{{ __('dashboard.Faqs Question') }} @lang('dashboard.en')</label>' +
                '            <input required name="en[questions][' + key + '][question]" type="text" class="form-control" id="faqsQuestionEn' + key + '" placeholder="">' +
                '        </div>' +
                '        <div class="col-6">' +
                '            <label for="faqsAnswerAr' + key + '">{{ __('dashboard.Faqs Answer') }} @lang('dashboard.ar')</label>' +
                '            <textarea name="ar[questions][' + key + '][answer]" class="form-control" id="faqsAnswerAr' + key + '" rows="2"></textarea>' +
                '        </div>' +
                '        <div class="col-6">' +
                '            <label for="faqsAnswerEn' + key + '">{{ __('dashboard.Faqs Answer') }} @lang('dashboard.en')</label>' +
                '            <textarea name="en[questions][' + key + '][answer]" class="form-control" id="faqsAnswerEn' + key + '" rows="2"></textarea>' +
                '        </div>' +
                '    </div>' +
                '    <div class="col-1">' +
                '        <div class="delete_content" style="cursor: pointer;"><i style="color:red" class="nav-icon fas fa-minus-circle"></i></div>' +
                '    </div>' +
                '</div><hr>' +
                '';

            $('#questions').append(content);

        });
    </script>
@endsection
