<?php
require_once('../model/database.php');
require_once('../model/course_db.php');

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];

    // Fetch course details
    $query = "SELECT * FROM courses WHERE id = :course_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id);
    $statement->execute();
    $course = $statement->fetch();
    $statement->closeCursor();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Course</title>
</head>
<body>
    <h2>Update Course</h2>
    <form action="../index.php" method="post">
        <input type="hidden" name="action" value="update_course">
        <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
        
        <label>Course Name:</label>
        <input type="text" name="course_name" value="<?php echo htmlspecialchars($course['courseName']); ?>">
        
        <button type="submit">Update Course</button>
    </form>
</body>
</html>
