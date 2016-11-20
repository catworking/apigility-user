<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/16
 * Time: 15:38
 */
namespace ApigilityUser\Service\Exception;

class PhoneExistException extends \Exception
{
    const CODE = 10001;
    const MESSAGE = '手机号已注册';
    public function __construct()
    {
        parent::__construct(self::MESSAGE, self::CODE);
    }
}