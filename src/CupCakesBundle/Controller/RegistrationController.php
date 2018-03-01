<?php
/**
 * Created by PhpStorm.
 * User: pc_roua
 * Date: 28/02/2018
 * Time: 00:12
 */

namespace CupCakesBundle\Controller;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;

    use Symfony\Component\HttpFoundation\RedirectResponse;
    use FOS\UserBundle\Controller\RegistrationController as BaseController;
    use Symfony\Component\HttpFoundation\Request;


    /**
     * Controller managing the registration.
     *
     * @author Thibault Duplessis <thibault.duplessis@gmail.com>
     * @author Christophe Coevoet <stof@notk.org>
     */
    class RegistrationController extends BaseController
    {

        public function __construct()
        {
        }
        public function registerAction(Request $request)
        {

            $formFactory = $this->get('fos_user.registration.form.factory');
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');
            /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
            $dispatcher = $this->get('event_dispatcher');;

            $user = $userManager->createUser();
            $user->setEnabled(true);

            $event = new GetResponseUserEvent($user, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

            if (null !== $event->getResponse()) {
                return $event->getResponse();
            }

            $form = $formFactory->createForm();
            $form->setData($user);

            $form->handleRequest($request);

            if ($form->isSubmitted()) {

                if ($form->isValid()) {

                    $event = new FormEvent($form, $request);
                    $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                    $userManager->updateUser($user);

                    if (null === $response = $event->getResponse()) {
                        $url = $this->generateUrl('fos_user_security_login');
                        $response = new RedirectResponse($url);
                    }

                    $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                    return $response;
                }

                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_FAILURE, $event);

                if (null !== $response = $event->getResponse()) {
                    return $response;
                }
            }

            return $this->render('@FOSUser/Registration/register.html.twig', array(
                'form' => $form->createView(),
            ));
        }
    }