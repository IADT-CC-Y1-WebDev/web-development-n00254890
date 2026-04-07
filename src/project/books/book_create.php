<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';


startSession();

try {
    $publishers = Publisher::findAll();
    $formats = Format::findAll();
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
        <title>Add New Book</title>
    </head>
    <body>
    <div class="container">

        <div class="width-12">
            <h1>Add New Book</h1>
        </div>

        <form id="book_form" action="/project/books/book_store.php" method="POST" enctype="multipart/form-data" novalidate>

            <div id="error_summary_top" class="error-summary" style="display:none;"></div>

            <!-- Title -->
            <div class="input">
                <label class="special" for="title">Title:</label>
                <input type="text" id="title" name="title">
                <p id="title_error" class="error"></p>
            </div>

            <!-- Author -->
            <div class="input">
                <label class="special" for="author">Author:</label>
                <input type="text" id="author" name="author">
                <p id="author_error" class="error"></p>
            </div>

            <!-- Publisher -->
            <div class="input">
                <label class="special" for="publisher_id">Publisher:</label>
                <select id="publisher_id" name="publisher_id">
                    <option value="">Select Publisher</option>
                    <?php foreach ($publishers as $pub): ?>
                        <option value="<?= $pub->id ?>">
                            <?= h($pub->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p id="publisher_id_error" class="error"></p>
            </div>

            <!-- Year -->
            <div class="input">
                <label class="special" for="year">Year:</label>
                <input type="number" id="year" name="year">
                <p id="year_error" class="error"></p>
            </div>

            <!-- ISBN -->
            <div class="input">
                <label class="special" for="isbn">ISBN:</label>
                <input type="text" id="isbn" name="isbn">
                <p id="isbn_error" class="error"></p>
            </div>

            <!-- Formats -->
            <div class="input">
                <label class="special">Formats:</label>

                <?php foreach ($formats as $format): ?>
                    <div>
                        <input type="checkbox"
                            name="format_ids[]"
                            value="<?= $format->id ?>">
                        <label><?= h($format->name) ?></label>
                    </div>
                <?php endforeach; ?>

                <p id="format_id_error" class="error"></p>
            </div>

            <!-- Description -->
            <div class="input">
                <label class="special" for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
                <p id="description_error" class="error"></p>
            </div>

            <!-- Cover -->
            <div class="input">
                <label class="special" for="cover">Cover Image:</label>
                <input type="file" id="cover" name="cover">
                <p id="image_error" class="error"></p>
            </div>

            <div class="input">
                <button type="submit" id="submit_btn" class="button">Save Book</button>
            </div>

        </form>
    </div>

    <script src="js/book-form.js"></script>

    </body>
    </html>
    <?php
    // Clear old form data and errors after displaying
    clearFormData();
    clearFormErrors();
    ?>
</body>
</html>