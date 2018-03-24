<?php
/**
 * Created by PhpStorm.
 * User: xutiecheng
 * Date: 2018/3/23
 * Time: 下午7:40
 */

namespace Lamc\Driver;

use Lamc\Events\AsgardQueryExecuted;
use Closure;
use Illuminate\Database\MySqlConnection;

class AsgardMySqlConnection extends MySqlConnection
{
    protected function run($query, $bindings, Closure $callback)
    {
        $start = microtime(true);
        $result = parent::run($query, $bindings, $callback);
        $time = $this->getElapsedTime($start);
        $this->event(new AsgardQueryExecuted($query, $bindings, $result, $time, $this));
        return $result;
    }

    public function listen(Closure $callback)
    {
        if (isset($this->events)) {
            $this->events->listen(AsgardQueryExecuted::class, $callback);
        }
    }
}
