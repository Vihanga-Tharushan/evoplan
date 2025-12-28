<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/sidebar/sidebar1.php'; ?>
<?php require_once APPROOT . '/views/issue/taskbar/taskbar.php'; ?>
<link rel="stylesheet" href="../public/css/components/issueC/dashboard.css" />
<div class="dashboard">
        

        <div class="card-container">
            <div class="card">
                <h2>Number of Events with Issues</h2>
                <div class="stat-number">15</div>
                <div class="stat-change">Increase compared to last week</div>
                <form method="post" action="<?php echo URLROOT; ?>/IssueC/eventswithissues">
			<button class="btn btn--primary" type="submit"> <a class="see-all">See All</a></button>
		</form>
            </div>
        </div>
        <div class="urgent-card">
            <div>
                <h2>Urgent Issues!!!</h2>
                <div class="urgent-number">2</div>
            </div>
            <div class="urgent-actions">
                <button class="btn btn-primary">Get Started</button>
                <button class="btn btn-outline">See All</button>
            </div>
        </div>

        <div class="issues-table">
            <h2>Event with Issues</h2>
            <table>
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
                        <td>#CMP-4266</td>
                        <td>One album is missing</td>
                        <td>Product Defect</td>
                        <td>Magic Johnson Supermarket Vilanova</td>
                        <td>2 hours ago</td>
                        <td><span class="status status-urgent">Urgent</span></td>
                    </tr>
                    <tr>
                        <td>#CMP-4266</td>
                        <td>One album is missing</td>
                        <td>Product Defect</td>
                        <td> Magic Johnson Supermarket Vilanova</td>
                        <td>2 days ago</td>
                        <td><span class="status status-progress">In Progress</span></td>
                    </tr>
                    <tr>
                        <td>#CMP-4266</td>
                        <td>One album is missing</td>
                        <td>Service</td>
                        <td> Magic Johnson Supermarket Vilanova</td>
                        <td>1 week ago</td>
                        <td><span class="status status-resolved">Resolved</span></td>
                    </tr>
                    <tr>
                        <td>#CMP-4266</td>
                        <td>One album is missing</td>
                        <td>Product Defect</td>
                        <td> Magic Johnson Supermarket Vilanova</td>
                        <td>1 week ago</td>
                        <td><span class="status status-not-urgent">Not Urgent</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>