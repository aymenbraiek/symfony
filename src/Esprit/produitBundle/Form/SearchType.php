<?php



namespace Esprit\produitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
		$builder->add('categorie','entity', array('class'=>'EspritproduitBundle:Categorie',
							'property'=>'nom',												
					'multiple'=>FALSE,'empty_value'=>'choisir une categorie','required'=>FALSE));
				
	}

    
    public function getName()
    {
        return 'recherche';
    }
	 public function getDefaultOptions(array $options)
    {
        return array('data_class' => 'Smart\AnnonceBundle\Entity\Categorie',);
    }
}

