<?php

namespace App\Service;

class CircularReferenceHandler
{
    public function __invoke($object)
    {
        return $object->getId();
    }
}