<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays - PHP Introduction</title>
    <link rel="stylesheet" href="/examples/css/style.css">
    <link rel="stylesheet" href="/examples/css/prism-tomorrow.min.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/exercises/01-php-introduction/03-arrays.php">Go to Exercise &rarr;</a>
    </div>

    <h1>Arrays</h1>

    <!-- Example 1 -->
    <h2>Indexed Arrays</h2>
    <p>Indexed arrays use numeric keys (0, 1, 2, etc.). You can access elements using their index and iterate through them using a for loop with the count() function.</p>
    <pre><code class="language-php">$team = ['Bill', 'Mary', 'Mike', 'Chris', 'Anne'];
echo "&lt;ul&gt;";
for ($i = 0; $i &lt; count($team); $i++) {
    echo "&lt;li&gt;Player $i: $team[$i]&lt;/li&gt;";
}
echo "&lt;/ul&gt;";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $team = ['Bill', 'Mary', 'Mike', 'Chris', 'Anne'];
        echo "<ul>";
        for ($i = 0; $i < count($team); $i++) {
            echo "<li>Player $i: $team[$i]</li>";
        }
        echo "</ul>";
        ?>
    </div>

    <!-- Example 2 -->
    <h2>Associative Arrays</h2>
    <p>Associative arrays use string keys instead of numeric indices. The => operator maps keys to values, allowing you to create structured data.</p>
    <pre><code class="language-php">$book = [
    "title" => "Lord of the Flies",
    "author" => "William Golding",
    "year" => 1954
];

$text = 
    "{$book['title']} was written by {$book['author']}" .
    " and published in {$book['year']}.";

print("&lt;p&gt;$text&lt;/p&gt;");</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $book = [
            "title" => "Lord of the Flies",
            "author" => "William Golding",
            "year" => 1954
        ];

        $text = 
            "{$book['title']} was written by {$book['author']}" .
            " and published in {$book['year']}.";

        print("<p>$text</p>");
        ?>
    </div>

    <!-- Example 3 -->
    <h2>Foreach Statement</h2>
    <p>The foreach loop is the easiest way to iterate through arrays. For associative arrays, you can extract both keys and values using the syntax: foreach ($array as $key => $value).</p>
    <pre><code class="language-php">$famous_books = [
    "Steinbeck" => "East of Eden",
    "Kafka" => "The Metamorphosis",
    "Beckett" => "Waiting for Godot",
    "Dickens" => "A Christmas Carol"
];

echo "&lt;ul&gt;";
foreach ($famous_books as $author => $title) {
    echo "&lt;li&gt;$author wrote $title&lt;/li&gt;";
}
echo "&lt;/ul&gt;";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $famous_books = [
            "Steinbeck" => "East of Eden",
            "Kafka" => "The Metamorphosis",
            "Beckett" => "Waiting for Godot",
            "Dickens" => "A Christmas Carol"
        ];

        echo "<ul>";
        foreach ($famous_books as $author => $title) {
            echo "<li>$author wrote $title</li>";
        }
        echo "</ul>";
        ?>
    </div>

    <!-- Example 4 -->
    <h2>Nested Arrays</h2>
    <p>Arrays can contain other arrays, creating multidimensional structures. Access nested values using multiple square brackets, like $array['key1']['key2'].</p>
    <pre><code class="language-php">$products = [
    'paper' => [
        'copier' => "Copier & Multipurpose",
        'inkjet' => "Inkjet Printer",
        'laser' => "Laser Printer",
        'photo' => "Photographic Paper"
    ],
    'pens' => [
        'ball' => "Ball Point",
        'hilite' => "Highlighters",
        'marker' => "Markers",
    ],
    'misc' => [
        'tape' => "Sticky Tape",
        'glue' => "Adhesives",
        'clips' => "Paperclips",
    ]
];
echo "&lt;p&gt;Our most expensive product is {$products['paper']['photo']}.&lt;/p&gt;";</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        $products = [
            'paper' => [
                'copier' => "Copier & Multipurpose",
                'inkjet' => "Inkjet Printer",
                'laser' => "Laser Printer",
                'photo' => "Photographic Paper"
            ],
            'pens' => [
                'ball' => "Ball Point",
                'hilite' => "Highlighters",
                'marker' => "Markers",
            ],
            'misc' => [
                'tape' => "Sticky Tape",
                'glue' => "Adhesives",
                'clips' => "Paperclips",
            ]
        ];
        echo "<p>Our most expensive product is {$products['paper']['photo']}.</p>";
        ?>
    </div>

    <!-- Example 5 -->
    <h2>Nested Loops</h2>
    <p>To iterate through nested arrays, use nested foreach loops. The outer loop processes the main array, and the inner loop processes each sub-array.</p>
    <pre><code class="language-php">foreach ($products as $section => $items) {
    echo "&lt;p&gt;" . ucfirst($section) . " products:&lt;/p&gt;";
    echo "&lt;ul&gt;";
    foreach ($items as $key => $value) {
        echo "&lt;li&gt;$key\t($value)&lt;/li&gt;";
    }
    echo "&lt;/ul&gt;";
}</code></pre>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        foreach ($products as $section => $items) {
            echo "<p>" . ucfirst($section) . " products:</p>";
            echo "<ul>";
            foreach ($items as $key => $value) {
                echo "<li>$key\t($value)</li>";
            }
            echo "</ul>";
        }
        ?>
    </div>

    <script src="/examples/js/prism-core.min.js"></script>
    <script src="/examples/js/prism-autoloader.min.js" data-autoloader-path="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/"></script>
</body>
</html>
