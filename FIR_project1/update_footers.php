<?php
$files = glob("*.php");
$registerTemplate = file_get_contents("register.php");

// Extract the footer section from register.php exactly
preg_match('/<section class="footer">.*?(?:<\/section>\s*<section.*?>|<\/section>)/is', $registerTemplate, $matches);
if (count($matches) > 0) {
    $footerHtml = $matches[0];
    
    // Sometimes there's an extra section tag match if we use lazy matching incorrectly, let's refine
    preg_match('/<section class="footer">.*?<\/div>\s*<\/section>/is', $registerTemplate, $exactMatch);
    if (count($exactMatch) > 0) {
        $footerHtml = $exactMatch[0];
        echo "Found register footer template! Length: " . strlen($footerHtml) . "\n";
        
        foreach ($files as $file) {
            if ($file == "register.php") continue;
            
            $content = file_get_contents($file);
            // Find existing footer in this file
            $replaced = preg_replace('/<section class="footer">.*?<\/div>\s*<\/section>/is', $footerHtml, $content, -1, $count);
            
            if ($count > 0 && $replaced !== null) {
                file_put_contents($file, $replaced);
                echo "Updated $file\n";
            }
        }
    } else {
        echo "Could not exact match footer inside register.php\n";
    }
} else {
    echo "Could not extract footer from register.php\n";
}
?>
