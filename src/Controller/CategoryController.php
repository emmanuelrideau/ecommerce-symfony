<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    protected $CategoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->CategoryRepository = $categoryRepository;
    }

    /**
     * @Route("/admin/category/{id}/edit", name="category_edit")
     */
    public function edit($id, CategoryRepository $CategoryRepository, Request $request, SluggerInterface $slugger, EntityManagerInterface $em)
    {
        $category = $CategoryRepository->find($id);

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setSlug(strtolower($slugger->slug($category->getName())));

            $em->flush();

            return $this->redirectToRoute('homepage');
        }

        $formView = $form->createView();

        return $this->render('category/edit.html.twig', ['category' => $category, 'formView' => $formView]);
    }

    /**
     * @Route("/admin/category/create", name="category_create")
     */
    public function create(Request $request, SluggerInterface $slugger, EntityManagerInterface $em)
    {

        $category = new Category;

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setSlug(strtolower($slugger->slug($category->getName())));

            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('homepage');
        }


        $formView = $form->createView();

        return $this->render('category/create.html.twig', ['formView' => $formView]);
    }
}
