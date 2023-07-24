
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="templates/style.css">
</head>
<body>
<?php
include("templates/header.php");
include("song_class.php");
include("artist_class.php");
?>

<form method="post" action="add_song.php">
<label for="image">Upload image:</label>
    <input type="file" name="image" id="image" required><br>
    
    <label for="artist_id">artist_id:</label>
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
<label for="name">song name:</label>
    <input type="text" name="name" id="name" required><br>

   
    <label for="albumid">album:</label>
    <input type="text" name="albumid" id="albumid" required><br>
    <!-- Add more input fields as needed for other columns -->
    <input type="submit" value="Submit">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle file upload and get the file path (you need to implement this separately)

    // Get form data
    $name = $_POST["name"];
    $image = $_POST["image"];
    $artist_id = $_POST["artist_id"];
    $albumid = $_POST["albumid"];
    // $image = ... (get the file path of the uploaded image)

    // Create the Song instance and save the data
    $Song = new Song($db, $id,$artist_id , $name, $image, $albumid);
    $Song->save($artist_id, $name, $image, $albumid);
}
?>
</body>
</html>