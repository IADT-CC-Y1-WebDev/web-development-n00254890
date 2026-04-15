<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';
require_once 'php/classes/Validator.php';
require_once 'php/classes/ImageUpload.php';
require_once 'php/classes/BookFormat.php';
require_once 'php/classes/Publisher.php';
require_once 'php/classes/Format.php';

startSession();

try {
    // Initialize form data array
    $data = [];
    // Initialize errors array
    $errors = [];
    
    // Check if request is POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // Get form data
    $data = [
        'id' => $_POST['id'] ?? null,
        'title' => $_POST['title'] ?? null,
        'author' => $_POST['author'] ?? null,
        'publisher_id' => $_POST['publisher_id'] ?? null,
        'year' => $_POST['year'] ?? null,
        'isbn' => $_POST['isbn'] ?? null,
        'description' => $_POST['description'] ?? null,
        'format_ids' => $_POST['format_ids'] ?? [],
        'image' => $_FILES['image'] ?? null
    ];

    // Define validation rules
    $year = date("Y");
    $data['isbn'] = preg_replace('/[-\s]/', '', $data['isbn']); // Remove dashes and spaces for validation
    $rules = [
        'id' => 'required|integer|min:1|max:255',
        'title' => 'required|notempty|min:1|max:255',
        'author' => 'required|notempty|min:1|max:255',
        'publisher_id' => 'required|notempty|integer',
        'year'=> 'required|notempty|integer|minvalue:1900|maxvalue:'. $year,
        'isbn' => 'required|nonempty|regex:/^\d{13}$/',
        'description' => 'required|notempty|min:10|max:5000',
        'format_ids' => 'required|array|min:1|max:10',
        'image' => 'file|image|mimes:jpg,jpeg,png|max_file_size:5242880'
    ];

    // Validate all data (including file)
    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        // Get first error for each field
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }

        throw new Exception('Validation failed.');
    }

    // Find existing book
    $book = Book::findById($data['id']);
    if (!$book) {
        throw new Exception('Book not found.');
    }

    // Verify Publisher exists
     $publisher = Publisher::findById($data['publisher_id']);
    if (!$publisher) {
        throw new Exception('Selected publisher does not exist.');
     }

    // Verify formats exist
     foreach ($data['format_ids'] as $formatId) {
         if (!Format::findById($formatId)) {
             throw new Exception('One or more selected formats do not exist.');
         }
     }

    // Process the uploaded image (validation already completed)
    $cover_filename = null;
    $uploader = new ImageUpload();
    if ($uploader->hasFile('image')) {
        $uploader->deleteImage($book->cover_filename);
        $cover_filename = $uploader->process($_FILES['image']);
        if (!$cover_filename) {
            throw new Exception('Failed to process and save the image.');
        }
    }
    
    // Update the book instance
    $book->id = $data['id'];
    $book->title = $data['title'];
    $book->author = $data['author'];
    $book->publisher_id = $data['publisher_id'];
    $book->year = $data['year'];
    $book->isbn = $data['isbn'];
    $book->description = $data['description'];
    if ($cover_filename) {
    $book->cover_filename = $cover_filename;
    }

    $book->save();

    // Delete existing format associations
     BookFormat::deleteByBook($book->id);
     // Create new format associations
     if (!empty($data['format_ids']) && is_array($data['format_ids'])) {
         foreach ($data['format_ids'] as $formatId) {
             BookFormat::create($book->id, $formatId);
         }
     }

    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();

    // Set success flash message
    setFlashMessage('success', 'Book updated successfully.');

    // Redirect to book details page
    redirect('book_view.php?id=' . $book->id);
}
catch (Exception $e) {
    // Error - clean up uploaded image
    if ($cover_filename) {
        $uploader->deleteImage($cover_filename);
    }

    // Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Store form data and errors in session
    setFormData($data);
    setFormErrors($errors);

    // Redirect back to edit page if there is an ID; otherwise, go to index page
    if (isset($data['id']) && $data['id']) {
        redirect('book_edit.php?id=' . $data['id']);
    }
    else {
        redirect('index.php');
    }
}
