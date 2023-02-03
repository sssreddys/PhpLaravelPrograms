<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('welcome', function () {
   echo "Hello World!";
   define("MINISIZE",50);
   define("PREFIX","OPTION");
   define(PREFIX."1","1");
   define(PREFIX."2","2");

   echo MINISIZE;
   echo PREFIX;

});

Artisan::command('vars', function () {
    $txt="Learn Php in";
    $txt1="Scorial It";
    echo $txt.$txt1;
 });

 Artisan::command('for-each', function () {
    $txt=array("a","b",123,"siva");
    foreach($txt as $key)
    {
        echo "element is $key \n";
    }
 });


 Artisan::command('ex-array', function () {
    $txt=array("a","b",123,"siva");
    $txt[4]="hello";
    unset($txt[2]);
    var_dump($txt);
    $x=["0"=> "siva","1"=>"reddy"];
    $x[2]="Hello";
    echo($x[1]);
    unset($x[2]);
    print_r($x);
 });


 Artisan::command('for-each-sum', function () {
    $sum=0;
    $txt=array(1,2,3,4,5,6,7,8,9);
    foreach($txt as $key)
    {
        echo "sum is $key \n";
        $sum= $sum+$key;
    }
    echo("the total sum is : ".$sum);

 });

 Artisan::command('array-key', function () {
    $html['title']='php associan arrays';
    $html['dis']='learning php';

});
   


Artisan::command('class-obj', function () {
    class employee{
        public $empId;
        public $empName;
        public $empSal;
        public function __construct($empId, $empName, $empSal){
            $this->empId=$empId;
            $this->empName=$empName;
            $this->empSal=$empSal;
         
        }
       
    }
       $emps[]=new employee(101,"siva",10000);

        //$emp[] = ['0'=> new employee(101,"siva",10000),'1'=> new employee(101,"siva",10000)]
       /* $emp = array(
            new employee(101,"siva",10000),
            new employee(101,"siva",10000),
            new employee(101,"siva",10000)
        );
        */

     print_r($emps);  
    
    });



    Artisan::command('class-foreach', function () {
        class employee{
            public $empId;
            public $empName;
            public $empSal;
            public function __construct($empId, $empName, $empSal){
                $this->empId=$empId;
                $this->empName=$empName;
                $this->empSal=$empSal;
             
            }
            public function getDisplay(){
                return ' empId: ' .$this->empId . ' empName: ' . $this->empName . ' empSal: ' . $this->empSal."\n";
            }

        }
          
        $emps[]=new employee(101,"siva",10000);
        $emps[]=new employee(102,"reddy",15000);

              foreach($emps as $aa){
                echo $aa ->getDisplay();
              }

    
});


Artisan::command('class-filter', function () {
    class employee{
        public $empId;
        public $empName;
        public $empSal;
        public function __construct($empId, $empName, $empSal){
            $this->empId=$empId;
            $this->empName=$empName;
            $this->empSal=$empSal;
         
        }

       

    }
      
    $empls = array(
        new employee(101,"siva",10000),
        new employee(103,"ram",12000),
        new employee(102,"reddy",20000),
        new employee(104,"ragu",11000)
    );
    function max_sal($empls){
        if($empls->empSal > 10000){
            return $empls->empSal;
        }
    }
    print_r(array_filter($empls,"max_sal"));
   

      function myfunction($v1)
       {
        if ($v1->empSal > 10000)
           {
             return $v1->empName;
           }
           return "below 10000";
        }
print_r(array_map("myfunction",$empls));
});


Artisan::command('switch-on', function () {
        $favcolor = "red";
        switch ($favcolor) {
            case "red":
              echo "Your favorite color is red!";
              break;
            case "blue":
              echo "Your favorite color is blue!";
              break;
            case "green":
              echo "Your favorite color is green!";
              break;
            default:
              echo "Your favorite color is neither red, blue, nor green!";
          }
        });


Artisan::command('array_reduce', function () {
function own_function($a, $b)
{
    return $a . " and " . $b;
}
 
$array = array(15, 120, 45, 78);
print_r(array_reduce($array, "own_function","Initial"));

});


Artisan::command('array-map', function () {
function myfunction($v1,$v2)
{
if ($v1===$v2)
  {
  return "same";
  }
return "different";
}

$a1=array("Horse","Dog","Cat");
$a2=array("Cow","Dog","Rat");
print_r(array_map("myfunction",$a1,$a2));

}
);

