<?php

namespace Esprit\produitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Esprit\produitBundle\Entity\Article;
use Esprit\produitBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Esprit\produitBundle\Form\SearchType;
use Esprit\produitBundle\Entity\Categorie;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller {

    public function indexAction(Request $request) {
        $form_ajout = $this->createForm(new SearchType());
        $article = new Article();
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('EspritproduitBundle:Article')->findAll();
        if ($request->isMethod('POST')) {
            $form_ajout->handleRequest($request);
            if ($form_ajout->isValid()) {
                $data = $form_ajout->getData();
                $categorie = new Categorie;
                $categorie = $data['categorie'];
                $id = $categorie->getId();
                return $this->redirect($this->generateUrl('search_article', array('id' => $id)));
            }
        }
        return $this->render('EspritproduitBundle:Article:index.html.twig', array('articles' => $article, 'form' => $form_ajout->createView()));
    }

    public function editAction() {
        return $this->render('EspritproduitBundle:Article:edit.html.twig', array(
                        // ...
        ));
    }

    public function deleteAction() {
        return $this->render('EspritproduitBundle:Article:delete.html.twig', array(
                        // ...
        ));
    }

    public function newAction(Request $request) {

        $article = new Article();
        $form_ajout = $this->createForm(new ArticleType(), $article);
        if ($request->isMethod('POST')) {
            $form_ajout->handleRequest($request);
            if ($form_ajout->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($article);
                $em->flush();
                return $this->redirect($this->generateUrl('index_article'));
            }
        }
        return $this->render('EspritproduitBundle:Article:new.html.twig', array('form' => $form_ajout->createView()))

        ;
    }

    public function rechercherByArticleAction($id) {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('EspritproduitBundle:Article')->findByCategorie($id);

        return $this->render('EspritproduitBundle:Article:search.html.twig', array('articles' => $article));
    }

    public function ContactArticleAction() {
        $message = \Swift_Message::newInstance()
                ->setSubject('Hello form')
                ->setFrom('aymenbraiek0@gmail.com')
                ->setTo('aymenbraiek0@gmail.com')
                ->setBody('je suis un test');
        $this->get('mailer')->send($message);
        return new Response('valide');
    }

    public function deleteAction(Article $article) {
        $form = $this->createFormBuilder()->getForm();
        $request = $this->get('request');
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            //var_dump($medecin);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->remove($article);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'article bien supprimé (' . $article->getTitre() . ').');
                return $this->redirect($this->generateUrl('index_article'));
            }
        }
        return $this->render('PFEPageBundle:Backend:Page/Article/supprimer.html.twig', array('article' => $article, 'form' => $form->createView(),));
    }

}
