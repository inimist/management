@extends('layouts.main')

@section('content')
    @if($message)
        <div class="alert alert-info">{{ $message }}</div>
    @endif
    <p>
        <a href="{{ route('categories.browse') }}" class="btn btn-default">Browse Categories</a>
        <a href="{{ route('categories.create') }}" class="btn btn-success">Create Category</a>
    </p>
    <form method="get" onsubmit="return false;">
        {{ Form::label('search', 'Category name: ') }} <input type="text" name="keyword" id="keyword" onkeyup="updateResults();" /> <span id="keyword-status"></span>
    </form>

    <div id="search-results"></div>

    <script type="text/javascript">
        var defaultText = 'Type something to search';
        var resultsCache = {};
        var lastTyped = '';

        $('#keyword-status').text(defaultText);

        var popular = [];
        @foreach($popular as $category)
        popular.push({
            id: '{{ $category->id }}',
            name: '{{ $category->name }}',
            enabled: {{ $category->enable ? 'true' : 'false' }}
        });
        @endforeach

        var timer0 = null;
        function renderResults(results) {
            var $results = $('#search-results');
            $results.empty();
            var $keywordStatus = $('#keyword-status');
            $keywordStatus.text('Results: ' + results.length);
            var $table = $('<table />').addClass('table');
            for(var i=0, j=results.length; i < j; i++) {
                var $link = $('<a />').attr('href', '/categories/browse?category=' + results[i].id);
                if (results[i].enable === false) $link.attr('style', 'text-decoration: line-through');
                $link.text(results[i].name);

                $table.append(
                    $('<tbody />').append(
                        $('<tr />').append(
                            $('<td />').append($link)
                        )
                    )
                );
            }
            $results.append($table);
        }

        function updateResults() {

            if (timer0) clearTimeout(timer0);
            var $keywordStatus = $('#keyword-status');
            var $results = $('#search-results');

            var keyword = $('#keyword').val();
            if (keyword.length == 0) {
                $keywordStatus.text(defaultText);
                renderResults(popular);
            } else {
                if (keyword == lastTyped) return;

                $keywordStatus.text('Typing...');
                $results.empty();
                timer0 = setTimeout(function () {
                    $keywordStatus.text('Retrieving results...');
                    $.get({
                        url: '/categories/autocomplete',
                        data: { q: keyword },
                        success: function(results) {
                            if (results.length > 0) {
                                renderResults(results);
                            } else {
                                $keywordStatus.text('No results');
                            }
                            lastTyped = keyword;
                        },
                        error: function(err) {
                            console.log('Error');
                        }
                    });
                }, 600);
            }
        }

        renderResults(popular);
    </script>
@endsection