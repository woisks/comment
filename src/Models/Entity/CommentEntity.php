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
 * Class CommentEntity.
 *
 * @package Woisks\Comment\Models\Entity
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/7/20 13:25
 */
class CommentEntity extends Models
{
    /**
     * table.  2019/7/20 13:25.
     *
     * @var  string
     */
    protected $table = 'comment';
    /**
     * fillable.  2019/7/20 13:25.
     *
     * @var  array
     */
    protected $fillable = [
        'id',
        'account_uid',
        'type',
        'type_numeric',
        'content',
        'status',
        'created_at',
        'updated_at',
        'parent_id'
    ];
}