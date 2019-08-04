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
 * Class UserEntity.
 *
 * @package Woisks\Comment\Models\Entity
 *
 * @Author Maple Grove  <bolelin@126.com> 2019/8/4 11:09
 */
class UserEntity extends Models
{
    /**
     * table.  2019/8/4 11:09.
     *
     * @var  string
     */
    protected $table = 'comment_user_count';

    /**
     * fillable.  2019/8/4 11:09.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'account_uid',
        'type',
        'count'
    ];

    /**
     * timestamps.  2019/8/4 11:09.
     *
     * @var  bool
     */
    public $timestamps = false;
}
