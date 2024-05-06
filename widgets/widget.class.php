<?php

class WP_YouTubeWidget extends WP_Widget {

    var $url = "";

function __construct(){
    
    parent::__construct('WP_YouTubeWidget', __('YouTube Video Feed', 'engr_foundation'), array('description' => __('A Widget that extracts a YouTube Video and its videos from a playlist', 'engr_foundation'),));
    
}

public function widget($args, $instance){
    
    $title = $instance['title'];

	$ch = curl_init();
	$data = "";
	$result = null;

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec ($ch);
	$data = json_decode($result);
	
	curl_close ($ch);
	
        $videos = $data->data;		

    
    print $args['before_widget'];

    if(!empty($title)) {
        
    print $args['before_title'];
    print $title;
    print $args['after_title'];
        
    }

    $this->displayVideos($instance);    
    
    print $args['after_widget']; 
    
}

public function form($instance){

?>

<p>
    <label for = "<?php print $this->get_field_id('title'); ?>"?><?php _e('Title: '); ?></label>
    <input class = "widefat" id = "<?php print $this->get_field_id('title') ?>" name = "<?php print $this->get_field_name('title'); ?>" value = "<?php print esc_attr($instance['title']); ?>" type = "text"/>
</p>
<p>
    <label for = "<?php print $this->get_field_id('json_url'); ?>"?><?php _e('JSON URL: '); ?></label>
    <input class = "widefat" id = "<?php print $this->get_field_id('json_url') ?>" name = "<?php print $this->get_field_name('json_url'); ?>" value = "<?php print esc_attr($instance['json_url']); ?>" type = "text" />
</p>
<p>
    <label for = "<?php print $this->get_field_id('disable_list'); ?>"?><?php _e('Disable List: '); ?>
    <select id = "<?php print $this->get_field_id('disable_list') ?>" name = "<?php print $this->get_field_name('disable_list'); ?>" >
        <option value = "Y" <?php print ((esc_attr($instance['disable_list']) == "Y") ? "selected" : "") ?>>Yes</option>
        <option value = "N" <?php print ((esc_attr($instance['disable_list']) == "N") ? "selected" : "") ?>>No</option>
    </select>
    </label>
</p>
<p>
    <label for = "<?php print $this->get_field_id('display_type'); ?>"?><?php _e('List Display Type: '); ?>
    <select id = "<?php print $this->get_field_id('display_type') ?>" name = "<?php print $this->get_field_name('display_type'); ?>" >
        <option value = "V" <?php print ((esc_attr($instance['display_type']) == "V") ? "selected" : "") ?>>Vertical</option>
        <option value = "H" <?php print ((esc_attr($instance['display_type']) == "H") ? "selected" : "") ?>>Horizontal</option>
    </select>
    </label>
</p>
<p>
    <label for = "<?php print $this->get_field_id('display_amt'); ?>"?><?php _e('Amount to Display: '); ?>
    <select id = "<?php print $this->get_field_id('display_amt') ?>" name = "<?php print $this->get_field_name('display_amt'); ?>" >
<?php for($i = 1; $i < 11; $i++){ ?>
        <option value = "<?php print $i; ?>" <?php print ((esc_attr($instance['display_amt']) == "$i") ? "selected" : "") ?>><?php print $i; ?></option>
<?php } ?>
    </select>
    </label>
</p>
<p>
    <label for = "<?php print $this->get_field_id('for_more_goto_txt'); ?>"?><?php _e('For More Text: '); ?><br />
    <input type = "text" id = "<?php print $this->get_field_id('for_more_goto_txt') ?>" name = "<?php print $this->get_field_name('for_more_goto_txt'); ?>" value = "<?php print esc_attr($instance['for_more_goto_txt']); ?>" />
    </label>
</p>
<p>
    <label for = "<?php print $this->get_field_id('for_more_goto_url'); ?>"?><?php _e('For More URL: '); ?><br />
    <input type = "text" id = "<?php print $this->get_field_id('for_more_goto_url') ?>" name = "<?php print $this->get_field_name('for_more_goto_url'); ?>" value = "<?php print esc_attr($instance['for_more_goto_url']); ?>" />
    </label>
</p>
<p>
    <label for = "<?php print $this->get_field_id('for_more_goto_label'); ?>"?><?php _e('For More URL Label: '); ?>
    <input type = "text" id = "<?php print $this->get_field_id('for_more_goto_label') ?>" name = "<?php print $this->get_field_name('for_more_goto_label'); ?>" value = "<?php print esc_attr($instance['for_more_goto_label']); ?>" />
    </label>
</p>

<?php
    
}

public function update($new_instance, $old_instance){
    
    $instance = array();

    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    $instance['json_url'] = (!empty($new_instance['json_url'])) ? strip_tags($new_instance['json_url']) : '';
    $instance['display_type'] = (!empty($new_instance['display_type'])) ? strip_tags($new_instance['display_type']) : '';
    $instance['disable_list'] = (!empty($new_instance['disable_list'])) ? strip_tags($new_instance['disable_list']) : '';
    $instance['display_amt'] = (!empty($new_instance['display_amt'])) ? strip_tags($new_instance['display_amt']) : '';
    $instance['for_more_goto_url'] = (!empty($new_instance['for_more_goto_url']) && filter_var($new_instance['for_more_goto_url'], FILTER_VALIDATE_URL)) ? strip_tags($new_instance['for_more_goto_url']) : '';
    $instance['for_more_goto_label'] = (!empty($new_instance['for_more_goto_label'])) ? strip_tags($new_instance['for_more_goto_label']) : '';
    $instance['for_more_goto_txt'] = (!empty($new_instance['for_more_goto_txt'])) ? strip_tags($new_instance['for_more_goto_txt']) : '';
    
    return $instance;
    
}

function displayVideos($instance){
    
    $tmp = null;
    $data = null;
    $videos = null;
    $video = null;
    $amt = 0;
    
    $tmp = $instance;

    if($tmp['json_url'] != "" && $tmp['json_url'] != null && filter_var($tmp['json_url'], FILTER_VALIDATE_URL)){
        
    $data = $this->getVideoFeeds($tmp['json_url']);

        if($data != null){

        $amt = count($data->items);
        
        for($i = 0; $i < 4; $i++){
            
        $videos[$i] = $data->items[$i];
            
        }
        
        $amt = count($videos);
        $video = $videos[0];
        
        ?>
<p><iframe src="http://www.youtube.com/embed/<?php print $video->video->id ?>" name = "featuredVid" id = "featuredVid" width="100%" height="315" frameborder="0" allowfullscreen="allowfullscreen"></iframe></p>
        <?php

            if($tmp['disable_list'] == "N"){
            
                if($tmp['display_type'] == "H"){
                
?>
<ul class="small-block-grid-3 large-block-grid-4">
<?php           for($i = 0; $i < $amt; $i++){
    
                $video = $videos[$i];    
    
?>
          <li class = "videoText"><a href = "http://www.youtube.com/embed/<?php print $video->video->id ?>" target = "featuredVid"><img src = "<?php print $video->video->thumbnail->hqDefault; ?>" alt = "icon" />
          <br />
          <?php print $video->video->title; ?>
          </a></li>  
<?php           } ?>
            </ul>
<?php if(!empty($instance['for_more_goto_label']) && !empty($instance['for_more_goto_txt']) && filter_var($instance['for_more_goto_url'], FILTER_VALIDATE_URL)): ?>
<p><b><?php print $instance['for_more_goto_txt'] ?></b> <a href = "<?php print $instance['for_more_goto_url'] ?>" class = "button tiny"><?php print $instance['for_more_goto_label'] ?></a></p>
<?php endif; ?>
<?php           } else {

                for($i = 0; $i < $amt; $i++){

                $video = $videos[$i];    

?>
          <p class = "videoText"><a href = "http://www.youtube.com/embed/<?php print $video->video->id ?>" target = "featuredVid"><img src = "<?php print $video->video->thumbnail->hqDefault; ?>" alt = "icon" align= "left" />
          <?php print $video->video->title; ?>
          </a><br clear = "all" /></p>  
<?php           }
            
                }
        
            }
        
        } else {
?>
There is no content available
<?php
        
        }
    
    } else {
        
?>
<p>Not a valid JSON URL</p>
<?php
        
    }
    
}

function getVideoFeeds($url){
	
	$ch = curl_init();
	$data = "";
	$result = null;
	$json = null;

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec ($ch);
	$data = json_decode($result);
	
	curl_close ($ch);
	
	return $data->data;		
	
}

function formatYTDate($ytDate){
	
	$upltime = "";
	$t = "";

	$upltime = date($ytDate);
	$upltime = explode("EDT", $upltime);
	$upltime = $upltime[0];
	$upltime = explode("-", $upltime);
	$tstamp = mktime(0, 0, 0, $upltime[1], $upltime[2], $upltime[0]);
	$t = date("M d Y", $tstamp);

	return $t;	
	
}

}

function WP_YouTubeWidget_load_widget(){
    
    register_widget('WP_YouTubeWidget');
    
}

add_action('widgets_init', 'WP_YouTubeWidget_load_widget');

?>