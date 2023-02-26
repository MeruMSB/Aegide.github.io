<?php 
///////////////////////////////////////////////////////////////////////////////
// How to use:                                                               //
//===========================================================================//
// Execute this script once locally after extract the new sprite pack.       //
// This will make you a JSON file with all the alt codes (the letter, number //
// or whatever after the {head}.{body}).                                     //
// You can execute it by just writting "php getAltList.php" in terminal      //
// (if you have php installed, of course).                                   //
// You will need to edit the "BATTLERS_FOLDER" constant with the path where  //
// the sprites are stored.                                                   //
///////////////////////////////////////////////////////////////////////////////


//ini_set('max_execution_time', 300); //Extends the execution time (if necessary in a future)

define("BATTLERS_FOLDER", "CustomBattlersVisible/"); //The folder where we have all sprites

$jsonFile = "altList.json";
echo "\nCreating {$jsonFile}..."; //Funny terminal comments

$battlers = []; //We are saving all the results here

$files = glob(BATTLERS_FOLDER . "*.*.png"); //Gets all custom battlers
foreach($files as $row) { //This loop parses the file names and gets if they are main or alt
    preg_match("/(\d+)\.(\d+)(.*)/", $row, $match); //We get an array ($match) that contains the values of {head}, {body}, and "{alt}.png"
    $firstPkmn = $match[1]; //This is the first Pokémon
    $secondPkmn = $match[2]; //This is the second Pokémon
    $alt = str_replace(".png", "", $match[3]); //This is the alt (removing ".png" from the string)

    if($alt!="") { //We get TRUE if the alt variable is not empty (TRUE will mean that this sprite is an alt)
        $battlers["{$firstPkmn}.{$secondPkmn}"][] = $alt; //Saves the alt code
    }
}

$json = json_encode($battlers); //Makes the json
$bytes = file_put_contents("{$jsonFile}", $json); //Saves the file with the results

echo "\n\n{$jsonFile} updated. ({$bytes}bytes)\n\n"; //It's ready!
?>