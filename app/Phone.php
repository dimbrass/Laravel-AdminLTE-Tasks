<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    // Массово присваиваемые атрибуты.
    protected $fillable = ['phone', 'ord_phone'];

    // Получить пользователя - владельца данной задачи
    public function user()
    {
       $fetch = $this->belongsTo(User::class);
        return $fetch;
    }
}
