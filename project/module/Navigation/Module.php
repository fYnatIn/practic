<?php

namespace Navigation;

use Zend\View\HelperPluginManager;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;

class Module
{
	protected $sm; // 
	
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
	
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

	public function init(\Zend\ModuleManager\ModuleManager $mm)
	{
		
	}
	
	public function onBootstrap(\Zend\EventManager\EventInterface $e) // use it to attach event listeners
	{
		$application = $e->getApplication();
		$this->sm = $application->getServiceManager();
	}
	
    public function getViewHelperConfig()
    {
		
        return array(
            'factories' => array(
                // This will overwrite the native navigation helper
                'navigation' => function(HelperPluginManager $pm) {
					$sm = $pm->getServiceLocator();
					$config = $sm->get('Config');
					
					
					$acl = new \Navigation\Acl\Acl($config);
                    
					// Get the AuthenticationService
					$auth = $sm->get('Zend\Authentication\AuthenticationService');
					$role = \Navigation\Acl\Acl::DEFAULT_ROLE;
					if ($auth->hasIdentity()) {
            			$usr = $auth->getIdentity();
            			$usrl_id = $usr->role;
            			switch ($usrl_id) {
                            case 1 :
                                $role = 'student';
                                break;
                            case 2 :
                                $role = 'teacher';
                                break;
                            case 3 :
                                $role = 'admin';
                                break;
                            case 4 :
                                $role = 'superadmin';
                                break;
                            default :
                                $role = Acl::DEFAULT_ROLE;
                                break;
            			}
            		}
		
                    $navigation = $pm->get('Zend\View\Helper\Navigation');
					
                    
                    $navigation->setAcl($acl)
                               ->setRole($role);

                    return $navigation;
                }
            )
        );
    }
	
}