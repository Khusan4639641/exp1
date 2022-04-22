<?php
namespace App\Models;

use \Core\DB;

class Message
{

  protected $table = 'sendmail';

  protected $DB;

  public function __construct()
  {
    $this->DB = new DB;
  }

  public function add($data)
  {
    return $this->DB->insert($this->table, $data);
  }

}
