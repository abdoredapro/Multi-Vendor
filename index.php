<?php

    $str = 'Abdo M';
    // define('M', 'You Have 50$', true);

    // str_word_count()
    // strrev()
    //strpos()
    // str_replace()
    // is_int()
    // min(array()) - max() 
    // abs() Return Positive Value
    // round() 
    // rand()
    // <> == != 
    // sort() - rsort() => Indexed Array
    // asort() => sort Associative array indpend V
    // ksort() => sort Associative array indpend Key
    // arsort() - krsort()
    // trim()
    $str = '\phpAbdo abdo reda mahmoud';

    // echo preg_match_all('/abdo/i', $str);


    date_default_timezone_set("Africa/Cairo");
    $date = date('h');
    // h => time 0 to 12
    // H => 0 to 23
    // i => minute
    // s => seconds
    // a => am or pm

    // d => Represents the day of the month (01 to 31)
    // m => Represents a month (01 to 12)
    // Y => Represents a year (in four digits)
    // l => Represents the day of the week
    // Y:M:d l h:i:s a
    // mktime(hour, minute, second, m, d, y)
    // strtotime('+1 Months')
    // $d = strtotime('+1 Months');

    // echo date("Y-m-d h:i:s a", $d) . "<br>";
    // echo date('h') . "<br>";

 
    // $maping = array_map(function ($item) 
    // {return strlen($item); }
    // ,['Ahmed', "sayesd"]);


    // json_encode() => is used to encode a value to JSON format.
    // json_decode() => is used to decode a JSON object into a PHP object or an associative array.

    // throw new Exception('Error message');


    
// ======================== OOP ==========
class cars {
    public $name;
    public $year;
    public $model;
    function __construct( $year, $model) {
        $this->name = 'Abdo';
        $this->year = $year;
        $this->model = $model;
    }

    function __destruct() // PHP will automatically call this function at the end of the script.
    {
        // echo $this->name;
    }
    
}
$car1 = new cars('2023', 'X7');


// print_r($car1);
// $car1->name ='Sayed';

// public scope to make that property/method available from anywhere, other classes and instances of the object.

// private scope when you want your property/method to be visible in its own class only.

// protected scope when you want to make your property/method visible in all classes that extend current class including the parent class.
interface  TestAbs {
        
     public function prefixName($name): string;
}
class GG implements TestAbs{
    public function prefixName($name) : string
    {
            return 'Test';
    }
}

$tet = new GG();
// print_r($tet);

// Interfaces vs. Abstract Classes
// 1 - Interfaces cannot have properties, while abstract classes can .

//2- All interface methods must be public, while abstract class methods is public or protected
// 3- All methods in an interface are abstract, so they cannot be implemented in code and the abstract keyword is not necessary
// 4- Classes can implement an interface while inheriting from another class at the same time


trait Message {
    public function message1() : string {
        return "This is Message 1" . '<br>';
    }
}
trait Messagges {
    public function messages() : string {
        return 'Message 2';
    }
}
class allMessages {
    use Message, Messagges;
}
$mes = new allMessages();
// echo $mes->message1();
// echo $mes->messages();

class GetMess {
    public static function Mess() {
        echo 'Mess';
    }

    public function __construct()
    {
        self::Mess();
    }
}
function amplify($number) {
    $arr = [];
    for($i=1; $i <=$number; $i++) {
        if($i % 4 == 0) {
            $arr[] = $i * 10;
        } else {
            $arr[] = $i;
        }
    }
    return $arr;
}
// print_r(amplify(8));


// __invoke()  => to call Object As a function

// spl_autoload_register(function ($class_name) {
//     include $class_name . '.php';
// });

// $login = new Login('abdo', 'email');

// final class prevent child class from overriding on methods

