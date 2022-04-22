<?php
namespace App\Models;

use \Core\DB;

/**
 *
 */
class Users
{
  protected $result = [];
  protected $table = 'users';
  protected $tableJoin = 'productivity';

  protected $DB;

  public function __construct()
  {
    $this->DB = new DB;
  }

  public function showAll()
  {
      return $this->DB->all($this->table);
  }
  public function effective()
  {
      $dataJoins = $this->DB->joinLeft($this->table,$this->tableJoin,'id','user_id');
      foreach ($dataJoins as $value) {
          if(!isset($this->result[$value->user_id]['sum']) && empty($this->result[$value->user_id]['sum'])){
              $this->result[$value->user_id]['sum'] = 0;
          }

          $this->result[$value->user_id]['sum'] += $value->work_hours;
          $this->result[$value->user_id]['name'] = $value->fio;
          $this->result[$value->user_id]['id'] = $value->user_id;
      }
      return $this->result;
  }
}
