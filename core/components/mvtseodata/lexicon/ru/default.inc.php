<?php
include_once 'setting.inc.php';

$_lang['mvtseodata'] = 'mvtSeoData';
$_lang['mvtseodata_menu_desc'] = 'Герерация по шаблонам';
$_lang['mvtseodata_intro_msg'] = '';

$_lang['mvtseodata_common_templates'] = 'Общие шаблоны';
$_lang['mvtseodata_resource_templates'] = 'Шаблоны ресурсов';

$_lang['mvtseodata_templates'] = 'Шаблоны';
$_lang['mvtseodata_template_id'] = 'Id';
$_lang['mvtseodata_template_name'] = 'Название';

$_lang['mvtseodata_template_window_form1'] = 'Заголовки';
$_lang['mvtseodata_template_window_form2'] = 'Описание';
$_lang['mvtseodata_template_window_form3'] = 'Контент';
$_lang['mvtseodata_template_window_info'] = 'Информация';
$_lang['mvtseodata_template_window_info_title'] = 'Доступные переменные в шаблонах';
$_lang['mvtseodata_template_window_info_html'] = '
	<p><strong>Общие</strong></p><ul>'
	.'<li><code>{pagetitle}</code> - заголовок</li>'
	.'<li><code>{menutitle}</code> - пункт меню</li>'
	.'<li><code>{longtitle}</code> - расширенный заголовок</li>'
	.'<li><code>{parent_pagetitle}</code> - заголовок родителя</li></ul><br>'
	.'<p><strong>Товар MS2</strong></p>'
	.'<ul><li><code>{price}</code> - цена</li></ul><br>'
	.'<p><strong>Категория MS2</strong></p>'
	.'<ul><li><code>{min_price}</code> - минимальная цена товара в данной категории</li>'
	.'<li><code>{max_price}</code> - максимальная цена товара в данной категории</li>'
	.'<li><code>{average_price}</code> - средняя цена товара в данной категории</li>'
	.'<li><code>{count_products}</code> - количество товаров в данной категории</li>'
	.'<li><code>{main_product_pagetitle}</code> - заголовок ведущего товара в данной категории</li>'
	.'<li><code>{main_product_thumb}</code> - превью ведущего товара в данной категории</li>'
	.'<li><code>{min_price_product_pagetitle}</code> - заголовок товара с минимальной ценой для данной категории</li>'
	.'<li><code>{max_price_product_pagetitle}</code> - заголовок товара с максимальной ценой для данной категории</li>'
	.'<li><code>{page}</code> - текущий номер страницы</li>'
	.'</ul><br>';
	/*
	.'<hr><p>В следующих версиях</p>'
	.'<ul>'
	.'<li><code>{vendors}</code> - список производителей в данной категории (для категории MS2)</li>'
	.'<li><code>{count_products_sale}</code> - количество товаров со скидкой в данной категории (для категории MS2)</li>'
	.'</ul>';*/

$_lang['mvtseodata_template_pagetitle_tpl'] = 'Шаблон заголовка страницы';
$_lang['mvtseodata_template_title_tpl'] = 'Шаблон meta-заголовка';
$_lang['mvtseodata_template_description_tpl'] = 'Шаблон meta-описания';
$_lang['mvtseodata_template_content_tpl'] = 'Шаблон контента';
$_lang['mvtseodata_template_get_tpl'] = 'Шаблон номера страницы';
$_lang['mvtseodata_template_pagetitle_tpl_bl'] = 'Заголовок';
$_lang['mvtseodata_template_title_tpl_bl'] = 'Meta-заголовок';
$_lang['mvtseodata_template_description_tpl_bl'] = 'Meta-описание';
$_lang['mvtseodata_template_content_tpl_bl'] = 'Контент';
$_lang['mvtseodata_template_get_tpl_bl'] = 'Номер страницы';
$_lang['mvtseodata_assortment_resource'] = 'Ресурс';

$_lang['mvtseodata_template_resource'] = 'Страница';
$_lang['mvtseodata_resource_class_key_document'] = 'документ';
$_lang['mvtseodata_resource_class_key_product'] = 'товар';
$_lang['mvtseodata_resource_class_key_category'] = 'категория';


$_lang['mvtseodata_resource_class_key'] = 'Тип страницы';
$_lang['mvtseodata_class_key_select'] = 'выберите тип страницы';
$_lang['mvtseodata_class_key_category'] = 'категория MS2';
$_lang['mvtseodata_class_key_product'] = 'товар MS2';
$_lang['mvtseodata_class_key_document'] = 'документ';

$_lang['mvtseodata_index'] = 'Индексация';
$_lang['mvtseodata_index_info'] = '';
$_lang['mvtseodata_index_set'] = 'Сформировать индекс для товарных категорий';
$_lang['mvtseodata_index_date'] = 'Дата индексации';
$_lang['mvtseodata_index_categories'] = 'Категорий';
$_lang['mvtseodata_index_products'] = 'Товаров';
$_lang['mvtseodata_list_prepare_process'] = 'Обработано категорий {offset} из {total}';
$_lang['mvtseodata_listcreate'] = 'Обработано: {categories}, {products}';
$_lang['mvtseodata_list_create_process'] = 'Формирование индекса ...';

$_lang['mvtseodata_item_active'] = 'Активно';

$_lang['mvtseodata_template_create'] = 'Создать';
$_lang['mvtseodata_template_update'] = 'Изменить';
$_lang['mvtseodata_item_enable'] = 'Включить';
$_lang['mvtseodata_items_enable'] = 'Включить выбранные';
$_lang['mvtseodata_item_disable'] = 'Отключить';
$_lang['mvtseodata_items_disable'] = 'Отключить выбранные';
$_lang['mvtseodata_item_remove'] = 'Удалить';
$_lang['mvtseodata_items_remove'] = 'Удалить выбранные';
$_lang['mvtseodata_item_remove_confirm'] = 'Вы уверены, что хотите удалить запись?';
$_lang['mvtseodata_items_remove_confirm'] = 'Вы уверены, что хотите удалить выбранные записи?';
$_lang['mvtseodata_item_active'] = 'Включено';

$_lang['mvtseodata_item_err_name'] = 'Вы должны указать имя.';
$_lang['mvtseodata_item_err_ae'] = 'Запись с таким именем уже существует.';
$_lang['mvtseodata_item_err_nf'] = 'Запись не найдена.';
$_lang['mvtseodata_item_err_ns'] = 'Запись не указана.';
$_lang['mvtseodata_item_err_remove'] = 'Ошибка при удалении записи.';
$_lang['mvtseodata_item_err_save'] = 'Ошибка при сохранении записи.';
$_lang['mvtseodata_resource_id_err_ae'] = 'Ресурс не найден';

$_lang['mvtseodata_grid_search'] = 'Поиск';
$_lang['mvtseodata_grid_actions'] = 'Действия';

$_lang['mvtseodata_success'] = 'Успешно';
$_lang['mvtseodata_errorlog'] = 'Произошла ошибка. Смотрите системный журнал.';
$_lang['mvtseodata_order_unit1'] = 'категория';
$_lang['mvtseodata_order_unit2'] = 'категории';
$_lang['mvtseodata_order_unit3'] = 'категорий';
$_lang['mvtseodata_list_unit1'] = 'товар';
$_lang['mvtseodata_list_unit2'] = 'товара';
$_lang['mvtseodata_list_unit3'] = 'товаров';

$_lang['mvtseodata_item_dublicate'] = 'Копировать';
$_lang['mvtseodata_item_dublicate_confirm'] = 'Действительно копировать этот шаблон?';
$_lang['mvtseodata_assortment_resource_parent'] = 'Ресурс-родитель';
$_lang['mvtseodata_replacement_priority'] = 'Приоритет данных';
$_lang['mvtseodata_replacement_priority_content'] = 'Приоритет данных для контента';
$_lang['mvtseodata_replacement_priority_0'] = 'ресурс';
$_lang['mvtseodata_replacement_priority_1'] = 'компонент';
$_lang['mvtseodata_replacement_priority_2'] = 'компонент дополняет ресурс';
$_lang['mvtseodata_template_window_info_title2'] = 'Модификаторы';
$_lang['mvtseodata_template_window_info_html2'] = '
	<p>Применение: <code>{pagetitle:lc}</code></p><br><br><ul>'
	.'<li><code>{:lc}</code> - все строчные</li>'
	.'<li><code>{:uc}</code> - первая буква прописная</li>'
	.'</ul><br>';
$_lang['mvtseodata_select'] = 'Выберите';
$_lang['mvtseodata_priority'] = 'Приоритет';
