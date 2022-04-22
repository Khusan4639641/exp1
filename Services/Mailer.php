<?php
namespace Services;

class Mailer
{
  public $arr = [];
  public $message = "";
  public function send($data)
  {
    if(isset($data) && !empty($data))
      foreach ($data as $key=>$value)
        $arr[$key] = $value;

    if (isset($arr) && !empty($arr) )
    {
        $to = "bakhronovkhusan@gmail.com";
        $subject = "Заказ";

        foreach ($arr as $key=>$value)
            if (!empty($value))
                $this->message .= strip_tags(str_replace('_',' ',$key).': '.trim($value))."\r\n";

        $message = wordwrap($this->message, 70, "\r\n");
        $send_status = mail($to, $subject, $message);

        if ($send_status)
            return 'Данные отправлены';
         else
            return 'Нет возможности отправить данные';

      } else {
          return 'Нет данных для отправления';
      }
  }
}
