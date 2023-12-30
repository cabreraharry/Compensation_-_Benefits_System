<?php include('auth.php'); ?>

<div class="container">
    <h1>Employee List</h1>

    <table class="employee-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birthdate</th>
                <th>Contact No</th>
                <th>Salary</th>
                <th>Job Position</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
            displayEmployeeListWithPagination($conn, $currentPage, $recordsPerPage);
            ?>
        </tbody>
    </table>

    <!-- Pagination links -->
    <?php include('includes/pagination.php'); ?>

    <!-- Add a link to the homepage -->
    <p style="text-align: center; margin-top: 20px;"><a href="index.php">Go to Home</a></p>
</div>

<!-- Add the modal for benefits -->
<div class="modal" id="benefitsModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Employee Benefits</h2>
        <div id="benefitsContent"></div>
    </div>
</div>

<script>
    function openModal(benefits) {
        document.getElementById('benefitsContent').innerHTML = benefits;
        document.getElementById('benefitsModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('benefitsModal').style.display = 'none';
    }
</script>
