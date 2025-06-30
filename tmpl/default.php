<?php 
defined('_JEXEC') or die; 

// Get the module path
$moduleUrl = JUri::root() . 'modules/mod_downloadcounter/';
?>
<div class="download-links">
  <?php foreach ($downloads as $item): ?>
    <div class="download-item" style="margin-bottom: 10px;">
      <a href="#" class="my-download" data-id="<?php echo $item['id']; ?>" data-url="<?php echo $item['url']; ?>" style="text-decoration: none; color: #0073aa; font-weight: bold;">
        <?php echo $item['title']; ?>
      </a>
      <span class="download-count" id="count-<?php echo $item['id']; ?>" style="margin-right: 10px; color: #666;">بارگیری...</span>
    </div>
  <?php endforeach; ?>
</div>

<?php if (!isset($GLOBALS['mod_downloadcounter_js_loaded'])): ?>
  <?php $GLOBALS['mod_downloadcounter_js_loaded'] = true; ?>
  <script src="<?php echo $moduleUrl; ?>js/counter.js"></script>
<?php endif; ?>
