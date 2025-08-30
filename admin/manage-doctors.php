<?php
include "../db/connection.php";
include "../includes/admin-sidebar.php";

// ------------------ Handle Update ------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['doctor_id'])) {
    $doctor_id = $_POST['doctor_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $availability = $_POST['availability'];

    $sql_update = "UPDATE users u
                   JOIN doctors d ON u.id = d.user_id
                   SET u.first_name = ?, u.last_name = ?, u.username = ?, u.email = ?,
                       d.department = ?, d.position = ?, d.availability = ?
                   WHERE d.id = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->execute([$first_name, $last_name, $username, $email, $department, $position, $availability, $doctor_id]);

    // Redirect to avoid resubmission
    header("Location: manage-doctors.php");
    exit;
}

// ------------------ Fetch Doctors ------------------
$sql = "SELECT d.id, u.first_name, u.last_name, u.username, u.email, d.department, d.position, d.availability
        FROM doctors d
        JOIN users u ON d.user_id = u.id
        WHERE u.role = 'doctor'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../css/navbar.css">
<link rel="stylesheet" href="../css/admin-dashboard.css">

<div class="admin-content">
    <h2>Manage Doctors</h2>
    <a href="#" class="btn add-btn">Add Doctor</a>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Department</th>
            <th>Position</th>
            <th>Availability</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($doctors) > 0): ?>
            <?php foreach($doctors as $row): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['first_name'] ?></td>
                    <td><?= $row['last_name'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['department'] ?></td>
                    <td><?= $row['position'] ?></td>
                    <td>
                        <?php
                        $days = explode(';', $row['availability']);
                        foreach($days as $day) echo $day . "<br>";
                        ?>
                    </td>
                    <td>
                        <a href="#" class="edit-btn">Edit</a> |
                        <a href="#" class="delete-btn">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="9">No doctors found.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ------------------ Edit Modal ------------------ -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Edit Doctor</h3>
        <form id="editDoctorForm" method="post" action="">
            <input type="hidden" name="doctor_id" id="doctor_id">

            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" id="first_name" required>
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" id="last_name" required>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label>Department</label>
                <input type="text" name="department" id="department" required>
            </div>
            <div class="form-group">
                <label>Position</label>
                <input type="text" name="position" id="position" required>
            </div>
            <div class="form-group">
                <label>Availability</label>
                <input type="text" name="availability" id="availability" required>
                <small>Format: Sunday:10-5;Monday:9-5</small>
            </div>

            <button type="submit" class="btn">Update Doctor</button>
        </form>
    </div>
</div>

<!-- ------------------ JS ------------------ -->
<script>
    const modal = document.getElementById("editModal");
    const span = modal.querySelector(".close");

    // Open modal and populate fields
    document.querySelectorAll(".edit-btn").forEach(btn => {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            const row = this.closest("tr");

            document.getElementById("doctor_id").value = row.cells[0].innerText;
            document.getElementById("first_name").value = row.cells[1].innerText;
            document.getElementById("last_name").value = row.cells[2].innerText;
            document.getElementById("username").value = row.cells[3].innerText;
            document.getElementById("email").value = row.cells[4].innerText;
            document.getElementById("department").value = row.cells[5].innerText;
            document.getElementById("position").value = row.cells[6].innerText;
            document.getElementById("availability").value = row.cells[7].innerText.replace(/<br>/g, ";");

            modal.style.display = "block";
        });
    });

    // Close modal
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) modal.style.display = "none";
    }
</script>