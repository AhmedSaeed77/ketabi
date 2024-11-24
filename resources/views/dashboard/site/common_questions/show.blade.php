@extends('dashboard.core.app')
@section('title', __('titles.common_question Details'))

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('dashboard.common_questions')</h1>
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
                            <h3 class="card-title">@lang('dashboard.details')@lang('titles.common_question')</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mt-3 row">
                                    <div class="card card-dark col-12">
                                        <div class="card-header">
                                            <h3 class="card-title">@lang('dashboard.details')</h3>
                                        </div>
                                        <div class="card-body row">
                                            <div class="col-10 row mt-3">
                                                <div class="col-6">
                                                    <strong><i
                                                            class="fas fa-user ml-1 mr-1"></i>{{ $common_question->question_ar }}</strong>
                                                </div>
                                                <div class="col-6">
                                                    <strong><i
                                                            class="fas fa-envelope ml-1 mr-1"></i>{{ $common_question->question_en }}</strong>
                                                </div>
                                                <div class="col-6">
                                                    <strong><i
                                                            class="fas fa-phone ml-1 mr-1"></i>{{ $common_question->answer_ar }}</strong>
                                                </div>
                                                <div class="col-6">
                                                    <strong><i
                                                            class="fas fa-address-card ml-1 mr-1"></i>{{ $common_question->answer_en }}</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
