<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Extensions - PHP Introduction</title>
    <link rel="stylesheet" href="/examples/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
    </div>

    <h1>File Extensions</h1>

    <h2>Why Extensions Matter</h2>
    <p>The three files below contain <strong>exactly the same content</strong>:</p>

    <pre><code>&lt;html&gt;
    &lt;head&gt;
        &lt;title&gt;Hello world!&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;p&gt;Hello world!&lt;/p&gt;
        &lt;?php
            echo "Hi, I am a PHP script!";
        ?&gt;
    &lt;/body&gt;
&lt;/html&gt;</code></pre>

    <p>Click each link and observe how the browser displays them differently:</p>

    <h2>The Files</h2>
    <ul class="example-list">
        <li><a href="ext/hello.txt">hello.txt</a></li>
        <li><a href="ext/hello.html">hello.html</a></li>
        <li><a href="ext/hello.php">hello.php</a></li>
    </ul>

    <h2>What You Should Observe</h2>

    <h3>.txt (Plain Text)</h3>
    <p>The browser displays the <strong>raw content</strong> exactly as written, including all the HTML tags and PHP code. No interpretation happens.</p>

    <h3>.html (HTML)</h3>
    <p>The browser <strong>interprets the HTML</strong> and renders the page structure. However, the PHP code is <strong>not executed</strong> &mdash; it appears as visible text on the page because the web server doesn't process PHP in .html files.</p>

    <h3>.php (PHP)</h3>
    <p>The web server <strong>executes the PHP code</strong> before sending the response. The <code>&lt;?php ... ?&gt;</code> block is replaced with its output ("Hi, I am a PHP script!"). The browser then renders the resulting HTML.</p>

    <h2>Key Takeaway</h2>
    <p>The file extension tells the web server <strong>how to process the file</strong>:</p>
    <ul>
        <li><strong>.txt</strong> &rarr; Serve as plain text (no processing)</li>
        <li><strong>.html</strong> &rarr; Serve as HTML (browser renders, no server-side processing)</li>
        <li><strong>.php</strong> &rarr; Execute PHP code first, then serve the result as HTML</li>
    </ul>

</body>
</html>
