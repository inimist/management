@extends('layouts.main')

@section('content')


    @if (count($feed) > 0)
        <p><a href="{{ route('accounts.show', ['id' => $feed[0]->user->id]) }}" class="btn btn-default">Back to User</a></p>
        <h1>Posts by {{ $feed[0]->user->displayName }}</h1>
    @else
        No posts
    @endif

    <table class="table">
        <tr>
            <th>Category</th>
            <th>Post</th>
            <th># Envies</th>
            <th># Comments</th>
            <th>Place</th>
            <th>Features</th>
        </tr>
    @foreach($feed as $post)
        <tr>
            <td>{{ $post->category->name }}</td>
            <td>{{ $post->object->description }}</td>
            <td>{{ number_format($post->object->numEnvies) }}</td>
            <td>{{ number_format($post->object->numComments) }}</td>
        {{--- media[]--}}
            {{--- type = image--}}
            {{--- url--}}
            {{--- sortorder--}}
            {{--- variations--}}
                {{--- thumbnail--}}
                    {{--- type--}}
                    {{--- url--}}
            <td>
                <a href="{{ route('places.show', ['id' => $post->place->id ]) }}">{{ $post->place->name }}</a>
                @if (isset($post->place->address))
                    ({{ $post->place->address->city }}
                    {{ $post->place->address->state }})
                @endif
            </td>
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
        </tr>
    @endforeach
    </table>
@endsection