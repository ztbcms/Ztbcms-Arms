<?php
/**
 * User: jayinton
 * Date: 2019-09-02
 * Time: 17:49
 */

namespace Arms\Service;


use System\Service\BaseService;

class ArmsService extends BaseService
{

    static function getRequestSummary()
    {
        G('beginTime', $GLOBALS['_beginTime']);

        $info = array(
            '请求信息' => [
                'protocol' => $_SERVER['SERVER_PROTOCOL'],
                'domain' => urlDomain(get_url()),
                'method' => $_SERVER['REQUEST_METHOD'],
                'uri' => __SELF__,
            ],
            '吞吐率' => number_format(1 / G('beginTime', 'viewEndTime'), 1),//单位 req/s
            '内存开销' => MEMORY_LIMIT_ON ? number_format((memory_get_usage() - $GLOBALS['_startUseMems']) / 1024 / 1024, 1) : '-1',//单位MB, -1时为不支持记录,预估值
            '查询信息' => [
                'query' => N('db_query'),
                'write' => N('db_write')
            ],
            '文件加载' => count(get_included_files()),
            '缓存信息' => [
                'get' => N('cache_read'),
                'write' => N('cache_write')
            ],
            '运行时间' => [
                '总时间' => G('beginTime', 'viewEndTime'), //总运行时间
                '加载时间' => G('beginTime', 'loadTime'), //总运行时间
                '初始化时间' => G('loadTime', 'initTime'), //初始化时间
                '执行时间' => G('initTime', 'viewStartTime'), //controller执行时间
                '渲染时间' => G('viewStartTime', 'viewEndTime'), //模板渲染时间
            ]
        );

        return self::createReturn(true, $info);
    }

    static function addAccessLog($data)
    {
        M('arms_access_log')->add($data);
    }
}