<?php

namespace App\Controller;

use App\Entity\Library;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\LibraryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

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
        $book1->setIsbn("9789178871759");
        $book1->setAuthor("Bo Mossberg");
        $book1->setImage("svensk-faltflora.jpg");

        $book2 = new Library();
        $book2->setTitle('Självhushållning i praktiken');
        $book2->setIsbn("9789113116853");
        $book2->setAuthor("Maria Österåker");
        $book2->setImage("sjalvhushallning-i-praktiken.jpg");

        $book3 = new Library();
        $book3->setTitle('Vildvuxet: mat och huskurer från naturen');
        $book3->setIsbn("9789174246612");
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

    /**
     * @Route("/library/delete/{id}", name="library_delete_by_id")
     */
    public function deleteBookById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Library::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id ' . $id
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('library_show_all');
    }

    /**
     * @Route(
     *      "/library/create/new",
     *      name="book-create",
     *      methods={"GET","HEAD"}
     * )
     */
    public function createBook(): Response
    {
        return $this->render('library/create-book.html.twig');
    }

    /**
     * @Route(
     *      "/library/create/new",
     *      name="book-create-process",
     *      methods={"POST"}
     * )
     */
    public function createBookProcess(
        Request $request,
        ManagerRegistry $doctrine
    ): Response {
        $title = $request->request->get('title');
        $isbn  = $request->request->get('ISBN');
        $author  = $request->request->get('author');
        $image  = $request->request->get('image');

        $entityManager = $doctrine->getManager();

        $book = new Library();
        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImage($image);

        $entityManager->persist($book);

        $entityManager->flush();

        return $this->redirectToRoute('book-create');
    }

    /**
     * @Route(
     *      "/library/update/{id}",
     *      name="book-update",
     *      methods={"GET","HEAD"}
     * )
     */
    public function updateBook(
        LibraryRepository $libraryRepository,
        int $id
    ): Response {
        $books = $libraryRepository
            ->find($id);

        return $this->render('library/update-book.html.twig', [
            'id' => $id,
            'book' => $books,
        ]);
    }
    /**
     * @Route(
     *      "/library/update/{id}",
     *      name="book-update-process",
     *      methods={"POST"}
     * )
     */
    public function updateProductProcess(
        ManagerRegistry $doctrine,
        Request $request,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $library = $entityManager->getRepository(Library::class)->find($id);

        if (!$library) {
            throw $this->createNotFoundException(
                'No book found for id ' . $id
            );
        }

        $title = $request->request->get('title');
        $isbn  = $request->request->get('ISBN');
        $author  = $request->request->get('author');
        $image  = $request->request->get('image');

        $library->setTitle($title);
        $library->setIsbn($isbn);
        $library->setAuthor($author);
        $library->setImage($image);
        $entityManager->flush();

        return $this->redirectToRoute('book-update', array('id' => $id));
    }
}
