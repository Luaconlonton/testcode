<?php

namespace App\Controller;

use App\Entity\Promotion;
use App\Entity\Category;
use App\Form\PromotionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{
    #[Route('', name: 'promotion_index')]
    public function promotionIndex()
    {
        $promotions = $this->getDoctrine()->getRepository(Promotion::class)->findAll();
        return $this->render('promotion/index.html.twig', [
            'promotions' => $promotions,
        ]);
    }
    #[Route('/delete/{id}', name: 'promotion_delete')]
    public function promotionDelete($id)
    {
        $promotion = $this->getDoctrine()->getRepository(Category::class)->find($id);
            $manager= $this->getDoctrine()->getManager();
            $manager->remove($promotion);
            $manager->flush();
            $this->addFlash("Success","Delete promotion succeed !");
            
        return $this->redirectToRoute("promotion_index");
    }
    #[Route('/edit{id}', name: 'promotion_edit')]
    public function promotionEdit(Request $request, $id)
    {
        $category = $this->getDoctrine()->getRepository(Promotion::class)->find($id);
        $form = $this->createForm(PromotionType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            return $this->redirectToRoute('promotion_index');
        }

        return $this->renderForm('promotion/edit.html.twig', 
        [
            'promotionForm' =>$form
        ]);
    }
    }
    #[Route('/add',name:'promotion_add')]
    public function promotionAdd(Request $request)
    {
        $product= new Product;
        $form = $this->createForm(ProductType::class,$product);
        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager=$this->getDoctrine()->getManager();
            $manager->persist($product);
            $manager->flush();
            return $this->redirectToRoute("product_index");
        }
        return $this->renderForm("product/add.html.twig",
        [
            'productForm' =>$form,
            
        ]);
    }
}
