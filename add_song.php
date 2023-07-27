
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="templates/style.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php
include("templates/header.php");
include("song_class.php");
include("artist_class.php");
include("album_class.php");
?>

<form method="post" action="add_song.php">
<label for="image">Upload image:</label>
    <input type="file" name="image" id="image" required><br>
    
    <label for="">artist_id:</label>
    <select name="artist_id" id="artist_id" required>
    <option value="" selected disabled>Select an artist</option>
    <?php
    
  $artistHandler = new Artist($db, null, null, null, null);

    // Fetch all artists
    $artists = $artistHandler->getArtists();
    foreach ($artists as $artist) {
        echo '<option value="' . $artist["id"] . '">' . $artist["name"] . '</option>';
    }
    ?>
    
</select>
<br>
<label for="file">Upload Song:</label>
    <input type="file" name="song" id="song" required><br>

<label for="name">song name:</label>
    <input type="text" name="name" id="name" required><br>
    <?php
    $albumHandler = new Album($db, null, null, null, null);
   $albums = $albumHandler->getAlbumById($artist_id);
   ?>
  <label for="album_id">album:</label>
  <select name="album_id" id="album_id" required>
    <option value="" selected disabled>Select an album</option>
    <!-- The options will be populated dynamically using AJAX -->
  </select>
   
    <input type="submit" value="Submit">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle file upload and get the file path (you need to implement this separately)

    // Get form data
    $name = $_POST["name"];
    $image = $_POST["image"];
    $artist_id = $_POST["artist_id"];
    $albumid = $_POST["album_id"];
    $song = $_POST["song"];
    // $image = ... (get the file path of the uploaded image)

    // Create the Song instance and save the data
    $Song = new Song($db, $id,$artist_id , $name, $image, $albumid,$song);
    $Song->save($artist_id, $name, $image, $albumid,$song);
}
?>
</body>
</html>
<script>
  // Wait for the document to be ready
  $(document).ready(function () {
    $('#artist_id').on('change', function () {
      var selectedOption = $(this).val();

      $.ajax({
        url: 'get_albums.php', // Replace 'get_albums.php' with the correct path to your server-side script
        type: 'POST',
        data: { artist_id: selectedOption },
        charset: 'utf-8',
        success: function (response) {
          $('#album_id').html(response);
        },
        error: function (xhr, status, error) {
          console.error(error);
        }
      });
    });
  });
</script>





