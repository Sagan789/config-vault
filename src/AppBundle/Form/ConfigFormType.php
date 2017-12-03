<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 02/12/2017
 * Time: 18:23
 */

namespace AppBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigFormType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('name')
			->add('desc');

	}


	public function configureOptions(OptionsResolver $resolver)
	{
	}

}