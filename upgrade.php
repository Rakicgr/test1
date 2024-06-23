<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codeChanges = $_POST['codeChanges'];
    
    // Parse the changes and apply them to the files
    $lines = explode("\n", $codeChanges);
    $mode = '';
    $filename = '';
    $location = '';
    $content = '';
    
    foreach ($lines as $line) {
        if (strpos($line, '# ADD TO') !== false) {
            $mode = 'ADD';
            preg_match('/# ADD TO (.*) AT (.*)/', $line, $matches);
            $filename = trim($matches[1]);
            $location = trim($matches[2]);
        } elseif (strpos($line, '# REMOVE FROM') !== false) {
            $mode = 'REMOVE';
            preg_match('/# REMOVE FROM (.*) AT (.*)/', $line, $matches);
            $filename = trim($matches[1]);
            $location = trim($matches[2]);
        } elseif (strpos($line, '# REPLACE IN') !== false) {
            $mode = 'REPLACE';
            preg_match('/# REPLACE IN (.*) AT (.*)/', $line, $matches);
            $filename = trim($matches[1]);
            $location = trim($matches[2]);
        } elseif (strpos($line, '# END ADD') !== false || strpos($line, '# END REMOVE') !== false || strpos($line, '# END REPLACE') !== false) {
            if ($mode == 'ADD') {
                addToFile($filename, $location, $content);
            } elseif ($mode == 'REMOVE') {
                removeFromFile($filename, $location, $content);
            } elseif ($mode == 'REPLACE') {
                replaceInFile($filename, $location, $content);
            }
            $mode = '';
            $filename = '';
            $location = '';
            $content = '';
        } else {
            if ($mode != '') {
                $content .= $line . "\n";
            }
        }
    }
}

function addToFile($filename, $location, $content) {
    $file = file_get_contents($filename);
    $newContent = str_replace($location, $location . "\n" . $content, $file);
    file_put_contents($filename, $newContent);
}

function removeFromFile($filename, $location, $content) {
    $file = file_get_contents($filename);
    $newContent = str_replace($content, '', $file);
    file_put_contents($filename, $newContent);
}

function replaceInFile($filename, $location, $content) {
    $file = file_get_contents($filename);
    $newContent = str_replace($location, $content, $file);
    file_put_contents($filename, $newContent);
}
?>
