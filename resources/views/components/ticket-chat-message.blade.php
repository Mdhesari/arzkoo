<!-- Message. Default to the left -->
<div class="direct-chat-msg @if($isReply) right @endif">
    <div class="direct-chat-info clearfix">
        <span class="direct-chat-name {{ $isReply ? 'float-right':'float-left' }}">{{ $user->name }}</span>
        <span
            class="direct-chat-timestamp {{ $isReply ? 'float-left':'float-right' }}">{{ $message->created_at->diffForHumans() }}</span>
    </div>
    <!-- /.direct-chat-info -->
    <img class="direct-chat-img" src="{{ $user->image }}" alt="@lang(' User portfolio ')">
    <!-- /.direct-chat-img -->
    <div class="direct-chat-text">
        {{ $message->body }}
    </div>

    @if($media = $message->media)

    <ul class="list-group">
        @foreach ($media as $file)
        <li class="list-group-item p-1">
            <span class="fa fa-file"></span>
            <a href="{{ $file->getFullUrl() }}" class="btn btn-link">
                <span class="file-name mx-2">{{ $file->file_name }}</span>
                <span class="file-size">{{ $file->human_readable_size }}</span>
            </a>
        </li>
        @endforeach
    </ul>
    @endif
    <!-- /.direct-chat-text -->
</div>
<!-- /.direct-chat-msg -->