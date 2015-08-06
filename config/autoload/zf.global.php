<?php
return array(
    'service_manager' => array(
        'invokables' => array(
            'Zend\Session\SessionManager' => 'Zend\Session\SessionManager',
            'oracle-session-init' => '\Doctrine\DBAL\Event\Listeners\OracleSessionInit',
        ),
        'aliases' => array(
            'Zend\Authentication\AuthenticationService' => 'zfcuser_auth_service'
        )
    ),

    'view_manager' => array(
        'template_map' => array(
            'error/403' => __DIR__ . '/../../module/Application/view/error/403.phtml',
        ),
    ),

    'view_helpers' => array(
        'invokables' => array(
          /*  'urlHelper' => 'Application\Helper\URLHelper',
            'menuHelper' => 'Application\Helper\MenuHelper',
            'FlashMessengerHelper' => 'Application\Helper\FlashMessengerHelper',
            'botoesListagem' => 'Application\Helper\BotoesListagem',*/
            //
//            'bootstrapForm' => 'ZucchiBootstrap\Form\View\Helper\BootstrapForm',
//            'bootstrapRow' => 'ZucchiBootstrap\Form\View\Helper\BootstrapRow',
//            'bootstrapCollection' => 'ZucchiBootstrap\Form\View\Helper\BootstrapCollection',
//            'bootstrapNavbar' => 'ZucchiBootstrap\Navigation\View\Helper\Navbar',
//            'bootstrapAlert' => 'ZucchiBootstrap\View\Helper\Alert',
//            'bootstrapAlerts' => 'ZucchiBootstrap\View\Helper\AlertList',
        )
    ),

);
