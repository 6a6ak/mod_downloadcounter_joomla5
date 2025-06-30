// Prevent multiple initializations
if (typeof window.downloadCounterInitialized === 'undefined') {
  window.downloadCounterInitialized = true;

  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.my-download').forEach(function (el) {
      // Check if already initialized to prevent duplicate listeners
      if (el.dataset.initialized === 'true') {
        return;
      }
      el.dataset.initialized = 'true';
      
      const fileId = el.dataset.id;

      // Only read the count on load
      fetch('/modules/mod_downloadcounter/php/count_download.php?mode=read&id=' + fileId)
        .then(res => res.json())
        .then(data => {
          const countSpan = document.getElementById('count-' + fileId);
          if (countSpan && data.count !== undefined) {
            countSpan.textContent = `(${data.count} بار دانلود شده)`;
          }
        })
        .catch(err => {
          console.error('Error loading count:', err);
          const countSpan = document.getElementById('count-' + fileId);
          if (countSpan) {
            countSpan.textContent = '(خطا در بارگیری)';
          }
        });

      // Count only on click
      el.addEventListener('click', function (e) {
        e.preventDefault();
        
        // Prevent multiple clicks
        if (el.dataset.downloading === 'true') {
          return;
        }
        el.dataset.downloading = 'true';
        
        const fileUrl = el.dataset.url;

        fetch('/modules/mod_downloadcounter/php/count_download.php?mode=update&id=' + fileId)
          .then(res => res.json())
          .then(data => {
            const countSpan = document.getElementById('count-' + fileId);
            if (countSpan && data.count !== undefined) {
              countSpan.textContent = `(${data.count} بار دانلود شده)`;
            }

            // Start the download
            const link = document.createElement('a');
            link.href = fileUrl;
            link.setAttribute('download', '');
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
          })
          .catch(err => {
            console.error('Download error:', err);
            // Still allow the download even if count update fails
            const link = document.createElement('a');
            link.href = fileUrl;
            link.setAttribute('download', '');
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
          })
          .finally(() => {
            // Reset the downloading flag after a short delay
            setTimeout(() => {
              el.dataset.downloading = 'false';
            }, 1000);
          });
      });
    });
  });
}
