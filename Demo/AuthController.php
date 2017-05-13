<?php

namespace Demo;


use PWE\Auth\PWEUserAuthController;
use PWE\Core\PWELogger;
use PWE\Exceptions\HTTP2xxException;
use PWE\Exceptions\HTTP3xxException;
use PWE\Exceptions\HTTP4xxException;
use PWE\Exceptions\HTTP5xxException;

class AuthController extends PWEUserAuthController
{
    public function getUserID()
    {
        return $_SESSION['username'];
    }

    public function getUserName()
    {
        return $_SESSION['username'];
    }

    public function handleAuth()
    {
        $this->PWE->startSession();

        $last = $this->PWE->getURL()->getFullAsArray();
        if (end($last) == 'logout') {
            $this->handleLogout();
            return;
        } elseif (end($last) == 'login') {
            if ($_POST['username']) {
                if ($_POST['password'] != strrev($_POST['username'])) { // isn't it confusing
                    throw new HTTP4xxException("Wrong password", HTTP4xxException::UNAUTHORIZED);
                }

                $_SESSION['username'] = $_POST['username'];
                PWELogger::info("Logged in as %s", $_SESSION['username']);
                throw new HTTP3xxException("../");
            } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
                throw new HTTP4xxException("You need to specify username and password");
            } else {
                $smarty = $this->PWE->getSmarty();
                $smarty->setTemplateFile('dat/auth.tpl');
                throw new HTTP2xxException($smarty->fetchAll());
            }
        }
    }

    public function isLoggedIn()
    {
        return boolval($_SESSION['username']);
    }

    public function handleLogout()
    {
        $this->PWE->startSession();
        $this->PWE->endSession();
        throw new HTTP3xxException("../");
    }


    public function getCategories()
    {
        if (!isset($_SESSION['categories'])) {
            $_SESSION['categories'] = [
                ["id" => 1, "name" => "Electronics"],
                ["id" => 2, "name" => "Home Appliances"],
                ["id" => 3, "name" => "Toys"],
                ["id" => 4, "name" => "Books"],
                ["id" => 5, "name" => "Sports Goods"],
            ];
        }
        return $_SESSION['categories'];
    }

    public function addCategory($data)
    {
        $data['id'] = sizeof($_SESSION['categories']);
        $_SESSION['categories'][] = $data;
    }

    public function deleteCategory($id)
    {
        foreach ($_SESSION['categories'] as $k => $v) {
            if ($v['id'] == $id) {
                unset($_SESSION['categories'][$k]);
                return $v;
            }
        }
        throw new HTTP5xxException("Did not find item $id to delete");
    }
}