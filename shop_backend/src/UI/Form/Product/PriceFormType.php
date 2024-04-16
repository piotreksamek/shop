<?php

declare(strict_types=1);

namespace App\UI\Form\Product;

use App\Application\Product\DTO\PriceDTO;
use App\UI\Form\Transformer\MoneyTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class PriceFormType extends AbstractType
{
    public function __construct(private readonly MoneyTransformer $moneyTransformer)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('netMoneyDTO', MoneyType::class, [
                'currency' => 'PLN',
                'html5' => true,
                'attr' => ['step' => '0.01', 'placeholder' => '0'],
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('grossMoneyDTO', MoneyType::class, [
                'currency' => 'PLN',
                'html5' => true,
                'attr' => ['step' => '0.01', 'placeholder' => '0'],
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('vat', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
        ;

        $builder
            ->get('netMoneyDTO')
            ->addModelTransformer($this->moneyTransformer);

        $builder
            ->get('grossMoneyDTO')
            ->addModelTransformer($this->moneyTransformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PriceDTO::class,
            'translation_domain' => 'ui',
            'label_format' => 'product.price.form.%name%',
        ]);
    }
}
