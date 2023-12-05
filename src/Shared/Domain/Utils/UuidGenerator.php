<?php

namespace Core\Shared\Domain\Utils;

interface UuidGenerator
{
    public function generate(): string;
}
