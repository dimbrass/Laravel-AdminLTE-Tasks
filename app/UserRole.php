<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $timestamps = false;

    protected $table = 'userroles';

  /**
   * Атрибуты, для которых запрещено массовое назначение.
   *
   * @var array
   */
  protected $guarded = ['admin'];

  // Получить пользователя - владельца данной записи ролей
  public function user()
  {
    return $this->hasOne('App\User');
  }
}
