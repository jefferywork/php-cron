<?php
namespace Jefferywork\PhpCron\Libs;


class AlarmSystem
{

    /**
     * https://open.dingtalk.com/document/orgapp/custom-robot-access#title-zob-eyu-qse
     *
     * @param string $url
     * @param array $content
     * @return void
     */
    public static function dingding(string $url, array $content)
    {
        self::asyncPostRequest($url, [
            'msgtype' => 'text',
            'text' => [
                'content' => implode("\n", $content),
            ]
        ], true);
    }

    /**
     * https://open.feishu.cn/document/client-docs/bot-v3/add-custom-bot
     *
     * @param string $url
     * @param array $content
     * @return void
     */
    public static function feishu(string $url, array $content)
    {
        self::asyncPostRequest($url, [
            'msg_type' => 'text',
            'content' => [
                'text' => implode("\n", $content),
            ]
        ], true);
    }

    /**
     * https://www.showdoc.com.cn/push
     *
     * @param string $url
     * @param array $content
     * @return void
     */
    public static function showdoc(string $url, array $content)
    {
        self::asyncPostRequest($url, [
            'title' => $content['message'] ?? '-',
            'content' => implode("\n", $content),
        ]);
    }

    private static function asyncPostRequest($url, $data, $isJson = false): void
    {
        $ch = curl_init($url);

        if ($isJson) {
            $payload = json_encode($data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        } else {
            $payload = http_build_query($data);
        }

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        // 设置为异步请求
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        curl_setopt($ch, CURLOPT_NOSIGNAL, 1);

        // 执行请求并关闭连接
        curl_exec($ch);
        curl_close($ch);
    }
}


