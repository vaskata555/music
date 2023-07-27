<?php
// get_artist_info.php
require_once("album_class.php");
require_once("templates/dbConfig.php");

if (isset($_GET['albumid'])) {
    $albumid = $_GET['albumid'];
    $Albums = new Album($db, null, null, null, null);
    $AlbumInfo = $Albums->getAlbumByAlbumId($albumid);

    if ($AlbumInfo) {
        // Display the retrieved artist information
        echo "Artist ID: " . $AlbumInfo['id'] . "<br>";
        echo "Name: " . $AlbumInfo['artist_id'] . "<br>";
        echo "Image String: " . $AlbumInfo['name'] . "<br>";
        echo "artist: " . $AlbumInfo['image'] . "<br><br>";
    } else {
        echo "Artist not found.";
    }
} else {
    echo "Invalid artist ID.";
}