<?php $filename = 'messages.csv'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>[Your Name]'s Freedom Board</title>
	<link rel="stylesheet" href="style.css"/>

</head>
<body>
    <h1>Freedom Board</h1>

    <!-- Action points to the processing file -->
	<!-- Note that when the form gets submitted, the form data
			is processed by post_message.php.
	-->
	<!-- TODO: Task 1 - Ensure that the form is submitted
				using the POST method. The message and the name of the
				poster must be available via $_POST["name"] and
				$_POST["message"] at the server side.
	-->
    <form action="post_message.php" method=post>
        <input type="text" name="name" placeholder="Your Name" required ><br><br>
        <textarea name="message" placeholder="Write a message..." required ></textarea><br><br>
        <button type="submit">Post to Board</button>
    </form>

    <hr>
    <h2>Recent Messages</h2>
    <?php
    if (file_exists($filename)) {
        $file = fopen($filename, 'r');
        $rows = [];
        // added parameters such as delimiters to avoid display of error on the website
        while (($row = fgetcsv($file, 0, ',', '"', '\\')) !== FALSE) {
            $rows[] = $row;
        }
        fclose($file);
        // sort rows by timestamp (newest first)
        // takes an array and a user-defined "anonymous" comparison function
        usort($rows, function($a, $b) {
            return strtotime($b[2]) - strtotime($a[2]);
        });
        // Loop through each row of the CSV to display it (newest first)
        foreach ($rows as $row) {
            // $row[0] = Name, $row[1] = Message, $row[2] = Timestamp
            echo "<div class='post'>";
            echo "<strong>" . htmlspecialchars($row[0]) . "</strong>: " . htmlspecialchars($row[1]);
            echo "<div class='meta'>Posted on: " . $row[2] . "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No messages yet. Be the first to post!</p>";
    }
    ?>
</body>
</html>
