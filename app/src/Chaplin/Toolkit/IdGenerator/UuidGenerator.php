<?php

namespace Chaplin\Toolkit\IdGenerator;

use Ramsey\Uuid\Uuid;

class UuidGenerator
{
    public static function generateId(): string
    {
        return Uuid::uuid4()->toString();
    }

    public function generate(): string
    {
        return self::generateId();
    }
}
