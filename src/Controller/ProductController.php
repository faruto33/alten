<?php

namespace App\Controller;

use DateTimeImmutable;
use DateTime;
use App\Entity\Product;
use App\Entity\InventoryStatus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractController
{
  #[Route('/product', name: 'get_all',methods:['GET'])]
  public function getAllProduct(EntityManagerInterface $entityManager): JsonResponse
  {
      $products = $entityManager->getRepository(Product::class)->findAll();
      $entityManager->flush();

      return $this->json($products);
  }

  #[Route('/product', name: 'create_product',methods:['POST'])]
  public function createProduct(Request $request,EntityManagerInterface $entityManager): JsonResponse
  {
      // get parameters in json format
      $parameters = json_decode($request->getContent(), true);
      // new product
      $product = new Product();
      // add all parameters to product object
      foreach($parameters as $k=>$v)
          $product->{'set'.$k}($v);

      // set the date time
      $product->setCreatedAt(new DateTimeImmutable("now"));
      $product->setUpdatedAt(new DateTime("now"));
      // persiste the product
      $entityManager->persist($product);
      // actually executes the queries (i.e. the INSERT query)
      $entityManager->flush();

      return $this->json($product);
  }

  #[Route('/product/{id}',name: 'details_product',methods:['GET'])]
  public function show(Product $product): JsonResponse
  {
    // show product detail
    return $this->json($product);
  }

  #[Route('/product/{id}',name: 'delete_product',methods:['DELETE'])]
  public function delete(Product $product,EntityManagerInterface $entityManager): JsonResponse
  {
    // delete a product
    $entityManager->remove($product);
    $entityManager->flush();
    return $this->json($product);
  }

  #[Route('/product/{id}', name: 'edit_product',methods:['PATCH'])]
  public function update(EntityManagerInterface $entityManager, Request $request,int $id): JsonResponse
  {
      // get parameters in json format
      $parameters = json_decode($request->getContent(), true);

      $product = $entityManager->getRepository(Product::class)->find($id);

      if (!$product) {
          throw $this->createNotFoundException(
              'No product found for id '.$id
          );
      }
      // set id
      $product->setId($id);
      // add all parameters to product object
      foreach($parameters as $k=>$v)
          $product->{'set'.$k}($v);
      // persiste the product
      $entityManager->persist($product);
      // update the product
      $entityManager->flush();

      return $this->json($product);
  }
}
