<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/12/9
 * Time: 11:22
 */
namespace ApigilityUser\Service;

use Zend\ServiceManager\ServiceManager;
use ApigilityUser\Vendor\EaseMob\HxCall;

class EaseMobService
{
    /**
     * @var \ApigilityUser\Vendor\EaseMob\HxCall
     */
    protected $hxCall;

    protected $config;

    public function __construct(ServiceManager $services)
    {
        $config = $services->get('config');
        if (!isset($config['apigility-user']['ease-mob'])) throw new \Exception('没有配置环信', 500);
        else $config = $config['apigility-user']['ease-mob'];

        $this->config = $config;
        $this->hxCall = new HxCall($config);
    }

    /**
     * 创建环信帐户
     *
     * @param $username
     * @param $nickname
     * @return mixed
     */
    public function createAccount($username, $nickname)
    {
        return $this->hxCall->hx_register($username, $this->config['account_register_password'], $nickname);
    }

    /**
     * 更新环信帐户的昵称
     *
     * @param $username
     * @param $nickname
     * @return string
     */
    public function updateNickname($username, $nickname)
    {
        return $this->hxCall->hx_user_update_nickname($username, $nickname);
    }
}