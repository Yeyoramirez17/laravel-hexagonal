<?php

namespace Core\Shared\Infrastructure\Util;

use Core\Shared\Domain\Utils\UuidGenerator;
use Ramsey\Uuid\Uuid as RamseyUuid;

final class RamseyUuidGenerator implements UuidGenerator
{

    public function generate(): string
    {
        return RamseyUuid::uuid4()->toString();
    }
}
