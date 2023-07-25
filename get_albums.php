<?php
// get_albums.php
include("song_class.php");
include("artist_class.php");
include("album_class.php");
include("templates/dbConfig.php");

if (isset($_POST['artist_id'])) {
    $artist_id = $_POST['artist_id'];
    
    // Debugging: Check if the artist_id is received correctly
    echo "Selected artist ID: " . $artist_id;

    // Assuming you have a method in your Album class called 'getAlbumByArtistId'
    $albumHandler = new Album($db, null, null, null, null);
    $albums = $albumHandler->getAlbumByArtistId($artist_id);

    if ($albums !== null) {
        // Prepare the album options as HTML
        $albumOptions = '<option value="" selected disabled>Select an album</option>';
        foreach ($albums as $album) {
            $albumOptions .= '<option value="' . $album['id'] . '">' . $album['name'] . '</option>';
        }

        echo $albumOptions;
    } else {
        echo '<option value="" selected disabled>No albums found</option>';
    }
}