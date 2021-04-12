@extends('layouts.main')

@section('content')

    <h1>Recent Posts</h1>

    {{ Form::open(['route' => 'posts.index']) }}
    <p>Filter by status: {{ Form::select('status', $statuses, null, ['class' =>'form-control']) }}
    {{ Form::close() }}

    @if (count($posts) > 0)
    <table class="table">
        @foreach($posts as $post)
        <tr>
            <td>{{ $post->description }}</td>
        </tr>
        @endforeach
    </table>
    @endif
@endsection