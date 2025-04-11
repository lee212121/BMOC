<?php
session_start();
session_destroy();            // 3. Destroy the session
header("Location: index.php"); // 4. Redirect to login or home page
exit;
?>
