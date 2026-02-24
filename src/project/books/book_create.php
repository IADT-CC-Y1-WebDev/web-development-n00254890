<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

// Mock data for the form
$publishers = [
    ['id' => 1, 'name' => 'Penguin Random House'],
    ['id' => 2, 'name' => 'HarperCollins'],
    ['id' => 3, 'name' => 'Simon & Schuster'],
    ['id' => 4, 'name' => 'Hachette Book Group'],
    ['id' => 5, 'name' => 'Macmillan Publishers'],
    ['id' => 6, 'name' => 'Scholastic Corporation'],
    ['id' => 7, 'name' => "O'Reilly Media"]
];

$formats = [
    ['id' => 1, 'name' => 'Hardcover'],
    ['id' => 2, 'name' => 'Paperback'],
    ['id' => 3, 'name' => 'Ebook'],
    ['id' => 4, 'name' => 'Audiobook']
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'php/inc/head_content.php'; ?>
    <title>Add New Book - Exercise</title>
</head>
<body>
    <?php require 'php/inc/flash_message.php'; ?>

    <div class="back-link">
        <a href="index.php">&larr; Back to Form Handling</a>
    </div>

    <h1>Add New Book</h1>

    <form action="/project/books/book_store.php" method="POST" enctype="multipart/form-data">
        <!-- Title -->
        <div class="form-group">
            <label for="title">Book Title:</label>
            <input type="text" id="title" name="title" value="<?= old('title') ?>">
            <?php if (error('title')): ?>
                <p class="error"><?= error('title') ?></p>
            <?php endif; ?>
        </div>

        <!-- Author -->
        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" value="<?= old('author') ?>">
            <?php if (error('author')): ?>
                <p class="error"><?= error('author') ?></p>
            <?php endif; ?>
        </div>

        <!-- Publisher -->
        <div class="form-group">
            <label for="publisher_id">Publisher:</label>
            <select id="publisher_id" name="publisher_id">
                <option value="">-- Select Publisher --</option>
                <?php foreach ($publishers as $pub): ?>
                    <option value="<?= $pub['id'] ?>" <?= chosen('publisher_id', $pub['id']) ? "selected" : "" ?>>
                        <?= h($pub['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (error('publisher_id')): ?>
                <p class="error"><?= error('publisher_id') ?></p>
            <?php endif; ?>
        </div>

        <!-- Year -->
        <div class="form-group">
            <label for="year">Year:</label>
            <input type="text" id="year" name="year" value="<?= h(old('year')) ?>">
            <?php if (error('year')): ?>
                <p class="error"><?= error('year') ?></p>
            <?php endif; ?>
        </div>

        <!-- ISBN -->
        <div class="form-group">
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" value="<?= h(old('isbn')) ?>">
            <?php if (error('isbn')): ?>
                <p class="error"><?= error('isbn') ?></p>
            <?php endif; ?>
        </div>

        <!-- Formats -->
        <div class="form-group">
            <label>Available Formats:</label>
            <div class="checkbox-group">
                <?php foreach ($formats as $format): ?>
                    <label class="checkbox-label">
                        <input type="checkbox" name="format_ids[]" value="<?= $format['id'] ?>" 
                            <?= chosen('format_ids', $format['id']) ? "checked" : "" ?>>
                        <?= h($format['name']) ?>
                    </label>
                <?php endforeach; ?>
            </div>
            <?php if (error('format')): ?>
                <p class="error"><?= error('format') ?></p>
            <?php endif; ?>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="5"><?= h(old('description')) ?></textarea>
            <?php if (error('description')): ?>
                <p class="error"><?= error('description') ?></p>
            <?php endif; ?>
        </div>

        <!-- Cover Image -->
        <div class="form-group">
            <label for="cover">Book Cover Image (max 2MB):</label>
            <input type="file" id="cover" name="cover" accept="image/*">
            <?php if (error('cover')): ?>
                <p class="error"><?= error('cover') ?></p>
            <?php endif; ?>
        </div>

        <!-- Submit -->
        <div class="form-group">
            <button type="submit" class="button">Save Book</button>
        </div>
    </form>

    <?php
    // Clear old form data and errors after displaying
    clearFormData();
    clearFormErrors();
    ?>
</body>
</html>