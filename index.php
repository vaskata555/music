
<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="templates/style.css">
</head>
<body>
<div class="background">
<?php
require_once("templates/header.php");

require_once("artist_class.php");
require_once("song_class.php");
?>
    <div class="gridmaker">
    <div class="gridwrapper">
<div class="musicrow">
<?php
    
    $Song = new Song($db,$artist_id,$id, $name, $image, $albumid);
    $Songs = $Song->getSong();
    
    // Display the artists
    foreach ($Songs as $Song) {
        echo "<div class='albumcell'>";
        echo "<div class='albumcell_song' data-artist-id='{$Song['artist_id']}' data-artist-name='{$Song['name']}'>";
       
       // echo "Artist ID: " . $Song['artist_id'] . "<br>";
      
        echo "<img class='songimage' src=songimg/" . $Song['image'] . "></img><br>";
        echo "<div class='textsongs'>";
        echo "<p class='songname'>" . $Song['name'] . "</p><br>";
         echo "<p class='songartist'>" . $Song['artist_id'] . "</p><br>";
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
        echo "Image String: " . $artistInfo['image'] . "<br>";
        echo "Description: " . $artistInfo['description'] . "<br><br>";
    } else {
        echo "Artist not found.";
    }
    }
?>
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
  // Listen for click event on song div elements with class 'song'
  $('.albumcell_song').on('click', function() {
    var artist_id = $(this).data('artist-id');

    // Make an AJAX request to get the artist information
    $.ajax({
      url: 'get_artist_info.php', // Replace 'get_artist_info.php' with the actual file name that will handle the AJAX request
      method: 'GET',
      data: { artist_id: artist_id },
      success: function(response) {
        // Update the artistrow div with the retrieved artist information
        $('.artistrow').html(response);
      },
      error: function() {
        console.log('Error occurred while retrieving artist information.');
      }
    });
  });
});
</script>