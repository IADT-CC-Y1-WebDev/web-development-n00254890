<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET' || !array_key_exists('id', $_GET)) {
    die("<p>Error: No book ID provided.</p>");
}
$id = $_GET['id'];

try {
    $book = Book::findById($id);
    if ($book === null) {
        die("<p>Error: book not found.</p>");
    }
}

catch (PDOException $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>View Book</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>
        </div>
        <div class="container">
            <div class="width-12">
                <div class="hCard">
                    <div class="bottom-content">
                        <img src="/project/books/images/<?= h($book->cover_filename) ?>" alt="Book Cover">

                                        <div class="actions">
                        <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a> /

                        <form action="book_delete.php" method="POST" style="display:inline;" 
                            onsubmit="return confirm('Are you sure you want to delete this book?');">
                            <input type="hidden" name="id" value="<?= h($book->id) ?>">
                            <button type="submit" class="button danger">Delete</button>
                        </form> /

                        <a href="index.php">Back to list</a>
                    </div>
                    </div>

                    <div class="bottom-content">
                        <h2><?= htmlspecialchars($book->title) ?></h2>
                        <p>Author: <?= htmlspecialchars($book->author) ?></p>
                        <p>year: <?= htmlspecialchars($book->year) ?></p>
                        <p>Description: <?= nl2br(htmlspecialchars($book->description)) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>