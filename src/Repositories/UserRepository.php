<?php

namespace Quiz\Repositories;

use Quiz\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * Returns the corresponding model class name
     * @return string
     */
    public static function modelName(): string
    {
        return User::class;
    }

    /**
     * @return string
     */
    public static function getTableName(): string
    {
        return 'users';
    }
}
