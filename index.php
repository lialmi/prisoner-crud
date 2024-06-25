<?php include 'database/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./style/styles.css"> 
</head>
<body>
    <div class="container-fluid">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-heading">Admin Dashboard</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        <i class="bi bi-house-door"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-people"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-gear"></i> Settings
                    </a>
                </li>
            </ul>
        </nav>
  
       
        <div class="content-wrapper">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand" href="#">Prisoner Crud </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <button class="btn btn-primary btn-add" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="bi bi-plus"></i> Add Prisoner
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Prisoner Name</th>
                            <th>Case</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query('SELECT * FROM crud');
                        while ($row = $result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['prisonerName']); ?></td>
                            <td><?php echo htmlspecialchars($row['case']); ?></td>
                            <td><?php echo $row['date_created']; ?></td>
                            <td>
                                <button class="btn btn-info btn-sm btn-edit me-2" 
                                        data-id="<?php echo $row['id']; ?>" 
                                        data-name="<?php echo htmlspecialchars($row['prisonerName']); ?>" 
                                        data-case="<?php echo htmlspecialchars($row['case']); ?>" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm btn-delete">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Prisoner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add.php" method="POST">
                        <div class="mb-3">
                            <label for="prisonerName" class="form-label">Prisoner Name</label>
                            <input type="text" class="form-control" id="prisonerName" name="prisonerName" required>
                        </div>
                        <div class="mb-3">
                            <label for="case" class="form-label">Case</label>
                            <input type="text" class="form-control" id="case" name="case" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Prisoner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="edit.php" method="POST">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="mb-3">
                            <label for="edit-prisonerName" class="form-label">Prisoner Name</label>
                            <input type="text" class="form-control" id="edit-prisonerName" name="prisonerName" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-case" class="form-label">Case</label>
                            <input type="text" class="form-control" id="edit-case" name="case" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    
    <!-- Edit Button when click  -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editButtons = document.querySelectorAll('.btn-edit');
            editButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id');
                    const name = button.getAttribute('data-name');
                    const caseInfo = button.getAttribute('data-case');

                    document.getElementById('edit-id').value = id;
                    document.getElementById('edit-prisonerName').value = name;
                    document.getElementById('edit-case').value = caseInfo;
                });
            });
        });
    </script>
</body>
</html>
