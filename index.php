<!DOCTYPE html>
<html>
<head>
  <title>Markdown Editor</title>
  <style>
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }

    .editor-container {
      display: flex;
      flex-direction: row;
      width: 90%;
      margin-bottom: 20px;
    }

    #editor {
      flex: 1;
      height: 400px;
      border: 1px solid #ccc;
      padding: 10px;
      resize: none;
    }

    #preview-container {
      position: relative;
      flex: 1;
      height: 400px;
      border: 1px solid #ccc;
      padding: 10px;
      overflow: auto;
    }

    #preview-frame {
      width: 100%;
      height: 100%;
      border: none;
    }

    #fullscreen-button {
      position: absolute;
      top: 10px;
      right: 10px;
      z-index: 999;
    }
  </style>
</head>
<body>
  <h1>Markdown Editor</h1>

  <div class="editor-container">
    <!-- Markdown editor -->
    <textarea id="editor" placeholder="Write your Markdown text here..." oninput="updatePreview()"></textarea>

    <!-- Preview container with iframe -->
    <div id="preview-container">
      <iframe id="preview-frame" sandbox="allow-scripts"></iframe>
      <button id="fullscreen-button" onclick="toggleFullScreen()">Toggle Full Screen</button>
    </div>
  </div>

  <script>
    // Function to update the preview
    function updatePreview() {
      const markdownText = document.getElementById('editor').value;
      const html = marked(markdownText);

      // Access the iframe
      const previewFrame = document.getElementById('preview-frame');

      // Create a data URL with the HTML content
      const dataUrl = 'data:text/html;charset=utf-8,' + encodeURIComponent(html);

      // Set the iframe source to the data URL
      previewFrame.src = dataUrl;
    }

    // Function to toggle full screen for the preview container
    function toggleFullScreen() {
      const previewContainer = document.getElementById('preview-container');
      const fullscreenButton = document.getElementById('fullscreen-button');

      if (!document.fullscreenElement) {
        previewContainer.requestFullscreen().catch(err => {
          console.error(`Error attempting to enable full-screen mode: ${err.message}`);
        });
        fullscreenButton.textContent = 'Close Full Screen';
      } else {
        document.exitFullscreen();
        fullscreenButton.textContent = 'Toggle Full Screen';
      }
    }
  </script>

  <!-- Include marked.js for Markdown to HTML conversion -->
  <script src="https://cdn.jsdelivr.net/npm/marked@2.1.3/marked.min.js"></script>
</body>
</html>
