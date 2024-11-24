@extends('dashboard.core.app')
@php use Illuminate\Support\Facades\Gate; @endphp
@section('title', __('titles.wallets'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.transactions')</h1>
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
                            <h3 class="card-title">@lang('dashboard.transactions')</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>@lang('dashboard.amount')</th>
                                    <th>@lang('dashboard.type')</th>
                                    <th>@lang('dashboard.from')</th>
                                    <th>@lang('dashboard.reason')</th>
                                    <th>@lang('dashboard.Operations')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($wallet->transactions as $key => $transaction)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{$transaction['amount']}}</td>
                                        <td>{{$transaction['type_value']}}</td>
                                        <td>{{$transaction['from']}}</td>
                                        <td>{{$transaction['reason']}}</td>
                                        <td>
                                            @if(Gate::allows('update-transaction',$transaction))
                                            <div class="operations-btns" style="">
                                                <a href="{{ route('transactions.edit', $transaction['id']) }}" class="btn  btn-dark">@lang('dashboard.Edit')</a>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    @include('dashboard.core.includes.no-entries', ['columns' => 6])
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
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
