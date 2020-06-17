<?php

namespace Bertshang\Dameng\Connectors;

use PDO;
use Illuminate\Database\Connectors\Connector;
use Illuminate\Database\Connectors\ConnectorInterface;

class DmConnector extends Connector implements ConnectorInterface
{
    /**
     * The default PDO connection options.
     *
     * @var array
     */
    protected $options = [
        PDO::ATTR_CASE         => PDO::CASE_LOWER,
        PDO::ATTR_ERRMODE      => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
    ];

    /**
     * Establish a database connection.
     *
     * @param array $config
     * @return PDO
     */
    public function connect(array $config)
    {
        $dsn = $this->getHostDsn($config);
        $options = $this->getOptions($config);
        $connection = $this->createConnection($dsn, $config, $options);
        return $connection;
    }

    protected function getHostDsn(array $config)
    {
        extract($config, EXTR_SKIP);

        return isset($port)
            ? "dm:host={$host};port={$port};"
            : "dm:host={$host};";
    }

}
