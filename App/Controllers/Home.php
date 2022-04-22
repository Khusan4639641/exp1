<?php

namespace App\Controllers;

use \Core\View;

use \App\Config;
use \Services\Mailer;
use \App\Models\Message;
use \App\Models\Users;
use \App\Models\Product;

use \Core\Controller;
/**
 * Home controller
 *
 * PHP version 5.4
 */
class Home extends Controller
{

    protected $mail;

    protected $message;

    protected $users;

    protected $products;
    /**
     * Before filter
     *
     * @return void
     */
    public function __construct()
    {
        $this->mail = new Mailer;
        $this->message = new Message;
        $this->users = new Users;
        $this->products = new Product;

    }
    protected function before()
    {
        // echo "(before) ";
        //return false;
    }

    /**
     * After filter
     *
     * @return void
     */
    protected function after()
    {
        // echo " (after)";
    }

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::renderTemplate('Home/index.html',['menu1'=>'active']);
    }
    public function email()
    {
      // Send mail
      $this->mail->send($_POST);
      // Add to DB Message
      if($this->message->add($_POST))
        echo true;
      else
        echo false;
    }
    public function info()
    {

      View::renderTemplate('Home/index2.html',[
            'users'    => $this->users->showAll(),
            'products' => $this->products->showAll(),
            'results'  => $this->users->effective(),
            'menu2'=>'active'
        ]);
    }
}
