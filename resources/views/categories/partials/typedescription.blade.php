<table class="table table-striped">
@foreach($type_grid as $section => $values)
    @if ($section == 'headers')
        <tr>
            <th>&nbsp;</th>
            @foreach($values as $value)
                <th>{{ $value }}</th>
            @endforeach
        </tr>
    @elseif ($section == 'rows')

        @foreach($values as $label => $sub_values)
            <tr>
                <th>{{ $label }}</th>
                @foreach($sub_values as $value)
                    <td width="25%">{{ $value }}</td>
                @endforeach
            </tr>
        @endforeach
    @endif
@endforeach
</table>