@extends('admin::app')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> @lang(' Setting ') </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route("admin.setting.update") }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">

                            <div class="form-group">
                                <label for="site_name">@lang(' Website Title ')</label>
                                <input value="{{ $site_name }}" type="text" class="form-control" id="site_name"
                                    name="site_name" placeholder="">
                            </div>

                            @error('site_name')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label for="site_description">@lang(' Website Description ')</label>
                                <textarea id="site_description" class="form-control" name="site_description" cols="30"
                                    rows="10">{{ $site_description }}</textarea>
                            </div>

                            @error('site_description')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label for="site_logo">@lang(' Website Logo ')</label>
                                @if($site_logo)
                                <div class="my-2">
                                    <a href="{{ $site_logo }}" target="_blank">
                                        <img class="favicon rounded" src="{{ $site_logo }}" alt="@lang('Site Logo')">
                                    </a>
                                </div>
                                @endif
                                <input type="file" id="site_logo" class="form-control" name="site_logo" />
                            </div>

                            @error('site_logo')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label for="site_favicon">@lang(' Website Favicon ')</label>
                                @if($site_favicon)
                                <div class="my-2">
                                    <a href="{{ $site_favicon }}" target="_blank">
                                        <img class="favicon rounded" src="{{ $site_favicon }}"
                                            alt="@lang('Site Favicon')">
                                    </a>
                                </div>
                                @endif
                                <input type="file" id="site_favicon" class="form-control" name="site_favicon" />
                            </div>

                            @error('site_favicon')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">@lang(' Save ')</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@push('add_scripts')
<script>
    jQuery(function($) {
            $('#amount').on('keyup',function(e) {
                $('#amount_help').html(calcPrice($(this).val()))
            })
        })
</script>
@endpush