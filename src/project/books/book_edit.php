<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';
// require_once 'php/classes/Publisher.php';
// require_once 'php/classes/Format.php';

startSession();

    try {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            throw new Exception('Invalid request method.');
        }

        if (!array_key_exists('id', $_GET)) {
            throw new Exception('No book ID provided.');
        }

        $id = $_GET['id'];

        $book = Book::findById($id);
        if ($book === null) {
            throw new Exception("Book not found.");
        }

        // Example: If you want to fetch publishers or formats
        // $bookPublishers = Publisher::findByBook($book->id);
        // $bookPublisherIds = array_map(fn($p) => $p->id, $bookPublishers);
        // $publishers = Publisher::findAll();
        // $formats = Format::findAll();

    } catch (Exception $e) {
        setFlashMessage('error', 'Error: ' . $e->getMessage());
        redirect('/index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>Edit Book</title>
    </head>
    <body>
        <div class="container">
            <div class="width-12">
                <?php require 'php/inc/flash_message.php'; ?>
            </div>
            <div class="width-12">
                <h1>Edit Book</h1>
            </div>
            <div class="width-12">
                <form action="book_update.php" method="POST" enctype="multipart/form-data">
                    <div class="input">
                        <input type="hidden" name="id" value="<?= h($book->id) ?>">
                    </div>
                    <div class="input">
                        <label class="special" for="title">Title:</label>
                        <div>
                            <input type="text" id="title" name="title" value="<?= old('title', $book->title) ?>" required>
                            <p><?= error('title') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="author">Author:</label>
                        <div>
                            <input type="text" id="author" name="author" value="<?= old('author', $book->author) ?>" required>
                            <p><?= error('author') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="year">year:</label>
                        <div>
                            <select id="year" name="year" required>
                                <?php foreach ($years as $year) { ?>
                                    <option value="<?= h($year->id) ?>" <?= chosen('year', $year->id, $book->year) ? "selected" : "" ?>>
                                        <?= h($year->name) ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <p><?= error('year') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <label class="special" for="description">Description:</label>
                        <div>
                            <textarea id="description" name="description" required><?= old('description', $game->description) ?></textarea>
                            <p><?= error('description') ?></p>
                        </div>
                    </div>
             
                    <div><img src="images/<?= $book->image_filename ?>" /></div>
                    <div class="input">
                        <label class="special" for="image">Image (optional):</label>
                        <div>
                            <input type="file" id="image" name="image" accept="image/*">
                            <p><?= error('image') ?></p>
                        </div>
                    </div>
                    <div class="input">
                        <button class="button" type="submit">Update Book</button>
                        <div class="button"><a href="index.php">Cancel</a></div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
<?php
// Clear form data after displaying
clearFormData();
// Clear errors after displaying
clearFormErrors();
?>