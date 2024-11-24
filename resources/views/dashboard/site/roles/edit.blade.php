@extends('dashboard.core.app')
@section('title', __('titles.Edit Role'))

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
                        <form action="{{ route('roles.update' , $role['id']) }}" method="post" autocomplete="off"
                              enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">@lang('titles.Edit Role')</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label
                                            for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.ar')</label>
                                        <input name="display_name_ar" type="text" class="form-control"
                                               id="exampleInputName1"
                                               value="{{ $role['display_name_ar'] ?? old('display_name_ar') }}"
                                               placeholder="">
                                    </div>

                                    <div class="form-group col-6">
                                        <label
                                            for="exampleInputName1">@lang('dashboard.Name') @lang('dashboard.en')</label>
                                        <input name="display_name_en" type="text" class="form-control"
                                               id="exampleInputName1"
                                               value="{{ $role['display_name_en'] ?? old('display_name_en')}}"
                                               placeholder="">
                                    </div>
                                </div>



                                <br>

                                <h4>@lang('dashboard.Permissions')</h4>

                                <div class="form-group row">
                                    @foreach($permissions as $key => $permission)
                                        <div class="col-6">
                                            {{--                                            <select id="select" name="permissions[]" class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" data-select2-id="{{$key}}" tabindex="-1" aria-hidden="true">--}}
                                            {{--                                                @foreach($permission as $p)--}}
                                            {{--                                                @continue($loop->iteration == 1)--}}
                                            {{--                                                <option @if($role->hasPermission($key . '-' . $p))--}}
                                            {{--                                                    selected--}}
                                            {{--                                                    @endif--}}
                                            {{--                                                    value="{{$key . '-' . $p}}" >{{__('dashboard.' . $p )}}</option>--}}
                                            {{--                                                @endforeach--}}

                                            {{--                                            @foreach($permission as $p)--}}
                                            <input {{$role->hasPermission($permission->name)?'checked':''}} type="checkbox" name="permissions[]"
                                                   value="{{$permission->id}}" class="mr-3" id="{{$key}}"/>
                                            <label style="font-size: 20px" for="{{$key}}">{{$permission->display_name}} </label>
                                            <br>
                                            {{--                                            @endforeach--}}
                                            <hr>
                                            {{--                                            </select>--}}
                                        </div>

                                    @endforeach

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
                    searching: function () {
                    }
                },
            });
        });
    </script>
@endsection
