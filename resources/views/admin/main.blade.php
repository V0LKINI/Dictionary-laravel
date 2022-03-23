@extends('layouts.admin-master')

@section('title', 'Панель администратора')

@section('content')

<input type="checkbox" id="nav-toggle" hidden checked>

<nav class="nav">
    <label for="nav-toggle" class="nav-toggle" onclick></label>

    <ul>
        <li class="admin__menu-back"><a href="/">Вернуться к сайту</a>
        <li class="admin__menu-item" data-sectionId="usersSection"><a href="#">Пользователи</a>
        <li class="admin__menu-item" data-sectionId="newsSection"><a href="#">Новости</a>
        <li class="admin__menu-item" data-sectionId="resetExperienceSection"><a href="#">Сброс опыта</a>
    </ul>

    <div class="mask-content"></div>
</nav>


@if (session()->has('warning'))
    <div class="alert alert-warning" role="alert">{{ session()->get('warning') }}</div>
@endif

<main class="admin__main" role="main" >


    <section id="usersSection" hidden>
        <table class="simple-little-table">
            <tr>
                <th style="width: 10%;">id</th>
                <th style="width: 20%;">Имя</th>
                <th style="width: 30%;">Email</th>
                <th style="width: 30%;">Зарегистрирован</th>
                <th style="width: 10%;">Взаимодействие</th>
            </tr>
            @foreach($allUsers as $user)
                <tr class="tableRow" id="usersTableRow-{{ $user->id }}">
                    <td class="tableColumn">{{ $user->id }}</td>
                    <td class="tableColumn">{{ $user->name }}</td>
                    <td class="tableColumn">{{ $user->email }}</td>
                    <td class="tableColumn">{{ $user->created_at }}</td>
                    <td class="tableColumn">
                        @if(!$user->isAdmin())
                            <button>Бан</button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </section>


    <section id="newsSection" class="admin__newsSection" hidden>
        <form action="{{ route('addNews') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="admin__input-wrapper">
                <input id="news_title" class="admin__input" type="text" name="title" placeholder="Title">
            </div>
            <div class="admin__input-wrapper">
                <input id="news_code" class="admin__input" type="text" name="code" placeholder="Code">
            </div>
            <div class="admin__input-wrapper">
                <textarea class="admin__input admin__textarea" name="description" placeholder="Description"></textarea>
            </div>
            <div class="admin__button-wrapper">
                <input type="file" name="image" accept="image/*">
                <input class="admin__button" type="submit" value="Добавить новость">
            </div>

        </form>
    </section>


    <section id="resetExperienceSection" class="resetExperienceSection" hidden>
        <form action="{{ route('resetDaily') }}" method="post">
            @csrf
            <input name="_method" type="hidden" value="PUT">
            <input class="btn btn-danger" type="submit" value="Сбросить ежедневный опыт">
        </form>

        <form action="{{ route('resetWeekly') }}" method="post">
            @csrf
            <input name="_method" type="hidden" value="PUT">
            <input class="btn btn-danger" type="submit" value="Сбросить недельный опыт">
        </form>

        <form action="{{ route('resetMonthly') }}" method="post">
            @csrf
            <input name="_method" type="hidden" value="PUT">
            <input class="btn btn-danger" type="submit" value="Сбросить месячный опыт">
        </form>
    </section>


</main>

    <script>

        $(document).ready(function () {
            sectionsOnLoad();
            sectionsOnClick();
            titleToCode();
        });

        function titleToCode(){
            $("#news_title").keyup(function() {
                $("#news_code").val(translit(this.value));
            });
        }

        function translit(str){
            var answer = '';
            var converter = {
                'а': 'a',    'б': 'b',    'в': 'v',    'г': 'g',    'д': 'd',
                'е': 'e',    'ё': 'e',    'ж': 'zh',   'з': 'z',    'и': 'i',
                'й': 'y',    'к': 'k',    'л': 'l',    'м': 'm',    'н': 'n',
                'о': 'o',    'п': 'p',    'р': 'r',    'с': 's',    'т': 't',
                'у': 'u',    'ф': 'f',    'х': 'h',    'ц': 'c',    'ч': 'ch',
                'ш': 'sh',   'щ': 'sch',  'ь': '',     'ы': 'y',    'ъ': '',
                'э': 'e',    'ю': 'yu',   'я': 'ya', ' ': '-',

                'А': 'A',    'Б': 'B',    'В': 'V',    'Г': 'G',    'Д': 'D',
                'Е': 'E',    'Ё': 'E',    'Ж': 'Zh',   'З': 'Z',    'И': 'I',
                'Й': 'Y',    'К': 'K',    'Л': 'L',    'М': 'M',    'Н': 'N',
                'О': 'O',    'П': 'P',    'Р': 'R',    'С': 'S',    'Т': 'T',
                'У': 'U',    'Ф': 'F',    'Х': 'H',    'Ц': 'C',    'Ч': 'Ch',
                'Ш': 'Sh',   'Щ': 'Sch',  'Ь': '',     'Ы': 'Y',    'Ъ': '',
                'Э': 'E',    'Ю': 'Yu',   'Я': 'Ya'
            };

            for (var i = 0; i < str.length; ++i ) {
                if (converter[str[i]] == undefined){
                    answer += str[i];
                } else {
                    answer += converter[str[i]];
                }
            }

            return answer;
        }

        function sectionsOnClick(){
            let menuItems = $('.admin__menu-item');

            menuItems.click(function(){
                let section_id = $(this).attr('data-sectionId');
                let allSections = $('section');
                let checkedSection = $('#' + section_id);

                allSections.attr('hidden', true);
                menuItems.find('a').removeClass('admin__checkedItem');
                checkedSection.attr('hidden', false);

                localStorage.setItem('section_id', section_id);
            });
        }


        function sectionsOnLoad(){

            let section_id = localStorage.getItem('section_id');
            if (section_id == null) {
                section_id = 'usersSection';
            }

            let allSections = $('section');
            let checkedSection = $('#' + section_id);
            let checkedMenuItem = $('[data-sectionid='+section_id+']').find('a');

            allSections.attr('hidden', true);
            checkedSection.attr('hidden', false);
            checkedMenuItem.addClass('admin__checkedItem');

        }
    </script>
@endsection
