<?php
require_once('../model/database.php');
require_once('../model/assignment_db.php');
require_once('../model/course_db.php');

if (isset($_GET['id'])) {
    $assignment_id = $_GET['id'];

    // Fetch assignment details
    $query = "SELECT * FROM assignments WHERE id = :assignment_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':assignment_id', $assignment_id);
    $statement->execute();
    $assignment = $statement->fetch();
    $statement->closeCursor();

    // Fetch all courses for the dropdown
    $courses = get_courses();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Assignment</title>
</head>
<body>
    <h2>Update Assignment</h2>
    <form action="../index.php" method="post">
        <input type="hidden" name="action" value="update_assignment">
        <input type="hidden" name="assignment_id" value="<?php echo $assignment['id']; ?>">
        
        <label>Description:</label>
        <input type="text" name="description" value="<?php echo htmlspecialchars($assignment['description']); ?>">
        
        <label>Course:</label>
        <select name="course_id">
            <?php foreach ($courses as $course) : ?>
                <option value="<?php echo $course['id']; ?>" <?php if ($assignment['courseID'] == $course['id']) echo 'selected'; ?>>
                    <?php echo $course['courseName']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Update Assignment</button>
    </form>
</body>
</html>
