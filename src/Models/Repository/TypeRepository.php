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


use Woisks\Comment\Models\Entity\TypeEntity;

/**
 * Class TypeRepository.
 *
 * @package Woisks\Comment\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/7/20 13:29
 */
class TypeRepository
{

    /**
     * model.  2019/7/28 10:52.
     *
     * @var static TypeEntity
     */
    private static $model;


    /**
     * TypeRepository constructor. 2019/7/28 10:52.
     *
     * @param TypeEntity $count
     *
     * @return void
     */
    public function __construct(TypeEntity $count)
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
        return self::$model->where('type', $type)->first();
    }

    /**
     * decrement. 2019/7/28 10:52.
     *
     * @param $type
     *
     * @return mixed
     */
    public function decrement($type)
    {
        return self::$model->where('type', $type)->decrement('count');
    }
}
