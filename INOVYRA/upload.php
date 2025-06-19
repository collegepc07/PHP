<?php
// Handle file upload
$uploadStatus = '';
$uploadMessage = '';
$uploadClass = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $targetDir = 'uploads/';
    $fileName = basename($_FILES['file']['name']);
    $targetFile = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Create uploads directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
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
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>File Upload | INOVYRA</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
      <nav class="sidebar-nav">
        <p class="active"><i class="fas fa-upload"></i> File Upload</p>
        <p><i class="fas fa-database"></i> Data Connections</p>
        <p><i class="fas fa-tasks"></i> Batch Processing</p>
        <p><i class="fas fa-chart-line"></i> Analytics</p>
        <p><i class="fas fa-cog"></i> Settings</p>
      </nav>
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
        <?php if (!empty($uploadStatus)): ?>
          <div class="results-box">
            <div class="alert <?php echo $uploadClass; ?>">
              <?php if ($uploadStatus === 'success'): ?>
                <i class="fas fa-check-circle"></i>
              <?php else: ?>
                <i class="fas fa-exclamation-circle"></i>
              <?php endif; ?>
              <span><?php echo $uploadMessage; ?></span>
            </div>
            <?php if ($uploadStatus === 'success'): ?>
              <div class="alert">
                <i class="fas fa-info-circle"></i>
                <span>Your file is being processed. You'll be notified when it's ready.</span>
              </div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </main>
  </div>

  <footer>
    <div class="themes">
      <p>Themes:</p>
      <span data-theme="light">Light</span>
      <span data-theme="dark">Dark</span>
      <span data-theme="ocean">Ocean</span>
      <span data-theme="leaf">Leaf</span>
    </div>
    <div class="follow">
      <p>Follow us:</p>
      <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
      <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
      <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
      <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
    </div>
  </footer>

  <script>
    // Toggle sidebar on mobile
    document.getElementById('menuToggle').addEventListener('click', function() {
      document.querySelector('.sidebar').classList.toggle('active');
    });

    // Theme switcher
    document.querySelectorAll('[data-theme]').forEach(button => {
      button.addEventListener('click', function() {
        const theme = this.getAttribute('data-theme');
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
      });
    });

    // Load saved theme
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.documentElement.setAttribute('data-theme', savedTheme);

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
