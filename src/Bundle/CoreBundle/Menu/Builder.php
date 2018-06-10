<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

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
         * CRUD
         */
        $isGranted = true; //$this->isGranted('ROLE_CLIENT_VIEW');

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
            'backend_category_index',
            'backend_pointofsale_index',
            'backend_category_tree_index',
            'backend_pointofsale_map_index',
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

        $menu['Master']->addChild('Producto', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', 'fa-fw fa-cube')
        ->setAttribute('class', $this->activeRoute([
            'backend_product_index',
        ]))
        ->setDisplay($isGranted)
        ;

        $menu['Master']['Producto']->addChild('Gestionar', [
            'route' => 'backend_product_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1)
        ->setAttribute('class', $this->activeRoute('backend_product_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Master']->addChild('Ruta', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('icon', 'fa-fw fa-road')
            ->setAttribute('class', $this->activeRoute([
                'backend_route_index',
            ]))
            ->setDisplay($isGranted)
        ;

        $menu['Master']['Ruta']->addChild('Gestionar', [
            'route' => 'backend_route_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1)
        ->setAttribute('class', $this->activeRoute('backend_route_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Master']->addChild('Punto de venta', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', 'fa-fw fa-map-marker')
        ->setAttribute('class', $this->activeRoute([
            'backend_pointofsale_index',
            'backend_pointofsale_map_index',
        ]))
        ->setDisplay($isGranted)
        ;

        $menu['Master']['Punto de venta']->addChild('Gestionar', [
            'route' => 'backend_pointofsale_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1)
        ->setAttribute('class', $this->activeRoute('backend_pointofsale_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Master']['Punto de venta']->addChild('Mapa', [
            'route' => 'backend_pointofsale_map_index',
            'childrenAttributes' => [
                'class' => '',
            ],
        ])
        ->setAttribute('icon', self::CIRCLE_2)
        ->setAttribute('class', $this->activeRoute('backend_pointofsale_map_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Master']->addChild('Categoría', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', 'fa-fw fa-sitemap')
        ->setAttribute('class', $this->activeRoute([
            'backend_category_index',
            'backend_category_tree_index',
        ]))
        ->setDisplay($isGranted)
        ;

        $menu['Master']['Categoría']->addChild('Gestionar', [
            'route' => 'backend_category_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1)
        ->setAttribute('class', $this->activeRoute('backend_category_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Master']['Categoría']->addChild('Tree', [
            'route' => 'backend_category_tree_index'
        ])
        ->setAttribute('icon', self::CIRCLE_2)
        ->setAttribute('class', $this->activeRoute('backend_category_tree_index'))
        ->setDisplay($isGranted)
        ;
        /**
         * CRUD
         */





        /**
         * USER
         */
        $isGranted = true; //$this->isGranted('ROLE_CLIENT_VIEW');
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
         * USER
         */






        /**
         * ASSOCIATION
         */
        $isGranted = true; //$this->isGranted('ROLE_CLIENT_VIEW');
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
            'backend_associative_category_has_product_index',
            'backend_associative_pointofsale_has_user_index',
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

        $menu['Asociación']->addChild('Categoría <i class="fa fa-fw fa-arrow-right"></i> Producto', [
            'route' => 'backend_associative_category_has_product_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', self::CIRCLE_2)
        ->setAttribute('class', $this->activeRoute('backend_associative_category_has_product_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Asociación']->addChild('Punto de venta <i class="fa fa-fw fa-arrow-right"></i> Canillita', [
            'route' => 'backend_associative_pointofsale_has_user_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', self::CIRCLE_3)
        ->setAttribute('class', $this->activeRoute('backend_associative_pointofsale_has_user_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Asociación']->addChild('Ruta <i class="fa fa-fw fa-arrow-right"></i> Punto de venta', [
            'route' => 'backend_associative_route_has_pointofsale_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', self::CIRCLE_4)
        ->setAttribute('class', $this->activeRoute('backend_associative_route_has_pointofsale_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Asociación']->addChild('Distribuidor <i class="fa fa-fw fa-arrow-right"></i> Ruta', [
            'route' => 'backend_associative_user_has_route_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', self::CIRCLE_5)
        ->setAttribute('class', $this->activeRoute('backend_associative_user_has_route_index'))
        ->setDisplay($isGranted)
        ;
        /**
         * ASSOCIATION
         */





        /**
         * REPORTS
         */
        $isGranted = true; //$this->isGranted('ROLE_CLIENT_VIEW');
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
                'backend_pdvhasproduct_index',
                'backend_visit_index',
            ]))
            ->setAttribute('icon', 'fa-fw fa-line-chart')
            ->setDisplay($isGranted)
        ;

        $menu['Reportes']->addChild('Punto de venta <i class="fa fa-fw fa-angle-double-right"></i> producto', [
            'route' => 'backend_pdvhasproduct_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('icon', self::CIRCLE_1)
            ->setAttribute('class', $this->activeRoute('backend_pdvhasproduct_index'))
            ->setDisplay($isGranted)
        ;

        $menu['Reportes']->addChild('Visita', [
            'route' => 'backend_visit_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('icon', self::CIRCLE_2)
            ->setAttribute('class', $this->activeRoute('backend_visit_index'))
            ->setDisplay($isGranted)
        ;
        /**
         * REPORTS
         */




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
         * SETTINGS
         */

        /*
        $isGranted = true; //$this->isGranted('ROLE_CLIENT_VIEW');
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

        $menu['Settings']->addChild('GoogleDrive mimetype', [
            'route' => 'backend_default_dashboard'
        ])
            ->setAttribute('icon', self::CIRCLE_2)
//            ->setAttribute('class', $this->activeRoute('backend_default_dashboard'))
            ->setDisplay($isGranted)
        ;
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