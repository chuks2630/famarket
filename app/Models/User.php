<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function shop(){
        return $this->hasOne(Shop::class);
    }
    public function feedback(){
        return $this->hasMany(Feedback::class,'user_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function savedads(){
        return $this->hasMany(SavedAd::class);
    }

    public function conversationAsUser1(){

        return $this->hasMany(Conversation::class, 'user_1_id');
    }

    public function conversationAsUser2(){

        return $this->hasMany(Conversation::class, 'user_2_id');
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'firstname',
        'lastname',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
