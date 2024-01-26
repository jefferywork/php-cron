<?php
namespace Jefferywork\PhpCron\Controllers;

use Jefferywork\PhpCron\Libs\AlarmSystem;
use Jefferywork\PhpCron\Libs\Jiaqi;
use Jefferywork\PhpCron\Traits\Variables;

class HeshuiController
{
    use Variables;

    private string $feishu = '';

    public function __construct()
    {
        $this->feishu = self::feishuHeshui();
    }

    public function index()
    {
        $hour = (int)date('H');
        if($hour < 11 || $hour > 18) {
            return;
        }
        if($hour > 12 && $hour < 14) {
            return;
        }


        if(Jiaqi::is()) {
            return;
        }

        echo '提醒喝水任务执行';
        AlarmSystem::feishu($this->feishu, $this->msg[array_rand($this->msg)]);
    }

    private array $msg = [
        [
            '大佬们喝水了',
            '如果感觉很疲惫，有榨干耗尽的感觉，很可能是脱水引起的，要及时补充水分。足量饮水能够使心脏更有效地泵血。而且体内水分有助于血液输送氧和其他细胞必需的养分。'
        ],
        [
            '老板们快喝水',
            '只有适量喝水能够防止肌肉抽筋，润滑身体关节。如果体内有足够的水分，运动的强度可以更大、时间也可以更长，更晚感受到极限，这也有助于练出健美的身材。'
        ],
        [
            '多多喝水身体棒',
            '水能滋润皮肤。皮肤缺水，就会变得干燥失去弹性，显得面容苍老。体内一些关节囊液、浆膜液可使器官之间免于摩擦受损，且能转动灵活。眼泪、唾液也都是相应器官的润滑剂。'
        ],
        [
            '快喝水',
            '因为水能加快新陈代谢，使人有饱腹感。因此，用水取代高热量的饮料，饭前喝一杯能让自己感觉更饱。而且多喝水能使新陈代谢更旺盛，特别是喝冰冷的水，因为身体需要把这些水加热，这个过程会消耗一定的热量。'
        ],
        [
            '别废话，喝水去',
            '由于水同纤维一样，对保持消化系统正常运转至关重要。水有助于分解废物，使它们顺畅地通过消化道排出体外。'
        ],
        [
            '喝水了',
            '水能促进细胞新陈代谢，维持细胞的正常形态；保持皮肤的湿润和弹性。'
        ],
        [
            '麻溜的喝水',
            '人体关节之间需要有润滑液，来避免骨头之间的损坏性摩擦，而水则是关节润滑液的主要来源。'
        ],
        [
            '速度的喝水',
            '食物的营养消化吸收后剩余的残渣废物，要通过出汗、呼吸及排泄的方式排出体外，这几种不同的排泄方式都需水分的帮助才能实现。'
        ],
        [
            '喝水可以改善血液',
            '水能改善血液、组织液的循环，并有助于平衡血液的黏稠度和酸碱度'
        ],
        [
            '喝水可以加快新陈代谢',
            '水能促进细胞新陈代谢，维持细胞的正常形态；保持皮肤的湿润和弹性'
        ],
    ];
}