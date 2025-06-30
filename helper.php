<?php
defined('_JEXEC') or die;

class ModDownloadCounterHelper
{
    /**
     * Get download items
     * 
     * @param   \Joomla\Registry\Registry  $params  Module parameters
     * @return  array                               Array of download items
     */
    public static function getDownloads($params)
    {
        // Static download items - you can extend this to use database or parameters
        $downloads = [
            [
                'id' => 1,
                'title' => 'دانلود فایل Book',
                'url' => '/downloads/book.pdf'
            ],
            [
                'id' => 2,
                'title' => 'دانلود فایل book2',
                'url' => '/downloads/book2.pdf'
            ]
        ];
        
        return $downloads;
    }
    
    /**
     * Get single download item by ID
     * 
     * @param   int  $id  Download ID
     * @return  array|null  Download item or null if not found
     */
    public static function getDownloadById($id)
    {
        $downloads = self::getDownloads(null);
        
        foreach ($downloads as $download) {
            if ($download['id'] == $id) {
                return $download;
            }
        }
        
        return null;
    }
}
