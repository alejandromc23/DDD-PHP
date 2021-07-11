<?php


namespace Chaplin\Core\Infrastructure\DoctrineTypes;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class Id extends GuidType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        // some bundles/libraries don't work with VO's
        if (is_scalar($value)) {
            return $value;
        }

        if (null !== $value) {
            return $value->id();
        }

        return null;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (is_null($value)) {
            return null;
        }
        $className = $this->getNamespace() . '\\' . $this->getName();

        return new $className($value);
    }

    public function getName(): string
    {
        return 'Id';
    }

    protected function getNamespace(): string
    {
        return 'Colvin\Core\Domain\ValueObject';
    }
}