@extends('dashboard.core.app')
@section('title', __('dashboard.Edit') . ' ' . __('dashboard.info_control'))

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
                    <h1>{{  __('dashboard.info_control') }}</h1>
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
                        <form action="{{ route('infos.update') }}" method="post" autocomplete="off"
                              enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('dashboard.Edit') . ' ' . __('dashboard.info_control') }}</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                @forelse($text as $item)
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="exampleInputName1">{{$item->name}}</label>
                                                <input name="text[{{$item->key}}]" type="text" class="form-control" id="exampleInputName1"
                                                       value="{{$item->value}}" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                                @forelse($images as $item)
                                    <div class="form-group">
                                        <label for="exampleInputFile">{{$item->name}}</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input name="images[{{$item->key}}]" type="file" class="custom-file-input"
                                                       id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                                @if($item->value)
                                                    <img src="{{asset($item->value)}}" width="auto" height="80px">
                                                @endif
                                        </div>
                                    </div>
                                @empty
                                @endforelse


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
@endsection
