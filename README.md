# Joomla Download Counter Module

This module tracks and displays the number of times a file has been downloaded.

## Features
- AJAX-based download counter
- Joomla database integration
- Easy to embed in Joomla articles or templates
- Support for multiple download items
- Tracks download dates and file information

## Installation

1. Install the module through Joomla's Extension Manager
2. The module will automatically create the required database table
3. For existing installations, the update SQL will add new columns automatically

## Usage

### Adding New Download Items

To add new download items, edit the `helper.php` file and add entries to the `getDownloads()` method:

```php
$downloads = [
    [
        'id' => 1,
        'title' => 'دانلود فایل Book',
        'url' => '/downloads/book.pdf'
    ],
    [
        'id' => 2,
        'title' => 'دانلود فایل Guide', 
        'url' => '/downloads/guide.pdf'
    ],
    // Add more items here
];
```

### Database Structure

The module uses the `#__download_counter` table with the following structure:
- `file_id`: Unique identifier for each download item
- `count`: Number of downloads
- `title`: Title of the download item
- `file_path`: Path to the file
- `created_date`: When the record was created
- `last_downloaded`: When the file was last downloaded

### Customization

You can customize the appearance by editing the `tmpl/default.php` template file.

## Files Structure

- `mod_downloadcounter.php` - Main module file
- `helper.php` - Helper class with download data
- `tmpl/default.php` - Template file for display
- `js/counter.js` - JavaScript for AJAX functionality
- `php/count_download.php` - Backend script for counting downloads
- `sql/install.mysql.utf8.sql` - Database installation script
- `sql/update.mysql.utf8.sql` - Database update script
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
