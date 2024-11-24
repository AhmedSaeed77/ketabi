@extends('dashboard.core.app')
@section('title', __('dashboard.Show') . ' ' . __('dashboard.package_review'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.package_review')</h1>
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
                            <h3 class="card-title">@lang('dashboard.package_review')</h3>
                        </div>
                        <div class="card-body">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>@lang('dashboard.question')</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($user_ratings as $key => $user_rating)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user_rating->question->question }}</td>
                                            @for ($i = 1; $i <=5 ; $i++)
                                            <td><input disabled type="checkbox" {{$user_rating->rating == $i ? 'checked':''}}></td>
                                            @endfor
                                        </tr>
                                    @empty
                                        @include('dashboard.core.includes.no-entries', ['columns' => 6])
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
