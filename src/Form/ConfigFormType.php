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


class ConfigFormType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('name')
			->add('description')
            ->add('apikey');
	}


	public function configureOptions(OptionsResolver $resolver)
	{
        $resolver->setDefaults([
            'data_class' => Config::class
        ]);
	}

}