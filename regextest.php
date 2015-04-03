
<?php
// The "i" after the pattern delimiter indicates a case-insensitive search
$ipRegEx = "/\b(?:[0-9]{1,3}\.){3}[0-9]{1,3}\b/";
$searchString = "PHP is the web scripting 223.32.32.11 language of choice.";
if (preg_match($ipRegEx,$searchString,$match)) {
    echo "A match was found.";
} else {
    echo "A match was not found.";
}
print('<BR>');
print($match[0]);
?>

