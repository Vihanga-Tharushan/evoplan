<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require_once APPROOT . '/views/issue/taskbar/taskbar.php'; ?>
<?php require_once APPROOT . '/views/issue/taskbar/taskbar_back.php'; ?>
<link rel="stylesheet" href="../public/css/components/issueC/eventsdetails.css"/>

 
        <main class="main-content">
            <div class="page-title">
                <h2>Issue Investigation</h2>
                
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Event Details</h3>
                    <div class="event-id">ID #1234</div>
                </div>

                <div class="event-details-grid">
                    <div class="detail-group">
                        <div class="detail-label">Event Title/Type</div>
                        <div class="detail-value">Birthday Party</div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">Event Venue</div>
                        <div class="detail-value">120/B, Hanthana Road, Kandy</div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">Start Time</div>
                        <div class="detail-value">3 P.M</div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">End Time</div>
                        <div class="detail-value">11 P.M</div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">Start Date</div>
                        <div class="detail-value">2025/05/05</div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">End Date</div>
                        <div class="detail-value">2025/05/05</div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">Package Type</div>
                        <div class="detail-value">Silver Package</div>
                    </div>
                    <div class="detail-group">
                        <div class="detail-label">Package Price</div>
                        <div class="detail-value">RS. 25,000</div>
                    </div>
                </div>

                <div class="detail-group">
                    <div class="detail-label">Event Owner</div>
                    <div class="detail-value">Chris Friedkly (Supermarket Villanova)</div>
                </div>

                <div class="detail-group">
                    <div class="detail-label">Special Notes</div>
                    <div class="detail-value">Customer requested additional decorations and a special cake design. They also mentioned potential dietary restrictions for some guests.</div>
                </div>
            </div>
        <form method="post" action="<?php echo URLROOT;?>/IssueC/issueInvestigation" >
            <div class="issue-section">
                <div class="issue-form card">
                    <h3 class="card-title">Issue Resolution</h3>
                    
                    <div class="form-group">
                        <label class="form-label">Issue Type</label>

                        <!-- hidden input to carry the selected value -->
                        <input type="hidden" name="issue_type" id="issue_type" value="<?php echo $data['issue_type']; ?>" />

                        <div class="issue-type-buttons">
                            <button type="button" class="issue-type-btn active" data-value="Replacement Issue">
                                <span class="issue-icon">✔</span>
                                <span>Replacement Issue</span>
                            </button>
                            <button type="button" class="issue-type-btn" data-value="Payment Adjustment">
                                <span class="issue-icon">💹</span>
                                <span>Payment Adjustment</span>
                            </button>
                            <button type="button" class="issue-type-btn" data-value="System Failure">
                                <span class="issue-icon">⚠️</span>
                                <span>System Failure</span>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="refund">Refund Required</label>
                        <select class="form-control" name="refund" id="refund" required value="<?php echo $data['refund']; ?>">
                            <option value="Yes" <?php echo ($data['refund'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($data['refund'] == 'No') ? 'selected' : ''; ?>>No</option>
                        </select>
                        <span class="error"><?php echo $data['refund_err']; ?></span>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Special Notes</label>
                        <input type="textarea" class="form-control" id="notes" name="notes" placeholder="Add investigation details, resolution steps, and any special notes..." value="<?php echo $data['notes']; ?>">
                        <span class="error"><?php echo $data['notes_err']; ?></span>
                    </div>

                    <div class="additional-fields">
                        <div class="form-group">
                            <label class="form-label">Replacement Items</label>
                            <input type="text" class="form-control" id="replace_item" name="replace_item" placeholder="Floral arrangements (roses and lilies)" value="<?php echo $data['replace_item']; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Estimated Cost of Replacement</label>
                            <input type="number" class="form-control" id="cost" name="cost" placeholder="Add the value in Rs." value="<?php echo $data['cost']; ?>">
                            <span class="error"><?php echo $data['cost_err']; ?></span>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Vendor Responsibility</label>
                            <select class="form-control" name="v_response" id="v_response">
                                <option value="Internal error" <?php echo ($data['v_response'] == 'Internal error') ? 'selected' : ''; ?>>Internal error</option>
                                <option value="Vendor failure" <?php echo ($data['v_response'] == 'Vendor failure') ? 'selected' : ''; ?>>Vendor failure</option>
                                <option value="Customer request" <?php echo ($data['v_response'] == 'Customer request') ? 'selected' : ''; ?>>Customer request</option>
                                <option value="Unforeseen circumstances" <?php echo ($data['v_response'] == 'Unforeseen circumstances') ? 'selected' : ''; ?>>Unforeseen circumstances</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Priority Level</label>
                        <select class="form-control"  id="priority" name="priority" >
                            <option value="Low" <?php echo ($data['priority'] == 'Low') ? 'selected' : ''; ?>>Low</option>
                            <option value="Medium" <?php echo ($data['priority'] == 'Medium') ? 'selected' : ''; ?>>Medium</option>
                            <option value="High" <?php echo ($data['priority'] == 'High') ? 'selected' : ''; ?>>High</option>
                            <option value="Critical" <?php echo ($data['priority'] == 'Critical') ? 'selected' : ''; ?>>Critical</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" >Admin Notes (Internal)</label>
                        <input type="textarea" class="form-control" id="a_note" name="a_note" placeholder="Notes for admin review..." value="<?php echo $data['a_note']; ?>"> 
                    </div>

                    <button type="submit" class="submit-btn">
                     Submit to Admin
                </button>
                </div>  

        </form>        

                <!--<div class="chat-section card">
                    <div class="chat-header">
                        <div class="chat-avatar">CF</div>
                        <div>
                            <h3>Chat with Chris Friedkly</h3>
                            <div class="detail-label">Event Owner</div>
                        </div>
                    </div>

                    <div class="chat-messages">
                        <div class="message received">
                            <div>Hello, I noticed that the floral arrangements at our event yesterday were different from what we agreed upon.</div>
                            <div class="message-time">10:24 AM</div>
                        </div>
                        <div class="message sent">
                            <div>Hi Chris, I'm looking into this issue for you. Can you specify what was different about the flowers?</div>
                            <div class="message-time">10:30 AM</div>
                        </div>
                        <div class="message received">
                            <div>We ordered roses and lilies, but we received carnations and daisies instead. This was quite disappointing for our special event.</div>
                            <div class="message-time">10:35 AM</div>
                        </div>
                        <div class="message sent">
                            <div>I apologize for this error. I've confirmed with our vendor that there was a mix-up in the order. We will arrange for replacement floral arrangements to be delivered to you tomorrow morning.</div>
                            <div class="message-time">10:42 AM</div>
                        </div>
                        <div class="message received">
                            <div>Thank you for addressing this promptly. We appreciate the quick resolution.</div>
                            <div class="message-time">10:45 AM</div>
                        </div>
                    </div>

                    <div class="chat-input">
                        <input type="text" placeholder="Type your message...">
                        <button>➤</button>
                    </div>
                </div>
            </div>
        </main>
    </div>-->
    </div>
</main>

    <script>
  const issueTypeButtons = document.querySelectorAll('.issue-type-btn');
  const issueTypeInput = document.getElementById('issue_type'); // hidden input

  issueTypeButtons.forEach(button => {
    button.addEventListener('click', () => {
      // Remove 'active' class from all buttons
      issueTypeButtons.forEach(btn => btn.classList.remove('active'));

      // Add 'active' class to the clicked one
      button.classList.add('active');

      // ✅ Update the hidden input with the selected button's value
      issueTypeInput.value = button.getAttribute('data-value');
    });
  });
</script>

</body>
<?php require APPROOT . '/views/inc/footer.php'; ?>