<?php
    foreach(glob('./classes/*.php') as $file)
    {
        require_once $file; ///Include all PHP classes
    }

    $controllers = new Controllers(); //Instantiate controllers

    function redirect($page, array $params = [])
    {
        $qs = $params ? '?' . http_build_query($params) : '';
        header("Location:$page.php" . $qs);
        exit;
    }

    // Generates a UUID for the image filenames. The chances of a duplicate filename being used are 1 in 2.71x10^18
    function guidv4($data = null) {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
    
        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
?>