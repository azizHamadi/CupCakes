<?php
/**
 * Created by PhpStorm.
 * User: escobar
 * Date: 04/02/2018
 * Time: 11:14
 */

namespace CupCakesBundle\Redirection;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class AfterLoginRedirection implements AuthenticationSuccessHandlerInterface
{

    private $router;

    /**
     * AfterLoginRedirection constructor.
     *
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param Request        $request
     *
     * @param TokenInterface $token
     *
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $roles = $token->getRoles();

        $rolesTab = array_map(function ($role) {
            return $role->getRole();
        }, $roles);

        if (in_array('ROLE_SUPER_ADMIN', $rolesTab, true)) {
            // c'est un aministrateur : on le rediriger vers l'espace admin
            $redirection = new RedirectResponse($this->router->generate('cup_cakes_Dashbord'));
        } else{
            if (in_array('ROLE_CLIENT', $rolesTab, true)) {
            // c'est un utilisaeur client : on le rediriger vers l'accueil
            $redirection = new RedirectResponse($this->router->generate('cup_cakes_Eshop'));
        }
        else {
                if (in_array('ROLE_PATISSERIE', $rolesTab, true)) {
                // c'est un utilisaeur Patisserie : on le rediriger vers l'accueil patisserie
                $redirection = new RedirectResponse($this->router->generate('cup_cakes_homepage'));
            }
            else {
                if (in_array('ROLE_SUPER_ADMIN', $rolesTab, true)) {
                    // c'est un utilisaeur Patisserie : on le rediriger vers l'accueil patisserie
                    $redirection = new RedirectResponse($this->router->generate('cup_cakes_DashAdmin'));
                }
                else
                {
                // c'est un utilisaeur formateur : on le rediriger vers l'accueil formateur
                $redirection = new RedirectResponse($this->router->generate('formateur_accueil'));
                }
            }
        }}
        return $redirection;
    }
}