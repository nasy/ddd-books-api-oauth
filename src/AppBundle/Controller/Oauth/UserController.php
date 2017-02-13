<?php

namespace AppBundle\Controller\Oauth;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use AppBundle\Form\User\CreateUserForm;

use MyCompany\Identity\Infrastructure\UUID;
use MyCompany\Oauth\Command\CreateUserCommand;
use MyCompany\Oauth\DomainModel\UserAlreadyExistsException;

use AppBundle\Response\ApiResponse;

class UserController extends FOSRestController
{
    /**
     * Create a user from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new book from the submitted data.",
     *   input = "MyCompany\Oauth\DomainModel\UserEntity",
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
    public function postUserAction(Request $request)
    {
        $form = $this->createForm(CreateUserForm::class);
        $form->submit($request->request->all());
        if ($form->isValid()) {

            try {
                $data = $form->getData();
                $id = UUID::create();
                $createBookCommand = new CreateUserCommand(
                    $id,
                    $data['email'],
                    $data['password']
                );
                $this->get('command_bus')->handle($createBookCommand);
                $response = new ApiResponse(true, ['id' => $id->id()]);
            } catch (UserAlreadyExistsException $e) {
                $response = new ApiResponse(false, null, $e->getMessage());
                return $response->getFormattedResponse();
            }

        } else {
            $response = new ApiResponse(false, null, $form->getErrors(true, false));
        }
        return $response->getFormattedResponse();
    }
}
