<?php

declare(strict_types=1);

namespace App\UI\Form\Product;

use App\Application\Product\DTO\ProductDTO;
use App\Data\Entity\Category\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('category', EntityType::class, [
                'required' => true,
                'placeholder' => '',
                'class' => Category::class,
                'choice_label' => fn (Category $category) => $category->getName(),
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('priceDTO', PriceFormType::class)
            ->add('description', TextType::class)
            ->add('barcode', TextType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Length(10),
                ]
            ])
            ->add('image', FileType::class, [
                'required' => true,
                'constraints' => [
                    new NotBlank(),
                    new Image(),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductDTO::class,
            'translation_domain' => 'ui',
            'label_format' => 'product.form.%name%',
        ]);
    }
}
