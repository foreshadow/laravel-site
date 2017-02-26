<?php

namespace App\Utilities;

class Functions
{
    public static function datetime($expression)
    {
        return date('y/n/j G:i', strtotime((string)$expression));
    }

    public static function relative_time($timeInterval, $extend = false)
    {
        $suffix = $timeInterval > 0 ? '后' : '前';
        $timeInterval = abs($timeInterval);
        $time = [
            ['text'=>'秒', 'base'=> 60],
            ['text'=>'分钟', 'base'=> 60],
            ['text'=>'小时', 'base'=> 24],
            ['text'=>'天', 'base'=> 7],
            ['text'=>'周', 'base'=> 4],
            ['text'=>'很久'],
        ];
        foreach ($time as $unit) {
            if ($timeInterval < $unit['base']) {
                $relative = $timeInterval . $unit['text'];
                if (isset($remainder) && $remainder) {
                    $relative .= $remainder;
                }
                return $relative. $suffix;
            } else {
                if ($extend) {
                    $remainder = $timeInterval % $unit['base'] . $unit['text'];
                }
                $timeInterval = floor($timeInterval / $unit['base']);
            }
        }
    }
}
