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



//        $user = $this->getUser();
//        echo 'GATO:::<pre>';
//        print_r($user->getRoles());
//        exit;




        /**
         * CRUD
         */
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
        ]);

        $menu->addChild('Master', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview')
        ->setAttribute('class', $this->activeRoute([
            'backend_client_index',
            'backend_product_index',
            'backend_pointofsale_index',
            'backend_category_tree_index',
            'backend_pointofsale_map_index',
            'backend_route_index',
        ]))
        ->setAttribute('icon', 'fa-fw fa-code-fork')
        ->setDisplay($isGranted)
        ;

        $menu['Master']->addChild('Cliente', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', 'fa-fw fa-odnoklassniki')
        ->setAttribute('class', $this->activeRoute([
            'backend_client_index',
        ]))
        ->setDisplay($isGranted)
        ;

        $menu['Master']['Cliente']->addChild('Gestionar', [
            'route' => 'backend_client_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1)
        ->setAttribute('class', $this->activeRoute('backend_client_index'))
        ->setDisplay($isGranted)
        ;

        /**
         * CRUD
         */





        /**
         * ACCOUNTS
         */
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
        ]);

        $menu->addChild('Cuentas', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview')
        ->setAttribute('class', $this->activeRoute([
            'backend_user_index',
            'backend_role_index',
            'backend_session_index',
            'backend_profile_index',
            'backend_groupofusers_index',
        ]))
        ->setAttribute('icon', 'fa-fw fa-users')
        ->setDisplay($isGranted)
        ;

        $menu['Cuentas']->addChild('Usuario', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', 'fa-fw fa-user')
        ->setAttribute('class', $this->activeRoute([
            'backend_user_index',
        ]))
        ->setDisplay($isGranted)
        ;

        $menu['Cuentas']['Usuario']->addChild('Gestionar', [
            'route' => 'backend_user_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1)
        ->setAttribute('class', $this->activeRoute('backend_user_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Cuentas']->addChild('Grupo de usuarios', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('icon', 'fa-fw fa-users')
            ->setAttribute('class', $this->activeRoute([
                'backend_groupofusers_index',
            ]))
            ->setDisplay($isGranted)
        ;

        $menu['Cuentas']['Grupo de usuarios']->addChild('Gestionar', [
            'route' => 'backend_groupofusers_index'
        ])
            ->setAttribute('icon', self::CIRCLE_1)
            ->setAttribute('class', $this->activeRoute('backend_groupofusers_index'))
            ->setDisplay($isGranted)
        ;

        $menu['Cuentas']->addChild('Perfil', [
            'route' => 'backend_default_dashboard',
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

        $menu['Cuentas']['Perfil']->addChild('Gestionar', [
            'route' => 'backend_profile_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1)
        ->setAttribute('class', $this->activeRoute('backend_profile_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Cuentas']->addChild('Rol', [
            'route' => 'backend_default_dashboard',
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

        $menu['Cuentas']['Rol']->addChild('Gestionar', [
            'route' => 'backend_role_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1)
        ->setAttribute('class', $this->activeRoute('backend_role_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Cuentas']->addChild('Sesión', [
            'route' => 'backend_default_dashboard',
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

        $menu['Cuentas']['Sesión']->addChild('Gestionar', [
            'route' => 'backend_session_index'
        ])
            ->setAttribute('icon', self::CIRCLE_1)
            ->setAttribute('class', $this->activeRoute('backend_session_index'))
            ->setDisplay($isGranted)
        ;
        /**
         * ACCOUNTS
         */






        /**
         * ASSOCIATION
         */
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
        ]);

        $menu->addChild('Asociación', [
            'route' => 'backend_default_dashboard',
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






        /**
         * REPORTS
         */
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
        ]);

        $menu->addChild('Reportes', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('allow_angle', true)
            ->setAttribute('class', 'treeview')
            ->setAttribute('class', $this->activeRoute([
                'backend_visit_index',
                'backend_report_pedido_vs_devolucion',
            ]))
            ->setAttribute('icon', 'fa-fw fa-line-chart')
            ->setDisplay($isGranted)
        ;

        $menu['Reportes']->addChild('Pedido vs Devolución (Chart)', [
            'route' => 'backend_report_pedido_vs_devolucion',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'backend_report_roturastock_area_chart',
                'backend_report_roturastock_line_chart',
                'backend_report_productos_entregados_a_pdv',
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('icon', self::CIRCLE_4)
            ->setAttribute('class', $this->activeRoute('backend_report_pedido_vs_devolucion'))
            ->setDisplay($isGranted)
        ;

        $menu['Reportes']->addChild('Visitas (Grid)', [
            'route' => 'backend_visit_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('icon', self::CIRCLE_7)
            ->setAttribute('class', $this->activeRoute('backend_visit_index'))
            ->setDisplay($isGranted)
        ;
        /**
         * REPORTS
         */






        /**
         * GOOGLE DRIVE
         */
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
        ]);

        $menu->addChild('Google', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('allow_angle', true)
            ->setAttribute('class', 'treeview')
            ->setAttribute('class', $this->activeRoute([
                'backend_google_drive_grid_watch',
                'backend_google_drive_index',
                'backend_google_drive_grid_index',
                'backend_google_drive_account_permissions',
            ]))
            ->setAttribute('icon', 'fa-fw fa-google')
            ->setDisplay($isGranted)
        ;

        $menu['Google']->addChild('Drive', [
            'route' => 'backend_google_drive_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('icon', 'fa-fw fa-plus-circle')
            ->setAttribute('class', $this->activeRoute([
                'backend_google_drive_grid_watch',
                'backend_google_drive_index',
                'backend_google_drive_grid_index',
                'backend_google_drive_account_permissions',
            ]))
            ->setDisplay($isGranted)
        ;

        $menu['Google']['Drive']->addChild('My drive', [
            'route' => 'backend_google_drive_index',
            'routeParameters' => ['field' => 'my-drive']
        ])
            ->setAttribute('icon', self::CIRCLE_1)
            ->setAttribute('class', $this->activeRoute('backend_google_drive_index'))
            ->setDisplay($isGranted)
        ;

        $menu['Google']['Drive']->addChild('Shared with me', [
            'route' => 'backend_google_drive_index',
            'routeParameters' => ['field' => 'shared-with-me']
        ])
            ->setAttribute('icon', self::CIRCLE_1)
            ->setAttribute('class', $this->activeRoute('backend_google_drive_index'))
            ->setDisplay($isGranted)
        ;

        $menu['Google']['Drive']->addChild('Gestionar en Tianos', [
            'route' => 'backend_google_drive_grid_index'
        ])
            ->setAttribute('icon', self::CIRCLE_2)
            ->setAttribute('class', $this->activeRoute([
                'backend_google_drive_grid_index',
                'backend_google_drive_grid_watch'
            ]))
            ->setDisplay($isGranted)
        ;

        /**
         * GOOGLE DRIVE
         */





        /**
         * SETTINGS
         */
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::ADMIN,
        ]);
        $menu->addChild('Settings', [
            'route' => 'backend_default_dashboard',
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

        $menu['Settings']->addChild('Load Fixtures', [
            'route' => 'backend_core_loadfixtures'
        ])
            ->setAttribute('icon', self::CIRCLE_1)
            ->setAttribute('class', $this->activeRoute('backend_core_loadfixtures'))
            ->setDisplay($isGranted)
        ;



        /**
         * ACCOUNTS - REGULAR_USER
         */
        $isGranted = $this->isGranted([
            'ROLE_' . Profile::REGULAR_USER,
        ]);
        $menu->addChild('Front-end', [
            'route' => 'backend_user_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('class', 'treeview')
            ->setAttribute('icon', 'fa-fw fa-user')
            ->setAttribute('class', $this->activeRoute('backend_user_index'))
            ->setDisplay($isGranted)
        ;



        /**
         * FRONTEND
         */
        $isGranted = true; //$this->isGranted('ROLE_CLIENT_VIEW');
        $menu->addChild('Front-end', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('class', 'treeview')
            ->setAttribute('icon', 'fa-fw fa-tv')
            ->setDisplay($isGranted)
        ;

        $menu['Front-end']->addChild('inicio', [
            'route' => 'frontend_default_index'
        ])
            ->setAttribute('icon', self::CIRCLE_1)
            ->setAttribute('class', $this->activeRoute('frontend_default_index'))
            ->setDisplay($isGranted)
        ;
        /**
         * FRONTEND
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