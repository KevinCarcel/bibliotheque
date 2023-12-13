<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('auteur')
            ->add('editeurs')
            ->add('prix' )
            ->add('resume')
            ->add('quantite')
            ->add('genre_id')
            ->add('couverture', FileType::class, [
                'attr'=>[
                    'class'=> 'form-control'],
                                'required' => false,
                                'mapped' => false,
                                'constraints' => [
                                new Image(['maxSize' => '1024k'])
                                ],
                                'label'=>'Photo du livre',
                    'label_attr'=> [
                        'class'=> 'form-label mt-4']
                    ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}