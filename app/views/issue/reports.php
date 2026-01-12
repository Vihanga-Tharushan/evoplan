<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar6.php'; ?>
<?php require_once APPROOT . '/views/issue/taskbar/taskbar.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Issue Coordinator Report</title>
    <link rel="stylesheet" href="../public/css/components/issueC/taskbar/reports.css">
</head>
<body>
    <div class="main-content">
        <div class="header">
            <h1 class="page-title">Issue Coordinator Report</h1>
            <div class="user-info">
                <div class="notification-icon"></div>
                <div class="user-avatar">U</div>
            </div>
        </div>
        
        <!-- Complaints Report -->
        <div class="report-section">
            <div class="section-header">
                <h2 class="section-title">Complaints Received</h2>
                <a href="#" class="view-all">View all</a>
            </div>
            <table class="complaints-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Subject</th>
                        <th>Category</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="complaint-id">CMP-4256</td>
                        <td class="complaint-subject">System crashed during checkout</td>
                        <td><span class="category system-failure">System Failure</span></td>
                        <td>Maggie Johnson</td>
                        <td>2 hours ago</td>
                        <td><span class="status urgent">Urgent</span></td>
                    </tr>
                    <tr>
                        <td class="complaint-id">CMP-4257</td>
                        <td class="complaint-subject">Wrong replacement sent</td>
                        <td><span class="category replacement-issue">Replacement Issue</span></td>
                        <td>John Smith</td>
                        <td>1 day ago</td>
                        <td><span class="status in-progress">In Progress</span></td>
                    </tr>
                    <tr>
                        <td class="complaint-id">CMP-4258</td>
                        <td class="complaint-subject">Double charge on credit card</td>
                        <td><span class="category payment-adjustments">Payment Adjustments</span></td>
                        <td>Sarah Wilson</td>
                        <td>3 days ago</td>
                        <td><span class="status resolved">Resolved</span></td>
                    </tr>
                    <tr>
                        <td class="complaint-id">CMP-4259</td>
                        <td class="complaint-subject">System timeout during payment</td>
                        <td><span class="category system-failure">System Failure</span></td>
                        <td>Mike Davis</td>
                        <td>1 week ago</td>
                        <td><span class="status not-urgent">Not Urgent</span></td>
                    </tr>
                    <tr>
                        <td class="complaint-id">CMP-4260</td>
                        <td class="complaint-subject">Refund not processed</td>
                        <td><span class="category payment-adjustments">Payment Adjustments</span></td>
                        <td>Emily Chen</td>
                        <td>2 weeks ago</td>
                        <td><span class="status resolved">Resolved</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Replacements Report -->
        <div class="report-section">
            <div class="section-header">
                <h2 class="section-title">Replacements Completed</h2>
                <a href="#" class="view-all">View all</a>
            </div>
            <table class="complaints-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Reason</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="complaint-id">#RPL-1001</td>
                        <td class="complaint-subject">Premium Album Set</td>
                        <td>Defective item</td>
                        <td>Maggie Johnson</td>
                        <td>2 hours ago</td>
                        <td><span class="status resolved">Completed</span></td>
                    </tr>
                    <tr>
                        <td class="complaint-id">#RPL-1002</td>
                        <td class="complaint-subject">Standard Packaging</td>
                        <td>Damaged during shipping</td>
                        <td>John Smith</td>
                        <td>1 day ago</td>
                        <td><span class="status in-progress">In Progress</span></td>
                    </tr>
                    <tr>
                        <td class="complaint-id">#RPL-1003</td>
                        <td class="complaint-subject">Deluxe Accessory Kit</td>
                        <td>Missing components</td>
                        <td>Mike Davis</td>
                        <td>1 week ago</td>
                        <td><span class="status resolved">Completed</span></td>
                    </tr>
                    <tr>
                        <td class="complaint-id">#RPL-1004</td>
                        <td class="complaint-subject">Collector's Edition Album</td>
                        <td>Wrong item shipped</td>
                        <td>Sarah Wilson</td>
                        <td>3 days ago</td>
                        <td><span class="status resolved">Completed</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Issue Distribution -->
        <div class="report-section">
            <div class="section-header">
                <h2 class="section-title">Issue Distribution by Type</h2>
            </div>
            <div class="distribution-grid">
                <div class="distribution-item">
                    <div class="distribution-color system-failure"></div>
                    <div style="flex: 1;">
                        <div class="distribution-bar">
                            <div class="distribution-fill system-failure-fill" style="width: 45%;"></div>
                        </div>
                        <div class="distribution-info">
                            <span class="distribution-type">System Failure</span>
                            <span class="distribution-percentage">45%</span>
                        </div>
                    </div>
                </div>
                <div class="distribution-item">
                    <div class="distribution-color replacement-issue"></div>
                    <div style="flex: 1;">
                        <div class="distribution-bar">
                            <div class="distribution-fill replacement-issue-fill" style="width: 35%;"></div>
                        </div>
                        <div class="distribution-info">
                            <span class="distribution-type">Replacement Issue</span>
                            <span class="distribution-percentage">35%</span>
                        </div>
                    </div>
                </div>
                <div class="distribution-item">
                    <div class="distribution-color payment-adjustments"></div>
                    <div style="flex: 1;">
                        <div class="distribution-bar">
                            <div class="distribution-fill payment-adjustments-fill" style="width: 20%;"></div>
                        </div>
                        <div class="distribution-info">
                            <span class="distribution-type">Payment Adjustments</span>
                            <span class="distribution-percentage">20%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php require APPROOT . '/views/inc/footer.php'; ?>
