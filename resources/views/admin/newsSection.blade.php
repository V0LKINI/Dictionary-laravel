<section id="newsSection" class="admin__section" hidden>

    <a class="admin__button-add" href="{{ route('news.create') }}">Добавить новость</a>

    <div class="admin__allElements">
        <h2>Список новостей</h2>
        @foreach($allNews as $news)
            <div class="admin__news-wrapper">

                <div class="admin__news-image" >
                    <img src="{{ Storage::url($news->image)}}" alt="{{$news->title}}">
                </div>

                <div class="admin__news-title-wrapper">
                    <h3>{{$news->title}}</h3>
                    <p>{{$news->description}}</p>
                </div>


                <div class="admin__buttonsWrapper">
                    <a class="admin__button button-success" href="{{ route('news.edit', $news) }}">Редактировать</a>

                    <form action="{{ route('news.destroy', $news) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" class="admin__button button-danger" value="Удалить">
                    </form>
                </div>

            </div>

        @endforeach
    </div>

</section>

@section('scripts')
    <script src="/js/admin/script.js"></script>
@endsection
