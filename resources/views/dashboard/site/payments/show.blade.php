@extends('dashboard.core.app')
@section('title', __('titles.payment Details'))

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.payments')</h1>
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
                            <h3 class="card-title">@lang('dashboard.payments')</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.Name')</span>
                                            <span class="info-box-number text-center mb-0">{{$payment->user->name}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.Amount')</span>
                                            <span class="info-box-number text-center mb-0">{{$payment->amount}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.type')</span>
                                            <span class="info-box-number text-center mb-0">{{$payment->method}}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.status')</span>
                                            <span class="info-box-number text-center mb-0">{{$payment->statusType}}</span>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="info-box bg-dark">
                                        <div class="info-box-content">
                                            <span class="info-box-text text-center">@lang('dashboard.created_at')</span>
                                            <span class="info-box-number text-center mb-0">{{$payment->created_at->diffForHumans()}}</span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">@lang('dashboard.subscriptions')</h3>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>@lang('dashboard.Name')</th>
                                            <th>@lang('dashboard.package')</th>
                                            <th>@lang('dashboard.amount_paid')</th>
                                            <th>@lang('dashboard.Ends At')</th>
                                            <th>@lang('dashboard.created_at')</th>
                                            <th>@lang('dashboard.active')</th>
                                            <th>@lang('dashboard.Operations')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($payment->subscriptions as $key => $subscription)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{$subscription->user->name}}</td>
                                                <td>{{$subscription->learnable->t('name')}}</td>
                                                <td>{{$subscription->paid_amount}}</td>
                                                <td>{{$subscription->ends_at}}</td>
                                                <td>{{$subscription->created_at->diffForHumans()}}</td>
                                                <td>
                                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input type="checkbox" {{$subscription->is_active=='1'?'checked':''}} class="custom-control-input status-toggle" id="customSwitch{{ $subscription->id }}" data-item-id="{{ $subscription->id }}">
                                                        <label class="custom-control-label" for="customSwitch{{ $subscription->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="operations-btns" style="">
                                                        @permission('subscriptions-update')
                                                        <a href="{{ route('subscriptions.edit', $subscription->id) }}"
                                                           class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                                        @endpermission
                                                        @if(auth()->user()->hasPermission('subscriptions-delete'))
                                                            <button class="btn btn-danger waves-effect waves-light" data-toggle="modal" data-target="#delete-modal{{$key}}">@lang('dashboard.Delete')</button>
                                                            <div id="delete-modal{{$key}}" class="modal fade modal2 " tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                                <div class="modal-dialog">
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
                                                                            <form action="{{route('subscriptions.destroy' , $subscription['id'])}}" method="post">
                                                                                @csrf
                                                                                {{method_field('DELETE')}}
                                                                                <button type="submit" class="btn btn-danger">@lang('dashboard.Delete')</button>
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
                                </div>

                            </div>


                        </div>
                        <!-- /.card-body -->
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
                    url: "{{ route('toggleSubscription') }}", // Replace with your actual route
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
