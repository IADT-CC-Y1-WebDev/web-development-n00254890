<?php

require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

$data = [];
$errors = [];
$cover_filename = null;

// Start the session
startSession();

try {

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'title'         => $_POST['title'] ?? null,
        'author'        => $_POST['author'] ?? null,
        'publisher_id'  => $_POST['publisher_id'] ?? null,
        'year'          => $_POST['year'] ?? null,
        'isbn'          => $_POST['isbn'] ?? null,
        'format_ids'    => $_POST['format_ids'] ?? [],
        'description'   => $_POST['description'] ?? null,
        'cover'         => $_FILES['cover'] ?? null
    ];

    $currentYear = date("Y");

    $rules = [
        'title'        => "required|nonempty|min:5|max:255",
        'author'       => "required|nonempty|min:5|max:255",
        'publisher_id' => "required|nonempty|integer",
        'year'         => "required|nonempty|integer|minvalue:1900|maxvalue:$currentYear",
        'isbn'         => "required|nonempty|min:13|max:13",
        'format_ids'   => "required|nonempty|array|min:1|max:4",
        'description'  => "required|nonempty|min:10",
        'cover'        => "required|file|image|mimes:jpg,jpeg,png|max_file_size:5242880"
    ];
    
    if (empty($_FILES['cover']['name'])) {
        $errors['cover'] = 'Cover image is required.';
    }

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {

        foreach ($validator->errors() as $field => $messages) {
            $errors[$field] = $messages[0];
        }

        throw new Exception('Validation failed.');
    }

    // Process uploaded cover image
    $uploader = new ImageUpload();
    $cover_filename = $uploader->process($_FILES['cover']);

    if (!$cover_filename) {
        throw new Exception('Failed to process and save the cover image.');
    }

    // Create new book instance
    $book = new Book();
    $book->title = $data['title'];
    $book->author = $data['author'];
    $book->publisher_id = $data['publisher_id'];
    $book->year = $data['year'];
    $book->isbn = $data['isbn'];
    $book->description = $data['description'];
    $book->cover_filename = $cover_filename;

    // Save book
    $book->save();

    // Attach formats (if you have pivot table)
     if (!empty($data['format_ids']) && is_array($data['format_ids'])) {
         foreach ($data['format_ids'] as $formatId) {
            if(Format::findbyId($formatId)) {
            BookFormat::create($book->id, $formatId);
       }
    }
}

    // Clear form data & errors
    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Book stored successfully.');

    redirect('book_view.php?id=' . $book->id);
}

catch (Exception $e) {

    // Delete uploaded image if something failed
    if ($cover_filename) {
        $uploader->deleteImage($cover_filename);
    }

    setFlashMessage('error', 'Error: ' . $e->getMessage());

    setFormData($data);
    setFormErrors($errors);

    redirect('book_create.php');
}