
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="templates/style.css">
</head>
<body>
<?php
include("templates/header.php");
include("artist_class.php");
?>

<form method="post" action="create_artist.php">
<label for="image">Upload image:</label>
    <input type="file" name="image" id="image" required><br>
<label for="name">Artist Name:</label>
    <input type="text" name="name" id="name" required><br>

   
    <label for="description">Description:</label>
    <input type="text" name="description" id="description" required><br>
    <!-- Add more input fields as needed for other columns -->
    <input type="submit" value="Submit">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle file upload and get the file path
    // (Implement file upload handling separately)

    // Get form data
    $name = $_POST["name"];
    $description = $_POST["description"];
    $image= $_POST["image"];
    
    // Create the Artist instance and save the data
    $Artist = new Artist($db,$id, $name, $image, $description);
    $Artist->save($name, $image, $description);
}
?>
</body>
</html>