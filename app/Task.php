<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    /**
     * Массово присваиваемые атрибуты.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Получить пользователя - владельца данной задачи
     */
    public function user()
    {
       $fetch = $this->belongsTo(User::class);

        return $fetch;
    }


    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    //protected $table = 'my_tasks';
}
