<?php

namespace Jefferywork\PhpCron\Libs;

class Jiaqi
{
    /**
     * 判断是否假期
     *
     * true：假期、false：非假期
     * @return bool
     */
    public static function is()
    {
        $dayOfWeek = (int)date('N');
        if ($dayOfWeek >= 6) { // 如果是星期六（6）或星期天（7）
            return true;
        }

        return self::isChinaJieRi();
    }

    // https://gitee.com/holate/public-holiday/tree/master/holidays/year
    public static function isChinaJieRi()
    {
        $file2023 = ROOT_PATH . 'src/Files/2023.json';
        $file2024 = ROOT_PATH . 'src/Files/2024.json';

        if(self::chinaJieRi($file2023)) {
            return true;
        }

        if(self::chinaJieRi($file2024)) {
            return true;
        }

        return false;
    }

    private static function chinaJieRi($file) {
        $date = date('Y-m-d');
        if(is_file($file)) {
            $json = file_get_contents($file);
            $data = json_decode($json, true);
            foreach ($data['holiday'] as $value) {
                if($date == $value['date']) {
                    return true;
                }
            }
        }
        return false;
    }

}