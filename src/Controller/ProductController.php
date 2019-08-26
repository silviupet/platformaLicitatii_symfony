<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Licitatie;


/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index", methods={"GET"})
     * 
     */
    public function index(ProductRepository $productRepository): Response
    {
//     
       $products = $this->getDoctrine()->getManager()
        ->createQuery('SELECT p FROM App\Entity\Product p WHERE p.dataStop >= CURRENT_DATE()')
        ->getResult();
   
        
       
        return $this->render('product/index.html.twig', [
            'products' => $products,
            'message' =>''
                ]);
    }  
//            $productRepository->findBy([
//                'dataStop' => $products ->getDataStop()
//            ])
//        ]);
//    } 
             
//         return $this->render('product/index.html.twig', [
//            'products' =>$product
//        ]);
                    
//                    findBy([
//                'dataStop'>= $Today
//                    ]);
//                dump($product); 
//             if($product){
//        return $this->render('product/index.html.twig', [
//            'products' => $product,
//             'message' => ''
//            ]);
//        
//             }
////             else return $this->render('product/index.html.twig', [
//////            'products' => $productRepository->findBy([
//////                'dataStop'>= $Today,
////                    'message' => 'nu avem nici un produs scos la licitatie '
////                 ]);
//           else  return new Respomse('nu avem nici un produs la licitatie');
//             
//    }

    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
     * @param Request $request
     */
    public function new(Request $request): Response
    {

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
       

        if ($form->isSubmitted() && $form->isValid()) {
             $file = $this->getUser()->getUserId();
             
//         $file = 2;     
//          $file = $request->getSession()->get('userId');
            $product->setUserId($file);
            $file = $product->getProductTitle();
            $product->setProductTitle($file);
            
            $file = $product->getProductDescription();
            $product->setProductDescription($file);
            
            $file = $product->getPhotoA();
            if($file){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('Photo_directory'),
                $fileName
            );
            $product->setPhotoA($fileName);
            }
  
            $file = $product->getPhotoB();
             if($file){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('Photo_directory'),
                $fileName
            );
            $product->setPhotoB($fileName);
             }
            $file = $product->getPhotoC();
              if($file){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('Photo_directory'),
                $fileName
            );
            $product->setPhotoC($fileName);
              }
            $file = $product->getPhotoD();
              if($file){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('Photo_directory'),
                $fileName
            );
            $product->setPhotoD($fileName);
              }
            $file = $product->getPhotoE();
              if($file){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('Photo_directory'),
                $fileName
            );
            $product->setPhotoE($fileName);
              }
             $file = $product->getPhotoF();
               if($file){
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('Photo_directory'),
                $fileName
            );
            $product->setPhotoF($fileName);
               }
               
            $file = $product->getPretPornire();
            $product->setPretPornire($file);
            $product->setUltimulPretLicitat($file);
            
            
            
            $file = $product->getDataStop();
            
            $product->setDataStop($file);
            
            
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();
      
            
            

            return $this->redirectToRoute('my_products');
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }


    /**
     * @Route("/{productId}", name="product_show", methods={"GET"},requirements={"productId":"\d+"})
     */
    public function show(Product $product): Response
    {
//         $repo = $this->getDoctrine()->getRepository(Licitatie::class);
//         $licitatie=$repo->findOneBy([
//             'productId'=>$product->getProductId() 
//         ], [
//             'dataPretLicitat'=>'DESC'
//         ]);
        
        return $this->render('product/show.html.twig', [
            'product' => $product,
//            'licitatie' =>$licitatie
        ]);
    }
    
     
//    /**
//     * @Route("/{productId}/edit", name="product_edit", methods={"GET","POST"},requirements={"ProductId":"\d+"})
//     */
//    public function edit(Request $request, Product $product): Response
//    {
//        $form = $this->createForm(ProductType::class, $product);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $this->getDoctrine()->getManager()->flush();
////de bagat cod aici 
//            return $this->redirectToRoute('product_index');
//        }
//
//        return $this->render('product/edit.html.twig', [
//            'product' => $product,
//            'form' => $form->createView(),
//        ]);
//    }

    /**
     * @Route("/{productId}", name="product_delete", methods={"DELETE"}, requirements={"productId":"\d+"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getProductId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('product_index');
    }
}
