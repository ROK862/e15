<?php
require "lib.php";

$str_info = ["processed"=>false];

if ($_POST["q"] && strlen($_POST["q"]) > 0) 
{
    $str_info["query"] = $_POST["q"];

    $str_info["processed"] = true;
    

    $QUERY = new StringProcessor($str_info["query"]);

    $str_info["palindrome"] = $QUERY->is_palindrome();
    $str_info["vowels"] = $QUERY->count_vowels();
    $str_info["shift"] = $QUERY->get_letter_shift();
    $str_info["encrypted"] = $QUERY->get_encrypted_string();
}


require "index-view.php";