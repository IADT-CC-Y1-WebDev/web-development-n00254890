<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

session_start();

$action = $_POST['action'] ?? null;

try {

    // add publisher
    if ($action === "add_publisher") {

        $name = trim($_POST['name'] ?? ''); // get and trim publisher name

        if ($name === '') {
            throw new Exception("Publisher name required."); //validation
        }

        $existing = Publisher::findByName($name); //check if publisher already exists

        if ($existing) {
            $_SESSION["flash"] = [
                "message" => "Publisher already exists.", 
                "type" => "error"
            ];

        } else {  // create and save new publisher if it doesn't exist
            $publisher = new Publisher([
                "name" => $name
            ]);
            $publisher->save(); //save to database

        $_SESSION["flash"] = [
            "message" => "Publisher added successfully.", // set success flash message
            "type" => "success"
        ];

        }
        header("Location: index.php");
        exit;
    }

    //delete publisher
    if ($action === "delete_publisher") {

        $publisherId = $_POST['publisher_id']; // get publisher ID from form

        $db = DB::getInstance()->getConnection();

        $stmt = $db->prepare("SELECT COUNT(*) FROM books WHERE publisher_id = :id"); //check if publisher is used by any books
        $stmt->execute([":id" => $publisherId]);
        $count = $stmt->fetchColumn(); // get count of books using this publisher

        if ($count > 0) { // if publisher is used by books, set error flash message and redirect without deleting
            $_SESSION["flash"] = [
                "message" => "Cannot delete publisher — used in $count book(s).",
                "type" => "error"
            ];
            header("Location: index.php");
            exit;
        }

        $publisher = Publisher::findById($publisherId); // find publisher by ID and delete 
        if ($publisher) {
            $publisher->delete();
            $_SESSION["flash"] = [
                "message" => "Publisher deleted successfully.", // set success flash message
                "type" => "success"
            ];
        }

        header("Location: index.php");
        exit;
    }


    // exit
    header("Location: index.php");
    exit;

} catch (Exception $e) {
    $_SESSION["flash"] = [
        "message" => "An error occurred: " . $e->getMessage(),
        "type" => "error"
    ];
    header("Location: index.php");
    exit;
}