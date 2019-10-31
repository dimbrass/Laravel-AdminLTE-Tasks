<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $timestamps = false;
    
    protected $table = 'userroles';

    protected $fillable = ['worker'];

    // Получить пользователя - владельца данной записи ролей
    public function user()
    {
        return $this->hasOne('App\User');
    }
}
