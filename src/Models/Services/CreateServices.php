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


use Woisks\Comment\Models\Repository\CommentRepository;
use Woisks\Comment\Models\Repository\CountRepository;

/**
 * Class CreateServices.
 *
 * @package Woisks\Comment\Models\Services
 *
 * @Author  Maple Grove  <bolelin@126.com> 2019/7/20 13:58
 */
class CreateServices
{
    /**
     * commentRepo.  2019/7/20 13:58.
     *
     * @var  \Woisks\Comment\Models\Repository\CommentRepository
     */
    private $commentRepo;
    /**
     * countRpo.  2019/7/20 13:58.
     *
     * @var  \Woisks\Comment\Models\Repository\CountRepository
     */
    private $countRpo;

    /**
     * CreateServices constructor. 2019/7/20 13:58.
     *
     * @param \Woisks\Comment\Models\Repository\CommentRepository $commentRepo
     * @param \Woisks\Comment\Models\Repository\CountRepository   $countRpo
     *
     * @return void
     */
    public function __construct(CommentRepository $commentRepo,
                                CountRepository $countRpo)
    {
        $this->commentRepo = $commentRepo;
        $this->countRpo = $countRpo;
    }


    /**
     * count. 2019/7/20 13:58.
     *
     * @param $type
     *
     * @return mixed
     */
    public function count($type)
    {
        return $this->countRpo->first($type);
    }

    /**
     * comment. 2019/7/20 13:58.
     *
     * @param $type
     * @param $numeric
     * @param $content
     * @param $uid
     *
     * @return mixed
     */
    public function comment($type, $numeric, $content, $uid)
    {
        return $this->commentRepo->created($type, $numeric, $content, $uid);
    }


}