@extends('dashboard.core.app')
@section('title', __('titles.Create Role'))

@section('css_addons')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.roles_and_permissions')</h1>
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
                        <form action="{{ route('roles.store') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('titles.Create Role')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.ar')</label>
                                        <input name="display_name_ar" type="text" class="form-control" id="exampleInputName1" value="{{ old('display_name_ar') }}" placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.en')</label>
                                        <input name="display_name_en" type="text" class="form-control" id="exampleInputName1" value="{{ old('display_name_en') }}" placeholder="">
                                    </div>
                                </div>
                                <br>

                                <h4>@lang('dashboard.Permissions')</h4>

                                <div class="form-group row">
                                    @foreach($permissions as $key => $permission)
                                        <div class="col-6">
                                            <input type="checkbox" id="{{$key}}" name="permissions[]"
                                                   value="{{$permission->id}}" class="mr-3"/>
                                            <label style="font-size: 20px" for="{{$key}}">{{$permission->display_name}} </label>
                                            <br>
                                            <hr>
                                        </div>

                                    @endforeach

                                </div>

                                <div class="row">
{{--                                    @foreach($permissions as $key => $permission)--}}
{{--                                        <div class="form-group" data-select2-id="67">--}}
{{--                                            <label for="select">{{__('dashboard.' . $key)}}</label>--}}
{{--                                            <select id="select" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">--}}
{{--                                                @foreach($permission as $p)--}}
{{--                                                    @continue($loop->iteration == 1)--}}
{{--                                                    <option >{{__('dashboard.' . $p )}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="8" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false"><ul class="select2-selection__rendered"><li class="select2-selection__choice" title="California" data-select2-id="79"><span class="select2-selection__choice__remove" role="presentation">×</span>California</li><li class="select2-selection__choice" title="Tennessee" data-select2-id="80"><span class="select2-selection__choice__remove" role="presentation">×</span>Tennessee</li><li class="select2-search select2-search--inline"><input class="select2-search__field" type="search" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="none" spellcheck="false" role="searchbox" aria-autocomplete="list" placeholder="" style="width: 0.75em;"></li></ul></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>--}}
{{--                                        </div>--}}

{{--                                        <div class="form-group col-6">--}}
{{--                                            <label for="select">{{__('dashboard.' . $key)}}</label>--}}
{{--                                            <select id="select" name="field_id" class="form-control select2 select2-hidden-accessible" style="width: 100%;">--}}
{{--                                                @foreach($permission as $p)--}}
{{--                                                    @continue($loop->iteration == 1)--}}
{{--                                                    <option >{{__('dashboard.' . $p )}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
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
        $(function () {
            bsCustomFileInput.init();
            $('.select2').select2({
                language: {
                    searching: function() {}
                },
            });
        });
    </script>
@endsection
