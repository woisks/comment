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

namespace Woisks\Comment\Models\Repository;


use Woisks\Comment\Models\Entity\CountEntity;

/**
 * Class CountRepository.
 *
 * @package Woisks\Comment\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/7/20 13:29
 */
class CountRepository
{
    /**
     * model.  2019/7/20 13:29.
     *
     * @var static \Woisks\Comment\Models\Entity\CountEntity
     */
    private static $model;

    /**
     * CountRepository constructor. 2019/7/20 13:29.
     *
     * @param \Woisks\Comment\Models\Entity\CountEntity $count
     *
     * @return void
     */
    public function __construct(CountEntity $count)
    {
        self::$model = $count;
    }

    /**
     * first. 2019/7/24 13:23.
     *
     * @param $type
     *
     * @return mixed
     */
    public function first($type)
    {
        return self::$model->where('name', $type)->first();
    }
}