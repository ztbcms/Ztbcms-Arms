<?php
/**
 * User: jayinton
 * Date: 2019-09-02
 * Time: 18:26
 */

namespace Arms\Traits;


use Arms\Service\ArmsService;

/**
 * Trait AjaxReturnTrait
 * @package Arms\Traits
 */
trait AjaxReturnTrait
{
    protected function ajaxReturn($data, $type = '', $json_option = 0)
    {
        $data['state'] = $data['status'] ? "success" : "fail";
        if (empty($type)) {
            $type = C('DEFAULT_AJAX_RETURN');
        }

        switch (strtoupper($type)) {
            case 'JSON':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:text/json; charset=utf-8');
                echo json_encode($data, $json_option);
                break;
            case 'XML':
                // 返回xml格式数据
                header('Content-Type:text/xml; charset=utf-8');
                echo xml_encode($data);
                break;
            case 'JSONP':
                // 返回JSON数据格式到客户端 包含状态信息
                header('Content-Type:application/json; charset=utf-8');
                $handler = isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');
                echo $handler . '(' . json_encode($data, $json_option) . ');';
                break;
            case 'EVAL':
                // 返回可执行的js脚本
                header('Content-Type:text/html; charset=utf-8');
                echo $data;
                break;
            default:
                // 用于扩展其他返回格式数据
                tag('ajax_return', $data);
        }

        // 记录信息
        $info = ArmsService::getRequestSummary()['data'];
        ArmsService::addAccessLog([
            'domain' => $info['请求信息']['domain'],
            'uri' => $info['请求信息']['uri'],
            'exec_time' => $info['运行时间']['总时间'] * 1000,
        ]);
        exit();
    }
}