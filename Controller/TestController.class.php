<?php
/**
 * User: jayinton
 * Date: 2019-09-02
 * Time: 19:16
 */

namespace Arms\Controller;


use Arms\Service\ArmsService;
use Arms\Traits\AjaxReturnTrait;
use Common\Controller\Base;

class TestController extends Base
{
    use AjaxReturnTrait;

    function index()
    {
        $info = ArmsService::getRequestSummary();
        $this->ajaxReturn($info);
    }
}