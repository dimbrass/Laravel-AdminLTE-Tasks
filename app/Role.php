<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

  // Получить пользователя - владельца данной записи ролей
  public function user()
  {
    return $this->hasOne('App\User');
  }
}
