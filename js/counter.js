document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.my-download').forEach(function (el) {
    const fileId = el.dataset.id;

    // Only read the count on load
    fetch('/modules/mod_downloadcounter/php/count_download.php?mode=read&id=' + fileId)
      .then(res => res.json())
      .then(data => {
        const countSpan = document.getElementById('count-' + fileId);
        if (countSpan && data.count !== undefined) {
          countSpan.textContent = ` (${data.count} بار دانلود شده)`;
        }
      });

    // Count only on click
    el.addEventListener('click', function (e) {
      e.preventDefault();
      const fileUrl = el.dataset.url;

      fetch('/modules/mod_downloadcounter/php/count_download.php?mode=update&id=' + fileId)
        .then(res => res.json())
        .then(data => {
          const countSpan = document.getElementById('count-' + fileId);
          if (countSpan && data.count !== undefined) {
            countSpan.textContent = ` (${data.count} بار دانلود شده)`;
          }

          const link = document.createElement('a');
          link.href = fileUrl;
          link.setAttribute('download', '');
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);
        })
        .catch(err => {
          console.error('Download error:', err);
        });
    });
  });
});
