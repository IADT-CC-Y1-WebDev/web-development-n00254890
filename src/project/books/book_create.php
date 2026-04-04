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
    <title>Add New Book - Exercise</title>
</head>
<body>
    <div class="container">
        <div class=" width-12">
            <?php require 'php/inc/flash_message.php'; ?>
        </div>
        <div class="width-12">
            <div class="back-link">
                <a href="index.php">&larr; Back to Form Handling</a>
            </div>
        </div>
        <div class="width-12">
            <h1>Add New Book</h1>
        </div>
        <div class="width-12">
            <form action="/project/books/book_store.php" method="POST" enctype="multipart/form-data" novalidate>
                <!-- Title -->
                <div class="input">
                    <label class="special" for="title">Book Title:</label>
                    <input type="text" id="title" name="title" value="<?= old('title') ?>">
                    <?php if (error('title')): ?>
                        <p class="error"><?= error('title') ?></p>
                    <?php endif; ?>
                </div>

                <!-- Author -->
                <div class="input">
                    <label class="special" for="author">Author:</label>
                    <input type="text" id="author" name="author" value="<?= old('author') ?>">
                    <?php if (error('author')): ?>
                        <p class="error"><?= error('author') ?></p>
                    <?php endif; ?>
                </div>

                <!-- Publisher -->

                <div class="input">
                    <label class="special" for="publisher_id">Publisher:</label>
                    <select id="publisher_id" name="publisher_id">
                        <option value="">Select Publisher</option>
                        <?php foreach ($publishers as $pub): ?>
                            <option value="<?= $pub->id ?>" <?= chosen('publisher_id', $pub->id) ? "selected" : "" ?>>
                                <?= h($pub->name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (error('publisher_id')): ?>
                        <p class="error"><?= error('publisher_id') ?></p>
                    <?php endif; ?>
                </div>

                <!-- Year -->
                <div class="input">
                    <label class="special"  for="year">Year:</label>
                    <input type="number" id="year" name="year" min="1900" max="2099" step="1" value="<?= h(old('year')) ?>">
                    <?php if (error('year')): ?>
                        <p class="error"><?= error('year') ?></p>
                    <?php endif; ?>
                </div>


                <!-- ISBN -->
                <div class="input">
                    <label class="special" for="isbn">ISBN:</label>
                    <input type="text" id="isbn" name="isbn" value="<?= h(old('isbn')) ?>">
                    <?php if (error('isbn')): ?>
                        <p class="error"><?= error('isbn') ?></p>
                    <?php endif; ?>
                </div>


                <!-- Formats -->
                <div class="input">
                        <label class="special">Formats:</label>
                        <div>
                            <?php foreach ($formats as $format) { ?>
                                <div>
                                    <input type="checkbox" 
                                        id="format_<?= h($format->id) ?>" 
                                        name="format_ids[]" 
                                        value="<?= h($format->id) ?>"
                                        <?= chosen('format_ids', $format->id) ? "checked" : "" ?>
                                        >
                                    <label for="format_<?= h($format->id) ?>"><?= h($format->name) ?></label>
                                </div>
                            <?php } ?>
                        </div>
                        <p><?= error('format_ids') ?></p>
                    </div>

                <!-- Description -->
                <div class="input">
                    <label class="special" for="description">Description:</label>
                     <textarea id="description" name="description" required><?= old('description') ?></textarea>
                    <?php if (error('description')): ?>
                        <p class="error"><?= error('description') ?></p>
                    <?php endif; ?>
                </div>

                <!-- Cover Image -->
                <div class="input">
                    <label class="special" for="cover"> Cover Image:</label>
                    <input type="file" id="cover" name="cover" accept="image/*" required>
                     <p class="error"><?= error('cover') ?></p>
                </div>

                <!-- Submit -->
                <div class="input">
                    <button type="submit" class="button">Save Book</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    // Clear old form data and errors after displaying
    clearFormData();
    clearFormErrors();
    ?>
</body>
</html>