@extends('admin::app')

@section('content')
<!-- Main content -->
<section class="content helpdesk">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card-meta">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="has-colon">@lang(' Title ')</span>
                            <span>{{ $helpticket->title }}</span>
                        </li>
                        <li class="list-group-item">
                            <span class="has-colon">@lang(' Department ')</span>
                            <span>{{ $helpticket->department->name }}</span>
                        </li>
                        <li class="list-group-item">
                            <span class="has-colon">@lang(' Priority ')</span>
                            <span>{{ $helpticket->priority->name }}</span>
                        </li>

                    </ul>
                </div>

                <!-- DIRECT CHAT -->
                <div class="card direct-chat direct-chat-primary mt-4">
                    <div class="card-header">
                        <h3 class="card-title">@lang(' Conversation ')</h3>

                        <div class="card-tools">
                            <span data-toggle="tooltip" title="@lang(' :count New Messages ', [
                                'count' => $new_messages->count()
                            ])" class="badge badge-primary">{{ $new_messages->count() }}</span>

                            <button type="button" class="btn btn-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="@lang(' Users ')"
                                data-widget="chat-pane-toggle">
                                <i class="fa fa-comments"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages">

                            @php
                            $user = $helpticket->user;

                            @endphp

                            @foreach ($messages as $message)

                            @php
                            $is_admin = !is_null($message->admin_id);
                            $has_new_messages = $new_messages->count() > 0 && $new_messages->first()->id ==
                            $message->id;
                            @endphp

                            @if($has_new_messages)
                            <div class="text-info direct-chat-has-new-messages my-2">@lang(' New Messages ')</div>
                            @endif

                            <x-ticket-chat-message :key="$loop->index" :isReply="$is_admin" :message="$message"
                                :user="$is_admin ? $message->admin:$user">
                            </x-ticket-chat-message>

                            @endforeach


                        </div>
                        <!--/.direct-chat-messages-->

                        <!-- Contacts are loaded here -->
                        <div class="direct-chat-contacts">
                            <ul class="contacts-list">

                                @foreach($helpticket->contacts() as $user)

                                <li>
                                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-link">
                                        <img class="contacts-list-img" src="{{ $user->image }}">

                                        @if($user->roles && $user->hasPermissionTo('contact user'))
                                        <div class="badge badge-info">@lang(' Agent ')</div>
                                        @endif

                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name">
                                                {{ $user->name }}
                                            </span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                    </a>
                                </li>
                                @endforeach

                                <!-- End Contact Item -->

                            </ul>
                            <!-- /.contacts-list -->
                        </div>
                        <!-- /.direct-chat-pane -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <form action="{{ route("admin.helpdesk.store", $helpticket) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <input id="message" required type="text" name="message"
                                    placeholder="@lang('Type Message ...')" class="form-control"
                                    value="{{ old('message') }}">
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">@lang(' Send ')</button>
                                </span>
                            </div>

                            @error('message')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="input-group">
                                <input type="file" focus multiple name="files[]" placeholder="@lang('Upload files...')"
                                    accept=".txt,.jpg,.png,.jpeg" class="form-control" value="{{ old('files') }}">
                            </div>

                            @error('files')
                            <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                        </form>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection

@push('add_scripts')

<script>
    jQuery(function($) {
    let last_message = $('.direct-chat-text').last().position().top,
    input_message = $('#message')

    $('.direct-chat-messages').scrollTop(Math.abs(last_message))

    input_message.focus()

    })
</script>

@endpush