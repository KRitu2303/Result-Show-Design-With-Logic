<!DOCTYPE html>
<html lang="zxx">
  <head>
    <!-- meta tag -->
    <meta charset="utf-8" />
    <title>Engineering Result</title>
    <meta name="description" content="" />
    <!-- responsive tag -->
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- favicon -->
    <link rel="apple-touch-icon" href="assets/images/bg/favicon.jpg" />
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="assets/images/bg/favicon.jpg"
    />
    <!-- Bootstrap v4.4.1 css -->
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="styles.css"
    />
    <!-- font-awesome css -->
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/font-awesome.min.css"
    />
    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="assets/css/animate.css" />
    <!-- owl.carousel css -->
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css" />
    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="assets/css/slick.css" />
    <!-- off canvas css -->
    <link rel="stylesheet" type="text/css" href="assets/css/off-canvas.css" />
    <!-- linea-font css -->
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/fonts/linea-fonts.css"
    />
    <!-- flaticon css  -->
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon.css" />
    <!-- magnific popup css -->
    <link
      rel="stylesheet"
      type="text/css"
      href="assets/css/magnific-popup.css"
    />
    <!-- Main Menu css -->
    <link rel="stylesheet" href="assets/css/rsmenu-main.css" />
    <!-- spacing css -->
    <link rel="stylesheet" type="text/css" href="assets/css/rs-spacing.css" />
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="style.css" />
    <!-- This stylesheet dynamically changed from style.less -->
    <!-- responsive css -->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css" />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="home-style2">


    <!-- Refined by -->
    <div class="paginations" id="paginations">
        <button id="refined-by-btn" class="refined-btn">
            Refined By
        </button>
        
    </div>
    <!-- Refined by -->


<!-- Filter Panel -->
<section class="filters" id="filter-panel">
    <form method="GET" action="">
        <h2>Filter Options</h2>
        
        <!-- <h2>Stream</h2> -->
        <!-- <div class="radio-group"> -->
            <!-- <div class="refine-by"> -->
                <!-- <label for="medical">Medical</label> -->
                <!-- <input type="radio" id="medical" name="stream" value="medical"> -->
            <!-- </div> -->
            <!-- <div class="refine-by"> -->
                <!-- <label for="engineering">Engineering</label> -->
                <!-- <input type="radio" id="engineering" name="stream" value="engineering"> -->
            <!-- </div> -->
            <!-- <div class="refine-by"> -->
                <!-- <label for="foundations">Foundations</label> -->
                <!-- <input type="radio" id="foundations" name="stream" value="foundations"> -->
            <!-- </div> -->
        <!-- </div> -->

        <h2>Exams</h2>
        <select id="exam-select" name="exam">
            <option value="">Select Exam</option>
            <option value="JEE Mains">JEE Mains & Advance</option>
            <option value="NEET UG">NEET UG</option>
            <option value="NTSE">NTSE</option>
            <option value="Board">Board</option>
        </select>

        <h2>Year</h2>
        <select id="year-select" name="year">
            <option value="">Select Year</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
        </select>

        <button class="apply-btn" type="submit">APPLY</button>
    </form>
</section>


    

    <section class="results">


    <?php
include('connect.php');

// Get filter parameters from the request
$selectedExam = isset($_GET['exam']) ? $_GET['exam'] : '';
$selectedYear = isset($_GET['year']) ? $_GET['year'] : '';




$table = 'eng_result';


if ($selectedExam == 'JEE Mains') {

  $table = 'eng_result';

}  else if ($selectedExam == 'NEET UG') {

  $table = 'medical_result';

} else if ($selectedExam == 'NTSE') {

  $table = 'ntse_result';

} else if($selectedExam == 'Board') {

  $table = 'board_result';

} 


// Build the SQL query with filters
$sql = "SELECT * FROM $table WHERE 1=1";

if($sql != null){

  if ($selectedExam) {
    $sql .= " AND exam = '" . $conn->real_escape_string($selectedExam) . "'";
}

if ($selectedYear) {
    $sql .= " AND year = '" . $conn->real_escape_string($selectedYear) . "'";
}

$sql .= " ORDER BY rank ASC";

$result = $conn->query($sql);



$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();

// Separate top rankers and other ranks
$topRankers = array_filter($data, function($item) {
    return $item['top_ranker'] === 'Yes';
});

// Limit to 3 top rankers
$topRankers = array_slice($topRankers, 0, 3);

// Get remaining rankers excluding those already in topRankers
$topRankerIds = array_column($topRankers, 'id'); // Assuming 'id' is a unique identifier
$otherRanks = array_filter($data, function($item) use ($topRankerIds) {
    return $item['top_ranker'] === 'No' && !in_array($item['id'], $topRankerIds);
});

// Display top rankers
if (!empty($topRankers)) {
    echo '<div class="top-rank" id="top-rank">';
    foreach ($topRankers as $item) {
      echo '<div class="rank-card" style="background: #4CB6E8; ">';
      
      echo '<img src="admin/' . htmlspecialchars($item['photo']) . '" alt="' . htmlspecialchars($item['name']) . '" style="height: 150px; width: 150px;">';
      echo '<h3 style="background: #D7F2FC; margin-left: 35%; margin-right: 35%; padding: 10px; color: #095392; border-radius: 30px;"><b>' . htmlspecialchars($item['rank']) . '</b></h3>';
      echo '<p style="color: white; font-size: 18px;"><b>' . htmlspecialchars($item['name']) . '</b></p>';
      echo '<p style="color: white;">Reg No: ' . htmlspecialchars($item['reg']) . '</p>';
      echo '<p style="color: white;">Year: ' . htmlspecialchars($item['year']) . '</p>';
      echo '</div>';
    }
    echo '</div>';
}

// Display other ranks
if (!empty($otherRanks)) {
    echo '<div class="other-ranks" id="rank-cards">';
    foreach ($otherRanks as $item) {
      echo '<div class="rank-card">';
      echo '<img src="admin/' . htmlspecialchars($item['photo']) . '" alt="' . htmlspecialchars($item['name']) . '" style="height: 150px; width: 150px;">';
        echo '<p style="background: #007BFF; margin-left: 35%; margin-right: 35%; padding: 6px; border-radius: 20px; color: white;">' . htmlspecialchars($item['rank']) . '</p>';
        echo '<p style="color: black; font-size: 18px;"><b>' . htmlspecialchars($item['name']) . '</b></p>';
        echo '<p>Reg No: ' . htmlspecialchars($item['reg']) . '</p>';
        echo '<p>' . htmlspecialchars($item['year']) . '</p>';
        echo '</div>';
    }
    echo '</div>';
}
  
} else {
  echo "No data";
}


?>


    <div class="pagination" style="margin-bottom: 300px;">
        <button id="prev-btn" class="pagination-btn" disabled>
            <i class="icon">❮</i> Previous
        </button>
        <button id="next-btn" class="pagination-btn">
            Next <i class="icon">❯</i>
        </button>
    </div>
</section>

  </body>
</html>
