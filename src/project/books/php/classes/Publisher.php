<?php

class Publisher {
    public $id;
    public $name;

    private $db;

    public function __construct($data = []) {
        $this->db = DB::getInstance()->getConnection();

        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->name = $data['name'] ?? null;
        }
    }

    // Find all publishers
    public static function findAll() {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM publishers ORDER BY name");
        $stmt->execute();

        $publishers = [];
        while ($row = $stmt->fetch()) {
            $publishers[] = new Publisher($row);
        }

        return $publishers;
    }

    // Find publisher by ID
    public static function findById($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM publishers WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        if ($row) {
            return new Publisher($row);
        }

        return null;
    }

    // Find publishers by book (requires JOIN with book_publisher table)
    public static function findByBook($bookId) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT p.*
            FROM publishers p
            INNER JOIN book_publisher bp ON p.id = bp.publisher_id
            WHERE bp.book_id = :book_id
            ORDER BY p.name
        ");
        $stmt->execute(['book_id' => $bookId]);

        $publishers = [];
        while ($row = $stmt->fetch()) {
            $publishers[] = new Publisher($row);
        }

        return $publishers;
    }

    // Convert to array for JSON output
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    //added for publisher controls in admin panel
    
    // Find publisher by name for adding new publisher (to prevent duplicates)
    public static function findByName($name) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM publishers WHERE name = :name");
        $stmt->execute(['name' => $name]);

        $row = $stmt->fetch();
        if ($row) {
            return new Publisher($row);
        }

        return null;
    }

    //save publisher (insert or update)
    public function save() {
        if ($this->id) {
            $stmt = $this->db->prepare("UPDATE publishers SET name = :name WHERE id = :id");
            $stmt->execute([
                'name' => $this->name,
                'id' => $this->id
            ]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO publishers (name) VALUES (:name)");
            $stmt->execute([
                'name' => $this->name
            ]);

            $this->id = $this->db->lastInsertId();
        }
    }
    
    // Delete publisher (only if not used by any books)
    public function delete() {
        $stmt = $this->db->prepare("DELETE FROM publishers WHERE id = :id");
        $stmt->execute(['id' => $this->id]);
    }


}
