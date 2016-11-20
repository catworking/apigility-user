<?php
/**
 * Created by PhpStorm.
 * User: figo-007
 * Date: 2016/11/16
 * Time: 15:38
 */
namespace ApigilityUser\Service\Exception;

class IdentityNotExistException extends \Exception
{
    const CODE = 10002;
    const MESSAGE = '用户标识不存在';
    public function __construct()
    {
        parent::__construct(self::MESSAGE, self::CODE);
    }
}