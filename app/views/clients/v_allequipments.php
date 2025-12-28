<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/components/client/packages.css">

<form method="POST" action="<?php echo URLROOT; ?>/Clients/packages">

<!-- Packages Grid -->
    <section class="packages">
        <h1>Event equipment packages</h1>
        <div class="packages-grid">
            <!-- Package Card 1 -->
            <div class="package-card">
                <div class="package-image" style="background-image: url('<?php echo URLROOT; ?>/img/home/image 12.svg?height=200&width=300');">
                    
                    <div class="package-overlay">
                        <h3>Diamond Package</h3>
                        <ul>
                            <li>Pre-shoot</li>
                            <li>wedding Coverage</li>
                            <li>Two Albums</li>
                        </ul>
                        <div class="price">200,000/=</div>
                    </div>
                </div>
                <div class="package-footer">
                    <div class="provider">
                        <img src="<?php echo URLROOT; ?>/img/home/profile.svg?height=32&width=32" alt="Jenna Sullivan">
                        <div>
                            <div class="provider-name">Jenna Sullivan</div>
                            <div class="provider-location">Walmart</div>
                        </div>
                    </div>
                    <button type="button" class="view-package" onclick="location.href='<?php echo URLROOT; ?>/clients/viewpackage';">View Package →</button>
                </div>
            </div>

            <!-- Package Card 2 -->
            <div class="package-card">
                <div class="package-image" style="background-image: url('<?php echo URLROOT; ?>/img/home/image 12.svg?height=200&width=300');">
                    
                    <div class="package-overlay">
                        <h3>Diamond Package</h3>
                        <ul>
                            <li>Pre-shoot</li>
                            <li>wedding Coverage</li>
                            <li>Two Albums</li>
                        </ul>
                        <div class="price">200,000/=</div>
                    </div>
                </div>
                <div class="package-footer">
                    <div class="provider">
                        <img src="<?php echo URLROOT; ?>/img/home/profile.svg?height=32&width=32" alt="Jenna Sullivan">
                        <div>
                            <div class="provider-name">Jenna Sullivan</div>
                            <div class="provider-location">Walmart</div>
                        </div>
                    </div>
                    <button type="button" class="view-package" onclick="location.href='<?php echo URLROOT; ?>/clients/viewpackage';">View Package →</button>
                </div>
            </div>
            <!-- Package Card 3 -->
            <div class="package-card">
                <div class="package-image" style="background-image: url('<?php echo URLROOT; ?>/img/home/image 12.svg?height=200&width=300');">
                    
                    <div class="package-overlay">
                        <h3>Diamond Package</h3>
                        <ul>
                            <li>Pre-shoot</li>
                            <li>wedding Coverage</li>
                            <li>Two Albums</li>
                        </ul>
                        <div class="price">200,000/=</div>
                    </div>
                </div>
                <div class="package-footer">
                    <div class="provider">
                        <img src="<?php echo URLROOT; ?>/img/home/profile.svg?height=32&width=32" alt="Jenna Sullivan">
                        <div>
                            <div class="provider-name">Jenna Sullivan</div>
                            <div class="provider-location">Walmart</div>
                        </div>
                    </div>
                    <button type="button" class="view-package" onclick="location.href='<?php echo URLROOT; ?>/clients/viewpackage';">View Package →</button>
                </div>
            </div>

            <!-- Package Card 4 -->
            <div class="package-card">
                <div class="package-image" style="background-image: url('<?php echo URLROOT; ?>/img/home/image 12.svg?height=200&width=300');">
                    <div class="package-overlay">
                        <h3>Diamond Package</h3>
                        <ul>
                            <li>Pre-shoot</li>
                            <li>wedding Coverage</li>
                            <li>Two Albums</li>
                        </ul>
                        <div class="price">200,000/=</div>
                    </div>
                </div>
                <div class="package-footer">
                    <div class="provider">
                        <img src="<?php echo URLROOT; ?>/img/home/profile.svg?height=32&width=32" alt="Jenna Sullivan">
                        <div>
                            <div class="provider-name">Jenna Sullivan</div>
                            <div class="provider-location">Walmart</div>
                        </div>
                    </div>
                    <button type="button" class="view-package" onclick="location.href='<?php echo URLROOT; ?>/clients/viewpackage';">View Package →</button>
                </div>
            </div>
            <!-- Package Card 5 -->
            <div class="package-card">
                <div class="package-image" style="background-image: url('<?php echo URLROOT; ?>/img/home/image 12.svg?height=200&width=300');">
                    
                    <div class="package-overlay">
                        <h3>Diamond Package</h3>
                        <ul>
                            <li>Pre-shoot</li>
                            <li>wedding Coverage</li>
                            <li>Two Albums</li>
                        </ul>
                        <div class="price">200,000/=</div>
                    </div>
                </div>
                <div class="package-footer">
                    <div class="provider">
                        <img src="<?php echo URLROOT; ?>/img/home/profile.svg?height=32&width=32" alt="Jenna Sullivan">
                        <div>
                            <div class="provider-name">Jenna Sullivan</div>
                            <div class="provider-location">Walmart</div>
                        </div>
                    </div>
                    <button type="button" class="view-package" onclick="location.href='<?php echo URLROOT; ?>/clients/viewpackage';">View Package →</button>
                </div>
            </div>
            <button type="button" class="view-package" onclick="location.href='<?php echo URLROOT; ?>/Clients/allfinalpayment';">Final Full Payment →</button>
        </div>
        
    </section>
    </form>
    <?php require APPROOT . '/views/inc/footer.php';?>