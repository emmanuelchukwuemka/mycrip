<?php

namespace App\Database;

use Illuminate\Database\Connectors\PostgresConnector;

/**
 * Neon's pooled/direct endpoints route by hostname via SNI. Older libpq
 * builds (notably the one bundled with some Windows PHP distributions)
 * don't negotiate that automatically and need the endpoint ID passed
 * explicitly as a connection option. See https://neon.tech/sni
 */
class NeonPostgresConnector extends PostgresConnector
{
    protected function getDsn(array $config)
    {
        $dsn = parent::getDsn($config);

        $host = $config['host'] ?? '';

        if (str_ends_with($host, '.neon.tech')) {
            $endpoint = strstr($host, '.', true);
            $dsn .= ";options='endpoint={$endpoint}'";
        }

        return $dsn;
    }
}
