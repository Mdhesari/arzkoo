@extends('admin::app')

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{ $user->image }}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $user->name }}</h3>

                        <p class="text-muted text-center">{{ $user->roles_as_string }}</p>

                        <form action="{{ route("admin.logout") }}" method="POST" class="text-center">
                            @csrf

                            <button type="submit" class="btn btn-link text-danger">
                                <i class="fa fa-sign-out"></i> @lang(' Logout ')
                            </button>

                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" href="#settings" data-toggle="tab">
                                    @lang(' Setting ')
                                </a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane active" id="settings">
                                <form action="{{ route('admin.profile') }}" method="POST" class="form-horizontal">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label"> @lang(' Name ') </label>

                                        <div class="col-sm-10">
                                            <input value="{{ $user->name }}" name="name" type="text"
                                                class="form-control" id="inputName" placeholder="@lang('Name')">
                                        </div>

                                        @error('name')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label"> @lang(' Email ')
                                        </label>

                                        <div class="col-sm-10">
                                            <input value="{{ $user->email }}" name="email" type="email"
                                                class="form-control" id="inputEmail" placeholder="@lang(' Email')">
                                        </div>

                                        @error('email')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputMobile" class="col-sm-2 control-label"> @lang('Mobile')
                                        </label>

                                        <div class="col-sm-10">
                                            <input value="{{ $user->mobile }}" name="mobile" type="tel"
                                                class="form-control" id="inputMobile" placeholder="@lang(' Mobile ')">
                                        </div>
                                        @error('mobile')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-2 control-label"> @lang(' Password ')
                                        </label>

                                        <div class="col-sm-10">
                                            <input name="password" type="password" class="form-control"
                                                id="inputPassword" placeholder="@lang(' Password ')">
                                        </div>
                                        @error('password')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPasswordConfirm" class="col-sm-2 control-label">
                                            @lang(' Confirm Password ')
                                        </label>

                                        <div class="col-sm-10">
                                            <input name="password_confirmation" type="password" class="form-control"
                                                id="inputPasswordConfirm" placeholder="@lang(' Confirm Password ')">
                                        </div>
                                        @error('password_confirmation')
                                        <p class="alert alert-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">@lang(' Update ')</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection