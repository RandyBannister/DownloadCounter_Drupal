<?php
/**
 * Plugin Name: Calclavia Download Counter
 * Plugin URI: http://calclavia.com
 * Description: A download counter previewer. Uses MySQL databases. [downloadcounter id="downloadName/url"]
 * Version: 1.0.0
 * Author: Calclavia
 * Author URI: http://calclavia.com
 * License: LGPL3
 */

function getDownloadCountFor($name)
{
    global $wpdb;

	$data = $wpdb->get_var("SELECT * FROM {download_counter} WHERE name = :name LIMIT 1", array(':name' => $name));
	if ($data)
	{

		if (empty($data -> count) || $data -> count == null || $data -> count < 0)
		{
			$data -> count = 0;
		}

		return $data -> count;
	}
	
	return 0;
}

function downloadcount_filter($atts)
{
    if(!empty($atts['id']))
    {
        return getDownloadCountFor($atts['id']);
    }
    
    return "<p>Please specify a download ID.";
}

add_shortcode('downloadcount', 'downloadcount_filter');

?>