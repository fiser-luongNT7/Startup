<?php

use Phalcon\Mvc\Controller;
use Phalcon\Forms\Element;
class LoginController extends Controller
{
	
	public function indexAction()
	{

	}
	private function _registerSession(){
		 $this->session->set(
            'auth',
            array(
                'id'   => $user->id,
                'account' => $user->account
            )
        );
	}
	public function loginAction()
	{

		$user = new Users();
		if($this->request->isPost()){
			//get the data from the user
			$account = $this->request->getPost('account');
			$password = $this->request->getPost('password');
			
			// Find the user in the database
			$user = Users::findFirst(
				array(
					"account = :account: AND password = :password: AND active = 'Y'",
					'bind' => array(
						'account'	=> $account,
						'password'	=> sha1($password)
						)
				)
			);
			if($user != false){
				$this->_registerSession($user);
				$this->flash->success('Welcom' .$user->name );
				 return $this->dispatcher->forward(
                    array(
                        'controller' => 'invoices',
                        'action'     => 'index'
                    )
                );
			}
			else {
				 $this->flash->error('Wrong account/password');
			}
			 // Forward to the login form again
			return $this->dispatcher->forward(
				array(
					'controller' => 'session',
					'action'     => 'index'
				)
			);
		}
		
	}
}