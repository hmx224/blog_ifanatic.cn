<li class="notifications {{ $notification->unread() ? 'unread':'' }}"
    style="margin: 0; padding: 0;list-style: none; font-size: large;">
    <a href="{{$notification->unread() ?'/notifications/'.$notification->id . '?redirect_url=/inbox/'. $notification->data['dialog_id']: '/inbox/'.$notification->data['dialog_id']}}">
        {{ $notification->data['name'] }}
        给你发了一条私信
    </a>
    <span class="pull-right">{{ $notification->updated_at }}</span>
</li>