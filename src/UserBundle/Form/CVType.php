<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CVType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        switch ($options['model']) {
            case 'info':
                $builder
                    ->add('competence')
                    ->add('langue')
                    ->add('userCandidat');
                break;
            case 'experience':
                $builder
                    ->add('experience', CollectionType::class, array(
                        'entry_type' => ExperienceType::class,
                    ));
                break;
            case 'formation':
                $builder
                    ->add('formation', CollectionType::class, array(
                        'entry_type' => FormationType::class,
                    ));
                break;
            case 'projet':
                $builder
                    ->add('projet', CollectionType::class, array(
                        'entry_type' => ProjetType::class,
                    ));
                break;

            default:
                throw new \Exception('CVType.class no type choisie.');
                break;
        }

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\CV',
            'mode' => null,
            'model' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_cv';
    }


}
