<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Platforms\MariaDBPlatform;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\Uid\Uuid;

class UuidType extends Type
{
    public const NAME = 'uuid_mariadb';

    public function getName(): string
    {
        return self::NAME;
    }

    public function getMappedDatabaseTypes(AbstractPlatform $platform): array
    {
        if ($platform instanceof MariaDBPlatform) {
            return ['uuid'];
        }

        throw new \RuntimeException('Unsupported platform.');
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        if ($platform instanceof MariaDBPlatform) {
            return 'UUID';
        }

        throw new \RuntimeException('Unsupported platform.');
    }

    public function convertToDatabaseValue(mixed $value, AbstractPlatform $platform): ?string
    {
        if ($value === null || is_string($value)) {
            return $value;
        }

        if ($value instanceof Uuid) {
            return $value->toRfc4122();
        }

        throw new \InvalidArgumentException();
    }

    public function convertToPHPValue(mixed $value, AbstractPlatform $platform): ?Uuid
    {
        if ($value === null) {
            return $value;
        }

        if (is_string($value)) {
            return Uuid::fromRfc4122($value);
        }

        throw new \InvalidArgumentException();
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
