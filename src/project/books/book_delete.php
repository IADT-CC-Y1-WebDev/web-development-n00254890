
    <?php
    require_once 'php/lib/config.php';
    require_once 'php/lib/session.php';
    require_once 'php/lib/forms.php';
    require_once 'php/lib/utils.php';
    require_once 'php/classes/Validator.php';
    require_once 'php/classes/ImageUpload.php';
    require_once 'php/classes/Book.php';

    startSession();

    try {
        // Only allow POST requests
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('Invalid request method.');
        }

        // Initialize form data and errors
        $data = [
            'id' => $_POST['id'] ?? null
        ];

        $errors = [];

        // Validation rules
        $rules = [
            'id' => 'required|integer'
        ];

        // Validate
        $validator = new Validator($data, $rules);

        if ($validator->fails()) {
            foreach ($validator->errors() as $field => $fieldErrors) {
                $errors[$field] = $fieldErrors[0];
            }

            throw new Exception('Validation failed.');
        }

        // Find the book
        $book = Book::findById($data['id']);

        if (!$book) {
            throw new Exception('Book not found.');
        }

        // Delete associated image if it exists
        if (!empty($book->cover_filename)) {
            $uploader = new ImageUpload();
            $uploader->deleteImage($book->cover_filename);
        }

        // Delete the book
        if (!$book->delete()) {
            throw new Exception('Failed to delete book.');
        }

        // Clear old session form data
        clearFormData();
        clearFormErrors();

        // Success message
        setFlashMessage('success', 'Book deleted successfully.');

        redirect('index.php');
    }
    catch (Exception $e) {

        // Error flash message
        setFlashMessage('error', 'Error: ' . $e->getMessage());

        // Store form data + errors in session
        setFormData($data ?? []);
        setFormErrors($errors ?? []);

        // Redirect safely
        if (!empty($data['id'])) {
            redirect('book_view.php?id=' . urlencode($data['id']));
        } else {
            redirect('index.php');
        }
    }