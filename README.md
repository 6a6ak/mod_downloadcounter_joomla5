# Joomla Download Counter Module

This module tracks and displays the number of times a file has been downloaded.

## Features
- AJAX-based download counter
- Joomla database integration
- Easy to embed in Joomla articles or templates

## Usage
1. Install the module via Joomla Extension Manager.
2. Ensure your files are located in `/downloads/`.
3. Embed download links in your articles like:

```html
<script src="/modules/mod_downloadcounter/js/counter.js"></script>

<a href="#" class="my-download" data-id="1" data-url="/downloads/book.pdf">
  Download Book
</a>
<span class="download-count" id="count-1"></span>
```

## Database Table
This module automatically creates a table called `#__download_counter`.

## License
MIT
