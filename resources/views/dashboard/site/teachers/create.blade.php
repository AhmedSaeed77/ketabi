@extends('dashboard.core.app')
@section('title', __('dashboard.Create') . ' ' . __('dashboard.user'))

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
                    <h1>{{__('dashboard.teacher') }}</h1>
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
                        <form action="{{ route('teachers.store') }}" method="post" autocomplete="off"
                              enctype="multipart/form-data">
                            <div class="card-header">
                                <h3 class="card-title">{{ __('dashboard.Create') . ' ' . __('dashboard.teacher') }}</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <input hidden="" name="type" value="teacher">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.Name')</label>
                                            <input name="name" type="text" class="form-control" id="exampleInputName1"
                                                   value="{{ old('name') }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.Email')</label>
                                            <input name="email" type="email" class="form-control"
                                                   id="exampleInputEmail1" value="{{ old('email') }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.Phone')</label>
                                            <input name="phone" type="text" class="form-control" id="exampleInputEmail1"
                                                   value="{{ old('phone') }}" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">@lang('dashboard.Image') <span
                                            class="optional">@lang('dashboard.optional')</span></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="image" type="file" class="custom-file-input"
                                                   id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">@lang('dashboard.cv_pdf') <span
                                            class="optional">@lang('dashboard.optional')</span></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="cv" type="file" class="custom-file-input"
                                                   id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.cv_description')</label>
                                            <textarea name="bio" class="form-control"
                                                      value="{{ old('bio') }}"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">@lang('dashboard.Password')</label>
                                            <input name="password" type="password" class="form-control"
                                                   id="exampleInputPassword1" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label
                                                for="exampleInputPassword2">@lang('dashboard.Confirm Password')</label>
                                            <input name="password_confirmation" type="password" class="form-control"
                                                   id="exampleInputPassword2" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label for="select2">@lang('dashboard.subjects')</label>
                                    <select id="select2" name="subjects[]" class="select2 select2-hidden-accessible" multiple style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        @foreach($subjects as $item)
                                            <option @if(old('subjects') !== null && in_array($item['id'], old('subjects'))) selected @endif value="{{$item['id']}}">{{$item->t('name')}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label for="select1">@lang('dashboard.educational_stages')</label>
                                    <select id="select1" name="stages[]" class="select2 select2-hidden-accessible" multiple style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        @foreach($educational_stages as $item)
                                            <option @if(old('stages') !== null && in_array($item['id'], old('stages'))) selected @endif value="{{$item['id']}}">{{$item->t('name')}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <label for="banks">@lang('dashboard.banks')</label>
                                    <select id="banks" name="bank_id" class="form-control"  style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        @foreach($banks as $item)
                                            <option @if(old('stages') !== null && in_array($item['id'], old('stages'))) selected @endif value="{{$item['id']}}">{{$item->t('name')}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputName1">@lang('dashboard.bank_account_name')</label>
                                            <input name="bank_account_name" type="text" class="form-control" id="exampleInputName1"
                                                   value="{{ old('bank_account_name') }}" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">@lang('dashboard.bank_account_number')</label>
                                            <input name="bank_account_number" type="number" class="form-control"
                                                   id="exampleInputEmail1" value="{{ old('bank_account_number') }}" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group clearfix">
                                    <div class="icheck-dark d-inline">
                                        <input name="is_active" type="checkbox"
                                               id="checkboxPrimary1" {{ old('is_active') == 'on' ? 'checked' : '' }}>
                                        <label for="checkboxPrimary1">@lang('dashboard.Activate')</label>
                                    </div>
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
@section('js_adons')

    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#select2').select2({
                language: {
                    searching: function () {
                        // Your custom searching logic for select2
                    }
                },
            });

            $('#select1').select2({
                language: {
                    searching: function () {
                        // Your custom searching logic for select1
                    }
                },
            });
        });
    </script>
@endsection
