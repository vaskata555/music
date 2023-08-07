
<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="templates/style.css">
</head>
<body>
<div class="wrap">
<div class="background">
<?php
require_once("templates/header.php");
require_once("album_class.php");
require_once("artist_class.php");
require_once("song_class.php");
?>
    <div class="gridmaker">
    <div class="gridwrapper">
<div class="musicrow">
<?php
    
    $Song = new Song($db,$artist_id,$id, $name, $image, $albumid,$song);
    $Songs = $Song->getSong();
    
    // Display the artists
    foreach ($Songs as $Song) {
        echo "<div class='albumcell'>";
        echo "<div class='songcell_song' data-songid='{$Song['id']}' data-artist-id='{$Song['artist_id']}' data-albumid='{$Song['albumid']}' data-artist-name='{$Song['name']}'>";
       
       // echo "Artist ID: " . $Song['artist_id'] . "<br>";
      
        echo "<img class='songimage' src=songimg/" . $Song['image'] . "></img>";
        echo "<div class='textsongs'>";
        echo "<p class='songname'>" . $Song['name'] . "</p><br>";
         echo "<p class='songartist'>" . $Song['artistname'] . "</p>";
       // echo "Album: " . $Song['albumid'] . "<br><br>";
       echo "</div>";
        echo "</div>";
        echo "</div>";
    }
    
    ?>
</div>
</div>
</div>
<div class="gridmaker2">
<div class="artistrow">
    <?php
    
    if (isset($_GET['artist_id'])) {
        $artist_id = $_GET['artist_id'];

    // Instantiate the Artist class to retrieve the specific artist information
    $Artist = new Artist($db, null, null, null, null);
    $artistInfo = $Artist->getArtistById($artist_id);
    
    // Check if the artist information is not null before displaying it
    if ($artistInfo !== null) {
        echo "Artist ID: " . $artistInfo['id'] . "<br>";
        echo "Name: " . $artistInfo['name'] . "<br>";
        echo "<img src=" . $artistInfo['image'] . "></img><br>";
        echo "Description: " . $artistInfo['description'] . "<br><br>";
    } else {
        echo "Artist not found.";
    }
    }
?>
</div>

<div class="albumrow">
<?php
 if (isset($_GET['albumid'])) {
  $albumid = $_GET['albumid'];
  $Albums = new Album($db, null, null, null, null);
  $AlbumInfo = $Albums->getAlbumByAlbumId($albumid);

  if ($AlbumInfo !== null) {
      // Display the retrieved artist information
      echo "Artist ID: " . $AlbumInfo['id'] . "<br>";
      echo "Name: " . $AlbumInfo['artist_id'] . "<br>";
      echo "Image String: " . $AlbumInfo['name'] . "<br>";
      echo "artist: " . $AlbumInfo['image'] . "<br><br>";
} else {
  echo "Album not found.";
}
 }
?>
</div>
<div class="equalizer">
 Equalizer TO BE CREATED
  </div>
</div>
</div>
<div class="playerback">
  <div class="whatsongison">

</div>
<?php
if (isset($_GET['songid'])) {
  $songid = $_GET['songid'];
  $Song = new Song($db, null, null, null, null, null, null);
  $Songinfo = $Song->getSongById($songid);
}
?>
<div class="grid-item">
<audio controls id="myAudio" preload="metadata" autoplay style=" width:1000px;">
	<source id="audioSource" src="<?php echo isset($Songinfo['song']) ? $Songinfo['song'] : ''; ?>" type="audio/mpeg">
  

</audio>
</div>
</div>
</div>
</body>
</html>

<?php
include("templates/footer.php")
?>
<script>
$(document).ready(function() {
  $(".songcell_song").on("click", function() {
    var artist_id = $(this).data("artist-id");
    var albumid = $(this).data("albumid");
    var songid = $(this).data("songid");

    // Make an AJAX request to get the artist information
    $.ajax({
      url: "get_artist_info.php",
      method: "GET",
      data: { artist_id: artist_id },
      success: function(response) {
        $(".artistrow").html(response);
      },
      error: function() {
        console.log("Error occurred while retrieving artist information.");
      }
    });

    // Make an AJAX request to get the album information
    $.ajax({
      url: "get_album_info.php",
      method: "GET",
      data: { albumid: albumid },
      success: function(response) {
        $(".albumrow").html(response);
      },
      error: function() {
        console.log("Error occurred while retrieving album information.");
      }
    });

    // Make an AJAX request to get the audio source information
    $.ajax({
      url: "get_new_audio.php",
      type: "GET",
      data: { songid: songid },
      dataType: "text",
      success: function(audioSource) {
        $("#audioSource").attr("src", audioSource);
        var audioPlayer = $("#myAudio")[0]; // Get the DOM element
        if (!audioPlayer.paused) {
          audioPlayer.pause();
        }
        audioPlayer.currentTime = 0; // Set the currentTime to 0 to reset the player without autoplaying
        $("#myAudio").get(0).load();
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });

    // Make an AJAX request to get "what song is on" information
    $.ajax({
      url: "get_whatsongison.php",
      type: "GET",
      data: { songid: songid },
      success: function(whatsongResponse) {
        $(".whatsongison").html(whatsongResponse);
      },
      error: function() {
        console.log('Error occurred while retrieving "what song is on" information.');
      }
    });
  });
});
</script>
