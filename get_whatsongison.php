<?php
// get_artist_info.php
require_once("song_class.php");
require_once("templates/dbConfig.php");
if (isset($_GET['songid'])) {
    $songid = $_GET['songid'];
    $Song= new Song($db, null, null, null, null, null, null);
    $SongInfo =  $Song->getSongById($songid);

    if ($SongInfo) {
        // Display the retrieved Songinformation
      
       
        echo"<div class='songonwrapper'>";
        echo "<img class='songon' src=songimg/" . $SongInfo['image'] . "></img>";
       echo "<p class='songonname'".$SongInfo['name']."</p>";
       echo "</div>";
    } else {
        echo "Songnot found.";
    }
} else {
    echo "Invalid SongID.";
}
?>