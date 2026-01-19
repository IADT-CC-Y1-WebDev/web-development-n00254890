<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions - PHP Introduction</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/exercises/01-php-introduction/05-functions.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Functions</h1>

    <!-- Example 1 -->
    <h2>Predefined Functions</h2>
    <p>PHP comes with thousands of built-in functions like sqrt(), strlen(), date(), etc. You can use them directly without defining them yourself.</p>
    <pre><code class="language-php">echo "&lt;p&gt;The square root of 16 is ". sqrt(16) . "&lt;/p&gt;";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        echo "<p>The square root of 16 is ". sqrt(16) . "</p>";
        ?>
    </div>

    <!-- Example 2 -->
    <h2>Defining Functions</h2>
    <p>You can create your own functions using the function keyword. Once defined, you can call the function by name to execute its code.</p>
    <pre><code class="language-php">function hello() {
    echo "&lt;p&gt;Hello world!&lt;/p&gt;";
}

hello();</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        function hello() {
            echo "<p>Hello world!</p>";
        }

        hello();
        ?>
    </div>

    <!-- Example 3 -->
    <h2>Function Parameters</h2>
    <p>Functions can accept parameters (inputs) that allow you to pass data into the function. Parameters are specified in parentheses after the function name.</p>
    <pre><code class="language-php">function goodbye($name) {
    echo "&lt;p&gt;Goodbye $name!&lt;/p&gt;";
}

goodbye("Jim");
goodbye("Sam");
goodbye("Jane");</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        function goodbye($name) {
            echo "<p>Goodbye $name!</p>";
        }

        goodbye("Jim");
        goodbye("Sam");
        goodbye("Jane");
        ?>
    </div>

    <!-- Example 4 -->
    <h2>Default Parameter Values</h2>
    <p>You can assign default values to parameters. If no argument is provided when calling the function, the default value is used instead.</p>
    <pre><code class="language-php">function happy_birthday($name, $language="en") {
    if ($language === "en") {
        echo "&lt;p&gt;Happy birthday, $name!&lt;/p&gt;";
    }
    else if ($language === "ga") {
        echo "&lt;p&gt;Lá breithe shona, $name!&lt;/p&gt;";
    }
    else if ($language === "fr") {
        echo "&lt;p&gt;Joyeux anniversaire, $name!&lt;/p&gt;";
    }
    else if ($language === "sp") {
        echo "&lt;p&gt;Feliz cumpleaños, $name!&lt;/p&gt;";
    }
    else {
        echo "&lt;p&gt;Beatus natalis, $name!&lt;/p&gt;";
    }
}

happy_birthday("Jim", "fr");
happy_birthday("Sam", "ga");
happy_birthday("Jane");
happy_birthday("Dara", "??");</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        function happy_birthday($name, $language="en") {
            if ($language === "en") {
                echo "<p>Happy birthday, $name!</p>";
            }
            else if ($language === "ga") {
                echo "<p>Lá breithe shona, $name!</p>";
            }
            else if ($language === "fr") {
                echo "<p>Joyeux anniversaire, $name!</p>";
            }
            else if ($language === "sp") {
                echo "<p>Feliz cumpleaños, $name!</p>";
            }
            else {
                echo "<p>Beatus natalis, $name!</p>";
            }
        }

        happy_birthday("Jim", "fr");
        happy_birthday("Sam", "ga");
        happy_birthday("Jane");
        happy_birthday("Dara", "??");
        ?>
    </div>

    <!-- Example 5 -->
    <h2>Returning Values</h2>
    <p>Functions can return values using the return statement. The returned value can be assigned to a variable or used directly in expressions.</p>
    <pre><code class="language-php">function format($author, $title, $year) {
    return "&lt;p&gt;$author wrote $title. It was published in $year.&lt;/p&gt;";
}

echo format("Steinbeck", "East of Eden", 1952);
echo format("Kafka", "Metamorphosis", 1954);
echo format("Beckett", "Waiting for Godot", 1954);
echo format("Dickens", "A Christmas Carol", 1843);</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        function format($author, $title, $year) {
            return "<p>$author wrote $title. It was published in $year.</p>";
        }

        echo format("Steinbeck", "East of Eden", 1952);
        echo format("Kafka", "Metamorphosis", 1954);
        echo format("Beckett", "Waiting for Godot", 1954);
        echo format("Dickens", "A Christmas Carol", 1843);
        ?>
    </div>

    <!-- Example 6 -->
    <h2>Returning Multiple Values</h2>
    <p>Functions can return multiple values by returning an array. You can use array destructuring with square brackets to assign each returned value to a separate variable.</p>
    <pre><code class="language-php">function calculate($number1, $number2) {
    $add = $number1 + $number2;
    $subtract = $number1 - $number2;
    $multiply = $number1 * $number2;

    return [$add, $subtract, $multiply];
}

$first = 8;
$second = 5;
[$sum, $difference, $product] = calculate($first, $second);

echo "&lt;p&gt;The sum of $first and $second is $sum.&lt;/p&gt;";
echo "&lt;p&gt;The difference of $first and $second is $difference.&lt;/p&gt;";
echo "&lt;p&gt;The product of $first and $second is $product.&lt;/p&gt;";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        function calculate($number1, $number2) {
            $add = $number1 + $number2;
            $subtract = $number1 - $number2;
            $multiply = $number1 * $number2;

            return [$add, $subtract, $multiply];
        }

        $first = 8;
        $second = 5;
        [$sum, $difference, $product] = calculate($first, $second);

        echo "<p>The sum of $first and $second is $sum.</p>";
        echo "<p>The difference of $first and $second is $difference.</p>";
        echo "<p>The product of $first and $second is $product.</p>";
        ?>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
