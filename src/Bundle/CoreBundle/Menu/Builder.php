<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    const CIRCLE_1_YELLOW = 'fa-circle-o text-yellow';
    const CIRCLE_2_AQUA = 'fa-circle-o text-aqua';
    const CIRCLE_3_BLUE = 'fa-circle-o text-blue';
    const CIRCLE_4_ORANGE = 'fa-circle-o text-orange';
    const CIRCLE_5_RED = 'fa-circle-o text-red';


    public function mainMenu(FactoryInterface $factory, array $options)
    {

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
        $clasesView = true; //$this->isGranted('ROLE_CLIENT_VIEW');
        $menu->addChild('Master', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview ') //active
        ->setAttribute('icon', 'fa-fw fa-code-fork')
        ->setDisplay($clasesView)
        ;

        $menu['Master']->addChild('Client', [
            'route' => 'backend_client_bundle_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', 'fa-fw fa-odnoklassniki')
        ->setDisplay($clasesView)
        ;

        $menu['Master']['Client']->addChild('Gestionar', [
            'route' => 'backend_client_bundle_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($clasesView)
        ;

        $menu['Master']->addChild('Product', [
            'route' => 'backend_product_bundle_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', 'fa-fw fa-cube')
        ->setDisplay($clasesView)
        ;

        $menu['Master']['Product']->addChild('Gestionar', [
            'route' => 'backend_product_bundle_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($clasesView)
        ;

        $menu['Master']->addChild('Punto de venta', [
            'route' => 'backend_pointofsale_bundle_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', 'fa-fw fa-map-marker')
//        ->setAttribute('class', 'active')
        ->setDisplay($clasesView)
        ;

        $menu['Master']['Punto de venta']->addChild('Gestionar', [
            'route' => 'backend_pointofsale_bundle_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($clasesView)
        ;

        $menu['Master']['Punto de venta']->addChild('Mapa', [
            'route' => 'backend_pointofsale_map_bundle_index',
            'childrenAttributes' => [
                'class' => '',
            ],
        ])
        ->setAttribute('icon', self::CIRCLE_2_AQUA)
//        ->setAttribute('class', 'active')
        ->setDisplay($clasesView)
        ;

        $menu['Master']->addChild('Category', [
            'route' => 'backend_category_bundle_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', 'fa-fw fa-sitemap')
        ->setDisplay($clasesView)
        ;

        $menu['Master']['Category']->addChild('Gestionar', [
            'route' => 'backend_category_bundle_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($clasesView)
        ;

        $menu['Master']->addChild('Session', [
            'route' => 'backend_session_bundle_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', 'fa-fw fa-history')
        ->setDisplay($clasesView)
        ;

        $menu['Master']['Category']->addChild('Gestionar', [
            'route' => 'backend_session_bundle_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($clasesView)
        ;
        /**
         * CRUD
         */





        /**
         * USER
         */
        $clasesView = true; //$this->isGranted('ROLE_CLIENT_VIEW');
        $menu->addChild('Cuentas', [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('allow_angle', true)
        ->setAttribute('class', 'treeview')
        ->setAttribute('icon', 'fa-fw fa-users')
        ->setDisplay($clasesView)
        ;

        $menu['Cuentas']->addChild('User', [
            'route' => 'backend_user_bundle_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', 'fa-fw fa-user')
        ->setDisplay($clasesView)
        ;

        $menu['Cuentas']['User']->addChild('Gestionar', [
            'route' => 'backend_user_bundle_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($clasesView)
        ;

        $menu['Cuentas']->addChild('Group of users', [
            'route' => 'backend_groupofusers_bundle_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('icon', 'fa-fw fa-users')
            ->setDisplay($clasesView)
        ;

        $menu['Cuentas']['Group of users']->addChild('Gestionar', [
            'route' => 'backend_groupofusers_bundle_index'
        ])
            ->setAttribute('icon', self::CIRCLE_1_YELLOW)
            ->setDisplay($clasesView)
        ;

        $menu['Cuentas']->addChild('Profile', [
            'route' => 'backend_profile_bundle_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', 'fa-fw fa-user-secret')
        ->setDisplay($clasesView)
        ;

        $menu['Cuentas']['Profile']->addChild('Gestionar', [
            'route' => 'backend_profile_bundle_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($clasesView)
        ;

        $menu['Cuentas']->addChild('Role', [
            'route' => 'backend_role_bundle_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('icon', 'fa-fw fa-expeditedssl')
        ->setDisplay($clasesView)
        ;

        $menu['Cuentas']['Role']->addChild('Gestionar', [
            'route' => 'backend_role_bundle_index'
        ])
        ->setAttribute('icon', self::CIRCLE_1_YELLOW)
        ->setDisplay($clasesView)
        ;




        /**
         * SETTINGS
         */
        $child = 'Settings';
        $loadFixture = true; //$this->isGranted('ROLE_CLIENT_VIEW');
        $menu->addChild($child, [
            'route' => 'backend_default_dashboard',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
            ->setAttribute('class', 'treeview')
            ->setAttribute('icon', 'fa-fw fa-cog')
            ->setDisplay($loadFixture)
        ;

        $menu[$child]->addChild('Load Fixtures', [
            'route' => 'backend_core_loadfixtures'
        ])
            ->setAttribute('icon', self::CIRCLE_1_YELLOW)
            ->setDisplay($loadFixture)
        ;

        $menu[$child]->addChild('GoogleDrive mimetype', [
            'route' => 'backend_default_dashboard'
        ])
            ->setAttribute('icon', self::CIRCLE_2_AQUA)
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

    protected function isCurrentRoute($attributes, $object = null)
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();
        $_route = $request->attributes->get('_route');

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