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

        $menu['Asociacion']->addChild('<i class="fa ' . self::CIRCLE_1_YELLOW . '"></i> Profile <i class="fa fa-fw fa-arrow-right"></i> Role', [
            'route' => 'backend_associative_profile_has_role_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('icon', '')
            ->setAttribute('class', $this->activeRoute('backend_associative_profile_has_role_index'))
            ->setDisplay($isGranted)
        ;
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

        $menu['Reports']->addChild('<i class="fa ' . self::CIRCLE_1_YELLOW . '"></i> Point of sale <i class="fa fa-fw fa-angle-double-right"></i> product', [
            'route' => 'backend_reportpointofsaleandproduct_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('icon', '')
            ->setAttribute('class', $this->activeRoute('backend_reportpointofsaleandproduct_index'))
            ->setDisplay($isGranted)
        ;
        /**
         * ASSOCIATION
         */




        /**
         * FRONTEND
         */
        $loadFixture = true; //$this->isGranted('ROLE_CLIENT_VIEW');
        $menu->addChild('Front-end', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('class', 'treeview')
            ->setAttribute('icon', 'fa-fw fa-tv')
            ->setDisplay($loadFixture)
        ;

        $menu['Front-end']->addChild('inicio', [
            'route' => 'frontend_default_index'
        ])
            ->setAttribute('icon', self::CIRCLE_1_YELLOW)
            ->setAttribute('class', $this->activeRoute('frontend_default_index'))
            ->setDisplay($loadFixture)
        ;



        /**
         * SETTINGS
         */
        $loadFixture = true; //$this->isGranted('ROLE_CLIENT_VIEW');
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
            ->setDisplay($loadFixture)
        ;

        $menu['Settings']->addChild('Load Fixtures', [
            'route' => 'backend_core_loadfixtures'
        ])
            ->setAttribute('icon', self::CIRCLE_1_YELLOW)
            ->setAttribute('class', $this->activeRoute('backend_core_loadfixtures'))
            ->setDisplay($loadFixture)
        ;

        $menu['Settings']->addChild('GoogleDrive mimetype', [
            'route' => 'backend_default_dashboard'
        ])
            ->setAttribute('icon', self::CIRCLE_2_AQUA)
//            ->setAttribute('class', $this->activeRoute('backend_default_dashboard'))
            ->setDisplay($loadFixture)
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



/*
        <ul class="sidebar-menu">

        <li class="treeview {% if app.request.get('_route') matches '(backend_files)' %}active{% endif %}">
            <a href="{{ path('backend_files_index') }}">
                <i class="fa fa-files-o"></i> <span>Mis archivos</span>
            </a>
        </li>

        <li class="treeview">
            <a href="#">
                <i class="fa fa-upload"></i> <span>Subir archivo</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="treeview {% if app.request.get('_route') matches '(backend_googledrive)' %}active{% endif %}">
                    <a href="{{ path('backend_googledrive_index') }}">
                        <i class="fa fa-fw fa-google"></i> <span>Google drive</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{% if app.request.get('_route') matches '(backend_googledrive)' %}active{% endif %}">
                            <a href="{{ path('backend_googledrive_index', {id:'my-drive'}) }}"><i class="fa fa-codepen"></i> Mi unidad</a>
                        </li>
                        <li class="{% if app.request.get('_route') matches '(backend_googledrive)' %}active{% endif %}">
                            <a href="{{ path('backend_googledrive_index', {id:'shared-with-me'}) }}"><i class="fa fa-users"></i> Compartido conmigo</a>
                        </li>
                        <li class="{% if app.request.get('_route') matches '(backend_googledrive)' %}active{% endif %}">
                            <a href="{{ path('backend_googledrive_revoke_token') }}"><i class="fa fa-fw fa-sign-out"></i> Salir del drive</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview {% if app.request.get('_route') matches '(backend_googledrive)' %}active{% endif %}">
                    <a href="{{ path('backend_googledrive_index') }}">
                        <i class="fa fa-fw fa-dropbox"></i> <span>Dropbox</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{% if app.request.get('_route') matches '(backend_googledrive)' %}active{% endif %}">
                            <a href="{{ path('backend_googledrive_index', {id:'my-drive'}) }}"><i class="fa fa-codepen"></i> Mi unidad</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li class="treeview {% if app.request.get('_route') matches '(backend_client)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-fw fa-industry"></i> <span>Clientes</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_client_index)' %}active{% endif %}">
                    <a href="{{ path('backend_client_index') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Listar</span></a>
                </li>
            </ul>
        </li>

        <li class="treeview {{ app.request.get('_route') matches '(backend_user|backend_aclrole|backend_aclprofile|backend_groupofusers)' ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-fw fa-user"></i> <span>Usuarios</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_user_index)' %}active{% endif %}">
                    <a href="{{ path('backend_user_index') }}"><i class="fa fa-circle-o text-red"></i> <span>Listar</span></a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_aclrole_index)' %}active{% endif %}">
                    <a href="{{ path('backend_aclrole_index') }}"><i class="fa fa-circle-o text-blue"></i> <span>Roles</span></a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_aclprofile_index)' %}active{% endif %}">
                    <a href="{{ path('backend_aclprofile_index') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Profile</span></a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_groupofusers_index)' %}active{% endif %}">
                    <a href="{{ path('backend_groupofusers_index') }}"><i class="fa fa-circle-o text-orange"></i> <span>Grupo de usuarios</span></a>
                </li>
            </ul>
        </li>

        <li class="treeview {% if app.request.get('_route') matches '(backend_pointofsale|backend_pointofsaletree)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-fw fa-home"></i> <span>Puntos de venta</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_pointofsale_index)' %}active{% endif %}">
                    <a href="{{ path('backend_pointofsale_index') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Listar</span></a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_pointofsaletree_index)' %}active{% endif %}">
                    <a href="{{ path('backend_pointofsaletree_index') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Listar tree</span></a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_googledrive_index)' %}active{% endif %}">
                    <a href="{{ path('backend_googledrive_index') }}"><i class="fa fa-circle-o text-aqua"></i> <span>Mapa</span></a>
                </li>
            </ul>
        </li>

        <li class="treeview {% if app.request.get('_route') matches '(backend_categorytree|backend_categorytreetoassign)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-fw fa-sitemap"></i> <span>Categor&iacute;as</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_categorytree_index)' %}active{% endif %}">
                    <a href="{{ path('backend_categorytree_index') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Gestionar</span></a>
                </li>
            </ul>
        </li>

        <li class="treeview {% if app.request.get('_route') matches '(backend_product)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-fw fa-cube"></i> <span>CRUD_DUMMYos</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_product_index)' %}active{% endif %}">
                    <a href="{{ path('backend_product_index') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Listar</span></a>
                </li>
            </ul>
        </li>

        <li class="treeview {{ app.request.get('_route') matches '(backend_assignuserhaspointofsale|backend_assigngrouphasuser|backend_assignpointofsalehasproduct|backend_categorytreetoassign|backend_assigntemplatehasmodule)' ? 'active' : '' }}">
            <a href="#">
                <i class="fa fa-fw fa-exchange"></i> <span>Asignaci&oacute;n</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_categorytreetoassign_index)' %}active{% endif %}">
                    <a href="{{ path('backend_categorytreetoassign_index') }}">
                        <i class="fa fa-circle-o text-blue"></i>
                        <span>Categoría <i class="fa fa-fw fa-arrow-right"></i> CRUD_DUMMYo</span>
                    </a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_assignpointofsalehasproduct_index)' %}active{% endif %}">
                    <a href="{{ path('backend_assignpointofsalehasproduct_index') }}">
                        <i class="fa fa-circle-o text-orange"></i>
                        <span>Punto de venta <i class="fa fa-fw fa-arrow-right"></i> CRUD_DUMMYo</span>
                    </a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_assignuserhaspointofsale_index)' %}active{% endif %}">
                    <a href="{{ path('backend_assignuserhaspointofsale_index') }}">
                        <i class="fa fa-circle-o text-blue"></i>
                        <span>Usuario <i class="fa fa-fw fa-arrow-right"></i> Punto de venta</span>
                    </a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_assigngrouphasuser_index)' %}active{% endif %}">
                    <a href="{{ path('backend_assigngrouphasuser_index') }}">
                        <i class="fa fa-circle-o text-orange"></i>
                        <span>Grupo <i class="fa fa-fw fa-arrow-right"></i> Usuario</span>
                    </a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_assigntemplatehasmodule_index)' %}active{% endif %}">
                    <a href="{{ path('backend_assigntemplatehasmodule_index') }}">
                        <i class="fa fa-circle-o text-orange"></i>
                        <span>Template <i class="fa fa-fw fa-arrow-right"></i> Module</span>
                    </a>
                </li>
            </ul>
        </li>



        <li class="treeview {% if app.request.get('_route') matches '(backend_acl)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-user-secret"></i> <span>Access Control Lists</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_acl_classes)' %}active{% endif %}">
                    <a href="{{ path('backend_acl_classes') }}"><i class="fa fa-circle-o text-red"></i> <span>Clases</span></a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_acl_object_identities)' %}active{% endif %}">
                    <a href="{{ path('backend_acl_object_identities') }}"><i class="fa fa-circle-o text-yellow"></i> <span>Object identities</span></a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_acl_entries)' %}active{% endif %}">
                    <a href="{{ path('backend_acl_entries') }}"><i class="fa fa-circle-o text-aqua"></i> <span>Entries</span></a>
                </li>
            </ul>
        </li>

        <li class="treeview {% if app.request.get('_route') matches '(backend_template|backend_templatemodule)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-object-group"></i> <span>Template</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_template_index)' %}active{% endif %}">
                    <a href="{{ path('backend_template_index') }}">
                        <i class="fa fa-circle-o text-red"></i> <span>List template</span>
                    </a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_templatemodule_index)' %}active{% endif %}">
                    <a href="{{ path('backend_templatemodule_index') }}">
                        <i class="fa fa-circle-o text-red"></i> <span>Template module</span>
                    </a>
                </li>
                <li class="{% if app.request.get('_route') matches '(backend_templateecategory_index)' %}active{% endif %}">
                    <a href="{{ path('backend_templateecategory_index') }}">
                        <i class="fa fa-circle-o text-red"></i> <span>Template category</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="treeview {% if app.request.get('_route') matches '(backend_setuptemplate|backend_setupedittemplate)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-object-group"></i> <span>Template setup</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu">
                <li class="{% if app.request.get('_route') matches '(backend_setuptemplate|backend_setupedittemplate)' %}active{% endif %}">
                    <a href="{{ path('backend_setuptemplate_index') }}">
                        <i class="fa fa-circle-o text-red"></i> <span>Choose</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="treeview {% if app.request.get('_route') matches '(backend_googledrive|core_default)' %}active{% endif %}">
            <a href="#">
                <i class="fa fa-cog"></i> <span>Configuraci&oacute;n</span>
                <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
            </a>
            <ul class="treeview-menu menu-open">
                <li class="{% if app.request.get('_route') matches '(core_default_load_fixtures)' %}active{% endif %}">
                    <a href="{{ path('core_default_load_fixtures') }}">
                        <i class="fa fa-circle-o text-red"></i> <span>Load Fixtures</span>
                    </a>
                </li>
                <li class="">
                    <a href="#"><i class="fa fa-circle-o"></i> Google drive
    <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                    </a>
                    <ul class="treeview-menu menu-open">
                        <li>
                            <a href="{{ path('backend_googledrivesettings_mimetype') }}">
                                <i class="fa fa-circle-o"></i> Mime type
    </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <li>
            <a href="#">
                <i class="fa fa-calendar"></i> <span>Calendar</span>
                <span class="pull-right-container">
                        <small class="label pull-right bg-red">3</small>
                        <small class="label pull-right bg-blue">17</small>
                    </span>
            </a>
        </li>

    </ul>
*/