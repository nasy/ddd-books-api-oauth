<?php

namespace AppBundle\Controller\Book;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use MyCompany\Identity\Infrastructure\UUID;
use MyCompany\Book\DomainModel\BookNotFoundException;
use MyCompany\Book\DomainModel\BookRepository;

use AppBundle\Form\Book\UpdateBookForm;
use AppBundle\Form\Book\CreateBookForm;

use MyCompany\Book\Command\CreateBookCommand;
use MyCompany\Book\Command\UpdateBookCommand;
use MyCompany\Book\Command\DeleteBookCommand;

use AppBundle\Response\ApiResponse;

class BookController extends FOSRestController
{
    /**
     * List all books.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing books.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="25", description="How many books to return.")
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getBooksAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
//        $user = $this->get('security.token_storage')->getToken()->getUser();

     //   if (false === $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
     //       $response = new ApiResponse(false, null, 'Unauthorized');
      //  } else {
            $offset = $paramFetcher->get('offset');
            $offset = null == $offset ? 0 : $offset;
            $limit = $paramFetcher->get('limit');

            /** @var BookRepository $bookRepository */
            $bookRepository = $this->container->get('my_company.book.repository');
            $result = $bookRepository->getAll($limit, $offset);
            $response = new ApiResponse(true, $result);
       // }
        return $response->getFormattedResponse();
    }

    /**
     * Get single Book.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Book for a given id",
     *   output = "MyCompany\Book\DomainModel\BookEntity",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the book is not found"
     *   }
     * )
     *
     * @param int     $id      the book id
     *
     * @return array
     *
     */
    public function getBookAction($id)
    {
        try {
            /** @var BookRepository $bookRepository */
            $bookRepository = $this->container->get('my_company.book.repository');
            $result = $bookRepository->getById($id);
        } catch (BookNotFoundException $e) {
            $response = new ApiResponse(false, null, $e->getMessage());
            return $response->getFormattedResponse();
        }
        $response = new ApiResponse(true, $result);
        return $response->getFormattedResponse();
    }

    /**
     * Create a Book from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new book from the submitted data.",
     *   input = "MyCompany\Book\DomainModel\BookEntity",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     *
     * @param Request $request the request object
     *
     * @return array
     */
    public function postBookAction(Request $request)
    {
        $form = $this->createForm(CreateBookForm::class);
        $form->submit($request->request->all());
        if ($form->isValid()) {

            $data = $form->getData();
            $id = UUID::create();
            $createBookCommand = new CreateBookCommand(
                $id,
                $data['title']
            );
            $this->get('command_bus')->handle($createBookCommand);
            $response = new ApiResponse(true, ['id' => $id->id()]);

        } else {
            $response = new ApiResponse(false, null, $form->getErrors(true, false));
        }
        return $response->getFormattedResponse();
    }

    /**
     * Update existing book from the submitted data
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "MyCompany\Book\DomainModel\BookEntity",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )xw
     *
     * @param Request $request the request object
     * @param int     $id      the book id
     *
     * @return array
     *
     */
    public function putBookAction(Request $request, $id)
    {
        try {
            /** @var BookRepository $bookRepository */
            $bookRepository = $this->container->get('my_company.book.repository');
            $bookEntity = $bookRepository->getById($id);
        } catch (BookNotFoundException $e) {
            $response = new ApiResponse(false, null, $e->getMessage());
            return $response->getFormattedResponse();
        }

        $form = $this->createForm(UpdateBookForm::class);
        $form->submit($request->request->all());
        if ($form->isValid()) {

            $data = $form->getData();
            $createBookCommand = new UpdateBookCommand(
                $bookEntity,
                $data['title'],
                $data['author']
            );
            $this->get('command_bus')->handle($createBookCommand);
            $response = new ApiResponse(true, []);

        } else {
            $response = new ApiResponse(false, null, $form->getErrors(true, false));
        }
        return $response->getFormattedResponse();
    }

    /**
     * Delete existing book
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "MyCompany\Book\DomainModel\BookEntity",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the book is not found"
     *   }
     * )xw
     *
     * @param Request $request the request object
     * @param int     $id      the book id
     *
     * @return array
     *
     */
    public function deleteBookAction(Request $request, $id)
    {
        try {
            /** @var BookRepository $bookRepository */
            $bookRepository = $this->container->get('my_company.book.repository');
            $bookEntity = $bookRepository->getById($id);
        } catch (BookNotFoundException $e) {
            $response = new ApiResponse(false, null, $e->getMessage());
            return $response->getFormattedResponse();
        }
        $deleteBookCommand = new DeleteBookCommand(
            $bookEntity
        );
        $this->get('command_bus')->handle($deleteBookCommand);
        $response = new ApiResponse(true, []);
        return $response->getFormattedResponse();
    }
}
