<?php defined('_JEXEC') or die; ?>
<div class="download-links">
  <?php foreach ($downloads as $item): ?>
    <a href="#" class="my-download" data-id="<?php echo $item['id']; ?>" data-url="<?php echo $item['url']; ?>">
      <?php echo $item['title']; ?>
    </a>
    <span class="download-count" id="count-<?php echo $item['id']; ?>">... بار دانلود شده</span>
    <br>
  <?php endforeach; ?>
</div>
<script src="modules/mod_downloadcounter/js/counter.js"></script>
