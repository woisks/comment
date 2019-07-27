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

namespace Woisks\Comment\Models\Entity;


/**
 * Class TypeEntity.
 *
 * @package Woisks\Comment\Models\Entity
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/7/20 13:26
 */
class TypeEntity extends Models
{
    /**
     * table.  2019/7/20 13:26.
     *
     * @var  string
     */
    protected $table = 'comment_type_count';
    /**
     * fillable.  2019/7/20 13:26.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'name',
        'readme',
        'count'
    ];

    /**
     * timestamps.  2019/7/20 13:26.
     *
     * @var  bool
     */
    public $timestamps = false;
}