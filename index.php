<?php
/**
 * Plugin Name: Setting field
 * Author: Rupom
 * Version: 1.0
 * Description: Create a setiing field 
 */
function pqrc_field(){
    add_settings_field("pqrc_height", "Height", "pqrc_text_field", "general","field_section", array("pqrc_height"));
    add_settings_field("pqrc_width", "Width", "pqrc_text_field", "general","field_section", array("pqrc_width"));
    add_settings_field("pqrc_select", "Select", "pqrc_select_field", "general","field_section");
    add_settings_field("pqrc_check", "Check", "pqrc_check_field", "general","field_section");
    add_settings_field("pqrc_radio", "Radio", "pqrc_radio_field", "general","field_section");
    add_settings_field("pqrc_toggle", "Toggle", "pqrc_minitoggle", "general","field_section");
    add_settings_section("field_section", "Details", "section_details", "general");
    register_setting("general","pqrc_height" );
    register_setting("general","pqrc_width" );
    register_setting("general","pqrc_select" );
    register_setting("general","pqrc_check" );
    register_setting("general","pqrc_radio" );
    register_setting("general","pqrc_toggle" );
}
function section_details(){
    echo '<p> Hello field</p>';
}
function pqrc_text_field($arg){
    $option = get_option($arg[0]);
    printf('<input type="text" name="%s" id="%s" value="%s" >',$arg[0],$arg[0],$option);  
}
function pqrc_select_field(){
    $option = get_option('pqrc_select');
    $citys = ["Rangpur","Dhaka","Cumilla","Dinajpur"];
    printf('<select name="%s" id="%s">',"pqrc_select","pqrc_select"); 
    foreach($citys as $city){
        $selected = '';
        if($city == $option){
            $selected = 'selected';
        }
        printf('<option value="%s" %s> %s</option>',$city, $selected,$city) ;
    }
    print '</select>';
}
function pqrc_check_field(){
    $option =get_option('pqrc_check');
    $counties = ["Bangladesh","Nepal","India"];
    foreach($counties as $country){
        $checked = '';
        if(in_array($country,$option)){
            $checked = 'checked';
        }
        printf('<input type="checkbox" name="pqrc_check[]" value="%s"  %s> %s',$country,$checked , $country ."<br>");
    }
}
function pqrc_radio_field(){
    $option =get_option('pqrc_radio');
    $Genders = ["Male","Famale","Others"];
    foreach($Genders as $Gender){
        $checked = '';
        if($Gender == $option){
            $checked = 'checked';
        }
        printf('<input type="radio" name="pqrc_radio" id="pqrc_radio" value="%s" %s> %s',$Gender,$checked,$Gender ."<br>" ); 
    }
}
function pqrc_minitoggle(){
    echo '<div class="toggle"> toggle</div>';
}

add_action("admin_init", "pqrc_field");
// add jquery plugin 
function pqrc_jquery($screen){
    if('options-general.php' == $screen){
        wp_enqueue_script('jquery');
        wp_enqueue_script("pqrc_js", plugin_dir_url( __FILE__ )."/assets/js/main.js", array('jquery'), '1.0', true );
        wp_enqueue_script("pqrc_min_js", plugin_dir_url( __FILE__ )."/assets/js/minitoggle.js", array('jquery'), '1.0', true );
        wp_enqueue_style("pqrc_min_css", plugin_dir_url( __FILE__ )."/assets/css/minitoggle.css" );
    }  
}
add_action("admin_enqueue_scripts", "pqrc_jquery");
?>