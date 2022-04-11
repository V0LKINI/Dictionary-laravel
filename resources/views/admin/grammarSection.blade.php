<section id="grammarSection" class="admin__section" hidden>

    <a class="admin__button-add" href="{{ route('grammar.create') }}">Добавить правило</a>

    <div class="admin__allElements">
        <h2>Список правил грамматики</h2>
        @foreach($allRules as $oneGroup)
            @foreach($oneGroup as $rule)
                <div class="admin__grammar-wrapper">

                    <div class="admin__grammar-title-wrapper">
                        <h3>{{$rule->name}}</h3>
                        <p class="admin__grammar-level description"
                                @if($rule->level == 'basic')
                                style="color: #21a842"
                                @elseif($rule->level == 'intermediate')
                                style="color: #eca53c"
                                @else
                                style="color: #ee4d4d"
                                @endif
                        >
                           уровень: {{$rule->level}}
                        </p>
                        <p>{!! $rule->description !!}</p>
                    </div>


                    <div class="admin__buttonsWrapper">
                        <a class="admin__button button-success" href="{{ route('grammar.edit', $rule) }}">Редактировать</a>

                        <form action="{{ route('grammar.destroy', $rule) }}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" class="admin__button button-danger" value="Удалить">
                        </form>
                    </div>

                </div>
            @endforeach
        @endforeach
    </div>

</section>

@section('scripts')
    <script src="/js/admin/script.js"></script>
@endsection