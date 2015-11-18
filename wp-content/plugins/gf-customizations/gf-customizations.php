<?php
/*
Plugin Name: Gravity Form Customizations
Plugin URI: http://www.honeystreet.com
Description: Customizations for the Gravity Forms Plugin
Version: 1.0
Author: Krissie VandeNoord, Honeystreet Design Studio
Author URI: http://www.honeystreet.com/

This plugin is released under the GPLv2 license. The images packaged with this plugin are the property of
their respective owners, and do not, necessarily, inherit the GPLv2 license.
*/

/**
 * Gravity Forms Placeholder Option
 */
/* Add a custom field to the field editor (See editor screenshot) */
add_action("gform_field_standard_settings", "my_standard_settings", 10, 2);

function my_standard_settings($position, $form_id){

// Create settings on position 25 (right after Field Label)

if($position == 25){
?>
		
<li class="admin_label_setting field_setting" style="display: list-item; ">
<label for="field_placeholder">Placeholder Text

<!-- Tooltip to help users understand what this field does -->
<a href="javascript:void(0);" class="tooltip tooltip_form_field_placeholder" tooltip="&lt;h6&gt;Placeholder&lt;/h6&gt;Enter the placeholder/default text for this field.">(?)</a>
			
</label>
		
<input type="text" id="field_placeholder" class="fieldwidth-3" size="35" onkeyup="SetFieldProperty('placeholder', this.value);">
		
</li>
<?php
}
}

/* Now we execute some javascript technicalitites for the field to load correctly */

add_action("gform_editor_js", "my_gform_editor_js");

function my_gform_editor_js(){
?>
<script>
//binding to the load field settings event to initialize the checkbox
jQuery(document).bind("gform_load_field_settings", function(event, field, form){
jQuery("#field_placeholder").val(field["placeholder"]);
});
</script>

<?php
}

/* We use jQuery to read the placeholder value and inject it to its field */

add_action('gform_enqueue_scripts',"my_gform_enqueue_scripts", 10, 2);

function my_gform_enqueue_scripts($form, $is_ajax=false){
?>
<script>

jQuery(function(){
<?php

/* Go through each one of the form fields */

foreach($form['fields'] as $i=>$field){

/* Check if the field has an assigned placeholder */
			
if(isset($field['placeholder']) && !empty($field['placeholder'])){
				
/* If a placeholder text exists, inject it as a new property to the field using jQuery */
				
?>
				
jQuery('#input_<?php echo $form['id']?>_<?php echo $field['id']?>').attr('placeholder','<?php echo $field['placeholder']?>');
				
<?php
}
}
?>
});
</script>
<?php
}

/**
* Merge Tags as Dynamic Population Parameters
* http://gravitywiz.com/dynamic-products-via-post-meta/
*/
add_filter('gform_pre_render', 'gw_prepopluate_merge_tags');
function gw_prepopluate_merge_tags($form) {
    
    $filter_names = array();
    
    foreach($form['fields'] as &$field) {
        
        if(!rgar($field, 'allowsPrepopulate'))
            continue;
        
        // complex fields store inputName in the "name" property of the inputs array
        if(is_array(rgar($field, 'inputs')) && $field['type'] != 'checkbox') {
            foreach($field['inputs'] as $input) {
                if(rgar($input, 'name'))
                    $filter_names[] = array('type' => $field['type'], 'name' => rgar($input, 'name'));
            }
        } else {
            $filter_names[] = array('type' => $field['type'], 'name' => rgar($field, 'inputName'));
        }
        
    }
    
    foreach($filter_names as $filter_name) {
        
        $filtered_name = GFCommon::replace_variables_prepopulate($filter_name['name']);
        
        if($filter_name['name'] == $filtered_name)
            continue;
        
        add_filter("gform_field_value_{$filter_name['name']}", create_function("", "return '$filtered_name';"));
    }
    
    return $form;
}

add_filter( 'gform_duplicate_message_1', function ( $message, $form, $field ) {

    return empty( $field->errorMessage ) ? $message : $field->errorMessage;
}, 2, 3 );
/**
* Better Pre-submission Confirmation
* http://gravitywiz.com/2012/08/04/better-pre-submission-confirmation/
*/
class GWPreviewConfirmation {

    private static $lead;

    public static function init() {
        add_filter( 'gform_pre_render', array( __class__, 'replace_merge_tags' ) );
    }

    public static function replace_merge_tags( $form ) {

        $current_page = isset(GFFormDisplay::$submission[$form['id']]) ? GFFormDisplay::$submission[$form['id']]['page_number'] : 1;
        $fields = array();

        // get all HTML fields on the current page
        foreach($form['fields'] as &$field) {

            // skip all fields on the first page
            if(rgar($field, 'pageNumber') <= 1)
                continue;

            $default_value = rgar($field, 'defaultValue');
            preg_match_all('/{.+}/', $default_value, $matches, PREG_SET_ORDER);
            if(!empty($matches)) {
                // if default value needs to be replaced but is not on current page, wait until on the current page to replace it
                if(rgar($field, 'pageNumber') != $current_page) {
                    $field['defaultValue'] = '';
                } else {
                    $field['defaultValue'] = self::preview_replace_variables($default_value, $form);
                }
            }

            // only run 'content' filter for fields on the current page
            if(rgar($field, 'pageNumber') != $current_page)
                continue;

            $html_content = rgar($field, 'content');
            preg_match_all('/{.+}/', $html_content, $matches, PREG_SET_ORDER);
            if(!empty($matches)) {
                $field['content'] = self::preview_replace_variables($html_content, $form);
            }

        }

        return $form;
    }

    /**
    * Adds special support for file upload, post image and multi input merge tags.
    */
    public static function preview_special_merge_tags($value, $input_id, $merge_tag, $field) {
        
        // added to prevent overriding :noadmin filter (and other filters that remove fields)
        if( ! $value )
            return $value;
        
        $input_type = RGFormsModel::get_input_type($field);
        
        $is_upload_field = in_array( $input_type, array('post_image', 'fileupload') );
        $is_multi_input = is_array( rgar($field, 'inputs') );
        $is_input = intval( $input_id ) != $input_id;
        
        if( !$is_upload_field && !$is_multi_input )
            return $value;

        // if is individual input of multi-input field, return just that input value
        if( $is_input )
            return $value;
            
        $form = RGFormsModel::get_form_meta($field['formId']);
        $lead = self::create_lead($form);
        $currency = GFCommon::get_currency();

        if(is_array(rgar($field, 'inputs'))) {
            $value = RGFormsModel::get_lead_field_value($lead, $field);
            return GFCommon::get_lead_field_display($field, $value, $currency);
        }

        switch($input_type) {
        case 'fileupload':
            $value = self::preview_image_value("input_{$field['id']}", $field, $form, $lead);
            $value = self::preview_image_display($field, $form, $value);
            break;
        default:
            $value = self::preview_image_value("input_{$field['id']}", $field, $form, $lead);
            $value = GFCommon::get_lead_field_display($field, $value, $currency);
            break;
        }

        return $value;
    }

    public static function preview_image_value($input_name, $field, $form, $lead) {

        $field_id = $field['id'];
        $file_info = RGFormsModel::get_temp_filename($form['id'], $input_name);
        $source = RGFormsModel::get_upload_url($form['id']) . "/tmp/" . $file_info["temp_filename"];

        if(!$file_info)
            return '';

        switch(RGFormsModel::get_input_type($field)){

            case "post_image":
                list(,$image_title, $image_caption, $image_description) = explode("|:|", $lead[$field['id']]);
                $value = !empty($source) ? $source . "|:|" . $image_title . "|:|" . $image_caption . "|:|" . $image_description : "";
                break;

            case "fileupload" :
                $value = $source;
                break;

        }

        return $value;
    }

    public static function preview_image_display($field, $form, $value) {

        // need to get the tmp $file_info to retrieve real uploaded filename, otherwise will display ugly tmp name
        $input_name = "input_" . str_replace('.', '_', $field['id']);
        $file_info = RGFormsModel::get_temp_filename($form['id'], $input_name);

        $file_path = $value;
        if(!empty($file_path)){
            $file_path = esc_attr(str_replace(" ", "%20", $file_path));
            $value = "<a href='$file_path' target='_blank' title='" . __("Click to view", "gravityforms") . "'>" . $file_info['uploaded_filename'] . "</a>";
        }
        return $value;

    }

    /**
    * Retrieves $lead object from class if it has already been created; otherwise creates a new $lead object.
    */
    public static function create_lead( $form ) {
        
        if( empty( self::$lead ) ) {
            self::$lead = GFFormsModel::create_lead( $form );
            self::clear_field_value_cache( $form );
        }
        
        return self::$lead;
    }

    public static function preview_replace_variables( $content, $form ) {

        $lead = self::create_lead($form);

        // add filter that will handle getting temporary URLs for file uploads and post image fields (removed below)
        // beware, the RGFormsModel::create_lead() function also triggers the gform_merge_tag_filter at some point and will
        // result in an infinite loop if not called first above
        add_filter('gform_merge_tag_filter', array('GWPreviewConfirmation', 'preview_special_merge_tags'), 10, 4);

        $content = GFCommon::replace_variables($content, $form, $lead, false, false, false);

        // remove filter so this function is not applied after preview functionality is complete
        remove_filter('gform_merge_tag_filter', array('GWPreviewConfirmation', 'preview_special_merge_tags'));

        return $content;
    }
    
    public static function clear_field_value_cache( $form ) {
        
        if( ! class_exists( 'GFCache' ) )
            return;
            
        foreach( $form['fields'] as &$field ) {
            if( GFFormsModel::get_input_type( $field ) == 'total' )
                GFCache::delete( 'GFFormsModel::get_lead_field_value__' . $field['id'] );
        }
        
    }

}

GWPreviewConfirmation::init();

/**
    * Allow Gravity Forms Edit Capability to Editors
    */
function add_grav_forms(){
    $role = get_role('author');
    $role->add_cap('gform_full_access');
}
add_action('admin_init','add_grav_forms');
?>