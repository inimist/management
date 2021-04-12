@extends('layouts.main')

@section('content')

    <h1>{{ $account->name }}</h1>

    <p><a href="{{ route('accounts.homefeed', ['id' => $account->id]) }}" class="btn btn-default">View Home Feed</a></p>
    @if (isset($account->stats))
        <table class="table">
            @if (isset($account->stats->numPosts))
            <tr>
                <th><a href="{{ route('accounts.posts', ['id' => $account->id]) }}"># Posts</a></th>
                <td>{{ number_format($account->stats->numPosts) }}</td>
            </tr>
            @endif
            {{--@if (isset($account->stats->numPlacesFollowing))--}}
            {{--<tr>--}}
                {{--<th># Places Following</th>--}}
                {{--<td>{{ number_format($account->stats->numPlacesFollowing) }}</td>--}}
            {{--</tr>--}}
            {{--@endif--}}
            @if (isset($account->stats->numFollowing))
            <tr>
                <th><a href="{{ route('accounts.following', ['id' => $account->id]) }}"># Following</a></th>
                <td>{{ number_format($account->stats->numFollowing) }}</td>
            </tr>
            @endif
            @if (isset($account->stats->numFollowers))
            <tr>
                <th><a href="{{ route('accounts.followers', ['id' => $account->id]) }}"># Followers</a></th>
                <td>{{ number_format($account->stats->numFollowers) }}</td>
            </tr>
            @endif
            {{--@if (isset($account->stats->numLikes))--}}
            {{--<tr>--}}
                {{--<th># Likes</th>--}}
                {{--<td>{{ number_format($account->stats->numLikes) }}</td>--}}
            {{--</tr>--}}
            {{--@endif--}}
            {{--@if (isset($account->stats->numCategoriesFollowing))--}}
                {{--<tr>--}}
                    {{--<th># Categories Following</th>--}}
                    {{--<td>{{ number_format($account->stats->numCategoriesFollowing) }}</td>--}}
                {{--</tr>--}}
            {{--@endif--}}
        </table>

        <h2>Badges</h2>
        <div id="badges">
            {{--@foreach($available_badges as $badge)--}}
                {{--<a href="#" onclick="return false;">{{ $badge->name }} <i class="glyphicon glyphicon-plus"></i> Add</a>--}}
            {{--@endforeach--}}
        </div>
        <script type="text/javascript">
            @php
                echo 'var availableBadges = ' . json_encode($available_badges) . ';';
                echo 'var inBadges = ' . json_encode($account->badges) . ';';
            @endphp
            @foreach($available_badges as $badge)
            @endforeach

            function hasBadge(badge) {
                return (inBadges.filter(function(inBadge) { return inBadge.key == badge.key }).length > 0);
            }
            function toggleBadge(obj) {
                var $obj = $(obj);

            }

            var addUrl = '{{ route('accounts.addBadge', ['id' => $account->id ]) }}';
            var removeUrl = '{{ route('accounts.removeBadge', ['id' => $account->id ]) }}';
            function renderBadges() {
                var $badges = $('#badges');
                $badges.empty();
                for(var i=0, j=availableBadges.length; i < j; i++) {
                    var inBadge = hasBadge(availableBadges[i]);
                    $chk = $('<input />').attr({type: 'checkbox', value: availableBadges[i].key});

                    if (inBadge) $chk.attr('checked', true);
                    $chk.change(function(ev) {
                        var $this = $(this);
                        var $status = $('<span />').text(' ...').css('font-weight', 'normal').appendTo($this.parent());
                        var isChecked = $(this).is(':checked');
                        var url = isChecked ? addUrl : removeUrl;
                        $.post(url, {
                                badge: $(this).val(),
                                _token: '{{ csrf_token() }}',
                            },
                            function(data, status) {
                                $this.attr('disabled', false);
                                $status.text(' (updated)');
                                setTimeout(function() { $status.remove(); }, 2000);
                            },
                            'json'
                        );
                    });
                    $label = $('<label />').text(' ' + availableBadges[i].name).prepend($chk);
                    $badges.append($label, $('<br />'));
                }
            }
            renderBadges();
        </script>

        <hr />

        <div class="advanced-options">
            <p><a href="#" onclick="$('.advanced-options').toggle();return false;">Show Advanced Options</a></p>
        </div>
        <div class="advanced-options init-hidden">
            <p><a href="#" onclick="$('.advanced-options').toggle();return false;">Hide Advanced Options</a></p>
            {{ Form::open(['route' => ['accounts.destroy', $account->id], 'method' => 'delete', 'onclick' => 'return confirm(\'Are you sure you want to delete this user and their posts?\');']) }}
            <input type="submit" value="Delete User" class="btn btn-danger" />
            {{ Form::close() }}
        </div>
    @else
        No stats available
    @endif
@endsection