<?php

namespace Lamc\Events;

use Illuminate\Database\Connection;
use Illuminate\Database\Events\QueryExecuted;

class AsgardQueryExecuted extends QueryExecuted
{
    public $result;

    public function __construct(string $sql, array $bindings, $result, $time, Connection $connection)
    {
        parent::__construct($sql, $bindings, $time, $connection);
        $this->result = $result;
    }

}
