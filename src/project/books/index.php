<?php
require_once 'php/lib/config.php';
require_once 'php/lib/utils.php';

try {
    $books = Book::findAll();
    $publishers = Publisher::findAll();
    $formats = Format::findAll();
} 
catch (PDOException $e) {
    die("<p>PDO Exception: " . $e->getMessage() . "</p>");
}

//latest id for tag 
$latestId = 0;

foreach ($books as $b) {
    if ($b->id > $latestId) {
        $latestId = $b->id;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'php/inc/head_content.php'; ?>
        <title>Books</title>
        <style>
            .hidden { display: none; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="width-12 header">
                <?php require 'php/inc/flash_message.php'; ?>
                    <a href="book_create.php" class="button">Add New Book</a>
            </div>

            <?php if (!empty($books)) { ?>
                <div class="width-12 filters">
                    <form>
                        <div>
                            <label for="title_filter">Title:</label>
                            <input type="text" id="title_filter" name="title_filter">
                        </div>
                        <div>
                            <label for="publisher_filter">Publisher:</label>
                            <select id="publisher_filter" name="publisher_filter">
                                <option value="">Select Publishers</option>
                                <?php foreach ($publishers as $publisher) { ?>
                                    <option value="<?= h($publisher->id) ?>"><?= h($publisher->name) ?></option>
                                <?php } ?>
                            </select>
                        </div>

                            <div class="filter-dropdown">
                                <label>Format:</label>

                                <div class="dropdown">
                                    <button type="button" class="dropdown-btn">
                                        Select formats ▾
                                    </button>
                                    <div class="dropdown-content">
                                        <?php foreach ($formats as $format) { ?>
                                            <label class="dropdown-item">
                                                <input type="checkbox" name="format_filter[]" value="<?= h($format->id) ?>">
                                                <?= h($format->name) ?>
                                            </label>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <div class ="filter-dropdown">
                                <label for="sort_by">Sort by:</label>
                                    <select id="sort_by" name="sort_by">
                                        <option value="">Select Date</option>
                                        <option value="date_desc">Newest Date</option>
                                        <option value="date_asc">Oldest Date</option>
                                        <option value="added_desc">Newest Added</option>
                                        <option value="added_asc">Oldest Added</option>
                                    </select>
                            </div>
                                                        

                        <div class="filter-actions">
                            <button type="button" id="apply_filters">Apply Filters</button>
                            <button type="button" id="clear_filters">Clear Filters</button>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>

        <div class="container">
            <?php if (empty($books)) { ?>
                <p>No books found.</p>
            <?php } else { ?>
                <div class="width-12 cards">
                    <?php foreach ($books as $book) { ?>
                    <div class="card"
                        data-title="<?= h(strtolower($book->title)) ?>"
                        data-publisher="<?= h($book->publisher_id) ?>"
                        data-format="<?= h(implode(',', $book->format_ids ?? [])) ?>" // implode turns array into comma-separated string for easier filtering
                        data-date="<?= strtotime($book->year) ?>" // store year as timestamp for sorting
                        data-added="<?= $book->id ?>">

                            <div class="top-content">
                
                                <h2>Title: <?= h($book->title) ?>
                                <?php if ($book->id == $latestId): ?>
                                    <span class="tag-new">NEW</span>
                                <?php endif; ?>
                                </h2>
                                <p>Release Year: <?= h($book->year) ?></p>
                                <p>Author: <?= h($book->author) ?></p>
                                <p>Formats: <?= h(implode(', ', $book->getFormatNames())) ?></p>
                                
                            </div>
                            <div class="bottom-content">
                                <img src="images/<?= h($book->cover_filename) ?>" alt="Image for <?= h($book->title) ?>" />
                                <div class="actions">
                                    <a href="book_view.php?id=<?= h($book->id) ?>">View</a> / 
                                    <a href="book_edit.php?id=<?= h($book->id) ?>">Edit</a> / 
                                    <form action="book_delete.php" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this book?');"
                                          style="display:inline;">       
                                        <input type="hidden" name="id" value="<?= h($book->id) ?>">
                                        <button type="submit" class="button danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
          <script src="js/book-filters.js"></script>
    </body>
</html>