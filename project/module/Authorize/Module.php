<?php

namespace Authorize;

// for Acl
use Authorize\Acl\Acl;

class Module
{
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

	// FOR Authorization
	public function onBootstrap(\Zend\EventManager\EventInterface $e) 
	{
		$application = $e->getApplication();
		$em = $application->getEventManager();
		$em->attach('route', array($this, 'onRoute'), -100);
	}
	

	public function onRoute(\Zend\EventManager\EventInterface $e) 
	{
		$application = $e->getApplication();
		$routeMatch = $e->getRouteMatch();
		$sm = $application->getServiceManager();
		$auth = $sm->get('Zend\Authentication\AuthenticationService');
		$config = $sm->get('Config');
		$acl = new Acl($config);
		$role = Acl::DEFAULT_ROLE;
        
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

		$controller = $routeMatch->getParam('controller');
		$action = $routeMatch->getParam('action');

		if (!$acl->hasResource($controller)) {
			throw new \Exception('Resource ' . $controller . ' not defined');
		}
		
		if (!$acl->isAllowed($role, $controller, $action)) {
			$url = $e->getRouter()->assemble(array(), array('name' => 'home'));
			$response = $e->getResponse();

			$response->getHeaders()->addHeaderLine('Location', $url);
			$response->setStatusCode(302);
			$response->sendHeaders();
			exit;
		}
	}
}