<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libraries - PHP Introduction</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/exercises/01-php-introduction/07-require.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Libraries</h1>

    <div style="background-color: #f5f5f5; padding: 15px; margin-bottom: 30px; border-radius: 5px;">
        <h3>Reference Files</h3>
        
        <h4>inc/header.php</h4>
        <pre><code class="language-php">&lt;div class="page-header"&gt;
    &lt;h3&gt;Welcome to Our Website&lt;/h3&gt;
    &lt;p&gt;This header is included from inc/header.php&lt;/p&gt;
&lt;/div&gt;</code></pre>

        <h4>inc/footer.php</h4>
        <pre><code class="language-php">&lt;div class="page-footer"&gt;
    &lt;p&gt;&amp;copy; &lt;?php echo date('Y'); ?&gt; - This footer is included from inc/footer.php&lt;/p&gt;
&lt;/div&gt;</code></pre>

        <h4>lib/math_functions.php</h4>
        <pre><code class="language-php">&lt;?php
function add($a, $b) {
    return $a + $b;
}

function multiply($a, $b) {
    return $a * $b;
}

function power($base, $exponent) {
    return pow($base, $exponent);
}
?&gt;</code></pre>

        <h4>lib/string_functions.php</h4>
        <pre><code class="language-php">&lt;?php
function shout($text) {
    return strtoupper($text) . "!";
}

function whisper($text) {
    return strtolower($text) . "...";
}

function reverse_text($text) {
    return strrev($text);
}
?&gt;</code></pre>
    </div>

    <!-- Example 1 -->
    <h2>Using require for Output Snippets</h2>
    <p>Use require to include files that generate output (like HTML snippets). The file is included and executed each time require is called, making it useful for reusable page sections.</p>
    <pre><code class="language-php">// Include header snippet
require 'inc/header.php';

echo "&lt;p&gt;This is the main content.&lt;/p&gt;";

// Include footer snippet
require 'inc/footer.php';</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // Include header snippet
        require 'inc/header.php';

        echo "<p>This is the main content.</p>";

        // Include footer snippet
        require 'inc/footer.php';
        ?>
    </div>

    <!-- Example 2 -->
    <h2>Using require_once for Function Libraries</h2>
    <p>Use require_once for files containing function definitions or classes. It ensures the file is only included once, preventing "function already declared" errors if the same file is required multiple times.</p>
    <pre><code class="language-php">// Import math functions library
require_once 'lib/math_functions.php';

$sum = add(5, 3);
$product = multiply(4, 7);
$result = power(2, 8);

echo "&lt;p&gt;5 + 3 = $sum&lt;/p&gt;";
echo "&lt;p&gt;4 × 7 = $product&lt;/p&gt;";
echo "&lt;p&gt;2^8 = $result&lt;/p&gt;";

// Calling require_once again has no effect
require_once 'lib/math_functions.php';</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // Import math functions library
        require_once 'lib/math_functions.php';

        $sum = add(5, 3);
        $product = multiply(4, 7);
        $result = power(2, 8);

        echo "<p>5 + 3 = $sum</p>";
        echo "<p>4 × 7 = $product</p>";
        echo "<p>2^8 = $result</p>";

        // Calling require_once again has no effect
        require_once 'lib/math_functions.php';
        ?>
    </div>

    <!-- Example 3 -->
    <h2>Multiple Library Files</h2>
    <p>You can import multiple library files to access all their functions in your code. Each require_once ensures the library is loaded exactly once.</p>
    <pre><code class="language-php">// Import multiple function libraries
require_once 'lib/math_functions.php';
require_once 'lib/string_functions.php';

$calculation = multiply(3, 4);
$message = shout("hello world");
$quiet = whisper("GOODBYE");

echo "&lt;p&gt;3 × 4 = $calculation&lt;/p&gt;";
echo "&lt;p&gt;Shouting: $message&lt;/p&gt;";
echo "&lt;p&gt;Whispering: $quiet&lt;/p&gt;";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // Import multiple function libraries
        require_once 'lib/string_functions.php';

        $calculation = multiply(3, 4);
        $message = shout("hello world");
        $quiet = whisper("GOODBYE");

        echo "<p>3 × 4 = $calculation</p>";
        echo "<p>Shouting: $message</p>";
        echo "<p>Whispering: $quiet</p>";
        ?>
    </div>

    <!-- Example 4 -->
    <h2>Difference: require vs require_once</h2>
    <p>require includes a file every time it's called (potentially multiple times), while require_once includes it only once. This demonstrates why require is suitable for output snippets (like headers) but require_once is better for function libraries.</p>
    <pre><code class="language-php">// require can include a file multiple times
require 'inc/header.php';
require 'inc/header.php'; // Included again!

echo "&lt;p&gt;Content between headers&lt;/p&gt;";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // require can include a file multiple times
        require 'inc/header.php';
        require 'inc/header.php'; // Included again!

        echo "<p>Content between headers</p>";
        ?>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
