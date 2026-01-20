<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/03-arrays.php">View Example &rarr;</a>
    </div>

    <h1>Arrays Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Favorite Movies</h2>
    <p>
        <strong>Task:</strong> 
        Create an indexed array with 5 of your favorite movies. Use a for 
        loop to display each movie with its position (e.g., "Movie 1: 
        The Matrix").
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $movie = ['Scream 1','Scream 2','Fnaf 1','Fnaf 2','Scream 5'];
        echo "<ul>";
        for($i = 0; $i < count($movie); $i++) {
            $movienum = $i+1;
            echo "<li>Movie $movienum: $movie[$i]</li>";
        }
        echo"</ul>";
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Student Record</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array for a student with keys: name, studentId, 
        course, and grade. Display this information in a formatted sentence.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $student = [
            "name" => "Kayleigh Nolan",
            "studentId" => "n00254890",
            "course" => "creative computing",
            "grade" => "b+",
        ];

        echo "<ul>";
         echo "<li> Students name is: {$student['name']} </li>";
         echo "<li> Students Id is: {$student['studentId']} </li>";
         echo "<li> Students course is: {$student['course']}</li>";
         echo "<li> Students grade is: {$student['grade']}</li>";
         echo "</ul>";
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Country Capitals</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array with at least 5 countries as keys and their 
        capitals as values. Use foreach to display each country and capital 
        in the format "The capital of [country] is [capital]."
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $countries = [
            "Ireland" => "Dublin",
            "Germany" => "Berlin",
            "France" => "Paris",
            "Romania" => "Bucharest",
            "Bulgaria" => "Sofia",
        ];

        echo "<ul>";
        foreach($countries as $country => $capital) {
            echo "<li> The capital of $country is $capital";
        }
        echo "<ul>";
        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Menu Categories</h2>
    <p>
        <strong>Task:</strong> 
        Create a nested array representing a restaurant menu with at least 
        2 categories (e.g., "Starters", "Main Course"). Each category should 
        have at least 3 items with prices. Display the menu in an organized 
        format.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $menu = [
            'starters' => [
                'garlic bread' => "6.99",
                'soup' => "5.99",
                'bruschetta' => "8.00",
            ],
            'mains' => [
                'spaghetti bolognaise' => "12.99",
                'Carbonara' => "15.99",
                'Pepperoni pizza' => "14.00",
            ],
            'dessert' => [
                'vanilla icecream' => "4.99",
                'brownie' => "5.00",
                'apple crumble' => "6.99",
            ],
        ];
        echo "<ul>";
        foreach ($menu as $section => $items) {
            echo "($section)";
            echo "</ul>";
            foreach ($items as $meal => $price) {
                echo "<li>$meal ($price)</li>";
            }
            echo"</ul>";
        }
        ?>
    </div>

</body>
</html>
