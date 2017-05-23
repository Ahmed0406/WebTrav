<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use UserBundle\Entity\UserRecruteur;

class UserRecruteurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        dump($options['mode']);
        switch ($options['mode']){
            case 'info':
                $builder
                    ->add('name',TextType::class)
                    ->add('address1',TextType::class)
                    ->add('address2',TextType::class)
                    ->add('city',TextType::class)
                    ->add('state',TextType::class)
                    ->add('zipcode',NumberType::class)
                    ->add('phone',NumberType::class)
                    ->add('image',ImageType::class);
                break;
            case 'apropos':
                $builder
                    ->add('apropos',AproposType::class);
                break;

            default:
                throw new \Exception('You need to select which type of user form type you want to use.');
                break;
        }

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => UserRecruteur::class,
            'mode' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_user_recruteur';
    }


}
