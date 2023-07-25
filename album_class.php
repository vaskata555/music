<?php
class Album {
    private $id;
    private $artist_id;
    private $name;
    private $image;
    private $db;

    public function getArtist_id() {
        return $this->artist_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getImage() {
        return $this->image;
    }

    public function setArtist_id($artist_id) {
        $this->artist_id = $artist_id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function __construct($db, $id, $artist_id, $name, $image) {
        $this->db = $db;
        $this->id = $id;
        $this->artist_id = $artist_id;
        $this->name = $name;
        $this->image = $image;
    }

    public function save($artist_id, $name, $image) {
        try {
            $stmt = $this->db->prepare("INSERT INTO album (artist_id, name, image) VALUES (?, ?, ?)");
            if (!$stmt) {
                throw new Exception("Failed to prepare the SQL statement");
            }

            // Bind the variables to the prepared statement
            $stmt->bind_param('iss', $artist_id, $name, $image);
            if ($stmt->execute()) {
                echo "Data inserted successfully!";
            } else {
                echo "Data insertion failed!";
            }

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function update() {
        try {
            $stmt = $this->db->prepare("UPDATE album SET artist_id = ?, name = ?, image = ? WHERE id = ?");
            $stmt->bind_param('issi', $this->artist_id, $this->name, $this->image, $this->id);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function delete() {
        try {
            $stmt = $this->db->prepare("DELETE FROM album WHERE id = ?");
            $stmt->bind_param('i', $this->id);
            $stmt->execute();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getAlbums() {
        $albums = array();
    
        try {
            $sql = "SELECT * FROM album";
            $result = $this->db->query($sql);
    
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $albums[] = $row;
                }
                $result->free();
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    
        return $albums;
    }

    public function getAlbumById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM album WHERE id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result && $result->num_rows > 0) {
                $album = $result->fetch_assoc();
                return $album;
            } else {
                return null;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    public function getAlbumByArtistId($artist_id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM album WHERE artist_id = ?");
            $stmt->bind_param('i', $artist_id);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result && $result->num_rows > 0) {
                $albums = [];
                while ($album = $result->fetch_assoc()) {
                    $albums[] = $album;
                }
                return $albums;
            } else {
                return null;
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
}

    $artist_id = "";
$name = "";
$image = "";
$id = "";
$Album = new Album($db,$id, $artist_id, $name, $image);
?>