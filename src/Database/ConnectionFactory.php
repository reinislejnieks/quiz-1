<?php

namespace Quiz\Database;

use Quiz\Database\Mysql\MysqlConnection;
use Quiz\Database\Mysql\MysqlConnectionConfig;
use Quiz\Interfaces\ConnectionConfigInterface;
use Quiz\Interfaces\ConnectionInterface;

class ConnectionFactory
{
    const DRIVER_MYSQL = 'mysql';

    const DRIVERS = [
        self::DRIVER_MYSQL => MysqlConnection::class,
    ];

    const CONFIGS = [
        self::DRIVER_MYSQL => MysqlConnectionConfig::class
    ];

    /**
     * @param string $driver
     * @param ConnectionConfigInterface|null $config
     * @return ConnectionInterface
     */
    public static function getDriver(
        string $driver = self::DRIVER_MYSQL,
        ConnectionConfigInterface $config = null
    ): ConnectionInterface {
        $className = self::DRIVERS[$driver];

        return new $className($config);
    }

    /**
     * @param string $driver
     * @return ConnectionConfigInterface
     */
    public static function getDriverConfig(string $driver = self::DRIVER_MYSQL): ConnectionConfigInterface
    {
        $className = self::CONFIGS[$driver];

        return new $className;
    }
}