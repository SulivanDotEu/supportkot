<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Walva\UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Walva\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Controller managing the registration
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author Christophe Coevoet <stof@notk.org>
 */
class RegistrationController extends BaseController {

    public static $SESSION_VAR_NAME = 'TYPE_INSCRIPTUION';

    public function registerAction($type_inscription = null) {

        if ($type_inscription != null) {
            $this->container->get('session')->set(self::$SESSION_VAR_NAME, $type_inscription);
        } else {
            $type_inscription = $this->container->get('session')->get(self::$SESSION_VAR_NAME);
            if ($type_inscription == null)
                throw new \Exception("aucun type d'inscription défini.");
        }
        
        $form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        //**** PROCESS WALVA
        if (isset($type_inscription) AND $type_inscription == User::$_TYPE_PARRAN) {
            $form->remove('filleul');
        } else if (isset($type_inscription) AND $type_inscription == User::$_TYPE_FILLEUL) {
            $form->remove('parrain');
        } else if (isset($type_inscription) AND $type_inscription == User::$_TYPE_ADMIN) {
            $form->remove('filleul');
            $form->remove('parrain');
        }

        $process = $formHandler->process($confirmationEnabled);
        if ($process) {
            $user = $form->getData();

            $authUser = false;
            if ($confirmationEnabled) {
                $this->container->get('session')->set('fos_user_send_confirmation_email/email', $user->getEmail());
                $route = 'fos_user_registration_check_email';
            } else {
                $authUser = true;
                $route = 'fos_user_registration_confirmed';
            }

            $this->setFlash('fos_user_success', 'registration.flash.user_created');
            $url = $this->container->get('router')->generate($route);
            $response = new RedirectResponse($url);

            if ($authUser) {
                $this->authenticateUser($user, $response);
            }

            return $response;
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.' . $this->getEngine(), array(
                    'form' => $form->createView(),
        ));
    }

}
