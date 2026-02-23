<?php

require_once './lib/config.php';
require_once './lib/session.php';
require_once './lib/forms.php';
require_once './lib/utils.php';

$data = [];
$errors = [];

// Start the session
startSession();

try {

    if($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception ('Invalid request method.');
    }

    $data = [
        'title'=> $_POST ['title'] ?? null,
        'author'=> $_POST ['author'] ?? null,
        'publisher_id'=> $_POST ['publisher_id'] ?? null,
        'year'=> $_POST ['year'] ?? null,
        'isbn'=> $_POST ['isbn'] ?? null,
        'format_ids'=> $_POST ['format_ids'] ??[],
        'description'=> $_POST ['description'] ?? null,
        'cover'=> $_FILES ['cover']?? null
    ];
 
    $year = date("Y");
    $rules = [
         'title'=> "required|nonempty|min:5|max:255",
        'author'=>  "required|nonempty|min:5|max:255",
        'publisher_id'=>  "required|nonempty|integer",
        'year'=>  "required|nonempty|integer|minvalue:1900|maxvalue:" . $year,
        'isbn'=> "required|nonempty|min:13|max:13",
        'format_ids'=>"required|nonempty|array|min:1|max:4",
        'description'=> "required|nonempty|min10",
        'cover'=>'required|file|image|mimes.jpg,jpeg,png|max_file_size:5242880'
      ];
    
      $validator = new Validator($data, $rules);

       if ($validator->fails()) {
            // Get first error for each field
            foreach ($validator->errors() as $field => $messages) {
                $errors[$field] = $messages[0];
            }
            throw new Exception('Validation failed.');
        }
        $uploader = new ImageUpload();
        $imageFilename = $uploader->process($_FILES['cover']);

     $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        // Get first error for each field
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }

        throw new Exception('Validation failed.');
    }

    // All validation passed - now process and save
    // Verify genre exists
    $genre = Genre::findById($data['genre_id']);
    if (!$genre) {
        throw new Exception('Selected genre does not exist.');
    }

    // Process the uploaded image (validation already completed)
    $uploader = new ImageUpload();
    $imageFilename = $uploader->process($_FILES['image']);

    if (!$cover_Filename) {
        throw new Exception('Failed to process and save the image.');
    }

    // Create new book instance
    $book = new Book();
    $book->title = $data['title'];
    $book->release_date = $data['release_date'];
    $book->genre_id = $data['genre_id'];
    $book->description = $data['description'];
    $book->cover_filename = $coverFilename;

    // Save to database
    $book->save();
    // Create platform associations
    if (!empty($data['platform_ids']) && is_array($data['platform_ids'])) {
        foreach ($data['platform_ids'] as $platformId) {
            // Verify platform exists before creating relationship
            if (Platform::findById($platformId)) {
                GamePlatform::create($game->id, $platformId);
            }
        }
    }

    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();

    // Set success flash message
    setFlashMessage('success', 'Game stored successfully.');

    // Redirect to game details page
    redirect('game_view.php?id=' . $game->id);
}
catch (Exception $e) {
    // Error - clean up uploaded image
    if (isset($imageFilename) && $imageFilename) {
        $uploader->deleteImage($imageFilename);
    }

    // Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Store form data and errors in session
    setFormData($data);
    setFormErrors($errors);

    redirect('game_create.php');
}
