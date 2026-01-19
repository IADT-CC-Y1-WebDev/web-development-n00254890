<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statements - PHP Introduction</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/exercises/01-php-introduction/02-statements.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Statements</h1>

    <!-- Example 1 -->
    <h2>If Statement</h2>
    <p>The if/else statement allows you to execute different code blocks based on conditions. You can chain multiple conditions using else if.</p>
    <pre><code class="language-php">$widgets = rand(0, 20);
echo "&lt;p&gt;We have $widgets widgets in stock.&lt;/p&gt;";
if ($widgets &gt; 10) {
    echo "&lt;p&gt;We have plenty of widgets in stock.&lt;/p&gt;";
}
else if ($widgets &gt; 5 and $widgets &lt;= 10) {
    echo "&lt;p&gt;We are running low on widgets, time to order some more.&lt;/p&gt;";
}
else if ($widgets &lt;= 5) {
    echo "&lt;p&gt;We are nearly out of widgets, ORDER MORE NOW!!.&lt;/p&gt;";
}</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $widgets = rand(0, 20);
        echo "<p>We have $widgets widgets in stock.</p>";
        if ($widgets > 10) {
            echo "<p>We have plenty of widgets in stock.</p>";
        }
        else if ($widgets > 5 and $widgets <= 10) {
            echo "<p>We are running low on widgets, time to order some more.</p>";
        }
        else if ($widgets <= 5) {
            echo "<p>We are nearly out of widgets, ORDER MORE NOW!!.</p>";
        }
        ?>
    </div>

    <!-- Example 2 -->
    <h2>Switch Statement</h2>
    <p>The switch statement provides an alternative to if/else chains. When using switch(true), you can evaluate boolean expressions in each case, similar to if/else.</p>
    <pre><code class="language-php">$widgets = rand(0, 20);
echo "&lt;p&gt;We have $widgets widgets in stock.&lt;/p&gt;";
switch (true) {
    case ($widgets &gt; 10):
        echo "&lt;p&gt;We have plenty of widgets in stock.&lt;/p&gt;";
        break;
    case ($widgets &gt; 5):
        echo "&lt;p&gt;We are running low on widgets, time to order some more.&lt;/p&gt;";
        break;
    default:
        echo "&lt;p&gt;We are nearly out of widgets, ORDER MORE NOW!!.&lt;/p&gt;";
        break;
}</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $widgets = rand(0, 20);
        echo "<p>We have $widgets widgets in stock.</p>";
        switch (true) {
            case ($widgets > 10):
                echo "<p>We have plenty of widgets in stock.</p>";
                break;
            case ($widgets > 5):
                echo "<p>We are running low on widgets, time to order some more.</p>";
                break;
            default:
                echo "<p>We are nearly out of widgets, ORDER MORE NOW!!.</p>";
                break;
        }
        ?>
    </div>

    <!-- Example 3 -->
    <h2>While Statement</h2>
    <p>The while loop continues executing as long as its condition is true. It's useful when you don't know in advance how many iterations you'll need.</p>
    <pre><code class="language-php">$widgets = rand(0, 10);
echo "&lt;p&gt;We have $widgets widgets in stock.&lt;/p&gt;";
while ($widgets &gt; 0) {
    echo "&lt;p&gt;Selling a widget...";
    $widgets = $widgets - 1;
    echo "...done. There are $widgets left in stock&lt;/p&gt;";
}
echo "&lt;p&gt;We are right out of widgets!!&lt;/p&gt;";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $widgets = rand(0, 10);
        echo "<p>We have $widgets widgets in stock.</p>";
        while ($widgets > 0) {
            echo "<p>Selling a widget...";
            $widgets = $widgets - 1;
            echo "...done. There are $widgets left in stock</p>";
        }
        echo "<p>We are right out of widgets!!</p>";
        ?>
    </div>

    <!-- Example 4 -->
    <h2>For Statement</h2>
    <p>The for loop is ideal when you know exactly how many times you want to iterate. It consists of initialization, condition, and increment expressions.</p>
    <pre><code class="language-php">$widgets = rand(0, 10);
echo "&lt;p&gt;We have $widgets widgets in stock.&lt;/p&gt;";
for ($i = 0; $i &lt; 4; $i++) {
    $widgets = $widgets + 10;
    echo "&lt;p&gt;We have received a delivery of 10 widgets.&lt;/p&gt;";
}
echo "&lt;p&gt;We have $widgets widgets in stock.&lt;/p&gt;";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $widgets = rand(0, 10);
        echo "<p>We have $widgets widgets in stock.</p>";
        for ($i = 0; $i < 4; $i++) {
            $widgets = $widgets + 10;
            echo "<p>We have received a delivery of 10 widgets.</p>";
        }
        echo "<p>We have $widgets widgets in stock.</p>";
        ?>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
