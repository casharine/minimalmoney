@if (count($users) > 0)
<ul class="list-unstyled">
    @foreach ($users as $user)
    <li>
        <div>
            {{ $user->name }}
        </div>
        <div>
            {{-- ユーザ詳細ページへのリンク --}}
            <p>{!! link_to_route('users.show', 'View profile', ['user' => $user->id]) !!}</p>
        </div>
        </div>
    </li>
    @endforeach
</ul>
{{-- ページネーションのリンク --}}
{{ $users->links() }}
@endif