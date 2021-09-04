<table class="features-table">
    <thead>
    <tr>
        <td class="grey">Слово</td>
        <td class="grey">Перевод</td>
    </tr>
    </thead>

    <tbody>
    @foreach($results as $key=>$value)
        @if ($value[1] == 1)
            <tr>
                <td class="green">{{ $key }}</td>
                <td class="green">{{ $value[0] }}</td>
            </tr>
        @else
            <tr>
                <td class="red">{{ $key }}</td>
                <td class="red">{{ $value[0] }}</td>
            </tr>
        @endif
    @endforeach
    </tbody>

    <tfoot>
    <tr>
        <td>Слов повторено:</td>
        <td>{{ $repeated }}</td>
    </tr>
    </tfoot>

</table>

<form action="{{ route('exercises') }}">
    <button class="btn btn-primary fs-5">Вернуться к упражнениям</button>
</form>
