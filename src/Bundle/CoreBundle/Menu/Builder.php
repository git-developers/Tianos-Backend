<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Menu;

use Bundle\CategoryBundle\Entity\Category;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Bundle\ProfileBundle\Entity\Profile;
use Bundle\RoleBundle\Entity\Role;

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
         * DASHBOARD
         */
	
	    if ($this->isGranted(Role::ROLE_PDV_ADMIN)) {
		    $route = 'backend_default_pdv_index';
	    } elseif ($this->isGranted(Role::ROLE_EMPLOYEE)) {
		    $route = 'backend_default_pdv_index';
	    } elseif ($this->isGranted(Role::ROLE_SUPER_ADMIN)) {
		    $route = 'backend_default_super_index';
	    }
	    
        $menu->addChild('Dashboard', [
            'route' => $route,
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('class', 'treeview')
        ->setAttribute('icon', 'fa-fw fa-tv')
        ->setAttribute('class', $this->activeRoute($route))
        ->setDisplay(true)
        ;
        /**
         * DASHBOARD
         */




        /**
         * MODULES
         */
        $isGranted = $this->isGranted([
            Role::ROLE_SUPER_ADMIN,
        ]);

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
		    Role::ROLE_SUPER_ADMIN,
	    ]);
	
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
			    'backend_pointofsale_module',
			    'backend_super_pointofsale_map_index',
			    'backend_super_pointofsale_add_user_index',
			    'backend_super_pointofsale_pdv_child_index',
		    ]))
		    ->setAttribute('icon', 'fa-fw fa-map-marker')
		    ->setDisplay($isGranted)
	    ;

	    $menu['Puntos de venta']->addChild('Gestionar', [
		    'route' => 'backend_pointofsale_index'
	    ])
		    ->setAttribute('icon', self::CIRCLE_1)
		    ->setAttribute('class', $this->activeRoute('backend_pointofsale_index'))
		    ->setDisplay($isGranted)
	    ;
	
	    $menu['Puntos de venta']->addChild('Mapa', [
		    'route' => 'backend_super_pointofsale_map_index'
	    ])
		    ->setAttribute('icon', self::CIRCLE_2)
		    ->setAttribute('class', $this->activeRoute('backend_super_pointofsale_map_index'))
		    ->setDisplay($isGranted)
	    ;
        /**
         * POINTS OF SALES
         */


        

        /**
         * ACCOUNTS - ADMIN
         */
        $isGranted = $this->isGranted([
            Role::ROLE_SUPER_ADMIN,
            Role::ROLE_PDV_ADMIN,
        ]);

        $isGrantedSuperAdmin = $this->isGranted(Role::ROLE_SUPER_ADMIN);
        $isGrantedAdmin = $this->isGranted(Role::ROLE_PDV_ADMIN);
        $isGrantedEmployee = $this->isGranted(Role::ROLE_EMPLOYEE);

        $menu->addChild('Usuarios', [
            'route' => 'frontend_default_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('class', 'treeview')
        ->setAttribute('class', $this->activeRoute([
	        'backend_user_profile',
	        'backend_super_user_index',
	        'backend_user_client_index',
	        'backend_user_employee_index',
        ]))
        ->setAttribute('icon', 'fa-fw fa-user')
        ->setDisplay(true)
        ;

        $menu['Usuarios']->addChild('Gestionar', [
            'route' => 'backend_super_user_index'
        ])
            ->setAttribute('icon', self::CIRCLE_1)
            ->setAttribute('class', $this->activeRoute('backend_super_user_index'))
            ->setDisplay($isGrantedSuperAdmin)
        ;

        $menu['Usuarios']->addChild('Clientes', [
            'route' => 'backend_user_client_index'
        ])
            ->setAttribute('icon', self::CIRCLE_2)
            ->setAttribute('class', $this->activeRoute('backend_user_client_index'))
            ->setDisplay($isGrantedAdmin || $isGrantedEmployee)
        ;

        $menu['Usuarios']->addChild('Empleados', [
            'route' => 'backend_user_employee_index'
        ])
            ->setAttribute('icon', self::CIRCLE_3)
            ->setAttribute('class', $this->activeRoute('backend_user_employee_index'))
            ->setDisplay($isGrantedAdmin)
        ;
        /**
         * ACCOUNTS - ADMIN
         */






        /**
         * STOCK - INVENTORY
         */
        $isGranted = $this->isGranted([
            Role::ROLE_PDV_ADMIN,
        ]);

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

        $menu['Inventario']->addChild('Categoria', [
            'route' => 'backend_category_tree_index',
            'routeParameters' => [
                'entity_type' => Category::TYPE_PRODUCT
            ]
        ])
            ->setAttribute('icon', self::CIRCLE_1)
            ->setAttribute('class', $this->activeRoute('backend_category_tree_index'))
            ->setDisplay($isGranted)
        ;

        $menu['Inventario']->addChild('Producto', [
            'route' => 'backend_product_index'
        ])
            ->setAttribute('icon', self::CIRCLE_2)
            ->setAttribute('class', $this->activeRoute('backend_product_index'))
            ->setDisplay($isGranted)
        ;
        /**
         * STOCK - INVENTORY
         */
		

        
        


        /**
         * SERVICES
         */
        $isGranted = $this->isGranted([
            Role::ROLE_PDV_ADMIN,
        ]);

        $menu->addChild('Services', [
            'route' => 'backend_services_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('allow_angle', true)
            ->setAttribute('class', 'treeview')
            ->setAttribute('class', $this->activeRoute([
                'backend_services_index',
                'backend_category_services_tree_index',
            ]))
            ->setAttribute('icon', 'fa-fw fa-file-text-o')
            ->setDisplay($isGranted)
        ;

        $menu['Services']->addChild('Categoria', [
            'route' => 'backend_category_services_tree_index',
            'routeParameters' => [
                'entity_type' => Category::TYPE_SERVICE
            ]
        ])
            ->setAttribute('icon', self::CIRCLE_1)
            ->setAttribute('class', $this->activeRoute('backend_category_services_tree_index'))
            ->setDisplay($isGranted)
        ;

        $menu['Services']->addChild('Services', [
            'route' => 'backend_services_index'
        ])
            ->setAttribute('icon', self::CIRCLE_2)
            ->setAttribute('class', $this->activeRoute('backend_services_index'))
            ->setDisplay($isGranted)
        ;
        /**
         * SERVICES
         */







        /**
         * SECURITY
         */
        $isGranted = $this->isGranted([
            Role::ROLE_SUPER_ADMIN,
        ]);

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
         * TICKET
         */
        $isGranted = $this->isGranted([
            Role::ROLE_EMPLOYEE,
	        Role::ROLE_PDV_ADMIN,
        ]);

        $menu->addChild('Ticket', [
            'route' => 'backend_ticket_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('class', 'treeview')
            ->setAttribute('class', $this->activeRoute([
                'backend_ticket_index',
                'backend_ticket_create',
                'backend_ticket_edit',
                'backend_calendar_index',
            ]))
            ->setAttribute('icon', 'fa-fw fa-ticket')
            ->setDisplay($isGranted)
        ;
        
	    $menu['Ticket']->addChild('Crear ticket', [
		    'route' => 'backend_ticket_create'
	    ])
		    ->setAttribute('icon', self::CIRCLE_1)
		    ->setAttribute('class', $this->activeRoute('backend_ticket_create'))
		    ->setDisplay($isGranted)
	    ;

        $menu['Ticket']->addChild('Gestionar', [
            'route' => 'backend_ticket_index'
        ])
            ->setAttribute('icon', self::CIRCLE_2)
            ->setAttribute('class', $this->activeRoute([
            	'backend_ticket_index',
	            'backend_ticket_edit'
            ]))
            ->setDisplay($isGranted)
        ;
        
	    $menu['Ticket']->addChild('Agenda', [
		    'route' => 'backend_calendar_index'
	    ])
		    ->setAttribute('icon', 'fa-fw fa-calendar')
		    ->setAttribute('class', $this->activeRoute('backend_calendar_index'))
		    ->setDisplay($isGranted)
	    ;
        /**
         * TICKET
         */
	
        
        

        /**
         * STATISTICS
         */
        $isGranted = $this->isGranted([
	        Role::ROLE_PDV_ADMIN,
        ]);

        $menu->addChild('Estadísticas', [
            'route' => 'backend_report_combo_chart',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('class', 'treeview')
            ->setAttribute('class', $this->activeRoute([
	            'backend_report_pie_chart',
	            'backend_report_combo_chart',
            ]))
            ->setAttribute('icon', 'fa-fw fa-bar-chart')
            ->setDisplay($isGranted)
        ;
        
	    $menu['Estadísticas']->addChild('Combo chart', [
		    'route' => 'backend_report_combo_chart'
	    ])
		    ->setAttribute('icon', self::CIRCLE_1)
		    ->setAttribute('class', $this->activeRoute('backend_report_combo_chart'))
		    ->setDisplay($isGranted)
	    ;
     
	    $menu['Estadísticas']->addChild('Pie chart', [
		    'route' => 'backend_report_pie_chart'
	    ])
		    ->setAttribute('icon', self::CIRCLE_2)
		    ->setAttribute('class', $this->activeRoute('backend_report_pie_chart'))
		    ->setDisplay($isGranted)
	    ;
        /**
         * STATISTICS
         */
	
	    
	
	
	
	    /**
	     * SETTINGS
	     */
	    $isGranted = $this->isGranted([
		    Role::ROLE_PDV_ADMIN,
	    ]);
	
	    $menu->addChild('Ajustes', [
		    'route' => 'frontend_default_index',
		    'extras' => ['safe_label' => true],
		    'childrenAttributes' => [
			    'class' => 'treeview-menu',
		    ],
	    ])
		    ->setAttribute('class', 'treeview')
		    ->setAttribute('class', $this->activeRoute([
			    'backend_pointofsale_per_user_index',
		    ]))
		    ->setAttribute('icon', 'fa-fw fa-cog')
		    ->setDisplay($isGranted)
	    ;
	
	    $menu['Ajustes']->addChild('Datos del salón', [
		    'route' => 'backend_pointofsale_per_user_index'
	    ])
		    ->setAttribute('icon', self::CIRCLE_1)
		    ->setAttribute('class', $this->activeRoute('backend_pointofsale_per_user_index'))
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