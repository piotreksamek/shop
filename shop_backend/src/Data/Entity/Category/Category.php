<?php

declare(strict_types=1);

namespace App\Data\Entity\Category;

use App\Data\Entity\BaseEntity;
use App\Data\Entity\Product\Product;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'category')]
class Category extends BaseEntity
{
    #[OneToMany(targetEntity: Product::class, mappedBy: 'category')]
    private Collection $product;

    public function __construct(
        #[Column(type: Types::STRING, length: 20)]
        private string $name,
        #[Column(type: Types::INTEGER, length: 3)]
        private int $priority = 0,
    )
    {
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

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }
}
