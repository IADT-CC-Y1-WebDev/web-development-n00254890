<?php
class Book
{
    // public properties for each database column
    public $id;
    public $title;
    public $author;
    public $publisher_id;
    public $year;
    public $isbn;
    public $description;
    public $cover_filename;

    // private $db property for database connection
    private $db;

    // =========================================================================
    // Constructor: Accepts optional data array
    // =========================================================================
    public function __construct($data = [])
    {
        // Get PDO connection from DB singleton
        $this->db = DB::getInstance()->getConnection();

        // Hydrate properties if data provided
        $this->id             = $data['id'] ?? null;
        $this->title          = $data['title'] ?? null;
        $this->author         = $data['author'] ?? null;
        $this->publisher_id   = $data['publisher_id'] ?? null;
        $this->year           = $data['year'] ?? null;
        $this->isbn           = $data['isbn'] ?? null;
        $this->description    = $data['description'] ?? null;
        $this->cover_filename = $data['cover_filename'] ?? null;
    }

    // =========================================================================
    // Finder Methods
    // =========================================================================
    public static function findAll()
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM books");
        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new self($row);
        }
        return $results;
    }

    public static function findById($id)
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new self($row) : null;
    }

    public static function findByPublisher($publisherId)
    {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books WHERE publisher_id = :publisher_id");
        $stmt->execute([':publisher_id' => $publisherId]);
        $results = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = new self($row);
        }
        return $results;
    }

    // =========================================================================
    // Save Method: INSERT or UPDATE
    // =========================================================================
    public function save()
    {
        if ($this->id) {
            // UPDATE existing book
            $stmt = $this->db->prepare("
                UPDATE books SET
                    title = :title,
                    author = :author,
                    publisher_id = :publisher_id,
                    year = :year,
                    isbn = :isbn,
                    description = :description,
                    cover_filename = :cover_filename
                WHERE id = :id
            ");
            return $stmt->execute([
                ':title'          => $this->title,
                ':author'         => $this->author,
                ':publisher_id'   => $this->publisher_id,
                ':year'           => $this->year,
                ':isbn'           => $this->isbn,
                ':description'    => $this->description,
                ':cover_filename' => $this->cover_filename,
                ':id'             => $this->id,
            ]);
        } else {
            // INSERT new book
            $stmt = $this->db->prepare("
                INSERT INTO books (title, author, publisher_id, year, isbn, description, cover_filename)
                VALUES (:title, :author, :publisher_id, :year, :isbn, :description, :cover_filename)
            ");
            $success = $stmt->execute([
                ':title'          => $this->title,
                ':author'         => $this->author,
                ':publisher_id'   => $this->publisher_id,
                ':year'           => $this->year,
                ':isbn'           => $this->isbn,
                ':description'    => $this->description,
                ':cover_filename' => $this->cover_filename,
            ]);

            if ($success) {
                $this->id = $this->db->lastInsertId();
            }

            return $success;
        }
    }

    // =========================================================================
    // Delete Method
    // =========================================================================
    public function delete()
    {
        if (!$this->id) {
            return false; // nothing to delete
        }

        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        $result = $stmt->execute([':id' => $this->id]);

        if ($result) {
            $this->id = null; // reset id after deletion
        }

        return $result;
    }

    // =========================================================================
    // Convert object to array
    // =========================================================================
    public function toArray()
    {
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'author'         => $this->author,
            'publisher_id'   => $this->publisher_id,
            'year'           => $this->year,
            'isbn'           => $this->isbn,
            'description'    => $this->description,
            'cover_filename' => $this->cover_filename,
        ];
    }
}
