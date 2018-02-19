<?php
/**
 * Created by PhpStorm.
 * User: laure
 * Date: 18/02/2018
 * Time: 18:35
 */

namespace App\Form;

use App\Entity\ConfigItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ConfigItemFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('item_key', TextType::class)
            ->add('item_value', TextType::class);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ConfigItem::class
        ]);
    }

}