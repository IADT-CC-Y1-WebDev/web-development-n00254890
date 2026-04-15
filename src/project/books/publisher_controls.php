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

        $name = trim($_POST['name'] ?? '');

        if ($name === '') {
            throw new Exception("Publisher name required.");
        }

        $existing = Publisher::findByName($name);

        if ($existing) {
            $_SESSION["flash"] = [
                "message" => "Publisher already exists.",
                "type" => "error"
            ];

        } else {
            $publisher = new Publisher([
                "name" => $name
            ]);
            $publisher->save();

        $_SESSION["flash"] = [
            "message" => "Publisher added successfully.",
            "type" => "success"
        ];

        }

        header("Location: index.php");
        exit;
    }

    //delete publisher
    if ($action === "delete_publisher") {

        $publisherId = $_POST['publisher_id'];

        $db = DB::getInstance()->getConnection();

        $stmt = $db->prepare("SELECT COUNT(*) FROM books WHERE publisher_id = :id");
        $stmt->execute([":id" => $publisherId]);
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $_SESSION["flash"] = [
                "message" => "Cannot delete publisher — used in $count book(s).",
                "type" => "error"
            ];
            header("Location: index.php");
            exit;
        }

        $publisher = Publisher::findById($publisherId);
        if ($publisher) {
            $publisher->delete();
            $_SESSION["flash"] = [
                "message" => "Publisher deleted successfully.",
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