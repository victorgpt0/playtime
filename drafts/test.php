<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title><?php echo $title;?></title>
    <link rel="icon" href="../assets/icons/favicon.svg" type="image/svg+xml">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel='stylesheet' type='text/css' media='screen' href='../assets/css/owner-dash.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Basic sidebar styling */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #1c1c1c;
            color: #fff;
            position: fixed;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            transition: width 0.3s ease;
        }

        /* Collapsed sidebar */
        .sidebar.collapsed {
            width: 80px;
        }

        /* Align items horizontally with flexbox */
        .nav .side-div {
            display: flex;
            align-items: center;
            padding: 10px 15px;
        }

        /* Icon alignment */
        .nav .side-div i {
            font-size: 18px;
            margin-right: 10px;
        }

        /* Hide text on collapse */
        .sidebar.collapsed .side-div span {
            display: none;
        }

        /* Make sidebar responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }

            .sidebar.collapsed {
                width: 50px;
            }

            .sidebar.collapsed .side-div span {
                display: none;
            }
        }

        /* Styling for active or hovered links */
        .side-div:hover {
            background-color: #333;
            cursor: pointer;
        }

        /* Main content positioning */
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .sidebar.collapsed + .main-content {
            margin-left: 80px;
        }

        /* Styling for the brand */
        h3 {
            margin-left: 15px;
            font-weight: bold;
            color: yellow;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <nav>
        <div class="sidebar" id="sidebar">
            <h3>PLAYTIME</h3>
            <br><br>
            <ul class="nav">
                <div class="side-div">
                    <li><a href="#"><i class="fas fa-server"></i><span> Dashboard </span></a></li>
                </div>
                <div class="side-div">
                    <li><a href="#"><i class="fa-solid fa-futbol"></i><span> Facilities </span></a></li>
                </div>
                <div class="side-div">
                    <li><a href="#"><i class="fas fa-user"></i><span> Profile </span></a></li>
                </div>
                <div class="side-div">
                    <li><a href="#"><i class="fas fa-users"></i><span> Staff </span></a></li>
                </div>
                <div class="side-div">
                    <li><a href="#"><i class="fas fa-cogs"></i><span> Settings </span></a></li>
                </div>
                <br><br><br><br>
                <div class="side-div">
                    <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i><span> Logout </span></a></li>
                </div>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Your main content here -->
    </div>

    <!-- Script to handle collapse on click or automatically -->
    <script>
        // Add toggle functionality for collapse on click (optional)
        const sidebar = document.getElementById('sidebar');
        document.addEventListener('DOMContentLoaded', function () {
            window.addEventListener('resize', function () {
                if (window.innerWidth <= 768) {
                    sidebar.classList.add('collapsed');
                } else {
                    sidebar.classList.remove('collapsed');
                }
            });

            // Initially collapse if window is smaller
            if (window.innerWidth <= 768) {
                sidebar.classList.add('collapsed');
            }
        });
    </script>
</body>

</html>
