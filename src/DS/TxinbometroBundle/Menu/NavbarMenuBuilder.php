<?php

namespace DS\TxinbometroBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Mopa\Bundle\BootstrapBundle\Navbar\AbstractNavbarMenuBuilder;

class NavbarMenuBuilder extends AbstractNavbarMenuBuilder
{
    protected $securityContext;
    protected $isLoggedIn;

    public function __construct(FactoryInterface $factory, SecurityContextInterface $securityContext)
    {
        parent::__construct($factory);

        $this->securityContext = $securityContext;
        $this->isLoggedIn = $this->securityContext->isGranted('IS_AUTHENTICATED_FULLY');
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav');

        $menu->addChild('Vehiculo',array('route' => 'txinbometro_vehiculo'));
        $menu->addChild('Estadisticas',array('route' => 'txinbometro_estadisticas_general'));
        $menu->addChild('Gasolina',array('route' => 'txinbometro_gasolina'));
        $menu->addChild('Gastos',array('route' => 'txinbometro_gasto'));
        
        /*
         * $menu->addChild('Shipdev', array('route' => 'shipdev'));

        $dropdown = $this->createDropdownMenuItem($menu, "Mehr");
        $dropdown->addChild('Captain Ränge', array('route' => 'revorix_ranks'));
        $dropdown->addChild('Schiffs-XP', array('route' => 'revorix_xptool'));
*/
        return $menu;
    }

    public function createRightSideDropdownMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right');

        if ($this->isLoggedIn) {
            $menu->addChild('Abmelden', array('route' => 'fos_user_security_logout'));
        } else {
            $menu->addChild('Anmelden', array('route' => 'fos_user_security_login'));
            $menu->addChild('Registrieren', array('route' => 'fos_user_registration_register'));
        }

        $this->addDivider($menu, true);
        $menu->addChild('Impressum', array('route' => 'impressum'));

        return $menu;
    }
}