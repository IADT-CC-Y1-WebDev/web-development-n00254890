<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Globals - PHP Introduction</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/exercises/01-php-introduction/04-super-globals.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Super Globals</h1>

    <!-- Example 1 -->
    <h2>$_SERVER</h2>
    <p>$_SERVER is a superglobal array containing server and execution environment information, such as headers, paths, and script locations.</p>
    <pre><code class="language-php">print('$_SERVER = ');
print_r($_SERVER);</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <pre><?php
        print('$_SERVER = ');
        print_r($_SERVER);
        ?></pre>
    </div>

    <!-- Example 2 -->
    <h2>$_GET</h2>
    <p>$_GET contains variables passed to the script via URL parameters (query strings). For example, page.php?name=John would populate $_GET['name'].</p>
    <pre><code class="language-php">print('$_GET = ');
print_r($_GET);</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <pre><?php
        print('$_GET = ');
        print_r($_GET);
        ?></pre>
    </div>

    <!-- Example 3 -->
    <h2>$_POST</h2>
    <p>$_POST contains variables passed to the script via HTTP POST method, typically from HTML forms. Data sent via POST is not visible in the URL.</p>
    <pre><code class="language-php">print('$_POST = ');
print_r($_POST);</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <pre><?php
        print('$_POST = ');
        print_r($_POST);
        ?></pre>
    </div>

    <!-- Example 4 -->
    <h2>$_COOKIE</h2>
    <p>$_COOKIE contains variables passed to the script via HTTP cookies, which are small pieces of data stored on the client's browser.</p>
    <pre><code class="language-php">print('$_COOKIE = ');
print_r($_COOKIE);</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <pre><?php
        print('$_COOKIE = ');
        print_r($_COOKIE);
        ?></pre>
    </div>

    <!-- Example 5 -->
    <h2>$_REQUEST</h2>
    <p>$_REQUEST contains a combination of $_GET, $_POST, and $_COOKIE. It's useful when you don't care about the source of the data, though using the specific arrays is generally preferred.</p>
    <pre><code class="language-php">print('$_REQUEST = ');
print_r($_REQUEST);</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <pre><?php
        print('$_REQUEST = ');
        print_r($_REQUEST);
        ?></pre>
    </div>

    <!-- Example 6 -->
    <h2>$_SESSION</h2>
    <p>$_SESSION stores variables that persist across multiple page requests for the same user session. Session data is stored on the server and must be started with session_start().</p>
    <pre><code class="language-php">print('$_SESSION = ');
print_r($_SESSION);</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <pre><?php
        print('$_SESSION = ');
        print_r($_SESSION);
        ?></pre>
    </div>

    <!-- Example 7 -->
    <h2>$_FILES</h2>
    <p>$_FILES contains information about files uploaded via HTTP POST file uploads. It includes details like file name, size, type, and temporary location.</p>
    <pre><code class="language-php">print('$_FILES = ');
print_r($_FILES);</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <pre><?php
        print('$_FILES = ');
        print_r($_FILES);
        ?></pre>
    </div>

    <!-- Example 8 -->
    <h2>$_ENV</h2>
    <p>$_ENV contains environment variables passed to the current script from the server environment. These are set by the operating system or web server.</p>
    <pre><code class="language-php">print('$_ENV = ');
print_r($_ENV);</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <pre><?php
        print('$_ENV = ');
        print_r($_ENV);
        ?></pre>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
