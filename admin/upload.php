<?php
include('../connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the radio button value is set
    if (isset($_POST['top-ranker'])) {
        $topRanker = $_POST['top-ranker'];
        
        // Set top_ranker value based on the selected radio button
        if ($topRanker === 'yes') {
            $top_ranker = "Yes";
        } elseif ($topRanker === 'no') {
            $top_ranker = "No";
        }
    } else {
        $top_ranker = "No"; // Default value if not selected
    }

    // Get form data
    $name = $_POST['name'];
    $rank = $_POST['rank'];
    $stream = $_POST['stream'];
    $exam = $_POST['exam'];
    $year = $_POST['year'];
    $reg = $_POST['reg'];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a valid image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // If everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($_FILES["photo"]["name"])). " has been uploaded.";

            // Insert data into database
            if($exam == "JEE Mains" || $exam == "JEE Advanced"){
                $sql = "INSERT INTO eng_result (name, photo, rank, stream, exam, year, top_ranker, reg)
                VALUES ('$name', '$target_file', '$rank', '$stream', '$exam', '$year', '$top_ranker', '$reg')";
                //eng
            } else if ($exam == "NEET UG") {
                $sql = "INSERT INTO medical_result (name, photo, rank, stream, exam, year, top_ranker, reg)
                VALUES ('$name', '$target_file', '$rank', '$stream', '$exam', '$year', '$top_ranker', '$reg')";
            } else if($exam == "NTSE") {
                $sql = "INSERT INTO ntse_result (name, photo, rank, stream, exam, year, top_ranker, reg)
                VALUES ('$name', '$target_file', '$rank', '$stream', '$exam', '$year', '$top_ranker', '$reg')";

            } else {
                // Board
                $sql = "INSERT INTO board_result (name, photo, rank, stream, exam, year, top_ranker, reg)
                VALUES ('$name', '$target_file', '$rank', '$stream', '$exam', '$year', '$top_ranker', '$reg')";
            }

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
                echo "<script language='javascript' type='text/javascript'>
                    alert('New record created successfully');
                    window.location = '../index.php';
                </script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                echo "<script language='javascript' type='text/javascript'>
                    alert('New record creation failed');
                    window.location = '../index.php';
                </script>";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
            echo "<script language='javascript' type='text/javascript'>
                alert('File upload failed');
                window.location = '../index.php';
            </script>";
        }
    }

    $conn->close();
}
?>
