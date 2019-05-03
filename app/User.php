<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Friendship;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function account_balance()
    {
        return $this->hasOne('App\AccountBalance');
    }
    protected function friendsOfThisUser()
    {
        return $this->belongsToMany(User::class, 'friendships', 'first_user', 'second_user')
            ->withPivot('status')
            ->wherePivot('status', 'confirmed');
    }

    // friendship that this user was asked for
    protected function thisUserFriendOf()
    {
        return $this->belongsToMany(User::class, 'friendships', 'second_user', 'first_user')
            ->withPivot('status')
            ->wherePivot('status', 'confirmed');
    }

    // accessor allowing you call $user->friends
    public function getFriendsAttribute()
    {
        if (!array_key_exists('friends', $this->relations)) $this->loadFriends();
        return $this->getRelation('friends');
    }

    protected function loadFriends()
    {
        if (!array_key_exists('friends', $this->relations)) {
                $friends = $this->mergeFriends();
                $this->setRelation('friends', $friends);
            }
    }

    protected function mergeFriends()
    {
        if ($temp = $this->friendsOfThisUser)
            return $temp->merge($this->thisUserFriendOf);
        else
            return $this->thisUserFriendOf;
    }

    protected function friendsOfThisUserBlocked()
    {
        return $this->belongsToMany(User::class, 'friendships', 'first_user', 'second_user')
            ->withPivot('status', 'acted_user')
            ->wherePivot('status', 'blocked')
            ->wherePivot('acted_user', 'first_user');
    }

    // friendship that this user was asked for but now blocked
    protected function thisUserFriendOfBlocked()
    {
        return $this->belongsToMany(User::class, 'friendships', 'second_user', 'first_user')
            ->withPivot('status', 'acted_user')
            ->wherePivot('status', 'blocked')
            ->wherePivot('acted_user', 'second_user');
    }

    // accessor allowing you call $user->blocked_friends
    public function getBlockedFriendsAttribute()
    {
        if (!array_key_exists('blocked_friends', $this->relations)) $this->loadBlockedFriends();
        return $this->getRelation('blocked_friends');
    }

    protected function loadBlockedFriends()
    {
        if (!array_key_exists('blocked_friends', $this->relations)) {
                $friends = $this->mergeBlockedFriends();
                $this->setRelation('blocked_friends', $friends);
            }
    }

    protected function mergeBlockedFriends()
    {
        if ($temp = $this->friendsOfThisUserBlocked)
            return $temp->merge($this->thisUserFriendOfBlocked);
        else
            return $this->thisUserFriendOfBlocked;
    }

    public function friend_requests()
    {
        return $this->hasMany(Friendship::class, 'second_user')
            ->where('status', 'pending');
    }
    public function addFriend($user_one, $user_two)
{

    $friend_request = Friendship::create([
        'first_user' => $user_one->id,
        'second_user' => $user_two->id,
        'acted_user' => $user_one->id,
        'status' => 'pending'
    ]);

    $friend_request->save();
    return $friend_request;

}
}
