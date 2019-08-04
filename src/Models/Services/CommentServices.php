<?php

declare(strict_types=1);

/*
 * +----------------------------------------------------------------------+
 * |                   At all timesI love the moment                      |
 * +----------------------------------------------------------------------+
 * | Copyright (c) 2019 www.Woisk.com All rights reserved.                |
 * +----------------------------------------------------------------------+
 * |  Author:  Maple Grove  <bolelin@126.com>   QQ:364956690   286013629  |
 * +----------------------------------------------------------------------+
 */

namespace Woisks\Comment\Models\Services;


use Woisks\Comment\Models\Entity\CommentEntity;
use Woisks\Comment\Models\Entity\TypeEntity;

/**
 * Class CommentServices.
 *
 * @package Woisks\Comment\Models\Services
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/8/4 21:37
 */
class CommentServices
{
    /**
     * delete. 2019/8/4 21:37.
     *
     * @param $type
     * @param $numeric
     *
     * @return mixed
     */
    public static function delete($type, $numeric)
    {
        $int = CommentEntity::where('numeric', $numeric)->where('type', $type)->count();
        TypeEntity::where('type', $type)->decrement('count', $int);
        return CommentEntity::where('numeric', $numeric)->where('type', $type)->delete();
    }

}
