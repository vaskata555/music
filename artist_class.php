

<?php
require_once 'templates/dbConfig.php';
class Artist {
    private $id;
    private $name;
    private $image;
    private $description;

    private $db;
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getimage() {
        return $this->image;
    }

    public function setimage($image) {
        $this->image = $image;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }


        // Other properties and methods...
    
       
    
        public function __construct($db, $id, $name, $image, $description) {
            $this->db = $db;
            $this->id = $id;
            $this->name = $name;
            $this->image = $image;
            $this->description = $description;
        }


    public function save($name, $image, $description) {
        try {
            $stmt = $this->db->prepare("INSERT INTO artist (name, image, description) VALUES (?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Failed to prepare the SQL statement");
            }
            
            // Bind the variables to the prepared statement
            $stmt->bind_param('sss', $name, $image, $description);
    
            // Execute the prepared statement
            if ($stmt->execute()) {
                echo "Data inserted successfully!";
            } else {
                echo "Data insertion failed!";
            }
    
            $stmt->close();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }



public function update() {
    global $db;

    
    $stmt = $this->db->prepare("UPDATE artists SET name = :name, image = :image, description = :description WHERE id = :id");
    $stmt->bindParam(':name', $this->name);
    $stmt->bindParam(':image', $this->image);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
    $stmt->execute();
}

public function delete() {
    global $db; 

     
    $stmt = $this->db->prepare("DELETE FROM artists WHERE id = :id");
    $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
    $stmt->execute();
}
public function displayInfo() {
    echo "Artist ID: " . $this->id . "<br>";
    echo "Name: " . $this->name . "<br>";
    echo "Image String: " . $this->image . "<br>";
    echo "Description: " . $this->description . "<br>";
}

public function getArtists() {
    $artists = array();

    $sql = "SELECT * FROM artist";
    $result = $this->db->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $artists[] = $row;
        }
        $result->free();
    }

    return $artists;
}
public function getArtistById($id) {
    $stmt = $this->db->prepare("SELECT * FROM artist WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $artist = $result->fetch_assoc();
        return $artist;
    } else {
        return null;
    }
}
}

$name = "John Doe";
$image = "image.jpg";
$description = "Some description";
$id = 123;
$artist = new Artist($db,$id, $name, $image, $description);

    ?>