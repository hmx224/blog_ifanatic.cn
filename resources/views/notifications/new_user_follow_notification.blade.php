<li class="notifications" style="margin: 0; padding: 0;list-style: none; font-size: large;">
    <a href="{{ $notification->data['name'] }}">{{ $notification->data['name'] }}
    </a>关注了你.
    <span class="pull-right">{{ $notification->updated_at }}</span>
</li>