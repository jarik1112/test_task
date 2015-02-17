<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date   2/17/15
 * @time   3:35 PM
 */

namespace Framework\Controllers;


use Framework\BaseController;
use Framework\Response;

class RegisterController extends BaseController
{
    public function index()
    {
        /** @var \Framework\Request $request */
        $request = $this->ioc->build('request');
        /** @var \Framework\UserStorageInterface $userStorage */
        $userStorage = $this->ioc->build('userStorage');
        $user        = $request->getPost('user');
        $errors      = array();
        /** @var  \Framework\Response $response */
        $response = $this->ioc->build('response');
        if ($user && $userStorage->validate($user)) {
            $userStorage->save($user);
            $response->redirect('/confirmation');
            exit;
        } else {
            if (!$userStorage->validate($user)) {
                $errors[] = 'Validation error!';
            }
        }

        $response->setView('register.php', array('user' => $user, 'errors' => $errors));
        return $response;
    }

    public function confirmationSent()
    {
        /** @var  \Framework\Response $response */
        $response = $this->ioc->build('response');
        $response->setView('sent.php', array());
        return $response;
    }
}