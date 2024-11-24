@extends('dashboard.core.app')
@section('title', __('titles.file'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.file')</h1>
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
                        <div class="card-header">
                            <h3 class="card-title">@lang('dashboard.files')</h3>
                            @permission('manager_files-create')
                            <div class="card-tools">
                                <a href="{{ route('manager-files.create') }}" class="btn  btn-dark">@lang('dashboard.Create')</a>
                            </div>
                            @endpermission
                        </div>
                        <div class="card-body">

                            <form action="{{route('manager-files.index')}}">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <input value="{{request('search') ?? ""}}" name="search" type="search" class="form-control" placeholder="@lang('dashboard.search_with_phone_number_or_name_or_email')">
                                    </div>
                                    <div class="form-group col-3">
                                        <button type="submit" class="btn btn-dark">@lang('dashboard.filter')</button>
                                    </div>
                                </div>
                            </form>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.Name Ar')</th>
                                    <th>@lang('dashboard.file')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($files as $file)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $file->name }}</td>
                                        <td><a href="{{ url($file->file) }}" target="_blank" >@lang('dashboard.show') @lang('dashboard.file')</a></td>
                                        <td>
                                            <div class="operations-btns" style="">
                                                @permission('favourites-read')
                                                        <a href="{{ route('favourites.index', ['id' => $file->id, 'type' => 'ManagerFile']) }}"
                                                            class="btn  btn-dark">@lang('dashboard.favourites')</a>
                                                    @endpermission
                                                @permission('manager_files-update')
                                                <a href="{{ route('manager-files.edit', $file->id) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                @endpermission
                                                @if (auth()->user()->hasPermission('manager_files-delete') && Gate::allows('delete-file', $file))

                                                <button class="btn btn-dark waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$loop->iteration}}">@lang('dashboard.delete')</button>
                                                <div id="delete-modal{{$loop->iteration}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">                                                    <div class="modal-dialog">
                                                        <div class="modal-content float-left">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">@lang('dashboard.confirm_delete')</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>@lang('dashboard.sure_delete')</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal" class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                    @lang('dashboard.close')
                                                                </button>
                                                                <form action="{{route('manager-files.destroy' , $file->id)}}" method="post">
                                                                    @csrf
                                                                    {{method_field('delete')}}
                                                                    <button type="submit" class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endpermission

                                                {{-- <a target="_blank" href="{{ route('manager-files.loginFromAdmin', $file->id) }}" class="btn  btn-success">@lang('dashboard.Login')</a> --}}

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    @include('dashboard.core.includes.no-entries', ['columns' => 5])
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $files->appends(request()->all())->links() }}
                        </div>
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
