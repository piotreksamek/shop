<?php

declare(strict_types=1);

namespace App\Data\Entity\Currency;

use App\Data\Entity\BaseEntity;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table('currency')]
class Currency extends BaseEntity
{
    public function __construct(
        #[Column(type: Types::STRING)]
        public string $name,
        #[Column(type: Types::STRING)]
        public string $code,
        #[Column(type: Types::FLOAT)]
        public float $mid,
    ) {
        parent::__construct();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getMid(): float
    {
        return $this->mid;
    }

    public function setMid(float $mid): void
    {
        $this->mid = $mid;
    }
}
