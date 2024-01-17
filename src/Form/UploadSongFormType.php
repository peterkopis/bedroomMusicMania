<?php

namespace App\Form;

use App\Entity\Song;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UploadSongFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            //->add('created_at')
            ->add('location', FileType::class, [
                'label' => 'Music File (MP3, WAV)',
                'mapped' => true,
                'required' => true,
                'constraints' => [
                    new File([
                        'maxSize' => '10024k',
                        'mimeTypes' => [
                            'audio/mpeg',  // Para archivos MP3
                            'audio/wav',   // Para archivos WAV
                            // Agrega aquí otros tipos MIME para otros formatos de audio
                        ],
                        'mimeTypesMessage' => 'Please upload a valid music file',
                    ])   
                ],
            ])
            ->add('image',FileType::class, [
                'label' => 'Image (JPG, PNG, JPEG)',
                'mapped' => true,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file',
                    ])   
                ],
            ])
            ->add('genre',ChoiceType::class,[
                'choices' => [
                    'Rock' => 'Rock',
                    'Pop' => 'Pop',
                    'Rap' => 'Rap',
                    'Hip-Hop' => 'Hip-Hop',
                    'RnB' => 'RnB',
                    'Jazz' => 'Jazz',
                    'Blues' => 'Blues',
                    'Country' => 'Country',
                    'Folk' => 'Folk',
                    'Classique' => 'Classique',
                    'Reggae' => 'Reggae',
                    'Metal' => 'Metal',
                    'Punk' => 'Punk',
                    'Electro' => 'Electro',
                    'Techno' => 'Techno',
                    'House' => 'House',
                    'Disco' => 'Disco',
                    'Funk' => 'Funk',
                    'Soul' => 'Soul',
                    'Gospel' => 'Gospel',
                    'Latino' => 'Latino',
                    'World' => 'World',
                    'Autre' => 'Autre',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            //->add('reproduced')
            /*->add('user_id', EntityType::class, [
                'class' => User::class,
'choice_label' => 'id',
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Song::class,
        ]);
    }
}
