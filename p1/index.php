<?php
require "lib.php";

$str_info = ["processed"=>false];

if ($_POST["q"] && strlen($_POST["q"]) > 0) 
{
    // Gets query string.
    $str_info["query"] = $_POST["q"];
    
    // Create a new query object with the query string.
    $QUERY = new StringProcessor($str_info["query"]);

    // Populate all required fields.
    $str_info["palindrome"] = $QUERY->is_palindrome();
    $str_info["vowels"] = $QUERY->count_vowels();
    $str_info["shift"] = $QUERY->get_letter_shift();
    $str_info["encrypted"] = $QUERY->get_encrypted_string();

    // We should update the processed value.
    $str_info["processed"] = true;
}


require "index-view.php";