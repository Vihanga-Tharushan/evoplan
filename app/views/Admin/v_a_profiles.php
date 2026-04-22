<?php require_once APPROOT . '/views/Admin/Sidebar/v_a_sidebar.php'; ?>
<?php require_once APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="../public/css/components/Admin/style(Admin_Profiles).css">

<div class="profiles-container">
  <!-- Header -->
  <div class="profiles-header">
    <h1>User Profiles</h1>
    <p>Manage and view all users across different categories</p>
  </div>

  <!-- Search Bar -->
  <div class="search-section">
    <div class="search-bar-wrapper">
      <i class="fas fa-search"></i>
      <input 
        type="text" 
        id="searchInput" 
        placeholder="Search by name or email..." 
        class="search-input"
      >
    </div>
  </div>

  <!-- Category Tabs -->
  <div class="category-tabs">
    <button class="tab-btn active" data-category="all" onclick="filterCategory('all')">
      <i class="fas fa-users"></i>
      <span>All Users</span>
      <span class="count">0</span>
    </button>
    <button class="tab-btn" data-category="clients" onclick="filterCategory('clients')">
      <i class="fas fa-user-circle"></i>
      <span>Clients</span>
      <span class="count">0</span>
    </button>
    <button class="tab-btn" data-category="service-providers" onclick="filterCategory('service-providers')">
      <i class="fas fa-briefcase"></i>
      <span>Service Providers</span>
      <span class="count">0</span>
    </button>
  </div>

  <!-- Profiles Container -->
  <div class="profiles-content">
    <!-- All Users Section -->
    <div id="all" class="category-content active">
      <div class="category-header">
        <h2>All Users</h2>
        <div class="view-toggle">
          <button class="view-btn active" data-view="list" onclick="toggleView('list')">
            <i class="fas fa-list"></i>
          </button>
          <button class="view-btn" data-view="grid" onclick="toggleView('grid')">
            <i class="fas fa-th"></i>
          </button>
        </div>
      </div>
      <div id="all-list" class="profiles-list"></div>
    </div>

    <!-- Clients Section -->
    <div id="clients" class="category-content">
      <div class="category-header">
        <h2>Client Profiles</h2>
        <span class="profile-count">0 profiles</span>
      </div>
      <div id="clients-list" class="profiles-list"></div>
    </div>

    <!-- Service Providers Section -->
    <div id="service-providers" class="category-content">
      <div class="category-header">
        <h2>Service Provider Profiles</h2>
        <span class="profile-count">0 profiles</span>
      </div>
      <div id="service-providers-list" class="profiles-list"></div>
    </div>
  </div>
</div>

<script>
  // Debug: Check what data is being passed
  console.log('Raw data from PHP:', <?php echo json_encode(['clients' => count($data['clients'] ?? []), 'serviceProviders' => count($data['serviceProviders'] ?? [])]); ?>);

  // Data from database
  const profilesData = {
    clients: [
      <?php
        if (!empty($data['clients'])) {
          foreach ($data['clients'] as $client) {
            $profile_pic = isset($client->profile_pic) && !empty($client->profile_pic) ? $client->profile_pic : '../public/img/Admin/default-profile.jpg';
            $created_at = isset($client->created_at) ? $client->created_at : date('Y-m-d H:i:s');
            echo "{
              id: '{$client->client_id}',
              name: '" . addslashes($client->name) . "',
              email: '{$client->email}',
              joinDate: '{$created_at}',
              status: 'Active',
              category: 'Clients',
              avatar: '{$profile_pic}'
            },";
          }
        } else {
          echo "// No clients data";
        }
      ?>
    ],
    serviceProviders: [
      <?php
        if (!empty($data['serviceProviders'])) {
          foreach ($data['serviceProviders'] as $provider) {
            $category = isset($provider->service_type) ? $provider->service_type : 'Service Provider';
            $profile_pic = isset($provider->profile_pic) && !empty($provider->profile_pic) ? $provider->profile_pic : '../public/img/Admin/default-profile.jpg';
            $created_at = isset($provider->created_at) ? $provider->created_at : date('Y-m-d H:i:s');
            $fname = isset($provider->fname) ? $provider->fname : '';
            $lname = isset($provider->lname) ? $provider->lname : '';
            echo "{
              id: '{$provider->service_id}',
              name: '" . addslashes($fname . ' ' . $lname) . "',
              email: '{$provider->email}',
              category: '{$category}',
              joinDate: '{$created_at}',
              status: 'Active',
              avatar: '{$profile_pic}'
            },";
          }
        } else {
          echo "// No service providers data";
        }
      ?>
    ]
  };

  console.log('profilesData loaded:', profilesData);

  let currentView = 'list';
  let currentCategory = 'all';

  // Initialize
  function initProfiles() {
    renderProfiles();
    updateCounts();
  }

  // Render profiles
  function renderProfiles() {
    const allProfiles = [...profilesData.clients, ...profilesData.serviceProviders];
    
    // Render by category
    renderCategory('all', allProfiles);
    renderCategory('clients', profilesData.clients);
    renderCategory('service-providers', profilesData.serviceProviders);
  }

  function renderCategory(category, profiles) {
    const container = document.getElementById(`${category}-list`);
    if (!container) return;

    if (profiles.length === 0) {
      container.innerHTML = '<div class="empty-state"><p>No profiles found</p></div>';
      return;
    }

    container.innerHTML = profiles.map(profile => `
      <div class="profile-item" data-searchable="${(profile.name + ' ' + profile.email).toLowerCase()}">
        <div class="profile-main">
          <!-- <img class="profile-avatar" src="${profile.avatar}" alt="${profile.name}" onerror="this.src='../public/img/Admin/default-profile.jpg'" /> -->
          <div class="profile-info">
            <h3>${profile.name}</h3>
            <p class="profile-id">${profile.id}</p>
            <p class="profile-email">${profile.email}</p>
            ${profile.category ? `<span class="profile-category">${profile.category}</span>` : ''}
          </div>
        </div>
        <div class="profile-meta">
          <span class="profile-status ${profile.status === 'Active' ? 'active' : 'inactive'}">${profile.status}</span>
          <span class="profile-date">${profile.joinDate}</span>
        </div>
        <div class="profile-actions">
          <!-- <button class="btn-icon" title="View Details">
            <i class="fas fa-eye"></i>
          </button> -->
          <button class="btn-icon danger" title="Deactivate" onclick="confirmDeleteProfile('${profile.id}', '${profile.category}')">
            <i class="fas fa-ban"></i>
          </button>
        </div>
      </div>
    `).join('');
  }

  // Filter category
  function filterCategory(category) {
    currentCategory = category;
    document.querySelectorAll('.category-content').forEach(el => el.classList.remove('active'));
    document.getElementById(category).classList.add('active');
    
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`[data-category="${category}"]`).classList.add('active');
  }

  // Toggle view
  function toggleView(view) {
    currentView = view;
    const container = document.getElementById(`${currentCategory}-list`);
    if (container) {
      container.classList.toggle('grid-view', view === 'grid');
    }
    
    document.querySelectorAll('.view-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`[data-view="${view}"]`).classList.add('active');
  }

  // Search functionality
  document.getElementById('searchInput').addEventListener('keyup', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const items = document.querySelectorAll('.profile-item');
    
    items.forEach(item => {
      const searchable = item.getAttribute('data-searchable');
      item.style.display = searchable.includes(searchTerm) ? 'flex' : 'none';
    });
    
    // Update counts based on visible items
    updateFilteredCounts();
  });

  // Update counts based on filtered results
  function updateFilteredCounts() {
    const allVisibleCount = document.querySelectorAll('#all-list .profile-item[style="display: flex"], #all-list .profile-item:not([style*="display: none"])').length;
    const clientsVisibleCount = document.querySelectorAll('#clients-list .profile-item[style="display: flex"], #clients-list .profile-item:not([style*="display: none"])').length;
    const providersVisibleCount = document.querySelectorAll('#service-providers-list .profile-item[style="display: flex"], #service-providers-list .profile-item:not([style*="display: none"])').length;
    
    document.querySelector('[data-category="all"] .count').textContent = allVisibleCount;
    document.querySelector('[data-category="clients"] .count').textContent = clientsVisibleCount;
    document.querySelector('[data-category="service-providers"] .count').textContent = providersVisibleCount;
  }

  // Update counts
  function updateCounts() {
    const allCount = profilesData.clients.length + profilesData.serviceProviders.length;
    document.querySelector('[data-category="all"] .count').textContent = allCount;
    document.querySelector('[data-category="clients"] .count').textContent = profilesData.clients.length;
    document.querySelector('[data-category="service-providers"] .count').textContent = profilesData.serviceProviders.length;
  }

  // Delete profile with confirmation
  function confirmDeleteProfile(userId, category) {
    const userType = category === 'Clients' ? 'client' : 'service_provider';
    const categoryName = category === 'Clients' ? 'Client' : 'Service Provider';
    
    if (confirm(`Are you sure you want to deactivate this ${categoryName}? They can be reactivated later.`)) {
      window.location.href = '<?php echo URLROOT; ?>/Admin/delete_profile/' + userId + '/' + userType;
    }
  }

  // Initialize on page load
  window.addEventListener('DOMContentLoaded', initProfiles);
</script>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>