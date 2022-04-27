<?php

namespace App\Controller;

use App\Entity\Library;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\LibraryRepository;
use Doctrine\ORM\EntityManagerInterface;

class LibraryController extends AbstractController
{
    #[Route('/library', name: 'library')]
    public function library(): Response
    {
        return $this->render('library/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
     * @Route("/library/create", name="create_library")
     */
    public function createProduct(
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();

        $book1 = new Library();
        $book1->setTitle('Svensk fältflora');
        $book1->setISBN("9789178871759");
        $book1->setAuthor("Bo Mossberg");
        $book1->setImage("svensk-faltflora.jpg");

        $book2 = new Library();
        $book2->setTitle('Självhushållning i praktiken');
        $book2->setISBN("9789113116853");
        $book2->setAuthor("Maria Österåker");
        $book2->setImage("sjalvhushallning-i-praktiken.jpg");

        $book3 = new Library();
        $book3->setTitle('Vildvuxet: mat och huskurer från naturen');
        $book3->setISBN("9789174246612");
        $book3->setAuthor("Lisen Sundgren");
        $book3->setImage("vildvuxet.jpg");

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($book1);
        $entityManager->persist($book2);
        $entityManager->persist($book3);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Created new library');
    }

    /**
     * @Route("/library/show", name="library_show_all")
     */
    public function showAll(
        EntityManagerInterface $entityManager
    ): Response {
        $library = $entityManager
            ->getRepository(Library::class)
            ->findAll();

        // return $this->json($library);

        return $this->render('library/show-library.html.twig', [
            'library' => $library,
        ]);
    }

    /**
     * @Route("/library/show/{id}", name="library_by_id")
     */
    public function showLibraryById(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {
        $books = $libraryRepository
            ->find($id);

        // return $this->json($books);

        return $this->render('library/show-single-book.html.twig', [
            'id' => $id,
            'book' => $books,
        ]);
    }
}
