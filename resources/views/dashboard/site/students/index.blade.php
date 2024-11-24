@php use Illuminate\Support\Facades\Gate; @endphp
@extends('dashboard.core.app')
@section('title', __('dashboard.users'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.students')</h1>
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
                            <h3 class="card-title">@lang('dashboard.students')</h3>
                            @permission('students-create')
                                <div class="card-tools">
                                    <a href="{{ route('students.create') }}"
                                        class="btn  btn-dark">@lang('dashboard.Create')</a>
                                </div>
                            @endpermission
                        </div>
                        <div class="card-body">
                            <table id="myTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th style="width: 50px;">@lang('dashboard.Image')</th>
                                        <th>@lang('dashboard.Name')</th>
                                        <th>@lang('dashboard.Email')</th>
                                        <th>@lang('dashboard.educational_stage')</th>
                                        <th>@lang('dashboard.active')</th>
                                        <th>@lang('dashboard.Operations')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($user->image !== null)
                                                    <img src="{{ url($user->image) }}" style="width: 50px;" />
                                                @endif
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{$user->studentStage->name}}</td>
                                            <td>
                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                    <input type="checkbox" {{$user->is_active=='1'?'checked':''}} class="custom-control-input status-toggle" id="customSwitch{{ $user->id }}" data-item-id="{{ $user->id }}">
                                                    <label class="custom-control-label" for="customSwitch{{ $user->id }}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="operations-btns" style="">

                                                    @permission('students-read')
                                                        <a href="{{ route('students.show', [ $user->id]) }}"
                                                            class="btn  btn-dark">@lang('dashboard.Show')</a>
                                                    @endpermission
                                                    @permission('students-update')
                                                        <a href="{{ route('students.edit', [ $user->id]) }}"
                                                            class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                    @endpermission
                                                    @if (auth()->user()->hasPermission('students-delete') )
                                                        <button class="btn btn-danger waves-effect waves-light"
                                                            data-toggle="modal"
                                                            data-target="#delete-modal{{ $loop->iteration }}">@lang('dashboard.delete')</button>
                                                        <div id="delete-modal{{ $loop->iteration }}"
                                                            class="modal fade modal2 " tabindex="-1" role="dialog"
                                                            aria-labelledby="myModalLabel" aria-hidden="true"
                                                            style="display: none;">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content float-left">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">@lang('dashboard.confirm_delete')</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>@lang('dashboard.sure_delete')</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" data-dismiss="modal"
                                                                            class="btn btn-dark waves-effect waves-light m-l-5 mr-1 ml-1">
                                                                            @lang('dashboard.close')
                                                                        </button>
                                                                        <form
                                                                            action="{{ route('students.destroy', [ $user->id]) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            {{ method_field('delete') }}
                                                                            <button type="submit"
                                                                                class="btn btn-danger">@lang('dashboard.Delete')</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        @include('dashboard.core.includes.no-entries', ['columns' => 6])
                                    @endforelse
                                </tbody>
                            </table>
                                {{$users->links()}}
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
@section('js_addons')
    <script>
        $(document).ready(function () {
            $('.status-toggle').on('change', function () {
                var itemId = $(this).data('item-id');
                var status = $(this).prop('checked') ? '1' : '0';

                $.ajax({
                    url: "{{ route('toggleStudent') }}", // Replace with your actual route
                    type: "GET", // or "GET" depending on your server setup
                    data: {
                        itemId: itemId,
                        status: status,
                        // Add any additional data you want to send with the request
                    },
                    success: function (data) {
                        toastr.success('@lang('messages.updated_successfully')');
                        // console.log(data); // Handle success response
                    },
                    error: function (xhr, status, error) {
                        console.error(error); // Handle error response
                    }
                });
            });
        });
    </script>
@endsection
