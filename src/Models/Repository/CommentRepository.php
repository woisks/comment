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


use Woisks\Comment\Models\Entity\CommentEntity;

/**
 * Class CommentRepository.
 *
 * @package Woisks\Comment\Models\Repository
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/7/20 13:29
 */
class CommentRepository
{
    /**
     * model.  2019/7/20 13:29.
     *
     * @var static \Woisks\Comment\Models\Entity\CommentEntity
     */
    private static $model;

    /**
     * CommentRepository constructor. 2019/7/20 13:29.
     *
     * @param \Woisks\Comment\Models\Entity\CommentEntity $comment
     *
     * @return void
     */
    public function __construct(CommentEntity $comment)
    {
        self::$model = $comment;
    }

    /**
     * created. 2019/7/20 13:56.
     *
     * @param $type
     * @param $numeric
     * @param $content
     * @param $uid
     *
     * @return mixed
     */
    public function created($type, $numeric, $content, $uid)
    {
        return self::$model->create([
            'id'           => create_numeric_id(),
            'account_uid'  => $uid,
            'type'         => $type,
            'type_numeric' => $numeric,
            'content'      => $content,
        ]);
    }

    /**
     * reply. 2019/7/20 13:57.
     *
     * @param $type
     * @param $numeric
     * @param $content
     * @param $parent_id
     * @param $uid
     *
     * @return mixed
     */
    public function reply($type, $numeric, $content, $parent_id, $uid)
    {
        return self::$model->create([
            'id'           => create_numeric_id(),
            'account_uid'  => $uid,
            'type'         => $type,
            'type_numeric' => $numeric,
            'content'      => $content,
            'parent_id'    => $parent_id
        ]);
    }

    /**
     * whereGet. 2019/7/20 14:48.
     *
     * @param $type
     * @param $numeric
     *
     * @return mixed
     */
    public function whereGet($type, $numeric)
    {
        return self::$model->where('type_numeric', $numeric)->where('type', $type)->paginate();
    }

}