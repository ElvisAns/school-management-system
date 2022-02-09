<?php
if ( !defined('K_INSTALLATION_IN_PROGRESS') ) die(); // cannot be loaded directly

/* supra_couch_templates (id, name, description, clonable, executable, title, access_level, commentable, hidden, k_order, dynamic_folders, nested_pages, gallery, handler, custom_params, type, config_list, config_form, parent, icon, deleted, has_globals) */
$k_stmt_pre = "INSERT INTO ".K_TBL_TEMPLATES." VALUES ";

/* supra_couch_fields (id, template_id, name, label, k_desc, k_type, hidden, search_type, k_order, data, default_data, required, deleted, validator, validator_msg, k_separator, val_separator, opt_values, opt_selected, toolbar, custom_toolbar, css, custom_styles, maxlength, height, width, k_group, collapsed, assoc_field, crop, enforce_max, quality, show_preview, preview_width, preview_height, no_xss_check, rtl, body_id, body_class, disable_uploader, _html, dynamic, custom_params, searchable, class, not_active) */
$k_stmt_pre = "INSERT INTO ".K_TBL_FIELDS." VALUES ";

/* supra_couch_pages (id, template_id, parent_id, page_title, page_name, creation_date, modification_date, publish_date, status, is_master, page_folder_id, access_level, comments_count, comments_open, nested_parent_id, weight, show_in_menu, menu_text, is_pointer, pointer_link, pointer_link_detail, open_external, masquerades, strict_matching, file_name, file_ext, file_size, file_meta, creation_IP, k_order, ref_count) */
$k_stmt_pre = "INSERT INTO ".K_TBL_PAGES." VALUES ";

/* supra_couch_folders (id, pid, template_id, name, title, k_desc, image, access_level, weight) */
$k_stmt_pre = "INSERT INTO ".K_TBL_FOLDERS." VALUES ";

/* supra_couch_data_text (page_id, field_id, value, search_value) */
$k_stmt_pre = "INSERT INTO ".K_TBL_DATA_TEXT." VALUES ";

/* supra_couch_data_numeric (page_id, field_id, value) */
$k_stmt_pre = "INSERT INTO ".K_TBL_DATA_NUMERIC." VALUES ";

/* supra_couch_fulltext (page_id, title, content) */
$k_stmt_pre = "INSERT INTO ".K_TBL_FULLTEXT." VALUES ";

/* supra_couch_comments (id, tpl_id, page_id, user_id, name, email, link, ip_addr, date, data, approved) */
$k_stmt_pre = "INSERT INTO ".K_TBL_COMMENTS." VALUES ";

/* supra_couch_relations (pid, fid, cid, weight) */
$k_stmt_pre = "INSERT INTO ".K_TBL_RELATIONS." VALUES ";
