<?php

include_once "./vendor/autoload.php";

use think\facade\Db;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Tools\Daemon;

class DaemonDemo extends Daemon
{
    /**
     * 守护进程的任务
     */
    protected function job()
    {
        // TODO 常驻脚本代码
        while (true) {
            $this->log('job done : ' . date('Y-m-d H:i:s') . PHP_EOL);
            sleep(10);
        }
    }

    /**
     * 自动日志
     *
     * @return void
     */
    private function log($msg)
    {
        // create a log channel
        $log = new Logger('report');
        $log->pushHandler(new StreamHandler(dirname(__FILE__) . '/cache/report.log'));
        $log->info($msg);
    }
}

$deamon = new DaemonDemo(dirname(__FILE__) . '/cache/daemon_demo.pid');
$deamon->run($argv);