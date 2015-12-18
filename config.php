<?php
/**
 * Squirrel User Prefs to Roundcube config file
 * Edit desired configuration to map Roundcubes config
 * Date: 12.08.2015
 * Author: Sam Alfano
 * Version: v0.1
 **/

/* Squirrelmail Host */
$h_sql_squir['host']                    = "HOST IP";
$h_sql_squir['user']                    = "DB USER";
$h_sql_squir['pass']                    = "DB PASSWORD";
$h_sql_squir['db']                      = "DATABASE NAME | DEFAULT squirrelmail";

/* Roundcube Host */
$h_sql_rcube['host']                    = "ROUNDCUBE HOST";
$h_sql_rcube['user']                    = "DB USER";
$h_sql_rcube['pass']                    = "DB PASSWORD";
$h_sql_rcube['db']                      = "DATABASE NAME";

$h_sql_rcube['user_table']              = "users";
$h_sql_rcube['identity_table']          = "identities";
$h_sql_rcube['contacts_table']          = "contacts";



/* Roundcube Default Configuration */
$h_rcube_defaults_user[":user_id"]                                = NULL;
$h_rcube_defaults_user[":username"]                               = "";
$h_rcube_defaults_user[":mail_host"]                              = "MAIL SERVER IP";
$h_rcube_defaults_user[":created"]                                = date("Y-m-d H:m:s", time());
$h_rcube_defaults_user[":last_login"]                             = NULL;
$h_rcube_defaults_user[":language"]                               = "de_CH";
/* Roundcube preferences */
$h_rcube_defaults_user[":preferences"]["drafts_mbox"]             =  "INBOX/Drafts";
$h_rcube_defaults_user[":preferences"]["junk_mbox"]               =  "INBOX/Spam";
$h_rcube_defaults_user[":preferences"]["sent_mbox"]               =  "INBOX/Sent";
$h_rcube_defaults_user[":preferences"]["trash_mbox"]              =  "INBOX/Trash";
/* Roundcube default folders */
$h_rcube_defaults_user[":preferences"]["default_folders"][0]      =  "INBOX";
$h_rcube_defaults_user[":preferences"]["default_folders"][1]      =  "INBOX/Drafts";
$h_rcube_defaults_user[":preferences"]["default_folders"][2]      =  "INBOX/Sent";
$h_rcube_defaults_user[":preferences"]["default_folders"][3]      =  "INBOX/Spam";
$h_rcube_defaults_user[":preferences"]["default_folders"][4]      =  "INBOX/Trash";
/* Roundcube additional preferences */
$h_rcube_defaults_user[":preferences"]["show_sig"]                =  0;
$h_rcube_defaults_user[":preferences"]["strip_existing_sig"]      =  true;
$h_rcube_defaults_user[":preferences"]["prefer_html"]             =  false;
$h_rcube_defaults_user[":preferences"]["timezone"]                =  "Europe/Zurich";
$h_rcube_defaults_user[":preferences"]["namespace_fixed"]         =  true;
$h_rcube_defaults_user[":preferences"]["refresh_interval"]        =  300;
$h_rcube_defaults_user[":preferences"]["read_when_deleted"]       =  false;
$h_rcube_defaults_user[":preferences"]["preview_pane"]            =  true;
$h_rcube_defaults_user[":preferences"]["autoexpand_threads"]      =  1;
$h_rcube_defaults_user[":preferences"]["check_all_folders"]       =  true;
$h_rcube_defaults_user[":preferences"]['list_cols'][]             = "subject";
$h_rcube_defaults_user[":preferences"]['list_cols'][]             = "status";
$h_rcube_defaults_user[":preferences"]['list_cols'][]             = "fromto";
$h_rcube_defaults_user[":preferences"]['list_cols'][]             = "date";
$h_rcube_defaults_user[":preferences"]['list_cols'][]             = "size";
$h_rcube_defaults_user[":preferences"]['list_cols'][]             = "flag";
$h_rcube_defaults_user[":preferences"]['list_cols'][]             = "attachment";
$h_rcube_defaults_user[":preferences"]['mail_pagesize']           = 50;
$h_rcube_defaults_user[":preferences"]['addressbook_pagesize']    = 50;
$h_rcube_defaults_user[":preferences"]['addressbook_sort_col']    = 'surname';
$h_rcube_defaults_user[":preferences"]['show_images']             = 0;
$h_rcube_defaults_user[":preferences"]['htmleditor']              = 0;
$h_rcube_defaults_user[":preferences"]['preview_pane_mark_read']  = 0;
$h_rcube_defaults_user[":preferences"]['logout_purge']            = false;
$h_rcube_defaults_user[":preferences"]['logout_expunge']          = false;
$h_rcube_defaults_user[":preferences"]['inline_images']           = true;
$h_rcube_defaults_user[":preferences"]['mime_param_folding']      = 1;
$h_rcube_defaults_user[":preferences"]['skip_deleted']            = false;
$h_rcube_defaults_user[":preferences"]['flag_for_deletion']       = false;
$h_rcube_defaults_user[":preferences"]['display_next']            = true;
$h_rcube_defaults_user[":preferences"]['reply_mode']              = 0;
$h_rcube_defaults_user[":preferences"]['delete_always']           = false;
$h_rcube_defaults_user[":preferences"]['delete_junk']             = false;
$h_rcube_defaults_user[":preferences"]['reply_same_folder']       = false;
$h_rcube_defaults_user[":preferences"]['forward_attachment']      = false;

/* Roundcube default identity settings */
$h_rcube_defaults_indentity[":identity_id"]        = NULL;
$h_rcube_defaults_indentity[":user_id"]            = NULL;
$h_rcube_defaults_indentity[":changed"]            = date("Y-m-d H:m:s", time());
$h_rcube_defaults_indentity[":del"]                = 0;
$h_rcube_defaults_indentity[":standard"]           = 1;
$h_rcube_defaults_indentity[":name"]               = "";
$h_rcube_defaults_indentity[":organization"]       = "";
$h_rcube_defaults_indentity[":email"]              = "";
$h_rcube_defaults_indentity[":reply"]              = "";
$h_rcube_defaults_indentity[":bcc"]                = "";
$h_rcube_defaults_indentity[":signature"]          = "";
$h_rcube_defaults_indentity[":html_signature"]     = 0;

/* Roundcube default contact settings */
$h_rcube_defaults_contact[":contact_id"]           = NULL;
$h_rcube_defaults_contact[":changed"]              = date("Y-m-d H:m:s", time());
$h_rcube_defaults_contact[":del"]                  = 0;
$h_rcube_defaults_contact[":name"]                 = "";
$h_rcube_defaults_contact[":email"]                = "";
$h_rcube_defaults_contact[":firstname"]            = "";
$h_rcube_defaults_contact[":surname"]              = "";
$h_rcube_defaults_contact[":vcard"]                = NULL;
$h_rcube_defaults_contact[":words"]                = NULL;
$h_rcube_defaults_contact[":user_id"]              = NULL;

/*
 * Mapping between squirrelmail and roundcube config 
 * Only change if you know the configurations
 */
$h_pref_map["show_html_default"]            = "prefer_html";
$h_pref_map["use_signature"]                = "show_sig";
$h_pref_map["strip_sigs"]                   = "strip_existing_sig";
$h_pref_map["email_address"]                = ":email";
$h_pref_map["timezone"]                     = "timezone";
$h_pref_map["language"]                     = ":language";
$h_pref_map["strip_sigs"]                   = "show_sig";
$h_pref_map["show_html_default"]            = "prefer_html";
$h_pref_map["full_name"]                    = ":name";
$h_pref_map["___signature___"]              = ":signature";
$h_pref_map["delete_move_next_show_unread"] = "read_when_deleted";
$h_pref_map["username_motd"]                = "";
$h_pref_map["show_num"]                     = "";
$h_pref_map["folder_sizes_subtotals"]       = "";
$h_pref_map["folder_synch_opt_right"]       = "";
$h_pref_map["hililist"]                     = "";
$h_pref_map["javascript_on"]                = "";
$h_pref_map["sort"]                         = "";
$h_pref_map["custom_css"]                   = "";
$h_pref_map["folder_sizes_on_folder_page"]  = "";
$h_pref_map["hour_format"]                  = "";
$h_pref_map["prefix_sig"]                   = "";
$h_pref_map["compose_window_type"]          = "";
$h_pref_map["show_username"]                = "";
$h_pref_map["show_full_date"]               = "";
$h_pref_map["folder_sizes_left_link"]       = "";
$h_pref_map["editor_size"]                  = "";
$h_pref_map["sig_first"]                    = "";

/* 
 * Contact preference mapping
 */
$h_pref_map_contact["owner"]                = ":username";
$h_pref_map_contact["nickname"]             = ":words";
$h_pref_map_contact["firstname"]            = ":firstname";
$h_pref_map_contact["lastname"]             = ":surname";
$h_pref_map_contact["email"]                = ":email";
$h_pref_map_contact["label"]                = ":name";
