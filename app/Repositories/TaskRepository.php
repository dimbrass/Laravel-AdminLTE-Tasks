<?php

namespace App\Repositories;

use App\User;

class TaskRepository
{
    /**
     * Получить все задачи заданного пользователя.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUserAllAlive($request)
    {
        $result = $request->user()->tasks()->orderBy('created_at', 'asc');

        if ($request->tasks == 'completed')          $result = $result->where('completed_at', '>', '')
                                                                      ->orWhere('completed_part', '>', 0);
        if ($request->tasks == 'completed-part')     $result = $result->where('completed_part', '>', 0);
        if ($request->tasks == 'add-time')           $result = $result->where('add_time', '>', '');

        if (!empty($request->datepicker)) $result = $result->where('created_at', 'LIKE', "$request->datepicker%" );

        return $result->get();
    }
}
