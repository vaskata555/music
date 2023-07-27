<?php
// Include the Song class
require_once 'song_class.php';
require_once 'templates/dbConfig.php';
if (isset($_GET['songid'])) {
    $songid = $_GET['songid'];
    $Song = new Song($db, null, null, null, null, null, null);

    try {
        $songInfo = $Song->getSongById($songid);
        if ($songInfo !== null && isset($songInfo['song'])) {
            $audioSource = $songInfo['song'];
            $prefix = 'songs/';
            $prefixedAudioSource = $prefix . $audioSource;
            echo  $prefixedAudioSource;
        } else {
            // Handle the case where the song is not found or song field is empty
            echo "default-audio-file.mp3";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid song ID.";
}
  ?>
