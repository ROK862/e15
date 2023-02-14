<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e15 Project 1</title>

    <!-- Projects main CSS file. -->
    <link rel="stylesheet" href="src/css/main.css">
</head>

<body>
    <div class="content-wrapper">
        <h1>String Processor - e15 Project 1</h1>
        <div id="instructions">
            <h2>Instructions</h2>
            <p>Enter a word to find out...</p>
            <ul>
                <li>Is it a Palindrome? (Same forwards and backwards)
                </li>
                <li>How many vowels does it contain?
                </li>
                <li>What the word would look like if every letter was shifted +1 places in the alphabet</li>
            </ul>
        </div>
        <form action="/" method="post">
            <div class="form-group">
                <input type="text" class="form-control" id="string-processor" name="q" placeholder="Enter a string?">
            </div>
            <button type="submit" class="btn btn-primary">Process</button>
        </form>
        <?php if ($str_info["processed"] == true) { ?>
        <div class="search-results">
            <h2>Results for: <span><?php echo $str_info["query"]; ?></span></h2>
            <h3>Is it a palindrome?</h3>
            <p><?php echo $str_info["palindrome"]; ?></p>
            <h3>How many vowels does it contain?</h3>
            <p><?php echo $str_info["vowels"]; ?></p>
            <h3>Letter shift</h3>
            <p><?php echo $str_info["shift"]; ?></p>
            <h3>Encrypted text.</h3>
            <p>
                <strong>Search String:</strong>
                <br><?php echo $str_info["encrypted"]["search_string"]; ?>
                <br>
                <br>
                <strong>Cipher Algorithm:</strong>
                <br><?php echo $str_info["encrypted"]["cipher_algorithm"]; ?>
                <br>
                <br>
                <strong>Encryption Key:</strong>
                <br><?php echo $str_info["encrypted"]["encryption_key"]; ?>
                <br>
                <br>
                <strong>Encryption Output:</strong>
                <br><?php echo $str_info["encrypted"]["encryption_output"]; ?>
                <br>
                <br>
                <strong>Decryption Output:</strong>
                <br><?php echo $str_info["encrypted"]["decryption_output"]; ?>
            </p>
        </div>
        <?php } ?>
    </div>
</body>

</html>