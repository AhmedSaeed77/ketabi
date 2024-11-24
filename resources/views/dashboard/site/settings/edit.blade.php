@extends('dashboard.core.app')
@section('title', __('dashboard.Account_Settings'))
@section('content')
    <style>
        .input-group {
            margin-bottom: 20px;
            /* Adjust the margin value as needed */
        }
        .image-container{
            position: relative
        }

        .pen-icon {
            background: none;
            border-left: none;
        }
        .pen-icon-image{
            position: absolute;
            bottom: 0.5rem;
            left: 6rem;
        }
        .image-container img {
            width: 150px;
            /* Adjust the width to your desired size */
            height: 150px;
            /* Adjust the height to your desired size */
        }

        .col-md-6 {
            position: relative;
        }


        .card {
            background-color: transparent;
            box-shadow: none
        }

        .pin-input {
            width: 20%;
            text-align: center;
        }

        .pin-group {
            display: flex;
            justify-content: space-between;
        }

        .pin-title {
            float: none;
        }
    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <label class="card-title">@lang('dashboard.Account_Settings')</label>
                        </div>
                        <form action="{{ route('settings.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @method('put') @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Default box -->
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label class="card-title">@lang('dashboard.General_Info')</label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <div class="image-container">
                                                                <img class="profile-user-img img-fluid img-circle"
                                                                    id="profileImage" src="{{ $user->image?asset($user->image):asset('img/NiImage.jpg') }}"
                                                                    alt="Profile Image" class="img-fluid img-responsive">
                                                                <span class="pen-icon pen-icon-image">
                                                                    <i class="fas fa-pen"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <input type="file" name="image" id="profileImageInput"
                                                            style="display: none;">

                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="firstName" placeholder="@lang('dashboard.name')">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text pen-icon no-bg">
                                                                            <i class="fas fa-pen"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" name="phone" id="firstName" value="{{ $user->phone }}" placeholder="@lang('dashboard.phone_number')">

                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text pen-icon no-bg">
                                                                            <i class="fas fa-pen"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="firstName" name="email" value="{{ $user->email }}" placeholder="@lang('dashboard.email')">

                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text pen-icon no-bg">
                                                                            <i class="fas fa-pen"></i>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 text-right">
                                                                <button type="submit" class="btn btn-view btn-dark">@lang('dashboard.Save_Changes')</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 line-after">
                                <h6>@lang('dashboard.Change_Passwords')</h6>
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{route('update-password')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <div class="input-group mb-3">
                                                <input name="current_password" type="password" class="form-control" placeholder="@lang('dashboard.Current_Password')">

                                            </div>
                                            <div class="input-group mb-3">
                                                <input name="new_password" type="password" class="form-control" placeholder="@lang('dashboard.New_Password')">

                                            </div>
                                            <div class="input-group mb-3">
                                                <input name="new_password_confirmation" type="password" class="form-control" placeholder="@lang('dashboard.Confirm_New_Password')">

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn btn-view btn-dark">@lang('dashboard.Save_Changes')</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                <!-- /.card -->
            </div>
        </div>
        <!-- /.card-body -->
        </section>





@endsection
@section('js_addons')
    <script>
        $(document).ready(function() {
            // Handle file input change event
            $("#profileImageInput").change(function() {
                var inputFile = $(this)[0];
                if (inputFile.files && inputFile.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $("#profileImage").attr("src", e.target.result);
                    };

                    reader.readAsDataURL(inputFile.files[0]);
                }
            });

            // Trigger file input click when clicking on the image container
            $(".image-container").click(function() {
                $("#profileImageInput").click();
            });
        });
        function showPinCode(event){
            event.srcElement.classList.add('d-none')
            var pinCode = document.getElementById('pinCode').classList.remove('d-none')
            var pinCode = document.getElementById('hideInput').classList.add('d-none')
            var pinCode = document.getElementById('hideInput').classList.remove('d-block')
        }
    </script>
@endsection
