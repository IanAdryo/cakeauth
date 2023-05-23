<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.app
 */
class AppController extends Controller {

    var $components = array('Auth', 'Session'); 

    public function beforeFilter() {
        
        $this->Auth->allow('index', 'view');
        $this->Auth->authError = 'Please login to view that page';
        $this->Auth->loginError = 'Incorrect User/Password combination.';
        $this->Auth->loginRedirect = array('controller' => 'posts', 'action' => 'index');
        $this->Auth->logoutRedirect = array('controller' => 'posts', 'action' => 'index');

        $this->set('admin', $this->_isAdmin());
        $this->set('logged_in', $this->_loggedIn());
        $this->set('users_username', $this->_usersUsername()); 

    }
    function _isAdmin() {

        $admin = false;

        if ($this->Auth->user('role') == 'admin') {
            
            $admin = true;
        }
        return $admin;
    }
    function _loggedIn() {

        $logged_in = false;
        if ($this->Auth->user()) {
            
            $logged_in = true;
        }
        return $logged_in;
    }
    function _usersUsername(){

        $users_username = false;
        if ($this->Auth->user()) {

            $users_username = $this->Auth->user('username');
        }
        return $users_username;
    }
}
?>