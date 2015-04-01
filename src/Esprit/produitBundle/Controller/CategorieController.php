<?php

namespace Esprit\produitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Esprit\produitBundle\Entity\Categorie;
use Esprit\produitBundle\Form\CategorieType;

class CategorieController extends Controller
{
    public function indexAction()
    {  $categorie= new Categorie();
       $em=  $this->getDoctrine()->getManager();
       $categorie= $em->getRepository('EspritproduitBundle:Categorie')->findAll();
       
        return $this->render('EspritproduitBundle:Categories:index.html.twig',array('categories'=>$categorie));
    }
     public function newAction(Request $request)
    {
         $categorie=new categorie;
         $form_ajout =$this ->createForm(new CategorieType(),$categorie);
         if($request ->isMethod('POST'))
         {
             $form_ajout->handleRequest($request);
             if($form_ajout->isValid())
             {
                 $em=$this->getDoctrine()->getManager();
                 $em->persist($categorie);
                 $em->flush();
                 return $this->redirect($this->generateUrl('produit_categories_index'));
                 
                 
             }
             
         }
        return $this->render('EspritproduitBundle:Categories:new.html.twig',array('form'=>$form_ajout->createView()));
    }
     public function editAction(Request $request,$token)
    {
       $categorie= new Categorie();
       $em=  $this->getDoctrine()->getManager();
       $categorie= $em->getRepository('EspritproduitBundle:Categorie')->findOneBy(array('token'=>$token));
       $form_edit =$this ->createForm(new CategorieType(),$categorie);
       if($request ->isMethod('POST'))
         {
             $form_edit->handleRequest($request);
             if($form_edit->isValid())
             {
                
                 $em->persist($categorie);
                 $em->flush();
                 return $this->redirect($this->generateUrl('produit_categories_index'));
             } 
                 
             }
        return $this->render('EspritproduitBundle:Categories:edit.html.twig',array('form'=>$form_edit->createView()));
    }
     public function deleteAction()
    {
        return $this->render('EspritproduitBundle:Categories:delete.html.twig');
    }
}


