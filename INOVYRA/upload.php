<?php
// Handle file upload
$uploadStatus = '';
$uploadMessage = '';
$uploadClass = '';

// Only process the upload if the form was submitted and a file was selected
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
    $targetDir = 'uploads/';
    $fileName = basename($_FILES['file']['name']);
    $targetFile = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Create uploads directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    // Check if there was an upload error
    if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        // Handle specific upload errors
        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $uploadStatus = 'error';
                $uploadMessage = 'The uploaded file exceeds the maximum file size limit.';
                $uploadClass = 'alert-error';
                break;
            case UPLOAD_ERR_PARTIAL:
                $uploadStatus = 'error';
                $uploadMessage = 'The uploaded file was only partially uploaded.';
                $uploadClass = 'alert-error';
                break;
            default:
                $uploadStatus = 'error';
                $uploadMessage = 'Sorry, there was an error uploading your file.';
                $uploadClass = 'alert-error';
        }
    } else {
        // File was uploaded successfully, now validate it
        // Check if file already exists
        if (file_exists($targetFile)) {
            $uploadStatus = 'error';
            $uploadMessage = 'Sorry, file already exists.';
            $uploadClass = 'alert-error';
        } 
        // Check file size (5MB max)
        elseif ($_FILES['file']['size'] > 5 * 1024 * 1024) {
            $uploadStatus = 'error';
            $uploadMessage = 'Sorry, your file is too large. Max size is 5MB.';
            $uploadClass = 'alert-error';
        } 
        // Allow certain file formats
        elseif (!in_array($fileType, ['csv', 'xlsx', 'xls'])) {
            $uploadStatus = 'error';
            $uploadMessage = 'Sorry, only CSV, XLSX & XLS files are allowed.';
            $uploadClass = 'alert-error';
        } 
        // Try to upload file
        elseif (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
            $uploadStatus = 'success';
            $uploadMessage = 'File uploaded successfully!';
            $uploadClass = 'alert-success';
            
            // Process the file here if needed
            // processFile($targetFile);
        } else {
            $uploadStatus = 'error';
            $uploadMessage = 'Sorry, there was an error uploading your file.';
            $uploadClass = 'alert-error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>INOVYRA</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    .theme-dot {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      display: inline-block;
      margin-right: 5px;
      cursor: pointer;
      border: 2px solid transparent;
    }
    .theme-dot.active {
      border-color: #fff;
    }
    .theme-light { background-color: #f7fafc; }
    .theme-dark { background-color: #1a202c; }
    .theme-blue { background-color: #1a365d; }
    .theme-picker {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: var(--card-bg);
      padding: 10px;
      border-radius: 8px;
      box-shadow: var(--shadow-md);
      z-index: 1000;
      display: none;
    }
    .theme-picker.active {
      display: block;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo">
        <div class="menu-icon" id="menuToggle">
          <i class="fas fa-bars"></i>
        </div>
        <h2>INOVYRA</h2>
      </div>
      <div class="sidebar-content">
        <nav class="sidebar-nav">
          <p><i class="fas fa-database"></i> <span>Data Connections</span></p>
          <p><i class="fas fa-tasks"></i> <span>Batch Processing</span></p>
          <p><i class="fas fa-chart-line"></i> <span>Analytics</span></p>
          <p><i class="fas fa-cog"></i> <span>Settings</span></p>
        </nav>
      </div>

    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <div class="form-container">
        <header class="form-header">
          <h1>Data Import</h1>
          <p>Upload your data files for processing and analysis</p>
        </header>

        <form id="uploadForm" action="" method="POST" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-box">
              <div class="form-group">
                <label for="sourceType" class="form-label">Source Type</label>
                <div class="input-row">
                  <select id="sourceType" name="sourceType" required>
                    <option value="" disabled selected>Select source type</option>
                    <option value="database">Database</option>
                    <option value="api">API</option>
                    <option value="file" selected>File Upload</option>
                    <option value="cloud">Cloud Storage</option>
                  </select>
                  <button type="button" class="menu-button">
                    <i class="fas fa-chevron-down"></i>
                  </button>
                </div>
              </div>
            </div>

            <div class="form-box">
              <div class="form-group">
                <label for="fileType" class="form-label">File Type</label>
                <div class="input-row">
                  <select id="fileType" name="fileType" required>
                    <option value="" disabled selected>Select file type</option>
                    <option value="csv">CSV</option>
                    <option value="excel">Excel (XLSX/XLS)</option>
                    <option value="json">JSON</option>
                    <option value="xml">XML</option>
                  </select>
                  <button type="button" class="menu-button">
                    <i class="fas fa-chevron-down"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- File Upload Section -->
          <div class="upload-section" id="dropZone">
            <div class="upload-icon">
              <i class="fas fa-cloud-upload-alt"></i>
            </div>
            <h3>Drag & Drop your file here</h3>
            <p class="upload-text">or</p>
            <label for="fileInput" class="upload-button">
              <i class="fas fa-folder-open"></i> Browse Files
              <input type="file" id="fileInput" name="file" class="file-input" required>
            </label>
            <div id="fileName" class="file-name">No file chosen</div>
          </div>

          <div class="form-actions">
            <button type="submit" class="upload-button" id="submitBtn">
              <span id="buttonText">Upload File</span>
              <div id="loading" class="loading" style="display: none;"></div>
            </button>
          </div>
        </form>

        <!-- Results Box -->
        <div id="resultsBox" class="results-box" style="display: none;">
          <div id="alertMessage" class="alert">
            <i id="alertIcon" class="fas"></i>
            <span id="alertText"></span>
          </div>
          <div id="infoAlert" class="alert" style="display: none;">
            <i class="fas fa-info-circle"></i>
            <span>Your file is being processed. You'll be notified when it's ready.</span>
          </div>
        </div>
        
        <?php if (!empty($uploadStatus)): ?>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              showAlert(
                '<?php echo $uploadMessage; ?>',
                '<?php echo $uploadClass; ?>',
                '<?php echo $uploadStatus === 'success' ? 'check-circle' : 'exclamation-circle'; ?>',
                <?php echo $uploadStatus === 'success' ? 'true' : 'false'; ?>
              );
            });
          </script>
        <?php endif; ?>
      </div>
    </main>
  </div>



  <footer>
    <div class="footer-content">
      <div class="footer-section">
        <div class="theme-selector">
          <div class="theme-option" data-theme="blue">
            <span class="theme-color" style="background: #3182ce"></span>
            <span class="theme-name">Blue</span>
          </div>
          <div class="theme-option" data-theme="dark">
            <span class="theme-color" style="background: #1a202c"></span>
            <span class="theme-name">Dark</span>
          </div>
          <div class="theme-option" data-theme="ocean">
            <span class="theme-color" style="background: #06b6d4"></span>
            <span class="theme-name">Ocean</span>
          </div>
          <div class="theme-option" data-theme="leaf">
            <span class="theme-color" style="background: #10b981"></span>
            <span class="theme-name">Leaf</span>
          </div>
        </div>
      </div>
      <div class="footer-section">
        <div class="follow">
          <p>Follow us:</p>
          <div class="social-links">
            <a href="https://www.facebook.com/inovyra" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
            <a href="https://github.com/inovyra" target="_blank" rel="noopener noreferrer" aria-label="GitHub"><i class="fab fa-github"></i></a>
            <a href="https://www.youtube.com/@InovyraEsports" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
            <a href="https://www.linkedin.com/company/inovyra" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script>
    // Supported formats for conversion
    const supportedFormats = {
        'csv': ['xlsx', 'json', 'xml'],
        'xlsx': ['csv', 'json', 'xls'],
        'xls': ['csv', 'xlsx', 'json'],
        'json': ['csv', 'xlsx'],
        'xml': ['csv', 'json']
    };

    // Format display names
    const formatNames = {
        'csv': 'CSV',
        'xlsx': 'Excel (XLSX)',
        'xls': 'Excel (XLS)',
        'json': 'JSON',
        'xml': 'XML'
    };

    // Update conversion options based on selected file
    function updateConversionOptions(fileExt) {
        const container = document.getElementById('formatOptions');
        const conversionSection = document.getElementById('conversionOptions');
        container.innerHTML = '';
        
        if (fileExt && supportedFormats[fileExt]) {
            conversionSection.style.display = 'block';
            supportedFormats[fileExt].forEach(format => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'format-button';
                button.textContent = formatNames[format] || format.toUpperCase();
                button.dataset.format = format;
                button.onclick = function() {
                    // Update active button
                    document.querySelectorAll('.format-button').forEach(btn => {
                        btn.classList.remove('active');
                    });
                    this.classList.add('active');
                    document.getElementById('targetFormat').value = format;
                };
                container.appendChild(button);
            });
        } else {
            conversionSection.style.display = 'none';
            document.getElementById('targetFormat').value = '';
        }
    }

    // Alert handler
    function showAlert(message, alertClass, icon, isSuccess = false) {
      const resultsBox = document.getElementById('resultsBox');
      const alertMessage = document.getElementById('alertMessage');
      const alertText = document.getElementById('alertText');
      const alertIcon = document.getElementById('alertIcon');
      const infoAlert = document.getElementById('infoAlert');
      
      // Update alert content
      alertText.textContent = message;
      alertMessage.className = `alert ${alertClass}`;
      alertIcon.className = `fas fa-${icon}`;
      
      // Show/hide info alert
      infoAlert.style.display = isSuccess ? 'flex' : 'none';
      
      // Show the results box
      resultsBox.style.display = 'block';
      
      // Auto-hide after 5 seconds for non-success messages
      if (!isSuccess) {
        setTimeout(() => {
          resultsBox.style.opacity = '1';
          setTimeout(() => {
            resultsBox.style.opacity = '0';
            setTimeout(() => {
              resultsBox.style.display = 'none';
            }, 300);
          }, 5000);
        }, 100);
      } else {
        resultsBox.style.opacity = '1';
      }
    }
    
    // Theme switcher
    function switchTheme(theme) {
      document.documentElement.setAttribute('data-theme', theme);
      localStorage.setItem('theme', theme);
      
      // Update active state for theme options
      document.querySelectorAll('.theme-option').forEach(option => {
        const isActive = option.getAttribute('data-theme') === theme;
        option.classList.toggle('active', isActive);
        
        // Add a checkmark to the active theme
        const checkmark = option.querySelector('.theme-check') || document.createElement('span');
        if (isActive) {
          checkmark.className = 'theme-check';
          checkmark.innerHTML = '&#10003;';
          if (!option.contains(checkmark)) {
            option.insertBefore(checkmark, option.firstChild);
          }
        } else if (checkmark) {
          checkmark.remove();
        }
      });
    }

    // Initialize theme from localStorage
    const savedTheme = localStorage.getItem('theme') || 'light';
    switchTheme(savedTheme);

    // Theme click handler with smooth transition
    document.querySelectorAll('.theme-option').forEach(option => {
      option.addEventListener('click', (e) => {
        e.preventDefault();
        const theme = option.getAttribute('data-theme');
        if (theme) {
          // Add a temporary class for click feedback
          option.classList.add('theme-clicked');
          setTimeout(() => option.classList.remove('theme-clicked'), 200);
          
          // Switch theme
          switchTheme(theme);
        }
      });
    });

    // Toggle sidebar
    function toggleSidebar() {
      const sidebar = document.querySelector('.sidebar');
      const mainContent = document.querySelector('.main-content');
      
      sidebar.classList.toggle('collapsed');
      mainContent.classList.toggle('expanded');
      
      // Save sidebar state
      const isCollapsed = sidebar.classList.contains('collapsed');
      localStorage.setItem('sidebarCollapsed', isCollapsed);
    }

    // Initialize sidebar state
    function initSidebar() {
      const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
      const sidebar = document.querySelector('.sidebar');
      const mainContent = document.querySelector('.main-content');
      
      if (isCollapsed) {
        sidebar.classList.add('collapsed');
        mainContent.classList.add('expanded');
      }
    }

    // Initialize the application
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize sidebar state
      initSidebar();
      
      // Toggle sidebar on menu button click
      const menuToggle = document.getElementById('menuToggle');
      if (menuToggle) {
        menuToggle.addEventListener('click', function(e) {
          e.stopPropagation();
          toggleSidebar();
        });
      }

      // Theme switcher for footer
      document.querySelectorAll('.themes span').forEach(button => {
        button.addEventListener('click', function() {
          const theme = this.getAttribute('data-theme');
          switchTheme(theme);
        });
      });

      // Close sidebar when clicking outside on mobile
      document.addEventListener('click', function(e) {
        const sidebar = document.querySelector('.sidebar');
        if (window.innerWidth <= 768 && sidebar && !sidebar.contains(e.target) && !e.target.closest('#menuToggle') && !sidebar.classList.contains('collapsed')) {
          toggleSidebar();
        }
      });

      // Load saved theme
      const savedTheme = localStorage.getItem('theme') || 'light';
      switchTheme(savedTheme);
      
      // Set active nav item
      const currentPath = window.location.pathname.split('/').pop() || 'upload.php';
      document.querySelectorAll('.sidebar-nav p').forEach(item => {
        const itemText = item.textContent.trim().toLowerCase().replace(/\s+/g, '-');
        if (currentPath.includes(itemText)) {
          document.querySelector('.sidebar-nav p.active')?.classList.remove('active');
          item.classList.add('active');
        }
      });
    });



    // File input handler
    const fileInput = document.getElementById('fileInput');
    const dropZone = document.getElementById('dropZone');
    const fileName = document.getElementById('fileName');
    const form = document.getElementById('uploadForm');
    const submitBtn = document.getElementById('submitBtn');
    const buttonText = document.getElementById('buttonText');
    const loading = document.getElementById('loading');

    // Handle file selection
    fileInput.addEventListener('change', function(e) {
      if (this.files.length > 0) {
        fileName.textContent = this.files[0].name;
      } else {
        fileName.textContent = 'No file chosen';
      }
    });

    // Drag and drop functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
      dropZone.addEventListener(eventName, preventDefaults, false);
    });


    function preventDefaults(e) {
      e.preventDefault();
      e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
      dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
      dropZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight() {
      dropZone.classList.add('highlight');
    }

    function unhighlight() {
      dropZone.classList.remove('highlight');
    }

    // Handle dropped files
    dropZone.addEventListener('drop', handleDrop, false);


    function handleDrop(e) {
      const dt = e.dataTransfer;
      const files = dt.files;
      
      if (files.length) {
        fileInput.files = files;
        fileName.textContent = files[0].name;
      }
    }

    // Form submission
    form.addEventListener('submit', function(e) {
      if (fileInput.files.length === 0) {
        e.preventDefault();
        return;
      }
      
      // Show loading state
      buttonText.textContent = 'Uploading...';
      submitBtn.disabled = true;
      loading.style.display = 'inline-block';
    });
  </script>
</body>
</html>
