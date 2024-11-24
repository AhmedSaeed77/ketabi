@extends('dashboard.core.app')
@section('title', __('dashboard.package_reviews'))
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.package_reviews')</h1>
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
                            <h3 class="card-title">@lang('dashboard.package_reviews')</h3>
                        </div>
                        <div class="card-body">

                            <form action="">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <input value="{{ request('search') ?? '' }}" name="search" type="search"
                                            class="form-control" placeholder="@lang('dashboard.search_with_phone_number_or_name_or_email')">
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
                                        <th>@lang('dashboard.student')</th>
                                        <th>@lang('dashboard.review')</th>
                                        <th>@lang('dashboard.created_at')</th>
                                        <th>@lang('dashboard.Operations')</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($package_reviews as $package_review)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('users.show', ['user' => $package_review->user->id]) }}">{{ $package_review->user->name }}</a>
                                            </td>
                                            <td>{{$package_review->review}}</td>
                                            <td>{{ $package_review->created_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="operations-btns" style="">
                                                    @permission('package_reviews-read')
                                                        <a href="{{ route('package-reviews.show', ['id' => $package_review->id]) }}"
                                                            class="btn  btn-dark">@lang('dashboard.show')</a>
                                                    @endpermission
                                                </div>
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
                            {{ $package_reviews->appends(request()->all())->links() }}
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
