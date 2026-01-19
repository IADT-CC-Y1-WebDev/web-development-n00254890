<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scope - PHP Introduction</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/exercises/01-php-introduction/06-scope.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Scope</h1>

    <!-- Example 1 -->
    <h2>Local Scope</h2>
    <p>Variables declared inside a function have local scope and can only be accessed within that function. They don't exist outside the function.</p>
    <pre><code class="language-php">function test_local() {
    $x = 5; // local variable
    echo "&lt;p&gt;Inside function: x = $x&lt;/p&gt;";
}

test_local();
// echo $x; // This would cause an error - $x not defined here</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        function test_local() {
            $x = 5; // local variable
            echo "<p>Inside function: x = $x</p>";
        }

        test_local();
        // echo $x; // This would cause an error - $x not defined here
        ?>
    </div>

    <!-- Example 2 -->
    <h2>Global Scope</h2>
    <p>Variables declared outside functions have global scope. To access global variables inside a function, you must use the global keyword.</p>
    <pre><code class="language-php">$count = 0; // global variable

function increment() {
    global $count; // access global variable
    $count++;
    echo "&lt;p&gt;Count is now: $count&lt;/p&gt;";
}

increment();
increment();
increment();
echo "&lt;p&gt;Final count: $count&lt;/p&gt;";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $count = 0; // global variable

        function increment() {
            global $count; // access global variable
            $count++;
            echo "<p>Count is now: $count</p>";
        }

        increment();
        increment();
        increment();
        echo "<p>Final count: $count</p>";
        ?>
    </div>

    <!-- Example 3 -->
    <h2>Static Variables</h2>
    <p>Static variables maintain their value between function calls. Unlike regular local variables which are destroyed when the function ends, static variables persist.</p>
    <pre><code class="language-php">function page_views() {
    static $views = 0; // retains value between calls
    $views++;
    echo "&lt;p&gt;This page has been viewed $views time(s)&lt;/p&gt;";
}

page_views();
page_views();
page_views();</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        function page_views() {
            static $views = 0; // retains value between calls
            $views++;
            echo "<p>This page has been viewed $views time(s)</p>";
        }

        page_views();
        page_views();
        page_views();
        ?>
    </div>

    <!-- Example 4 -->
    <h2>Parameter Scope</h2>
    <p>Function parameters are local to the function. Even if a parameter has the same name as a global variable, they are separate entities (the parameter "shadows" the global).</p>
    <pre><code class="language-php">$message = "Hello";

function greet($message) {
    // $message parameter is local, shadows global
    echo "&lt;p&gt;Inside function: $message&lt;/p&gt;";
    $message = "Modified";
    echo "&lt;p&gt;Changed to: $message&lt;/p&gt;";
}

greet("Hi there");
echo "&lt;p&gt;Outside function: $message&lt;/p&gt;";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $message = "Hello";

        function greet($message) {
            // $message parameter is local, shadows global
            echo "<p>Inside function: $message</p>";
            $message = "Modified";
            echo "<p>Changed to: $message</p>";
        }

        greet("Hi there");
        echo "<p>Outside function: $message</p>";
        ?>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
