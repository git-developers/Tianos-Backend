<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Bundle\ProfileBundle\Entity\Profile;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private $_route;

    const CIRCLE_1 = 'fa-circle-o text-yellow';
    const CIRCLE_2 = 'fa-circle-o text-aqua';
    const CIRCLE_3 = 'fa-circle-o text-blue';
    const CIRCLE_4 = 'fa-circle-o text-teal';
    const CIRCLE_5 = 'fa-circle-o text-red';
    const CIRCLE_6 = 'fa-circle-o text-purple';
    const CIRCLE_7 = 'fa-circle-o text-maroon';
    const CIRCLE_8 = 'fa-circle-o text-green';
    const CIRCLE_9 = 'fa-circle-o text-orange';

    function __construct() {

    }

    public function mainMenu(FactoryInterface $factory, array $options)
    {

        $request = $this->container->get('request_stack')->getCurrentRequest();
        $this->_route = $request->attributes->get('_route');

        $menu = $factory->createItem('root', [
            'childrenAttributes' => [
                'class' => 'sidebar-menu tree',
                'data-widget' => 'tree',
            ],
        ])
        ;



        /**
         * FRONTEND
         */
        $isGranted = true;
        $menu->addChild('Inicio', [
            'route' => 'frontend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('class', 'treeview')
            ->setAttribute('icon', 'fa-fw fa-tv')
            ->setAttribute('class', $this->activeRoute('frontend_default_index'))
            ->setDisplay($isGranted)
        ;
        /**
         * FRONTEND
         */




        /**
         * MODULES
         */
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
        ]);

        $isGranted = true;

        $menu->addChild('Modulos', [
            'route' => 'backend_module_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('allow_angle', true)
            ->setAttribute('class', 'treeview')
            ->setAttribute('class', $this->activeRoute([
                'backend_module_index',
            ]))
            ->setAttribute('icon', 'fa-fw fa-cubes')
            ->setDisplay($isGranted)
        ;
        /**
         * MODULES
         */




        /**
         * POINTS OF SALES
         */
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
            'ROLE_' . Profile::ADMIN,
        ]);

        $isGranted = true;

        $menu->addChild('Puntos de venta', [
            'route' => 'backend_pointofsale_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('allow_angle', true)
            ->setAttribute('class', 'treeview')
            ->setAttribute('class', $this->activeRoute([
                'backend_pointofsale_index',
            ]))
            ->setAttribute('icon', 'fa-fw fa-map-marker')
            ->setDisplay($isGranted)
        ;
        /**
         * POINTS OF SALES
         */






        /**
         * CALENDAR
         */
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
            'ROLE_' . Profile::ADMIN,
        ]);

        $isGranted = true;

            $menu->addChild('Agenda', [
            'route' => 'backend_calendar_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview')
        ->setAttribute('class', $this->activeRoute([
            'backend_calendar_index',
        ]))
        ->setAttribute('icon', 'fa-fw fa-calendar')
        ->setDisplay($isGranted)
        ;
        /**
         * CALENDAR
         */







        /**
         * ACCOUNTS - ADMIN
         */
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
            'ROLE_' . Profile::ADMIN,
        ]);

        $isGranted = true;

        $menu->addChild('Usuarios', [
            'route' => 'frontend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('class', 'treeview')
        ->setAttribute('class', $this->activeRoute([
            'frontend_user_profile',
            'backend_user_client_index',
            'backend_user_employee_index',
        ]))
        ->setAttribute('icon', 'fa-fw fa-user')
        ->setDisplay(true)
        ;

        $menu['Usuarios']->addChild('Clientes', [
            'route' => 'backend_user_client_index'
        ])
            ->setAttribute('icon', self::CIRCLE_1)
            ->setAttribute('class', $this->activeRoute('backend_user_client_index'))
            ->setDisplay(true)
        ;

        $menu['Usuarios']->addChild('Empleados', [
            'route' => 'backend_user_employee_index'
        ])
            ->setAttribute('icon', self::CIRCLE_2)
            ->setAttribute('class', $this->activeRoute('backend_user_employee_index'))
            ->setDisplay($isGranted)
        ;
        /**
         * ACCOUNTS - ADMIN
         */






        /**
         * STOCK
         */
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
            'ROLE_' . Profile::ADMIN,
        ]);

        $isGranted = true;

        $menu->addChild('Inventario', [
            'route' => 'backend_product_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('allow_angle', true)
            ->setAttribute('class', 'treeview')
            ->setAttribute('class', $this->activeRoute([
                'backend_product_index',
                'backend_category_tree_index',
            ]))
            ->setAttribute('icon', 'fa-fw fa-dropbox')
            ->setDisplay($isGranted)
        ;
        /**
         * STOCK
         */







        /**
         * SECURITY
         */
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
        ]);

        $isGranted = true;

        $menu->addChild('Seguridad', [
            'route' => 'frontend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('allow_angle', true)
            ->setAttribute('class', 'treeview')
            ->setAttribute('class', $this->activeRoute([
                'backend_role_index',
                'backend_session_index',
                'backend_profile_index',
            ]))
            ->setAttribute('icon', 'fa-fw fa-lock')
            ->setDisplay($isGranted)
        ;
        $menu['Seguridad']->addChild('Perfil', [
            'route' => 'backend_profile_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('icon', 'fa-fw fa-user-secret')
            ->setAttribute('class', $this->activeRoute([
                'backend_profile_index',
            ]))
            ->setDisplay($isGranted)
        ;
        $menu['Seguridad']->addChild('Rol', [
            'route' => 'backend_role_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('icon', 'fa-fw fa-expeditedssl')
            ->setAttribute('class', $this->activeRoute([
                'backend_role_index',
            ]))
            ->setDisplay($isGranted)
        ;
        $menu['Seguridad']->addChild('Sesión', [
            'route' => 'backend_session_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('icon', 'fa-fw fa-history')
            ->setAttribute('class', $this->activeRoute([
                'backend_session_index',
            ]))
            ->setDisplay($isGranted)
        ;
        /**
         * SECURITY
         */





        /**
         * SETTINGS
         */
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
        ]);

        $isGranted = true;

        $menu->addChild('Ajustes', [
            'route' => 'frontend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('class', 'treeview')
            ->setAttribute('class', $this->activeRoute([
                'backend_core_loadfixtures',
            ]))
            ->setAttribute('icon', 'fa-fw fa-cog')
            ->setDisplay($isGranted)
        ;

        $menu['Ajustes']->addChild('Load Fixtures', [
            'route' => 'backend_core_loadfixtures'
        ])
            ->setAttribute('icon', self::CIRCLE_1)
            ->setAttribute('class', $this->activeRoute('backend_core_loadfixtures'))
            ->setDisplay($isGranted)
        ;
        /**
         * SETTINGS
         */


















//        *************************************************************************
//        *************************************************************************
//        *************************************************************************

        /**
         * ASSOCIATION
         */

        /*
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
        ]);

        $isGranted = true;

        $menu->addChild('Asociación', [
            'route' => 'frontend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview')
        ->setAttribute('class', $this->activeRoute([
            'backend_associative_user_has_route_index',
            'backend_associative_profile_has_role_index',
            'backend_associative_route_has_pointofsale_index',
        ]))
        ->setAttribute('icon', 'fa-fw fa-exchange')
        ->setDisplay($isGranted)
        ;

        $menu['Asociación']->addChild('Perfil <i class="fa fa-fw fa-arrow-right"></i> Rol', [
            'route' => 'backend_associative_profile_has_role_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', self::CIRCLE_1)
        ->setAttribute('class', $this->activeRoute('backend_associative_profile_has_role_index'))
        ->setDisplay($isGranted)
        ;
        /**
         * ASSOCIATION
         */



        return $menu;
    }

    protected function getUser()
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        return $user;
    }

    protected function isGranted($attributes, $object = null)
    {
        if (!$this->container->has('security.authorization_checker')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        return $this->container->get('security.authorization_checker')->isGranted($attributes, $object);
    }

    protected function activeRoute($routes): string
    {
        if(is_array($routes)){
            foreach ($routes as $key => $route){
                if($this->_route === $route){
                    return 'active';
                }
            }
        }

        if($this->_route === $routes){
            return 'active';
        }

        return '';
    }

}