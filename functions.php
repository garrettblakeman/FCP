<?php
/**
 * Created by PhpStorm.
 * User: garrettblakeman
 * Date: 12/29/14
 */
session_start();
/** Get base list of colors */
function getColorSelect() {
    global $dbh;
    $statement = $dbh->prepare("select * from colors where result = :result");
    $statement->execute(array(':result' => "0"));
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $row) {
            echo "<option value='" . $row['hex'] . "'>" . $row['name'] . "</option>";
        }
}



/** class to get a new color from two */

class colorSelect
{
    var $hex1;
    var $hex2;
    var $format;
    var $color;
    function __construct($hex1, $hex2, $format){
        $this->hex1 = $hex1;
        $this->hex2 = $hex2;
        $this->format = $format;
        $id1 = self::singleSelect('id','colors','hex',$hex1);
        $id2 = self::singleSelect('id','colors','hex',$hex2);
        // Just adding the two ids together to get a new color for demonstration
        $newid = ($id1 + $id2);
        $result = self::singleSelect($format,'colors','id',$newid);
        $this->color = $result;
    }
    function singleSelect($column,$table,$field,$value) {
        global $dbh;
        $statement = $dbh->prepare("SELECT $column FROM $table WHERE $field = :value");
        $statement->execute(array(':value' => "$value"));
        {
            return $statement->fetchColumn();
        }
    }

}

function incrementColor($value) {
    global $dbh;
    $statement = $dbh->prepare("UPDATE colors SET count = count + 1 WHERE hex = :value");
    $statement->execute(array(':value' => $value));
}


/** Functions to clean up post data */

function trimPosts(&$data)
{
    $value = trim($data);
}

function lettersNumbersOnly($input){
    $cleaned = preg_replace("/[^a-zA-Z0-9]+/", "", $input);
    return $cleaned;
}

function getTopColors() {
    global $dbh;
    $statement = $dbh->prepare("select name from colors ORDER BY count DESC LIMIT 10");
    $statement->execute(array(':result' => "0"));
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $row) {
        echo '<li>' . $row['name'] . '</li>';
    }
}