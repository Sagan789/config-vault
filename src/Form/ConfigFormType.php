<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02/12/2017
 * Time: 18:23
 */

namespace App\Form;
use App\Entity\Config;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class ConfigFormType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('name', TextType::class)
			->add('description', TextType::class)
            ->add('items', CollectionType::class, array(
                'entry_type' => ConfigItemFormType::class,
                'entry_options' => array('label' => false),
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ));;
	}


	public function configureOptions(OptionsResolver $resolver)
	{
        $resolver->setDefaults([
            'data_class' => Config::class
        ]);
	}

}