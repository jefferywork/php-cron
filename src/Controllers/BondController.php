<?php

namespace Jefferywork\PhpCron\Controllers;

use Jefferywork\PhpCron\Libs\AlarmSystem;
use Jefferywork\PhpCron\Libs\Jiaqi;

class BondController extends Controller
{

    private string $feishu = '';
    private string $url = 'https://www.jisilu.cn/data/calendar/get_calendar_data/?qtype=CNV&start=%d&end=%d';

    public function __construct()
    {
        $this->feishu = getenv('FEISHU') ?? '';
    }

    public function index()
    {
        if(Jiaqi::is()) {
            $this->info('新债判断假期，任务中止');
            return;
        }

        $start = strtotime('-1 day');
        $end = strtotime('+1 day');
        $url = sprintf($this->url, $start, $end);
        $this->info('获取到请求的url' . $url);
        $json = file_get_contents($url);
        if(empty($json)) {
            echo '没有获取到数据' . PHP_EOL;
            return;
        }

        $this->info('获取到数据' . $json);

        $array = json_decode($json, true);

        $data = [];
        foreach ($array as $value) {
            if($value['start'] != date('Y-m-d')) {
                continue;
            }

            if(strpos($value['title'], '上市日') ||
                strpos($value['title'], '申购日')
            ) {
                $data[] = implode("\n", $value) . "\n";
            }
        }

        if(empty($data)) {
            return;
        }

        $this->info('新债消息发送' . json_encode($data, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE));
        AlarmSystem::feishu($this->feishu, $data);
    }

}