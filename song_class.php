

<?php
require_once 'templates/dbConfig.php';
class Song {
    private $id;
    private $artist_id;
    private $name;
    private $image;
    private $albumid;
    private $song;

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
    public function getsongs() {
        return $this->song;
    }
    public function setartist_id($artist_id) {
        $this->artist_id = $artist_id;
    }
    public function setsongs($song) {
        $this->song = $song;
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

    public function __construct($db,$id,$artist_id,$name, $image, $albumid,$song) {
        $this->db = $db;
        $this->artist_id = $artist_id;
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->albumid = $albumid;
        $this->song = $song;
    }


    public function save($artist_id, $name, $image, $albumid,$song) {
        global $db;
    
        try {
            $stmt = $db->prepare("INSERT INTO song (artist_id, name, image, albumid, song) VALUES (?, ?, ?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Failed to prepare the SQL statement");
            }
    
            // Bind the variables to the prepared statement
            $stmt->bind_param('issss', $artist_id, $name, $image, $albumid, $song);
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
    
        $stmt = $db->prepare("UPDATE song SET artist_id = ?, name = ?, image = ?, albumid = ?, song =? WHERE id = ?");
        $stmt->bind_param('isssi', $this->artist_id, $this->name, $this->image, $this->albumid, $this->id, $this->song);
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

    $sql = "SELECT s.id,s.name,s.artist_id,s.image,s.albumid,s.song, a.name as artistname
        FROM song s
        INNER JOIN artist a ON s.artist_id = a.id";
    $result = $this->db->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $songs[] = $row;
        }
        $result->free();
    }

    return $songs;
}
public function getSongById($id)
{
    try {
        // Implement the logic to fetch the song information based on the provided 'id'
        $sql = "SELECT * FROM song WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        
        if (!$stmt) {
            throw new Exception("Error in preparing the SQL query: " . $this->db->error);
        }

        $stmt->bind_param('i', $id); // Assuming 'id' is an integer, adjust the type accordingly if it's different

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result && $result->num_rows > 0) {
                $song = $result->fetch_assoc();
                $stmt->close();
                return $song;
            }
        }
        return null;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

}
$artist_id = "";
$name = "";
$image = "";
$albumid = "";
$id = "";
$song = "";
$Song = new Song($db,$artist_id,$id,$name, $image, $albumid,$song);

    ?>