<?php

function loadEnv($file = '.env')
{
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            // Ignore comments (lines starting with #)
            if (strpos(trim($line), '#') === 0) {
                continue;
            }
            // Split the line at the first '=' to separate key and value
            list($key, $value) = explode('=', $line, 2);
            // Trim spaces around key and value
            $key = trim($key);
            $value = trim($value);
            // Set the environment variable
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}
