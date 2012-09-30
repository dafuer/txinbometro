<?php

namespace Dafuer\TxinbometroBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Mopa\Bundle\BootstrapBundle\Navbar\AbstractNavbarMenuBuilder;

class NavbarMenuBuilder extends AbstractNavbarMenuBuilder
{
    protected $securityContext;
    protected $isLoggedIn;
    protected $session;

    public function __construct(FactoryInterface $factory, SecurityContextInterface $securityContext, $session)
    {
        parent::__construct($factory);

        $this->securityContext = $securityContext;
        $this->isLoggedIn = $this->securityContext->isGranted('IS_AUTHENTICATED_FULLY');
        $this->session=$session;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav');
        
        $vehiculo=$this->session->get('vehiculo');
        
        if($vehiculo!=null){
            $menu->addChild('Vehiculo',array('route' => 'txinbometro_vehiculo', 'label' => $vehiculo->getMarca()." ".$vehiculo->getModelo(), 'extras'=>array('safe_label'=>true) ));
        }else{
            $menu->addChild('Vehiculo',array('route' => 'txinbometro_vehiculo', 'label' => 'Veh&iacute;culo', 'extras'=>array('safe_label'=>true) ));
        }
        
        $estadisticas=$this->createDropdownMenuItem($menu, 'Estadisticas', true,array(),array('label'=>'Estad&iacute;sticas', 'extras'=>array('safe_label'=>true))); 
        //$estadisticas=$this->createDropdownMenuItem($menu, 'Estadisticas' );
        //$estadisticas->setLabel('Estad&iacute;sticas');
        //$estadisticas->setExtras(array('safe_label'=>true) );
        $estadisticas->addChild('General',array('route' =>'txinbometro_estadisticas_general'));
        $estadisticas->addChild('Mensual',array('route' =>'txinbometro_estadisticas_mensual'));
        $estadisticas->addChild('Economicas',array('route' =>'txinbometro_estadisticas_economicas', 'label' => 'Econ&oacute;micas', 'extras'=>array('safe_label'=>true) ));
        
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

/*    
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
 */
}