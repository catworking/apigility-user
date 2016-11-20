<?php
namespace ApigilityUser\V1\Rest\Identity;

use Zend\Paginator\Paginator;
use Zend\Hydrator\ClassMethods as ClassMethodsHydrator;
use Zend\Stdlib\ArrayObject as ZendArrayObject;

class IdentityCollection extends Paginator
{
    public function getCurrentItems()
    {
        $set = parent::getCurrentItems();
        $collection = new ZendArrayObject();

        foreach ($set as $item) {
            $collection->append(new IdentityEntity($item));
        }
        return $collection;
    }
}
