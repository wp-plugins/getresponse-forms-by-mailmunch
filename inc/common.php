<?php
class GetresponseMailmunchHelpers {
  function __construct() {
  }

  function getEmailPassword() {
    $gr_mm_email = get_option("gr_mm_user_email");
    $gr_mm_password = get_option("gr_mm_user_password");

    if (empty($gr_mm_email)) {
      $current_user = wp_get_current_user();
      update_option("gr_mm_user_email", $current_user->user_email);
    }

    if (empty($gr_mm_password)) {
      update_option("gr_mm_user_password", uniqid());
    }

    $gr_mm_email = get_option("gr_mm_user_email");
    $gr_mm_password = get_option("gr_mm_user_password");

    return array('email' => $gr_mm_email, 'password' => $gr_mm_password);
  }

  function getSite($sites, $site_id) {
    foreach ($sites as $s) {
      if ($s->id == intval($site_id)) {
        $site = $s;
        break;
      }
    }

    return (isset($site) ? $site : false);
  }

  function createAndGetSites($mm) {
    $site_url = home_url();
    $site_name = get_bloginfo();

    if (!$mm->hasSite()) {
      $mm->createSite($site_name, $site_url);
    }
    $request = $mm->sites();
    if ($request['response']['code'] == 200){
      $sites = $request['body'];

      return json_decode($sites);
    }
    else {
      return array();
    }
  }

  function createAndGetGuestSites($mm) {
    // This is for GUEST users. Do NOT collect any user data.
    $site_url = "";
    $site_name = "WordPress";

    if (!$mm->hasSite()) {
      $mm->createSite($site_name, $site_url);
    }
    $request = $mm->sites();
    if ($request['response']['code'] == 200){
      $sites = $request['body'];

      return json_decode($sites);
    }
    else {
      return array();
    }
  }
}
?>
