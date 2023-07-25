<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="templates/style.css">
</head>
<body>

<?php
include("templates/header.php");
include("album_class.php");
include("artist_class.php");
$id = ""; // Initialize id variable
    $artist_id = "";
    $name = "";
    $image = "";
    $albumid = ""; // For illustration purposes, since the template had albumid
    $Album = new Album($db, $id, $artist_id, $name, $image);
    ?>

    <form method="post" action="create_album.php">
       
        <label for="artist">artist</label>
        <select name="artist_id" id="artist_id" required>
    <option value="" selected disabled>Select an artist</option>
       <?php  $artistHandler = new Artist($db, null, null, null, null);

// Fetch all artists
$artists = $artistHandler->getArtists();
foreach ($artists as $artist) {
    echo '<option value="' . $artist["id"] . '">' . $artist["name"] . '</option>';
}
?>
</select> 
<br>
        <label for="name">Album Name:</label>
        <input type="text" name="name" id="name" required><br>
        <label for="image">Upload image:</label>
        <input type="file" name="image" id="image" required><br>
        <!-- Add more input fields as needed for other columns -->
        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Handle file upload and get the file path
        // (Implement file upload handling separately)

        // Get form data
        $name = $_POST["name"];
        $artist_id = $_POST["artist_id"];
        $image = $_POST["image"];

        // Create the Album instance and save the data
        $Album = new Album($db, $id, $artist_id, $name, $image);
        $Album->save($artist_id, $name, $image);
    }

    $db->close(); // Close the database connection
    ?>

</body>
</html>