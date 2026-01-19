<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables - PHP Introduction</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/exercises/01-php-introduction/01-variables.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Variables</h1>

    <!-- Example 1 -->
    <h2>String Variables</h2>
    <p>Variables in PHP start with the $ symbol. Strings can be enclosed in double quotes, and variables inside double quotes are interpolated (their values are inserted into the string).</p>
    <pre><code class="language-php">$name = "Alice";
$greeting = "Hello, $name!";
echo $greeting;</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $name = "Alice";
        $greeting = "Hello, $name!";
        echo $greeting;
        ?>
    </div>

    <!-- Example 2 -->
    <h2>Numeric Variables</h2>
    <p>PHP supports both integers and floating-point numbers. You can perform arithmetic operations directly on numeric variables.</p>
    <pre><code class="language-php">$price = 19.99;
$quantity = 3;
$total = $price * $quantity;
echo "Total: &euro;$total";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $price = 19.99;
        $quantity = 3;
        $total = $price * $quantity;
        echo "Total: &euro;$total";
        ?>
    </div>

    <!-- Example 3 -->
    <h2>Boolean Variables</h2>
    <p>Boolean variables can hold either true or false. They are useful for conditional logic. The ternary operator (? :) provides a shorthand for if/else statements.</p>
    <pre><code class="language-php">$isLoggedIn = true;
$isAdmin = false;

echo "Logged in: " . ($isLoggedIn ? "Yes" : "No") . "&lt;br&gt;";
echo "Admin: " . ($isAdmin ? "Yes" : "No");</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $isLoggedIn = true;
        $isAdmin = false;

        echo "Logged in: " . ($isLoggedIn ? "Yes" : "No") . "<br>";
        echo "Admin: " . ($isAdmin ? "Yes" : "No");
        ?>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
