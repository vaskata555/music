<?php
// get_artist_info.php
require_once("artist_class.php");
require_once("templates/dbConfig.php");
if (isset($_GET['artist_id'])) {
    $artist_id = $_GET['artist_id'];
    $Artist = new Artist($db, null, null, null, null);
    $artistInfo = $Artist->getArtistById($artist_id);

    if ($artistInfo) {
        // Display the retrieved artist information
      
       
        echo "<div class='artistfiller'>";
        echo "<img class='artistimg' src=artistimg/" . $artistInfo['image'] . "></img>";
        echo "</div>";
        echo "Name: " . $artistInfo['name'] . "<br>";
        echo "Description: " . $artistInfo['description'] . "";
    } else {
        echo "Artist not found.";
    }
} else {
    echo "Invalid artist ID.";
}
?>