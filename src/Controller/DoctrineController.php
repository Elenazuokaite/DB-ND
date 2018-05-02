<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Categories;
use App\Entity\Product;

class DoctrineController extends Controller
{
    /**
     * @Route("/add", name="add")
     */
    public function add()
    {
        $category = new Categories();
        $category->setTitle("Shoes");

        $product = new Product();
        $product->setTitle("Sneakers")
                ->setPrice("20")
                ->setCategory($category)
                ->setActive(1);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush($product);
        return new Response("Product added");
    }
    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $product = $entityManager->find(Product::class, $id);
        $entityManager->remove($product);
        $entityManager->flush($product);

        return new Response("Product deleted");
    }
}
