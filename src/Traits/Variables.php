<?php
namespace Jefferywork\PhpCron\Traits;

trait Variables
{
    public static function feishuHeshui()
    {
        return getenv('FEISHUHESHUI') ?? '';
    }

    public static function feishuBond()
    {
        return getenv('FEISHUBOND') ?? '';
    }

}