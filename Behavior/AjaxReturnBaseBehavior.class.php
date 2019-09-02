<?php

/**
 * author: Jayin <tonjayin@gmail.com>
 */

namespace Arms\Behavior;

use Arms\BehaviorParam\AjaxReturnBaseBehaviorParam;
use Common\Behavior\BaseBehavior;
use Log\Service\LogService;

class AjaxReturnBaseBehavior extends BaseBehavior {

    /**
     * @param AjaxReturnBaseBehaviorParam
     */
    public function run(&$param)
    {
        parent::run($param);

        LogService::log('AjaxReturnBaseBehavior', ',,,,');
        var_dump('111');exit;
    }


}