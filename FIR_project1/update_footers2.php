<?php
$files = glob("*.php");
$footerTemplate = file_get_contents("footer_template.txt");

foreach ($files as $file) {
    if ($file == "register.php") continue;
    
    $content = file_get_contents($file);
    // Find existing footer in this file, handling possible invalid closing tags like </section style="...">
    $replaced = preg_replace('/<section class="footer">.*?<\/section(?:\s+[^>]*?)?>/is', $footerTemplate, $content, -1, $count);
    
    if ($count > 0 && $replaced !== null) {
        file_put_contents($file, $replaced);
        echo "Updated $file\n";
    }
}
?>
