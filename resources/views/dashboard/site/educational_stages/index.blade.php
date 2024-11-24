@php use Illuminate\Support\Facades\Gate; @endphp
@extends('dashboard.core.app')
@section('title', __('titles.educational_stages'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.educational_stage')</h1>
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
                            <h3 class="card-title">@lang('dashboard.educational_stage')</h3>
                            @permission('educational_stages-create')
                                <div class="card-tools">
                                    <a href="{{ route('educational-stages.create') }}"
                                        class="btn  btn-dark">@lang('dashboard.Create')</a>
                                </div>
                            @endpermission

                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="myTable">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>@lang('dashboard.Name Ar')</th>
                                        <th>@lang('dashboard.Name En')</th>
                                        <th>@lang('dashboard.active')</th>
                                        <th>@lang('dashboard.Operations')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($educational_stages as $educational_stage)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $educational_stage->name_ar }}</td>
                                            <td>{{ $educational_stage->name_en }}</td>
                                            <td>
                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                    <input type="checkbox" {{$educational_stage->is_active=='1'?'checked':''}} class="custom-control-input status-toggle" id="customSwitch{{ $educational_stage->id }}" data-item-id="{{ $educational_stage->id }}">
                                                    <label class="custom-control-label" for="customSwitch{{ $educational_stage->id }}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="operations-btns" style="">
                                                    @permission('educational_stages-update')
                                                        <a href="{{ route('educational-stages.edit', $educational_stage->id) }}"
                                                            class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                    @endpermission
                                                    @if(Gate::allows('delete-educational-stage',$educational_stage))

                                                    @permission('educational_stages-delete')
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
                                                                            action="{{ route('educational-stages.destroy', $educational_stage->id) }}"
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
                                                    @endpermission
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        @include('dashboard.core.includes.no-entries', ['columns' => 5])
                                    @endforelse
                                </tbody>
                            </table>
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
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>

<script>
    $(document).ready(function () {
        $('.status-toggle').on('change', function () {
            var itemId = $(this).data('item-id');
            var status = $(this).prop('checked') ? '1' : '0';

            $.ajax({
                url: "{{ route('toggleEducationStage') }}", // Replace with your actual route
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
