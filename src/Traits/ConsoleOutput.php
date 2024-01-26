<?php

namespace Jefferywork\PhpCron\Traits;

trait ConsoleOutput
{
    public function info(string $message): void
    {
        $this->write("\033[32m", 'Info: ' . $message); // Green
    }

    public function warning(string $message): void
    {
        $this->write("\033[33m", 'Warning: ' . $message); // Yellow
    }

    public function error(string $message): void
    {
        $this->write("\033[31m", 'Error: ' . $message); // Red
    }

    private function write(string $color, string $message): void
    {
        fwrite(STDOUT, $color . $message . "\033[0m" . PHP_EOL); // Reset color
    }
}