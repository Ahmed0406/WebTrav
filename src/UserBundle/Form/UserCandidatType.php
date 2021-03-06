<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserCandidatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        switch ($options['mode']) {
            case 'info':
                $builder
                    ->add('nom', TextType::class)
                    ->add('prenom', TextType::class)
                    ->add('address1', TextType::class)
                    ->add('address2', TextType::class)
                    ->add('city', TextType::class)
                    ->add('state', TextType::class)
                    ->add('zipcode', NumberType::class)
                    ->add('phone', NumberType::class)
                    ->add('image', ImageType::class);
//
                break;
            case 'cv':
                $builder
                    ->add('cV', CVType::class, array(
                        'model' => $options['model']
                    ));
                break;
            case 'img_cover':
                $builder
                    ->add('imgcover', ImageType::class);
                break;
            case 'img_profil':
                $builder
                    ->add('imgcover', ImageType::class);
                break;

            default:
                throw new \Exception('UserCandidat.class no type choisie.');
                break;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\UserCandidat',
            'mode' => null,
            'model' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_usercandidat';
    }


}
