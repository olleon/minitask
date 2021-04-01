<?php

class MyDateOrderReady
{

    public function dateOrderReady()
    {
        //массив праздничных дней в формате день.месяц
        $dateHoliday =[31.12,01.01,02.01,03.01,04.01,05.01,06.01,07.01,08.01,23.02,24.02,08.03,09.03,01.05,02.05,03.05,04.05,05.05,09.05,10.05,11.05,12.06,04.11];
     
        //какие дни недели выходные
        $dateWeekend = [6,7];
     
        //нерабочее время,  формат 24ч, при котором дата меняется на следующую
        $timeHoliday = [14,15,16,17,18,19];
     
     
        //дата доставки сегодня
        $dateOrderCheck = strtotime(date("d.m.Y H:m:s"));
     
        if (in_array(date("H",$dateOrderCheck), $timeHoliday)) {
            $dateOrderCheck += 86400;
        }
     
        while ((in_array(date("N",$dateOrderCheck), $dateWeekend))|| (in_array(date("d.m",$dateOrderCheck), $dateHoliday)))  {
          $dateOrderCheck += 86400;
          continue ;
        }
  
        $dateOrder=$this->ruDate("d M Y",$dateOrderCheck);
     
        return $dateOrder;
     
    }
   
     
    //вывод названий месяцев по-русски
    protected function ruDate($param, $time=0)
    {
        if(intval($time)==0) {
            $time=time();
        }
   
        $monthNamesRu=array("января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря");    
   
        if(strpos($param,'M')===false) {
            return date($param, $time); 
        } else {
              return date(str_replace('M',$monthNamesRu[date('n',$time)-1],$param), $time);
        }
  
    }
   
}

$dateOrder = new MyDateOrderReady;

echo ("Готовность Вашего заказа, сделанного сегодня: " . $dateOrder->dateOrderReady ()) 
     
?>