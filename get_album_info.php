<?php
// get_artist_info.php
require_once("album_class.php");
require_once("templates/dbConfig.php");

if (isset($_GET['albumid'])) {
    $albumid = $_GET['albumid'];
    $Albums = new Album($db, null, null, null, null);
    $AlbumInfo = $Albums->getAlbumByAlbumId($albumid);

    if ($AlbumInfo) {
        echo "<div class='artistfiller'>";
        echo "<img class='artistimg' src=albumimg/" . $AlbumInfo['image'].">" ;
        echo"</div>";
        echo "Artist ID: " . $AlbumInfo['id'] . "<br>";
        echo "Name: " . $AlbumInfo['artist_id'] . "<br>";
        echo "Image String: " . $AlbumInfo['name'] . "<br>";
       
    } else {
        echo "Artist not found.";
    }
} else {
    echo "Invalid artist ID.";
}