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
    public function forUserAllAlive(User $user, $request)
    {
        $result = $user->tasks()->orderBy('created_at', 'asc');

        if ($request->completed == 1)     $result = $result->where('completed_at', '>', '');

        if (!empty($request->datepicker)) $result = $result->where('created_at', 'LIKE', "$request->datepicker%" );

        return $result->get();
    }
}
