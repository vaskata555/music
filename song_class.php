

<?php
class Song {
    private $id;
    private $artist_id;
    private $name;
    private $image;
    private $albumid;

    private $db;
    public function getartist_id() {
        return $this->artist_id;
    }
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function setartist_id($artist_id) {
        $this->artist_id = $artist_id;
    }
    public function setName($artist_id) {
        $this->name = $artist_id;
    }
 

   

    public function setimage($image) {
        $this->image = $image;
    }
    public function setalbum($albumid) {
        $this->image = $albumid;
    }
    public function getimage() {
        return $this->image;
    }
    public function getalbumid() {
        return $this->albumid;
    }

    public function setalbumid($albumid) {
        $this->albumid = $albumid;
    }

    public function __construct($db,$id,$artist_id,$name, $image, $albumid) {
        $this->db = $db;
        $this->artist_id = $artist_id;
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->albumid = $albumid;
    }


    public function save($artist_id, $name, $image, $albumid) {
        global $db;
    
        try {
            $stmt = $db->prepare("INSERT INTO song (artist_id, name, image, albumid) VALUES (?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Failed to prepare the SQL statement");
            }
    
            // Bind the variables to the prepared statement
            $stmt->bind_param('isss', $artist_id, $name, $image, $albumid);
            if ($stmt->execute()) {
                echo "Data inserted successfully!";
            } else {
                echo "Data insertion failed!";
            }
    
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    // For update() method
    public function update() {
        global $db;
    
        $stmt = $db->prepare("UPDATE song SET artist_id = ?, name = ?, image = ?, albumid = ? WHERE id = ?");
        $stmt->bind_param('isssi', $this->artist_id, $this->name, $this->image, $this->albumid, $this->id);
        $stmt->execute();
    }
    
    // For delete() method
    public function delete() {
        global $db;
    
        $stmt = $db->prepare("DELETE FROM song WHERE id = ?");
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
    }



public function getSong() {
    $songs = array();

    $sql = "SELECT * FROM song";
    $result = $this->db->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $songs[] = $row;
        }
        $result->free();
    }

    return $songs;
}
}
$artist_id = "";
$name = "";
$image = "";
$albumid = "";
$id = "";
$Song = new Song($db,$artist_id,$id,$name, $image, $albumid);

    ?>