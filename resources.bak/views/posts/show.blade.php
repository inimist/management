@extends('layouts.main')

@section('content')

    @unless(empty($message))
        <div class="alert alert-info">{{ $message }}</div>
    @endunless

    @if (isset($post->flagged) && $post->flagged)
        <div class="alert alert-danger">
            <i class="glyphicon glyphicon-flag"></i>
            This Post has been flagged
            @if (count($flags) == 0)
                <br />Unfortunately no details about the flagged content have been returned.
            @endif
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <h1>Post Details</h1>

            <p><strong>Created: </strong> {{ (new \Carbon\Carbon($post->created))->format('m/d/Y H:iA') }}</p>

            <p><strong>Published:</strong>
                @if (isset($post->published) && ! empty($post->published))
                    {{ (new \Carbon\Carbon($post->published))->format('m/d/Y H:iA') }}
                @else
                    N/A
                @endif
            </p>

            <p><strong>Description:</strong> {{ $post->object->description }}</p>

            <p><strong>Creator:</strong>
                @if (isset($post->user) && isset($post->user->displayName))
                    {{ $post->user->displayName }}
                @else
                    Anonymous
                @endif
            </p>

            <p><strong>Category:</strong>
                @if (isset($post->category) && isset($post->category->name))
                    {{ $post->category->name }}
                @else
                    N/A
                @endif
            </p>

            <p><strong>Place: </strong>
                @if (isset($post->place))
                    <br />
                    {{ $post->place->name }}
                    @if (isset($post->place->address))
                        <br />
                        {{ $post->place->address->street1 }}<br />
                        {{ $post->place->address->city }}, {{ $post->place->address->state }}, {{ $post->place->address->zip }}<br />
                        Coordinates:
                        @if (isset($post->place->address->coordinates))
                            {{ $post->place->address->coordinates->latitude }}, {{ $post->place->address->coordinates->longitude }}
                        @else
                            N/A
                        @endif
                    @endif
                @else
                    N/A
                @endif
            </p>

            <h2>Media</h2>
            @if (isset($post->object->media) && is_array($post->object->media))
                <ul>
                @foreach($post->object->media as $media)
                    <li>
                    @if (isset($media->variations->thumbnail))
                        <a href="{{ $media->url }}" target="_blank"><img src="{{ $media->variations->thumbnail->url }}" /></a>
                    @else
                        <a href="{{ $media->url }}" target="_blank">Link to media</a>
                    @endif
                    </li>
                @endforeach
                </ul>
            @else
                <p>None</p>
            @endif

            @if (count($flags) > 0)
                <h2>Flags</h2>

                <table class="table">
                    <tr>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Flagged by</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($flags as $flag)
                        <tr>
                            <td>{{ $flag->reason }}</td>
                            <td>{{ $flag->status }}</td>
                            <td>{{ $flag->flagger->name }}</td>
                            <td>
                                <a href="{{ route('posts.approveFlag', ['postId' => $post->object->id, 'flagId' => $flag->id ]) }}" class="btn btn-warning">Confirm</a>

                                <a href="{{ route('posts.disapproveFlag', ['postId' => $post->object->id, 'flagId' => $flag->id ]) }}" class="btn btn-info">Cancel</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>

        <div class="col-md-4">
            <h3>Status</h3>
            <p>{{ $post->object->status }}</p>

            <h3>Hashtags</h3>
            @if (isset($post->hashtags) && count($post->hashtags) > 0)
                <ul><li>#{{ implode('</li><li>#', $post->hashtags) }}</li></ul>
            @else
                <p>N/A</p>
            @endif

            <h3>Stats</h3>

            @if (isset($post->stats))
                <ul>
                    <li># Envies: @if (isset($post->stats->numEnvies)) {{ $post->stats->numEnvies }} @else N/A @endif </li>
                    <li># Comments: @if (isset($post->stats->numComments)) {{ $post->stats->numComments }} @else N/A @endif </li>
                    <li># Likes: @if (isset($post->stats->numLikes)) {{ $post->stats->numLikes }} @else N/A @endif </li>
                    <li># Dislikes: @if (isset($post->stats->numDislikes)) {{ $post->stats->numDislikes }} @else N/A @endif </li>
                </ul>
            @else
                <p>None reported</p>
            @endif
        </div>
    </div>
@endsection