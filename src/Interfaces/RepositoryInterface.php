<?php

namespace Quiz\Interfaces;

interface RepositoryInterface
{
    /**
     * Returns the corresponding model class name
     * @return string
     */
    public static function modelName(): string;

    /**
     * @return string
     */
    public static function getTableName(): string;
}
