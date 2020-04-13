<?php
class Track {
  /* [DATABASE HELPER FUNCTIONS] */
  protected $pdo = null;
  protected $stmt = null;
  public $lastID = null;

  function __construct () {
  // __construct() : connect to the database
  // PARAM : DB_HOST, DB_CHARSET, DB_NAME, DB_USER, DB_PASSWORD

    // ATTEMPT CONNECT
    try {
      $str = "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET;
      if (defined('DB_NAME')) { $str .= ";dbname=" . DB_NAME; }
      $this->pdo = new PDO(
        $str, DB_USER, DB_PASSWORD, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
          PDO::ATTR_EMULATE_PREPARES => false
        ]
      );
    }

    // ERROR - CRITICAL STOP - THROW ERROR MESSAGE
    catch (Exception $ex) {
      print_r($ex);
      die();
    }
  }

  function __destruct () {
  // __destruct() : close connection when done

    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

  function exec ($sql, $data=null) {
  // exec() : run insert, replace, update, delete query
  // PARAM $sql : SQL query
  //       $data : array of data

    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($data);
      $this->lastID = $this->pdo->lastInsertId();
    } catch (Exception $ex) {
      $this->error = $ex;
      return false;
    }
    $this->stmt = null;
    return true;
  }
  
  function fetchAll ($sql, $cond=null, $key=null, $value=null) {
  // fetchAll() : perform select query (multiple rows expected)
  // PARAM $sql : SQL query
  //       $cond : array of conditions
  //       $key : sort in this $key=>data order, optional
  //       $value : $key must be provided. If string provided, sort in $key=>$value order. If function provided, will be a custom sort.

    $result = [];
    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($cond);
      // Sort in given order
      if (isset($key)) {
        if (isset($value)) {
          if (is_callable($value)) {
            while ($row = $this->stmt->fetch(PDO::FETCH_NAMED)) {
              $result[$row[$key]] = $value($row);
            }
          } else {
            while ($row = $this->stmt->fetch(PDO::FETCH_NAMED)) {
              $result[$row[$key]] = $row[$value];
            }
          }
        } else {
          while ($row = $this->stmt->fetch(PDO::FETCH_NAMED)) {
            $result[$row[$key]] = $row;
          }
        }
      }
      // No key-value sort order
      else {
        $result = $this->stmt->fetchAll();
      }
    } catch (Exception $ex) {
      $this->error = $ex;
      return false;
    }
    // Return result
    $this->stmt = null;
    return count($result)==0 ? false : $result ;
  }

  function fetch ($sql, $cond=null, $sort=null) {
  // fetch() : perform select query (single row expected)
  //           returns an array of column => value
  // PARAM $sql : SQL query
  //       $cond : array of conditions
  //       $sort : custom sort function

    $result = [];
    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($cond);
      if (is_callable($sort)) {
        while ($row = $this->stmt->fetch(PDO::FETCH_NAMED)) {
          $result = $sort($row);
        }
      } else {
        while ($row = $this->stmt->fetch(PDO::FETCH_NAMED)) {
          $result = $row;
        }
      }
    } catch (Exception $ex) {
      $this->error = $ex;
      return false;
    }
    // Return result
    $this->stmt = null;
    return count($result)==0 ? false : $result ;
  }
  
  /* [TRACKING FUNCTIONS] */
  function update ($id, $lng, $lat) {
  // update() : update rider coordinates
  // PARAM $id : rider ID
  //       $lng : longitude
  //       $lat : latitude

    return $this->exec(
      "REPLACE INTO `gps_track` (`rider_id`, `track_time`, `track_lng`, `track_lat`) VALUES (?, ?, ?, ?)",
      [$id, date("Y-m-d H:i:s"), $lng, $lat]
    );
  }

  function get ($id) {
  // get() : get rider coordinates
  // PARAM $id : rider ID

    return $this->fetch(
      "SELECT * FROM `gps_track` WHERE `rider_id`=?",
      [$id]
    );
  }

  function getAll () {
  // getAll() : get all the rider locations
  // !! You might want to implement an "on active duty" flag in your own system
  // !! Just so that only the relevant riders are extracted

    return $this->fetchAll(
      "SELECT * FROM `gps_track`", null, "rider_id"
    );
  }
}
?>