<?php

namespace Softspring\Component\DynamicFormType;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SfsDynamicFormTypeBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}