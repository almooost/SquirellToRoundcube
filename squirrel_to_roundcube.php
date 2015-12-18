<?php
/**
 * Convert Squirrel Settings to Roundcube
 * Author: Sam Alfano
 * Version v0.1
 **/



require_once('config.php');

/**
 * Converts the pref to roundcube format
 * @return mixed
 * @date 12.08.2015
 * @version v0.1
 **/

function convertPref($s_prefkey, $s_prefval)
{
  switch ($s_prefkey) {
    case "show_html_default":
      if(preg_match('/[01]/', $s_prefval))
        if($s_prefval == 1)
          return true;
        else
          return false;
      break;
    case "use_signature":
      if(preg_match('/[01]/', $s_prefval))
        if($s_prefval == 1)
          return 1;
        else
          return 0;
      break;
    case "strip_sigs":
      if(preg_match('/[01]/', $s_prefval))
        if($s_prefval == 1)
          return true;
        else
          return false;
      break;
    case "delete_move_next_show_unread":
      if(preg_match('/[on|off]/', $s_prefval))
        if($s_prefval == "on")
          return true;
        else
          return false;
      break;
    default:
      return $s_prefval;
      break;
  }

}

/*
 * Predefine variables
 */
$b_complete       = false;
$h_userprefs      = array();
$h_user_contacts  = array();
$h_usercontacts   = array();
$h_user           = array();
$h_user_identity  = array();

/*
 * Open connection and get preferences and contacts
 */
try
{
  $dbh = new PDO("mysql:host=".$h_sql_squir['host'].";dbname=".$h_sql_squir['db'],$h_sql_squir['user'],$h_sql_squir['pass']);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt_prefs = $dbh->query("SELECT `user`, `prefkey`, `prefval` FROM `userprefs` ORDER BY `user`");
  $stmt_prefs->setFetchMode(PDO::FETCH_ASSOC);

  // Loop trough user results
  while($h_pref = $stmt_prefs->fetch())
  {
    $h_userprefs[$h_pref['user']][$h_pref['prefkey']] = $h_pref['prefval'];
  }

  $stmt_contact = $dbh->query("SELECT `owner`,`nickname`,`firstname`,`lastname`,`email`,`label` FROM `address` ORDER BY `owner`");
  $stmt_contact->setFetchMode(PDO::FETCH_ASSOC);

  // Loop trough contact results
  while($h_cont = $stmt_contact->fetch())
  {
   $h_usercontacts[$h_cont['owner']][] = array('owner'      => $h_cont['owner'],
                                               'nickname'   => $h_cont['nickname'],
                                               'firstname'  => $h_cont['firstname'],
                                               'lastname'   => $h_cont['lastname'],
                                               'email'      => $h_cont['email'],
                                               'label'      => $h_cont['label']);
  }

  $b_complete = true;
}
catch (Exception $e)
{
  echo $e->getMessage();
  error_log("Error in MySQL Connection/Statement: ".$e->getMessage());
  exit(0);
}
// Close handle if completed without errors
if($b_complete)
  $dbh = null;


/*
 * Loop over userpref arrays for preparation
 */
foreach($h_userprefs as $s_username => $h_userpref)
{
  $h_user[$s_username]                      = $h_rcube_defaults_user;
  $h_user[$s_username][':username']         = $s_username;
  $h_user_identity[$s_username]             = $h_rcube_defaults_indentity;
  foreach($h_userpref as $s_prefkey => $s_prefval)
  {
    if(array_key_exists($s_prefkey, $h_pref_map))
      if(array_key_exists($h_pref_map[$s_prefkey], $h_user[$s_username][':preferences']))
        $h_user[$s_username][':preferences'][$h_pref_map[$s_prefkey]] = convertPref($s_prefkey,$s_prefval);
      else
        if($h_pref_map[$s_prefkey] != "")
        {
          if(array_key_exists($h_pref_map[$s_prefkey], $h_user_identity[$s_username]))
            $h_user_identity[$s_username][$h_pref_map[$s_prefkey]] = $s_prefval;

          else if(array_key_exists($h_pref_map[$s_prefkey], $h_user[$s_username]))
            $h_user[$s_username][$h_pref_map[$s_prefkey]] = $s_prefval;
        }
    else
      continue;
  }
}
/*
 * Loop over userpref arrays for preparation
 */
foreach ($h_usercontacts as $s_username => $a_contact) 
  foreach($a_contact as $i_id => $h_contact)
  {
    $h_user_contacts[$s_username][$i_id]     = $h_rcube_defaults_contact;
    foreach ($h_contact as $s_prefkey => $s_prefval) 
      if(array_key_exists($s_prefkey, $h_pref_map_contact) && $s_prefkey != "owner")
        $h_user_contacts[$s_username][$i_id][$h_pref_map_contact[$s_prefkey]] = $s_prefval;
      else
        continue;
  }

/*
 * Insert prepared values into roundcube database
 */
try
{
  $dbh = new PDO("mysql:host=".$h_sql_rcube['host'].";dbname=".$h_sql_rcube['db'],$h_sql_rcube['user'],$h_sql_rcube['pass']);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->beginTransaction();
  $stmt_user = $dbh->prepare("INSERT INTO ".$h_sql_rcube['user_table']." ".
                        " (`user_id`, `username`, `mail_host`, `created`, `last_login`, `language`, `preferences`) ".
                        " VALUES (:user_id, :username, :mail_host, :created, :last_login, :language, :preferences)");

  $stmt_identity = $dbh->prepare("INSERT INTO ".$h_sql_rcube['identity_table']." ".
                        " (`identity_id`, `user_id`, `changed`, `del`, `standard`, `name`, `organization`, `email`, `reply-to`, `bcc`, `signature`, `html_signature`) ".
                        " VALUES (:identity_id, :user_id, :changed, :del, :standard, :name, :organization, :email, :reply, :bcc, :signature, :html_signature)");

  $stmt_contact = $dbh->prepare("INSERT INTO ".$h_sql_rcube['contacts_table']." ".
                        " (`contact_id`,`changed`,`del`,`name`,`email`,`firstname`,`surname`,`vcard`,`words`,`user_id`) ".
                        " VALUES (:contact_id, :changed, :del, :name, :email, :firstname, :surname, :vcard, :words, :user_id)");

  foreach ($h_user as $h_user_entity)
  {
    // Serialize user config before inserting it into the db
    $h_user_entity[':preferences'] = serialize($h_user_entity[':preferences']);
    $stmt_user->execute($h_user_entity);
    $i_last_insert_id = $dbh->lastInsertId();

    // Insert user identities
    $h_user_identity[$h_user_entity[':username']][':user_id'] = $i_last_insert_id;
    $stmt_identity->execute($h_user_identity[$h_user_entity[':username']]);

    // Insert contacts
    if(array_key_exists($h_user_entity[':username'], $h_user_contacts))
      foreach ($h_user_contacts[$h_user_entity[':username']] as $i_key => $h_contact) 
      {
        $h_contact[':user_id'] = $i_last_insert_id;
        $stmt_contact->execute($h_contact);
      }
  }

  $dbh->commit();
}
catch (Exception $e)
{
  echo $e->getMessage();
  error_log("Error in MySQL Connection/Statement: ".$e->getMessage());
}
  echo "Squirrelmail to Roundcube migration completed!";
