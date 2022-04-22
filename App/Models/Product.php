<?php
namespace App\Models;

use \Core\DB;

/**
 *
 */
class Product
{

  protected $table = 'productivity';

  protected $DB;

  public function __construct()
  {
    $this->DB = new DB;
  }

  public function showAll()
  {
      return $this->DB->all($this->table);
  }

}
