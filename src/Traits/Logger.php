<?php
namespace MiniStore\Traits;

trait Logger
{
    protected function log(string $message, string $level = 'INFO'): void
    {
        $config = include __DIR__ . '/../../config/config.php';
        $logEntry = sprintf(
            "[%s] %s: %s\n",
            date('Y-m-d H:i:s'),
            $level,
            $message
        );
        file_put_contents($config['log_file'], $logEntry, FILE_APPEND);
    }
}