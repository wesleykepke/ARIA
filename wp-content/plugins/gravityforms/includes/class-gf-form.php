<?php

if ( ! class_exists( 'GFForms' ) ) {
  die();
}

class GF_Form {
  // Basic Properties
  public $id = null;
  public $title = null;
  public $description = null;
  public $labelPlacement = null;
  public $descriptionPlacement = null;
  public $fields = array();

  // Post Related Properties
  public $useCurrentUserAsAuthor = null;
  public $postAuthor = null;
  public $postCategory = null;
  public $postContentTemplate = null;
  public $postContentTemplateEnabled = null;
  public $postFormat = null;
  public $postTitleTemplate = null;
  public $postTitleTemplateEnabled = null;

  // Form Submission
  public $confirmation = array();
  public $notifications = null;

  // Advanced Properties
  public $button = null;
  public $cssClass = null;
  public $enableAnimation = null;
  public $enableHoneypot = null;
  public $limitEntries = null;
  public $limitEntriesCount = null;
  public $limitEntriesMessage = null;
  public $scheduleForm = null;
  public $scheduleStart = null;
  public $scheduleStartHour = null;
  public $scheduleStartMinute = null;
  public $scheduleStartAmpm = null;
  public $scheduleEnd = null;
  public $scheduleEndHour = null;
  public $scheduleEndMinute = null;
  public $scheduleEndAmpm = null;
  public $scheduleMessage = null;
  public $schedulePendingMessage = null;

  public function __construct($title, $description) {
    $this->title = $title;
    $this->description = $description;
    $this->button = array("type" => "text", "text" => "submit");
  }

  public function createFormArray() {
    $form = array();

    // if ( ! is_null($id) ) {
    //   $form["id"] = $id;
    // }
    // if ( ! is_null($title) ) {
    //   $form["title"] = $title;
    // }
    // if ( ! is_null($description) ) {
    //   $form["description"] = $description;
    // }
    // if ( ! is_null($labelPlacement) ) {
    //   $form["labelPlacement"] = $labelPlacement;
    // }
    // if ( ! is_null($descriptionPlacement) ) {
    //   $form["descriptionPlacement"] = $descriptionPlacement;
    // }
    // if ( ! is_null($fields) ) {
    //   $form["fields"] = $fields;
    // }
    // if ( ! is_null($useCurrentUserAsAuthor) ) {
    //   $form["useCurrentUserAsAuthor"] = $useCurrentUserAsAuthor;
    // }
    // if ( ! is_null($postAuthor) ) {
    //   $form["postAuthor"] = $postAuthor;
    // }
    // if ( ! is_null($postCategory) ) {
    //   $form["postCategory"] = $postCategory;
    // }
    // if ( ! is_null($postContentTemplate) ) {
    //   $form["postContentTemplate"] = $postContentTemplate;
    // }
    // if ( ! is_null($postContentTemplateEnabled) ) {
    //   $form["postContentTemplateEnabled"] = $postContentTemplateEnabled;
    // }
    // if ( ! is_null($postFormat) ) {
    //   $form["postFormat"] = $postFormat;
    // }
    // if ( ! is_null($postTitleTemplate) ) {
    //   $form["postTitleTemplate"] = $postTitleTemplate;
    // }
    // if ( ! is_null($postTitleTemplateEnabled) ) {
    //   $form["postTitleTemplateEnabled"] = $postTitleTemplateEnabled;
    // }
    // if ( ! is_null($confirmation) ) {
    //   $form["confirmation"] = $confirmation;
    // }
    // if ( ! is_null($notifications) ) {
    //   $form["notifications"] = $notifications;
    // }
    // if ( ! is_null($button) ) {
    //   $form["button"] = $button;
    // }
    // if ( ! is_null($cssClass) ) {
    //   $form["cssClass"] = $cssClass;
    // }
    // if ( ! is_null($enableAnimation) ) {
    //   $form["enableAnimation"] = $enableAnimation;
    // }
    // if ( ! is_null($enableHoneypot) ) {
    //   $form["enableHoneypot"] = $enableHoneypot;
    // }
    // if ( ! is_null($limitEntries) ) {
    //   $form["limitEntries"] = $limitEntries;
    // }
    // if ( ! is_null($limitEntriesCount) ) {
    //   $form["limitEntriesCount"] = $limitEntriesCount;
    // }
    // if ( ! is_null($limitEntriesMessage) ) {
    //   $form["limitEntriesMessage"] = $limitEntriesMessage;
    // }
    // if ( ! is_null($scheduleForm) ) {
    //   $form["scheduleForm"] = $scheduleForm;
    // }
    // if ( ! is_null($scheduleStart) ) {
    //   $form["scheduleStart"] = $scheduleStart;
    // }
    // if ( ! is_null($scheduleStartHour) ) {
    //   $form["scheduleStartHour"] = $scheduleStartHour;
    // }
    // if ( ! is_null($scheduleStartMinute) ) {
    //   $form["scheduleStartMinute"] = $scheduleStartMinute;
    // }
    // if ( ! is_null($scheduleStartAmpm) ) {
    //   $form["scheduleStartAmpm"] = $scheduleStartAmpm;
    // }
    // if ( ! is_null($scheduleEnd) ) {
    //   $form["scheduleEnd"] = $scheduleEnd;
    // }
    // if ( ! is_null($scheduleEndHour) ) {
    //   $form["scheduleEndHour"] = $scheduleEndHour;
    // }
    // if ( ! is_null($scheduleEndMinute) ) {
    //   $form["scheduleEndMinute"] = $scheduleEndMinute;
    // }
    // if ( ! is_null($scheduleEndAmpm) ) {
    //   $form["scheduleEndAmpm"] = $scheduleEndAmpm;
    // }
    // if ( ! is_null($scheduleMessage) ) {
    //   $form["scheduleMessage"] = $scheduleMessage;
    // }
    // if ( ! is_null($schedulePendingMessage) ) {
    //   $form["schedulePendingMessage"] = $schedulePendingMessage;
    // }

    return $form;
  }
};






