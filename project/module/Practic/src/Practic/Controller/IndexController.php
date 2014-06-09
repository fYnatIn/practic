<?php
namespace Practic\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;

use Zend\Db\Adapter\Adapter as DbAdapter;

use Zend\Authentication\Adapter\DbTable as AuthAdapter;

use Practic\Model\Auth;
use Practic\Form\AuthForm;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
		if(!$user = $this->identity()){
            return $this->redirect()->toRoute("auth", array('action' => 'login'));
        }
	}

    public function loginAction()
	{
		$user = $this->identity();
		$form = new AuthForm();
		$form->get('submit')->setValue('Login');
		$messages = null;

		$request = $this->getRequest();
        if ($request->isPost()) {
			$authFormFilters = new Auth();
            $form->setInputFilter($authFormFilters->getInputFilter());
            $form->setData($request->getPost());
			if ($form->isValid()) {
				$data = $form->getData();
				$sm = $this->getServiceLocator();
				$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
				
				$config = $this->getServiceLocator()->get('Config');

				$authAdapter = new AuthAdapter($dbAdapter,
										   'account',
										   'u_login',
										   'u_pwd'
										  );
				$authAdapter
					->setIdentity($data['u_login'])
					->setCredential(md5($data['u_pwd']))
				;

				$auth = new AuthenticationService();
				$result = $auth->authenticate($authAdapter);			
				
				switch ($result->getCode()) {
					case Result::FAILURE_IDENTITY_NOT_FOUND:						
						break;

					case Result::FAILURE_CREDENTIAL_INVALID:						
						break;

					case Result::SUCCESS:
						$storage = $auth->getStorage();
						$storage->write($authAdapter->getResultRowObject(
							null,
							'password'
						));
                        return $this->redirect()->toRoute("home");
						break;

					default:						
						break;
				}				
				foreach ($result->getMessages() as $message) {
					$messages .= "$message\n"; 
				}			
			 }
		}
		return new ViewModel(array('form' => $form, 'messages' => $messages));
	}
	
	public function logoutAction()
	{
		$auth = new AuthenticationService();
		if ($auth->hasIdentity()) {
			$identity = $auth->getIdentity();
		}			
		
		$auth->clearIdentity();
		$sessionManager = new \Zend\Session\SessionManager();
		$sessionManager->forgetMe();
		
		return $this->redirect()->toRoute('auth', array('action' => 'login'));		
	}	
}