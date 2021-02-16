@extends('admin::app')

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"> @lang(' Landing Setting ') </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route("admin.setting.landing.update") }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">

                            {{-- <div class="form-group mb-3">
                                <label class="col-12" for="FormSelect3">@lang(' Choose Top Categories ')</label>
                                <small>@lang(' To show in landing ')</small>
                                <x-auto-complete-search :options="$all_categories" id="category-search"
                                    name="categories[]" :route="route('admin.category.search')"
                                    placeholder="{{__(' Choose Category ')}}" :defaults="$categories">
                                </x-auto-complete-search>
                            </div>
                            @error('categories')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror --}}

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