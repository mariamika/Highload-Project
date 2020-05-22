<?php
require_once('vendor/autoload.php');
include('func.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);


use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$time_start = time();


echo "String memory usage test.\n\n";
$base_memory_usage = memory_get_usage();
$base_memory_usage = memory_get_usage();

echo "Start\n";
memoryUsage(memory_get_usage(), $base_memory_usage);

$a = someBigValue();

echo "String value setted\n";
memoryUsage(memory_get_usage(), $base_memory_usage);

$a = null;

echo "String value unsetted\n";
memoryUsage(memory_get_usage(), $base_memory_usage);

echo "Array memory usage example.";
$base_memory_usage = memory_get_usage();
$base_memory_usage = memory_get_usage();

echo 'Base usage.'.PHP_EOL;
memoryUsage(memory_get_usage(), $base_memory_usage);

$a = array(someBigValue(), someBigValue(), someBigValue(), someBigValue());

echo 'Array is set.'.PHP_EOL;
memoryUsage(memory_get_usage(), $base_memory_usage);

foreach ($a as $k=>$v) {
$a[$k] = someBigValue();
unset($k, $v);
echo 'In FOREACH cycle.'.PHP_EOL;
memoryUsage(memory_get_usage(), $base_memory_usage);
}

$message = 'array set';

echo 'Usage right after FOREACH.'.PHP_EOL;
memoryUsage(memory_get_usage(), $base_memory_usage);

$a = null;
echo 'Array unset.'.PHP_EOL;
memoryUsage(memory_get_usage(), $base_memory_usage);

function deep_end($count){
  //добавляем 1 к парарметру count
  $count +=1;
  if($count < 48){
  deep_end($count);
  }
  else {
  trigger_error("going off thi deep end!");
  }
  
  }
  
  deep_end(1);
  
  
  $time_end = time();
  
  $log = new Logger('time');
  $log->pushHandler(new StreamHandler('log/time.log', Logger::DEBUG));
  
  $log->debug($time_end - $time_start);
  $log->debug(memory_get_usage());
  $log->debug($base_memory_usage);
  
  $logger = new Logger('message');
  $logger->pushHandler(new StreamHandler('log/message.log', Logger::ALERT));
  
  $logger->alert($message);