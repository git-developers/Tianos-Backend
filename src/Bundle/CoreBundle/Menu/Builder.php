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

    const CIRCLE_1_YELLOW = 'fa-circle-o text-yellow';
    const CIRCLE_2_AQUA = 'fa-circle-o text-aqua';
    const CIRCLE_3_BLUE = 'fa-circle-o text-blue';
    const CIRCLE_4_ORANGE = 'fa-circle-o text-orange';
    const CIRCLE_5_RED = 'fa-circle-o text-red';

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

        $menu['Master']->addChild('Client', [
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

        $menu['Master']['Client']->addChild('Gestionar', [
            'route' => 'backend_client_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setAttribute('class', $this->activeRoute('backend_client_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Master']->addChild('Product', [
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

        $menu['Master']['Product']->addChild('Gestionar', [
            'route' => 'backend_product_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setAttribute('class', $this->activeRoute('backend_product_index'))
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
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setAttribute('class', $this->activeRoute('backend_pointofsale_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Master']['Punto de venta']->addChild('Mapa', [
            'route' => 'backend_pointofsale_map_index',
            'childrenAttributes' => [
                'class' => '',
            ],
        ])
        ->setAttribute('icon', self::CIRCLE_2_AQUA)
        ->setAttribute('class', $this->activeRoute('backend_pointofsale_map_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Master']->addChild('Category', [
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

        $menu['Master']['Category']->addChild('Gestionar', [
            'route' => 'backend_category_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setAttribute('class', $this->activeRoute('backend_category_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Master']['Category']->addChild('Tree', [
            'route' => 'backend_category_tree_index'
        ])
        ->setAttribute('icon', self::CIRCLE_2_AQUA)
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

        $menu['Cuentas']->addChild('User', [
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

        $menu['Cuentas']['User']->addChild('Gestionar', [
            'route' => 'backend_user_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setAttribute('class', $this->activeRoute('backend_user_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Cuentas']->addChild('Group of users', [
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

        $menu['Cuentas']['Group of users']->addChild('Gestionar', [
            'route' => 'backend_groupofusers_index'
        ])
            ->setAttribute('icon', self::CIRCLE_1_YELLOW)
            ->setAttribute('class', $this->activeRoute('backend_groupofusers_index'))
            ->setDisplay($isGranted)
        ;

        $menu['Cuentas']->addChild('Profile', [
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

        $menu['Cuentas']['Profile']->addChild('Gestionar', [
            'route' => 'backend_profile_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setAttribute('class', $this->activeRoute('backend_profile_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Cuentas']->addChild('Role', [
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

        $menu['Cuentas']['Role']->addChild('Gestionar', [
            'route' => 'backend_role_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setAttribute('class', $this->activeRoute('backend_role_index'))
        ->setDisplay($isGranted)
        ;

        $menu['Cuentas']->addChild('Session', [
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

        $menu['Cuentas']['Session']->addChild('Gestionar', [
            'route' => 'backend_session_index'
        ])
            ->setAttribute('icon', self::CIRCLE_1_YELLOW)
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
        $menu->addChild('Asociacion', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('allow_angle', true)
            ->setAttribute('class', 'treeview')
            ->setAttribute('class', $this->activeRoute([
                'backend_associative_profile_has_role_index',
            ]))
            ->setAttribute('icon', 'fa-fw fa-exchange')
            ->setDisplay($isGranted)
        ;

//        $menu['Asociacion']->addChild('Profile <i class="fa fa-fw fa-arrow-right"></i> Role', [
//            'route' => 'backend_associative_profile_has_role_index',
//            'extras' => ['safe_label' => true],
//            'childrenAttributes' => [
//                'class' => 'treeview-menu',
//            ],
//        ])
//            ->setAttribute('icon', self::CIRCLE_1_YELLOW)
//            ->setAttribute('class', $this->activeRoute('backend_associative_profile_has_role_index'))
//            ->setDisplay($isGranted)
//        ;
        /**
         * ASSOCIATION
         */





        /**
         * REPORTS
         */
        $isGranted = true; //$this->isGranted('ROLE_CLIENT_VIEW');
        $menu->addChild('Reports', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('allow_angle', true)
            ->setAttribute('class', 'treeview')
            ->setAttribute('class', $this->activeRoute([
                'backend_reportpointofsaleandproduct_index',
            ]))
            ->setAttribute('icon', 'fa-fw fa-line-chart')
            ->setDisplay($isGranted)
        ;

        $menu['Reports']->addChild('Point of sale <i class="fa fa-fw fa-angle-double-right"></i> product', [
            'route' => 'backend_reportpointofsaleandproduct_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('icon', self::CIRCLE_1_YELLOW)
            ->setAttribute('class', $this->activeRoute('backend_reportpointofsaleandproduct_index'))
            ->setDisplay($isGranted)
        ;
        /**
         * ASSOCIATION
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
            ->setAttribute('icon', self::CIRCLE_1_YELLOW)
            ->setAttribute('class', $this->activeRoute('frontend_default_index'))
            ->setDisplay($isGranted)
        ;



        /**
         * SETTINGS
         */
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
            ->setAttribute('icon', self::CIRCLE_1_YELLOW)
            ->setAttribute('class', $this->activeRoute('backend_core_loadfixtures'))
            ->setDisplay($isGranted)
        ;

        $menu['Settings']->addChild('GoogleDrive mimetype', [
            'route' => 'backend_default_dashboard'
        ])
            ->setAttribute('icon', self::CIRCLE_2_AQUA)
//            ->setAttribute('class', $this->activeRoute('backend_default_dashboard'))
            ->setDisplay($isGranted)
        ;


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