<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Result</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to the CSS file -->
</head>
<body>

<style>
    /* Basic reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
    display: flex;
    justify-content: center;
    align-items: center;
}

.container {
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 100%;
    max-width: 600px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
    font-size: 2rem;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #555;
}

input[type="text"],
input[type="number"],
input[type="file"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s, box-shadow 0.3s;
}

input[type="text"]:focus,
input[type="number"]:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    outline: none;
}

input[type="file"] {
    padding: 6px;
}

fieldset {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    margin: 10px 0;
    background: #f9f9f9;
}

legend {
    padding: 0 10px;
    font-weight: 600;
    font-size: 1.1rem;
    color: #333;
}

label input[type="radio"] {
    margin-right: 8px;
}

input[type="submit"] {
    background-color: #007bff;
    color: #ffffff;
    border: none;
    padding: 12px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s, transform 0.3s;
}

input[type="submit"]:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

input[type="submit"]:active {
    background-color: #004494;
    transform: scale(1);
}

</style>

<div class="container" style="    margin-top: 20px;
    margin-bottom: 20px;">
    <h1>Upload Result</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="rank">Rank:</label>
            <input type="text" id="rank" name="rank" required>
        </div>

        <div class="form-group">
            <label for="stream">Stream:</label>
            <input type="text" id="stream" name="stream" required>
        </div>
        
        <div class="form-group">
            <label for="reg">Reg No.:</label>
            <input type="number" id="reg" name="reg" required>
        </div>

        <div class="form-group">
            <label for="exam">Exam:</label>
            <select id="exam" name="exam" required style="
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
">
                <option value="" disabled selected>Select an exam</option>
                <option value="JEE Mains">JEE Mains</option>
                <option value="JEE Advanced">JEE Advanced</option>
                <option value="NEET UG">NEET UG</option>
                <option value="NTSE">NTSE</option>
                <option value="Board">Board</option>
                <!-- Add more options as needed -->
            </select>
        </div>

        <div class="form-group">
            <label for="year">Year:</label>
            <input type="number" id="year" name="year" min="2000" max="2099" required>
        </div>

        <fieldset class="form-group">
            <legend>Is the student a top ranker?</legend>
            <label for="top-ranker-yes">
                <input type="radio" id="top-ranker-yes" name="top-ranker" value="yes">
                Yes
            </label>
            <label for="top-ranker-no">
                <input type="radio" id="top-ranker-no" name="top-ranker" value="no">
                No
            </label>
        </fieldset>

        <input type="submit" value="Submit" class="submit-btn" id="submit">
    </form>
</div>

</body>
</html>
