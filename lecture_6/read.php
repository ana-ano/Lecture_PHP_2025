<div>
    <?php
        $file = $_GET['read'];
        $f = fopen($file, 'r');
        // $content = fread($f, filesize($file));
        while(!feof($f)) {
            // echo fgets($f) . "<br>";
            echo fgetc($f) . "<br>";
        }
        fclose($f);
    ?>
</div>
