<?php
session_start();

if (isset($_SESSION['username'])) {
    if (substr($_SESSION['username'], 0, 2) != "st") {
        echo "<div 
        style='position: fixed; top: 50%; left: 50%;
        transform: translate(-50%, -50%); 
        background-color: #f44336;
        color: white; padding: 20px;
        font-size: 20px;
        '>
        Access Denied
    </div>";
    } else {
        require_once 'include/header.php';
        require_once 'function.php';
        $total_days = "SELECT COUNT(*) AS student_count FROM attendance WHERE student_id =" . $_SESSION['id'] ."";
        $total_days = query($total_days);
        $totalWorkingDays = $total_days[0]['student_count'];

        $total_present = "SELECT COUNT(*) AS student_present FROM attendance WHERE student_id =" . $_SESSION['id'] ." AND attendance_status = 'present'";
        $total_present = query($total_present);
        $totalPresentDays = $total_present[0]['student_present'];
        if ($totalWorkingDays && $totalPresentDays > 0) {
            $percentage =  ( $totalPresentDays / $totalWorkingDays ) * 100;
        }
        else 
        {
            $percentage = '';
        }
        
?>

        <div class="container-fluid" id="container-wrapper">
            <div class="row mb-3">
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Attendance Percentage ( % )</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $percentage . ' %'; ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Earnings (Annual) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">650</div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                        <span>Since last years</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-cart fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New User Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                                        <span>Since last month</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                    <div class="mt-2 mb-0 text-muted text-xs">
                                        <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                        <span>Since yesterday</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
} else {
    header("Location: " . $ROOT . "/index.php");
}
require_once 'include/footer.php';
?>