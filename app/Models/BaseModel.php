<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function getCreatedAtAttribute()
    {
        $time = $this->attributes['created_at'];
        return self::formatDate($time);
    }

    public function getUpdatedAtAttribute()
    {
        $time = $this->attributes['updated_at'];

        return self::formatDate($time);
    }

    public function getParseStatusAttribute()
    {
        if (!isset($this->attributes['status'])) {
            return '';
        }

        return static::$status[$this->attributes['status']];
    }

    /**
     * Format time
     * @param $time
     * @return false|string
     */
    public static function formatDate($time)
    {
        if (!is_numeric($time)) {
            $time = strtotime($time);
        }

        $fee = time() - $time;
        if ($fee <= 0) {
            $str = '刚刚';
        } else {
            if (date("Y", $time) != date("Y")) {
                $str = date("Y-m-d", $time);
            } else {
                $day = floor(($fee / 86400));
                if ($day > 3) {
                    $str = date("m-d H:i", $time);
                } elseif ($day > 0 && $day <= 3) {
                    $str = $day . '天前';
                } else {
                    $hour = floor(($fee / 3600));
                    if ($hour > 0) {
                        $str = $hour . '小时前';
                    } else {
                        $min = floor(($fee / 60));
                        if ($min > 0) {
                            $str = $min . '分钟前';
                        } else {
                            $str = $fee . '秒前';
                        }
                    }
                }
            }
        }

        return $str;
    }
}
