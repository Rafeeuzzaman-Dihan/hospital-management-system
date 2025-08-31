<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<nav class="doctor-navbar">
    <div class="doctor-logo">Doctor Panel</div>
    <ul class="doctor-nav-links">
        <li><a href="../doctor/dashboard.php" class="<?= basename($_SERVER['PHP_SELF']) == 'doctor-dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
        <li><a href="../doctor/doctor-patients.php" class="<?= basename($_SERVER['PHP_SELF']) == 'doctor-patients.php' ? 'active' : '' ?>">My Patients</a></li>
        <li><a href="../doctor/doctor-appointments.php" class="<?= basename($_SERVER['PHP_SELF']) == 'doctor-appointments.php' ? 'active' : '' ?>">Appointments</a></li>
        <li><a href="../doctor/doctor-lab-results.php" class="<?= basename($_SERVER['PHP_SELF']) == 'doctor-lab-results.php' ? 'active' : '' ?>">Lab Results</a></li>
        <li><a href="../doctor/doctor-prescriptions.php" class="<?= basename($_SERVER['PHP_SELF']) == 'doctor-prescriptions.php' ? 'active' : '' ?>">Prescriptions</a></li>
        <li><a href="../auth/logout.php">Logout</a></li>
    </ul>
</nav>
