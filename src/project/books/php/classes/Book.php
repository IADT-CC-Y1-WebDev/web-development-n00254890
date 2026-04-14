<?php

class Book {

    public $id;
    public $title;
    public $author;
    public $publisher_id;
    public $year;
    public $isbn;
    public $description;
    public $cover_filename;
    public $format_ids = []; //multi value array to hold format ids for book

    private $db;

    public function __construct($data = [])
    {
        $this->db = DB::getInstance()->getConnection();

        if (!empty($data)) {
            $this->id = $data['id'] ?? null;
            $this->title = $data['title'] ?? null;
            $this->author = $data['author'] ?? null;
            $this->publisher_id = $data['publisher_id'] ?? null;
            $this->year = $data['year'] ?? null;
            $this->isbn = $data['isbn'] ?? null;
            $this->description = $data['description'] ?? null;
            $this->cover_filename = $data['cover_filename'] ?? null;
        }
    }

    public static function findAll() { //get all books
        $db = DB::getInstance()->getConnection();

        $stmt = $db->prepare("SELECT * FROM books ORDER BY title");
        $stmt->execute();

        $books = []; //array to hold book objects

        while ($row = $stmt->fetch()) {

            // Create book object 
            $book = new Book($row);

            // Safety check
            if (!$book->id) {
                continue;
            }

            // Load formats for this book
            $formats = Format::findByBook($book->id);

            // Convert to array of IDs using mapping function *easier for js filtering*
            $book->format_ids = array_map(
                fn($f) => $f->id,
                $formats
            );

            // Add to result list
            $books[] = $book;
        }

        return $books;
    }


    public static function findById($id) {
        $db = DB::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM books WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        return $row ? new Book($row) : null;
    }

    public function save() {

        if ($this->id) {
            $stmt = $this->db->prepare("
                UPDATE books
                SET title = :title,
                    author = :author,
                    publisher_id = :publisher_id,
                    year = :year,
                    isbn = :isbn,
                    description = :description,
                    cover_filename = :cover_filename
                WHERE id = :id
            ");

            $params = [
                'title' => $this->title,
                'author' => $this->author,
                'publisher_id' => $this->publisher_id,
                'year' => $this->year,
                'isbn' => $this->isbn,
                'description' => $this->description,
                'cover_filename' => $this->cover_filename,
                'id' => $this->id
            ];

        } else {
            $stmt = $this->db->prepare("
                INSERT INTO books
                (title, author, publisher_id, year, isbn, description, cover_filename)
                VALUES
                (:title, :author, :publisher_id, :year, :isbn, :description, :cover_filename)
            ");

            $params = [
                'title' => $this->title,
                'author' => $this->author,
                'publisher_id' => $this->publisher_id,
                'year' => $this->year,
                'isbn' => $this->isbn,
                'description' => $this->description,
                'cover_filename' => $this->cover_filename
            ];
        }

        $status = $stmt->execute($params);

        if (!$status) {
            $error_info = $stmt->errorInfo();
            throw new Exception($error_info[2]);
        }

        if ($this->id === null) {
            $this->id = $this->db->lastInsertId();
        }
    }

    public function delete() {
        if (!$this->id) return false;

        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        $status = $stmt->execute(['id' => $this->id]);

        if ($status) {
            $this->id = null;
        }

        return $status;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'publisher_id' => $this->publisher_id,
            'year' => $this->year,
            'isbn' => $this->isbn,
            'description' => $this->description,
            'cover_filename' => $this->cover_filename
        ];
    }
    //format ids to names for card display 
    public function getFormatNames() {
    $formats = Format::findByBook($this->id);

    $names = []; //array to hold format names
    foreach ($formats as $format) {
        $names[] = $format->name;
    }

    return $names;
}

}
