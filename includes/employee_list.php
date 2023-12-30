<!-- includes/employee_list.php -->

<div class="container">
    <h1>Employee List</h1>

    <table class="employee-table">

        <tbody>
            <?php
            $currentPage = $_GET['page'];
            displayEmployeeListWithPagination($conn, $currentPage, $recordsPerPage);
            ?>
        </tbody>
    </table>

    <!-- Pagination links -->
    <?php include('includes/pagination.php'); ?>

    <!-- Add a link to the homepage -->
    <p style="text-align: center; margin-top: 20px;"><a href="index.php">Go to Home</a></p>
</div>
