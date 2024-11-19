<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userName = $_POST['name'];
    $userSkills = $_POST['skills'];

    // Insert user data into the database
    $stmt = $conn->prepare("INSERT INTO users (name, skills) VALUES (?, ?)");
    $stmt->bind_param("ss", $userName, $userSkills);
    $stmt->execute();
    $stmt->close();

    // Match jobs based on skills
    $skillsArray = explode(',', $userSkills);
    $skillsPlaceholder = implode(',', array_fill(0, count($skillsArray), '?'));

    $query = "SELECT * FROM jobs WHERE ";
    $query .= implode(' OR ', array_map(fn($skill) => "FIND_IN_SET(?, skills_required)", $skillsArray));

    $stmt = $conn->prepare($query);
    $stmt->bind_param(str_repeat('s', count($skillsArray)), ...$skillsArray);
    $stmt->execute();
    $result = $stmt->get_result();

    $matchedJobs = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Matching Platform</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Job Matching Platform</h1>
        <form method="POST" class="form">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="skills">Skills (comma-separated):</label>
            <input type="text" id="skills" name="skills" required>

            <button type="submit">Find Jobs</button>
        </form>

        <?php if (!empty($matchedJobs)): ?>
            <h2>Matched Jobs</h2>
            <ul>
                <?php foreach ($matchedJobs as $job): ?>
                    <li>
                        <strong><?= htmlspecialchars($job['job_title']) ?></strong>
                        <p><?= htmlspecialchars($job['job_description']) ?></p>
                        <small>Required Skills: <?= htmlspecialchars($job['skills_required']) ?></small>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
            <p>No jobs matched your skills.</p>
        <?php endif; ?>
    </div>
</body>
</html>
