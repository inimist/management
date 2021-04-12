<?php

$cur_page = ceil( ($offset+1) / $limit);
$n_pages = ceil($total / $limit);
$has_prev = $cur_page > 1;
$prev_offset = $offset - $limit;
$next_offset = $offset + $limit;
$has_next = $cur_page < $n_pages;

$query_param = 'offset';

$prev_link = $link;
$prev_query = ['limit' => $limit];

$next_link = $link;
$next_query = ['limit' => $limit];

if ($query_param == 'offset') {
    $prev_query['offset'] = $prev_offset;
    $next_query['offset'] = $next_offset;
}
$prev_link .= '?' . http_build_query($prev_query);
$next_link .= '?' . http_build_query($next_query);
?>
<p>
    Page {{ $cur_page }} of {{ $n_pages }}
</p>
<p>
    @if ($has_prev)
        <a href="{{ $prev_link }}">Prev</a>
    @endif
    @if ($has_next)
        <a href="{{ $next_link }}">Next</a>
    @endif
</p>
{{--<p>Offset: {{ $offset }}</p>--}}
{{--<p>Previous Offset: {{ $prev_offset }}</p>--}}
{{--<p>Previous Link: {{ $prev_link }}</p>--}}
{{--<p>Next Offset: {{ $next_offset }}</p>--}}
{{--<p>Next Link: {{ $next_link }}</p>--}}
{{--<p>Limit: {{ $limit }}</p>--}}
{{--<p>Total: {{ $total }}</p>--}}