<section id="newsSection" class="admin__newsSection" hidden>

    <a class="admin__button-addNews" href="{{ route('news.create') }}">Добавить новость</a>

    <div class="admin__news-allNews">
        <h2>Список новостей</h2>
        @foreach($allNews as $news)
            <div class="admin__news-wrapper">

                <div class="admin__news-image" >
                    <img src="{{ Storage::url($news->image)}}" alt="{{$news->title}}">
                </div>

                <div class="admin__news-title-wrapper">
                    <h3 class="admin__news-title">{{$news->title}}</h3>
                    <p class="admin__news-text">{{substr($news->description,0,550)}}</p>
                </div>


                <div class="admin__news-buttonsWrapper">
                    <a class="admin__button button-success" href="{{ route('news.edit', $news->id) }}">Редактировать</a>

                    <form action="{{ route('news.destroy', $news->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="{{ $news->id }}">
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