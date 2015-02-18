<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date   2/17/15
 * @time   3:35 PM
 */

namespace Framework\Controllers;


use Framework\BaseController;
use Framework\Response;

/**
 * Class RegisterController
 *
 * @package Framework\Controllers
 */
class RegisterController extends BaseController
{
    public function index()
    {
        /** @var \Framework\Request $request */
        $request = $this->ioc->build('request');
        /** @var \Framework\Interfaces\UserStorageInterface $userStorage */
        $userStorage = $this->ioc->build('userStorage');
        $user        = $request->getPost('user');
        $errors      = array();
        /** @var  \Framework\Response $response */
        $response = $this->ioc->build('response');
        if ($user && $userStorage->validate($user)) {
            $hash                 = dechex(microtime(true));
            $user['confirm_hash'] = $hash;
            $saveState            = $userStorage->save($user);
            if (!$saveState) {
                throw new \Exception('Can\' save user');
            }
            $sentResult = $this->ioc->build('mailer')->send(
                'Confirm you email',
                '<a href="http://' . $request->getHost() . '/confirm?h=' . $hash . '">Link</a>',
                $user['email']
            );
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

    public function confirm()
    {
        /** @var \Framework\Request $request */
        $request = $this->ioc->build('request');
        /** @var \Framework\Interfaces\UserStorageInterface $userStorage */
        $userStorage = $this->ioc->build('userStorage');
        /** @var  \Framework\Response $response */
        $response = $this->ioc->build('response');
        $hash     = $request->getParam('h');
        if (!is_null($hash) && ($user = $userStorage->findBy(array('confirm_hash' => $hash)))) {
            $_SESSION['logged_in']      = true;
            $user['is_email_confirmed'] = 'y';
            $userStorage->save($user);
            $this->ioc->unregister('userStorage');
            $this->ioc->register('userStorage', 'Framework\XmlUserStorage');
            $this->ioc->build('userStorage')->save($user);
            $response->redirect('/');
            exit;
        }
        $response->redirect('/login');
    }

    public function confirmationSent()
    {
        /** @var  \Framework\Response $response */
        $response = $this->ioc->build('response');
        $response->setView('sent.php', array());
        return $response;
    }
}