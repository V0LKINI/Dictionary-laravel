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
                        @if ($user->banned_until && now()->lessThan($user->banned_until))
                            <p>Заблокирован до {{ $user->banned_until }}</p>
                            <form action="{{ route('user-unblock', $user->id) }}" method="post">
                                @method('put')
                                @csrf
                                <input class="admin__button button-success" type="submit" value="Разблокировать">
                            </form>
                        @else
                            <form action="{{ route('user-block', $user->id) }}" method="post">
                                @method('put')
                                @csrf
                                <select name="ban_time">
                                    <option value="1">День</option>
                                    <option value="7">Неделя</option>
                                    <option value="14">2 недели</option>
                                    <option value="30">Месяц</option>
                                    <option value="999999">Навсегда</option>
                                </select>
                                <input class="admin__button button-danger" type="submit" value="Блокировать">
                            </form>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</section>