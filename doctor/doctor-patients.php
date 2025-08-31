<?php
session_start();
include "../includes/doctor-navbar.php";
include "../db/connection.php";

$doctor_id = $_SESSION['user_id'];

// ------------------ Handle Cancel Appointment ------------------
if (isset($_GET['cancel_id'])) {
    $cancel_id = $_GET['cancel_id'];
    $stmt = $conn->prepare("UPDATE appointments SET status = 'canceled' WHERE id = ? AND doctor_id = ?");
    $stmt->execute([$cancel_id, $doctor_id]);
    header("Location: doctor-patients.php");
    exit;
}

// ------------------ Fetch Doctor's Patients ------------------
$sql = "SELECT a.id AS appointment_id, u.first_name, u.last_name, u.email, u.username, 
        a.appointment_date, a.appointment_time, a.status
        FROM appointments a
        JOIN users u ON a.user_id = u.id
        WHERE a.doctor_id = ?
        ORDER BY a.appointment_date, a.appointment_time";
$stmt = $conn->prepare($sql);
$stmt->execute([$doctor_id]);
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../css/doctor-navbar.css">
<link rel="stylesheet" href="../css/doctor-dashboard.css">

<div class="doctor-content">
    <h2>My Patients</h2>

    <?php if(count($patients) > 0): ?>
        <table>
            <thead>
            <tr>
                <th>Patient Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($patients as $p): ?>
                <tr>
                    <td><?= $p['first_name'] . ' ' . $p['last_name'] ?></td>
                    <td><?= $p['username'] ?></td>
                    <td><?= $p['email'] ?></td>
                    <td><?= date("d M Y", strtotime($p['appointment_date'])) ?></td>
                    <td><?= date("h:i A", strtotime($p['appointment_time'])) ?></td>
                    <td><?= ucfirst($p['status']) ?></td>
                    <td>
                        <?php if($p['status'] != 'canceled'): ?>
                            <a href="?cancel_id=<?= $p['appointment_id'] ?>" onclick="return confirm('Are you sure you want to cancel this appointment?')">Cancel</a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No patients found.</p>
    <?php endif; ?>
</div>
