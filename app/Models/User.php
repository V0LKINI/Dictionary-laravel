<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Ramsey\Collection\Collection;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Атрибуты, которым можно массово присваивать значения.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_dark_theme',
        'banned_until'
    ];

    /**
     * Атрибуты, которые должны быть скрыты для массивов.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Аттрибуты, которые запрещено заполнять.
     *
     * @var array
     */
    protected $guarded = [
        'is_admin',
    ];

    /**
     * Атрибуты, которые должны быть приведены к собственным типам.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Каждый пользователь имеет сколько угодно слов.
     */
    public function words()
    {
        return $this->hasMany(Word::class)->orderByDesc('updated_at');
    }

    /**
     * Каждый пользователь имеет строчку в таблице упражнений.
     */
    public function experience()
    {
        return $this->hasOne(Experience::class);
    }

    /**
     * Увеличить опыт пользователя в БД.
     *
     * param int $experience
     *
     * @return void
     */
    public function increaseExperience(int $experience): void
    {
        $this->experience->daily_experience += $experience;
        $this->experience->weekly_experience += $experience;
        $this->experience->monthly_experience += $experience;
        $this->experience->total_experience += $experience;
        $this->experience->save();
    }

    /**
     * Проверить, является ли пользователь администратором.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->is_admin === 1;
    }

    /**
     * Все друзья и заявки в друзья ОТ авторизированного пользователя
     */
    public function friendsOfMine()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id');
    }

    /**
     * Все друзья и заявки в друзья К авторизированному пользователю
     */
    public function friendOf()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id');
    }

    /**
     * Отображение списка друзей у пользователя
     */
    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
            ->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    /**
     * Отображение списка пользователей, которые хотят добавить в друзья
     */
    public function friendRequests()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    /**
     * Все пользователи, к которым отправлена заявка в друзья
     */
    public function friendRequestPending()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    /**
     * Проверка, отправлена ли заявка конкретному пользователю
     *
     * @param User $user
     * @return bool
     */
    public function hasFriendRequestPending(User $user): bool
    {
        return (bool) $this->friendRequestPending()->where('id', $user->id)->count();
    }

    /**
     * Проверка, получена ли заявка в друзья
     *
     * @param User $user
     * @return bool
     */
    public function hasFriendRequestReceived(User $user): bool
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    /**
     * Отправить заявку в друзья пользователю
     *
     * @param User $user
     */
    public function addFriend(User $user)
    {
        $this->friendsOfMine()->attach($user->id, ['accepted' => false]);
    }

    /**
     * Удалить друга и отправить его в подписчики
     *
     * @param User $user
     */
    public function deleteFriend(User $user)
    {
        $this->friends()->where('id', $user->id)->first()->pivot->update([
            'user_id' => $user->id,
            'friend_id' => Auth::id(),
            'accepted' => false
        ]);
    }

    /**
     * Принять заявку в друзья
     *
     * @param User $user
     */
    public function acceptFriendRequest(User $user)
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
            'accepted' => true
        ]);
    }

    /**
     * Отклонить заявку в друзья
     *
     * @param User $user
     */
    public function rejectFriendRequest(User $user)
    {
        $this->friendOf()->detach($user->id);
    }

    /**
     * Отменить отправку заявки в друзья
     *
     * @param User $user
     */
    public function cancelFriendRequest(User $user)
    {
        $this->friendsOfMine()->detach($user->id);
    }

    /**
     * Проверка, является ли пользователь другом.
     *
     * @param User $user
     *
     * @return bool
     */
    public function isFriendWithMe(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    /**
     * Смена темы у пользователя.
     *
     * @param bool $isDark
     */
    public function changeTheme($isDark): void
    {
        $this->is_dark_theme = $isDark;
        $this->save();
    }
}
