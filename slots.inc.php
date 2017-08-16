<?php

// Class to give user random credits on first start
class RandomCreditGenerator {
// Best practice - get /set
  public $credits;

    public function __construct() {
      // random_int() does not work, so had to use rand() - maybe not using PHP 7?
      $this->credits = rand(200, 2500);
        /*
        Damn, this is a cool trick - this guarantees that credits will be an increment of 50
        People on the internet say this is faster than doing a while loop
        Creating logic here to create a random number as an increment of 50
        */
        if ($this->credits % 50 != 0) {
            $this->credits += 50 - ($this->credits % 50);
          }
      }

}
/*
Not sure what the best approach is here, I can either create an array and pick a character,
or just do a string and pick a random char from string
*/
class RandomCharGenerator {

  public $chars = array("$", "%", "+", "*", "#", "~", "&", "@");
  public $luck;
  public $outcome = "You Have Lost";

  public function __construct(){
    $this->luck = rand(0,99);
      if ($this->luck < 21) {
        $this->luck = " " . $this->chars[0] . " " . $this->chars[0] . " " . $this->chars[0] . " ";
        $this->outcome = "YOU WIN!";
      } else {
        // This looks wrong - is this ok?
        $this->luck = " " . $this->randomizer() . " " . $this->randomizer() . " " . $this->randomizer() . " ";
      }
  }

    public function randomizer(){
      $randChar = $this->chars[mt_rand(0, count($this->chars) - 1)];
      return $randChar;
    }

}

class Db {
  // Creating the database connection
  protected static $connection;

  public function connect() {
    // Trying to connect to the db
      if (!isset(self::$connection)){
        // Load config as an array
        $config = parse_ini_file("/config.ini");
        self::$connection = new mysqli("localhost", $config["username"], $config["password"], $config["dbname"]);
      }
      // If connection to db was not successful
      if (self::$connection === false) {
        echo "DB Connection Error"; // Need to change this before this goes live
        return false;
      }
      return self::$connection;

  }



}


?>
