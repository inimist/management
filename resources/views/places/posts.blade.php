@extends('layouts.main')

@section('content')


    <p>
        <a href="{{ route('places.show', ['id' => $place->id]) }}" class="btn btn-default">Back to Place</a>
        <a href="{{ route('posts.create', ['placeId' => $place->id]) }}" class="btn btn-primary">Add Post</a>
    </p>

    @if (count($feed) > 0)
        <h1>Posts for {{ $place->name }}</h1>
    @else
        No posts
    @endif

    <table class="table">
        <tr>
            <th>User</th>
            <th>Category</th>
            <th>Post</th>
            <th># Envies</th>
            <th># Comments</th>
            <th>Features</th>
            <th>View</th>
        </tr>
        @foreach($feed as $post)
            <tr>
                <td>
                    @if (isset($post->user->id) && !empty($post->user->id))<a href="{{ route('accounts.show', ['id' => $post->user->id]) }}">@endif
                        {{ $post->user->displayName }}
                    @if (isset($post->user->id) && !empty($post->user->id))</a>@endif
                </td>
                <td><a href="{{ route('categories.show', ['id' => $post->category->id]) }}">{{ $post->category->name }}</a></td>
                <td>{{ $post->object->description }}</td>
                <td>{{ number_format($post->object->numEnvies) }}</td>
                <td>{{ number_format($post->object->numComments) }}</td>
                <td>
                    @if (isset($post->features))
                        @if (isset($post->features->uber) && $post->features->uber)
                            Uber
                        @endif
                        @if (isset($post->features->fare) && $post->features->fare)
                            Fare
                        @endif
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <a href="{{ route('posts.show', ['id' => $post->object->id]) }}" class="btn btn-default">View</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection