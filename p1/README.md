# Project 1

- By: Robbins Kariseb
- URL: <http://e15p1.appsuits.org/>

## Outside resources

- [ASCII Table - ASCII codes,hex,decimal,binary,html](https://www.rapidtables.com/code/text/ascii-table.html)
- [Changing the Git user inside Visual Studio Code](https://stackoverflow.com/questions/42318673/changing-the-git-user-inside-visual-studio-code)
- [PHP substr_count() Function](https://www.w3schools.com/php/func_string_substr_count.asp#:~:text=The%20substr_count()%20function%20counts,substrings%20(see%20example%202).)

## Notes for instructor

### Structure:

- To keep the codebase clean, I created an additional file called `./lib.php` which contains code for String Processing.

```php
<?php
class StringProcessor 
{
    // String we are going to search through.
    private $search_str = "";
    private $vowels_str = "aeiou";

    /**
     * Object constructor.
     */
    function __construct ($_srt) 
    {
        $this->search_str = $_srt;
    }

    /**
     * is_palindrome is used to test if the string is a palindrome.
     * Return type: @Boolean
     */
    public function is_palindrome ()
    {
        $control_str = strtolower($this->search_str );
        
        return (strrev($control_str) == $control_str) ? "Yes" : "No";
    }
    
    /**
     * count_vowels is used to count the number of vowels in the given string.
     * Return type: @Integer
     */
    public function count_vowels () 
    {
        $count = 0;
        // Loop through each char in string vowels_str and count occurrences.
        foreach (str_split($this->vowels_str) as $vowel) {
            $count += substr_count(strtolower($this->search_str),$vowel);
        }
        return $count;
    }

    /**
     * Converts the search string to a shifted version.
     * The shifted string follows a rule where each char is shifted 1 index to the right.
     * If current value is Z/z, shift starts from index 0.
     */
    public function get_letter_shift () 
    {
        $final_string = "";
        
        // Loop through the char set within the main string.
        for ($index = 0; $index < strlen($this->search_str); $index++)
        {   
            // Test if the char is of type alphabet.
            if (ctype_alpha($this->search_str[$index])) 
            {
                // Change the string into a ascii numeric (0-255 ranged).
                $encoding = ord($this->search_str[$index]);

                $alphabet_index = ($encoding + 1);

                // Test if char is at z and needs to start at a.
                if (($encoding + 1) === 123) 
                {
                    $alphabet_index = 97;
                } 
                // Now check if char is at Z and needs to start at A.
                else if (($encoding + 1) === 91)
                {
                    $alphabet_index = 41;
                }
                
                $final_string .= chr($alphabet_index);
            } else {
                $final_string .= $this->search_str[$index];
            }
        }
        
        return $final_string;
    }

    /**
     * This is an encryption function which uses OPEN SSL's AES-128-CTR algorithm to encrypt a search string.
     */
    public function get_encrypted_string ()
    {
        // Create a new array which will contain all our settings.
        $descriptive = [];

        // Update search string.
        $descriptive["search_string"] = $this->search_str;

        // Update Cipher algorithm which we will use to encrypt the text.
        $descriptive["cipher_algorithm"] = "AES-128-CTR"; 

        // Update the encryption key. Well, normally you want to hide this value.
        $descriptive["encryption_key"] = "ROK862-Is-Awesome!";  

        // Update the resulting output from encryption.
        $descriptive["encryption_output"] = openssl_encrypt($descriptive["search_string"], $descriptive["cipher_algorithm"], $descriptive["encryption_key"]);                    
        
        // Update decrypted value.
        $descriptive["decryption_output"] = openssl_decrypt($descriptive["encryption_output"], $descriptive["cipher_algorithm"], $descriptive["encryption_key"]);
        
        
        return $descriptive;
    }
}
```
