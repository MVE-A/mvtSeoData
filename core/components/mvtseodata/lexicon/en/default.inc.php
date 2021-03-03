<?php
include_once 'setting.inc.php';

$_lang['mvtseodata'] = 'mvtSeoData';
$_lang['mvtseodata_menu_desc'] = 'Pattern Conservation';
$_lang['mvtseodata_intro_msg'] = '';

$_lang['mvtseodata_common_templates'] = 'Common patterns';
$_lang['mvtseodata_resource_templates'] = 'Resource Templates';

$_lang['mvtseodata_templates'] = 'Patterns';
$_lang['mvtseodata_template_id'] = 'Id';
$_lang['mvtseodata_template_name'] = 'Name';

$_lang['mvtseodata_template_window_form1'] = 'Headings';
$_lang['mvtseodata_template_window_form2'] = 'Description';
$_lang['mvtseodata_template_window_form3'] = 'Content';
$_lang['mvtseodata_template_window_info'] = 'Info';
$_lang['mvtseodata_template_window_info_title'] = 'Available variables in templates';
$_lang['mvtseodata_template_window_info_html'] = '
	<p><strong>Общие</strong></p><ul>'
	.'<li><code>{pagetitle}</code> - title</li>'
	.'<li><code>{menutitle}</code> - menu title</li>'
	.'<li><code>{longtitle}</code> - long title</li>'
	.'<li><code>{parent_pagetitle}</code> - parent title</li></ul><br>'
	.'<p><strong>Product MS2</strong></p>'
	.'<ul><li><code>{price}</code> - price</li></ul><br>'
	.'<p><strong>Category MS2</strong></p>'
	.'<ul><li><code>{min_price}</code> - minimum price of goods in this category</li>'
	.'<li><code>{max_price}</code> - maximum price of goods in this category</li>'
	.'<li><code>{average_price}</code> - average price of goods in this category</li>'
	.'<li><code>{count_products}</code> - count of goods in this category</li>'
	.'<li><code>{main_product_pagetitle}</code> - title of the leading product in this category</li>'
	.'<li><code>{main_product_thumb}</code> - preview of the leading product in this category</li>'
	.'<li><code>{min_price_product_pagetitle}</code> - product header with the lowest price for this category</li>'
	.'<li><code>{max_price_product_pagetitle}</code> - product heading with maximum price for this category</li>'
	.'<li><code>{page}</code> - current page number</li>'
	.'</ul><br>';


$_lang['mvtseodata_template_pagetitle_tpl'] = 'Pagetitle Template';
$_lang['mvtseodata_template_title_tpl'] = 'Meta Title template';
$_lang['mvtseodata_template_description_tpl'] = 'Meta description template';
$_lang['mvtseodata_template_content_tpl'] = 'Content Template';
$_lang['mvtseodata_template_get_tpl'] = 'Page Number Template';
$_lang['mvtseodata_template_pagetitle_tpl_bl'] = 'Pagetitle';
$_lang['mvtseodata_template_title_tpl_bl'] = 'Meta-title';
$_lang['mvtseodata_template_description_tpl_bl'] = 'Meta-description';
$_lang['mvtseodata_template_content_tpl_bl'] = 'Content';
$_lang['mvtseodata_template_get_tpl_bl'] = 'Page Number';
$_lang['mvtseodata_assortment_resource'] = 'Resource';

$_lang['mvtseodata_template_resource'] = 'Page';
$_lang['mvtseodata_resource_class_key_document'] = 'document';
$_lang['mvtseodata_resource_class_key_product'] = 'product';
$_lang['mvtseodata_resource_class_key_category'] = 'category';


$_lang['mvtseodata_resource_class_key'] = 'Page type';
$_lang['mvtseodata_class_key_select'] = 'select page type';
$_lang['mvtseodata_class_key_category'] = 'category MS2';
$_lang['mvtseodata_class_key_product'] = 'product MS2';
$_lang['mvtseodata_class_key_document'] = 'document';

$_lang['mvtseodata_index'] = 'Indexing';
$_lang['mvtseodata_index_info'] = '';
$_lang['mvtseodata_index_set'] = 'Generate an index for product categories';
$_lang['mvtseodata_index_date'] = 'Index Date';
$_lang['mvtseodata_index_categories'] = 'Category';
$_lang['mvtseodata_index_products'] = 'Products';
$_lang['mvtseodata_list_prepare_process'] = 'Processed categories {offset} of {total}';
$_lang['mvtseodata_listcreate'] = 'Processed: {categories}, {products}';
$_lang['mvtseodata_list_create_process'] = 'Index Formation ...';

$_lang['mvtseodata_item_active'] = 'Actively';

$_lang['mvtseodata_template_create'] = 'Create';
$_lang['mvtseodata_template_update'] = 'Update';
$_lang['mvtseodata_item_enable'] = 'Enable';
$_lang['mvtseodata_items_enable'] = 'Enable Selected';
$_lang['mvtseodata_item_disable'] = 'Disable';
$_lang['mvtseodata_items_disable'] = 'Disable Selected';
$_lang['mvtseodata_item_remove'] = 'Delete';
$_lang['mvtseodata_items_remove'] = 'Delete Selected';
$_lang['mvtseodata_item_remove_confirm'] = 'Are you sure you want to delete the entry?';
$_lang['mvtseodata_items_remove_confirm'] = 'Are you sure you want to delete the selected entries?';
$_lang['mvtseodata_item_active'] = 'Enabled';

$_lang['mvtseodata_item_err_name'] = 'You must specify a name.';
$_lang['mvtseodata_item_err_ae'] = 'A record with the same name already exists..';
$_lang['mvtseodata_item_err_nf'] = 'Record not found.';
$_lang['mvtseodata_item_err_ns'] = 'No entry specified.';
$_lang['mvtseodata_item_err_remove'] = 'Error deleting record.';
$_lang['mvtseodata_item_err_save'] = 'Error saving record.';
$_lang['mvtseodata_resource_id_err_ae'] = 'Resource is not found';

$_lang['mvtseodata_grid_search'] = 'Search';
$_lang['mvtseodata_grid_actions'] = 'Actions';

$_lang['mvtseodata_success'] = 'Successfully';
$_lang['mvtseodata_errorlog'] = 'An error has occurred. See the system log.';
$_lang['mvtseodata_order_unit1'] = 'category';
$_lang['mvtseodata_order_unit2'] = 'categories';
$_lang['mvtseodata_order_unit3'] = 'categories';
$_lang['mvtseodata_list_unit1'] = 'product';
$_lang['mvtseodata_list_unit2'] = 'product';
$_lang['mvtseodata_list_unit3'] = 'products';

$_lang['mvtseodata_item_dublicate'] = 'Copy';
$_lang['mvtseodata_item_dublicate_confirm'] = 'Really copy this template.?';
$_lang['mvtseodata_assortment_resource_parent'] = 'Parent resource';
$_lang['mvtseodata_replacement_priority'] = 'Data priority';
$_lang['mvtseodata_replacement_priority_content'] = 'Data priority for content';
$_lang['mvtseodata_replacement_priority_0'] = 'resource';
$_lang['mvtseodata_replacement_priority_1'] = 'component';
$_lang['mvtseodata_replacement_priority_2'] = 'component complements the resource';
$_lang['mvtseodata_template_window_info_title2'] = 'Modifiers';
$_lang['mvtseodata_template_window_info_html2'] = '
	<p>Application: <code>{pagetitle:lc}</code></p><br><br><ul>'
	.'<li><code>{:lc}</code> - all lower case</li>'
	.'<li><code>{:uc}</code> - uppercase first letter</li>'
	.'</ul><br>';
$_lang['mvtseodata_select'] = 'Select';
$_lang['mvtseodata_priority'] = 'Priority';