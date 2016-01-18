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
  public $fields = null;

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
  public $confirmation = null;
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
    $this->fields = array();
    $this->confirmation = array();
    $this->button = array("type" => "text", "text" => "submit");
  }

  public function createFormArray() {
    $form = array();

    if ($id != null) {
      $form["id"] = $id;
    }
    if ($title != null) {
      $form["title"] = $title;
    }
    if ($description != null) {
      $form["description"] = $description;
    }
    if ($labelPlacement != null) {
      $form["labelPlacement"] = $labelPlacement;
    }
    if ($descriptionPlacement != null) {
      $form["descriptionPlacement"] = $descriptionPlacement;
    }
    if ($fields != null) {
      $form["fields"] = $fields;
    }
    if ($useCurrentUserAsAuthor != null) {
      $form["useCurrentUserAsAuthor"] = $useCurrentUserAsAuthor;
    }
    if ($postAuthor != null) {
      $form["postAuthor"] = $postAuthor;
    }
    if ($postCategory != null) {
      $form["postCategory"] = $postCategory;
    }
    if ($postContentTemplate != null) {
      $form["postContentTemplate"] = $postContentTemplate;
    }
    if ($postContentTemplateEnabled != null) {
      $form["postContentTemplateEnabled"] = $postContentTemplateEnabled;
    }
    if ($postFormat != null) {
      $form["postFormat"] = $postFormat;
    }
    if ($postTitleTemplate != null) {
      $form["postTitleTemplate"] = $postTitleTemplate;
    }
    if ($postTitleTemplateEnabled != null) {
      $form["postTitleTemplateEnabled"] = $postTitleTemplateEnabled;
    }
    if ($confirmation != null) {
      $form["confirmation"] = $confirmation;
    }
    if ($notifications != null) {
      $form["notifications"] = $notifications;
    }
    if ($button != null) {
      $form["button"] = $button;
    }
    if ($cssClass != null) {
      $form["cssClass"] = $cssClass;
    }
    if ($enableAnimation != null) {
      $form["enableAnimation"] = $enableAnimation;
    }
    if ($enableHoneypot != null) {
      $form["enableHoneypot"] = $enableHoneypot;
    }
    if ($limitEntries != null) {
      $form["limitEntries"] = $limitEntries;
    }
    if ($limitEntriesCount != null) {
      $form["limitEntriesCount"] = $limitEntriesCount;
    }
    if ($limitEntriesMessage != null) {
      $form["limitEntriesMessage"] = $limitEntriesMessage;
    }
    if ($scheduleForm != null) {
      $form["scheduleForm"] = $scheduleForm;
    }
    if ($scheduleStart != null) {
      $form["scheduleStart"] = $scheduleStart;
    }
    if ($scheduleStartHour != null) {
      $form["scheduleStartHour"] = $scheduleStartHour;
    }
    if ($scheduleStartMinute != null) {
      $form["scheduleStartMinute"] = $scheduleStartMinute;
    }
    if ($scheduleStartAmpm != null) {
      $form["scheduleStartAmpm"] = $scheduleStartAmpm;
    }
    if ($scheduleEnd != null) {
      $form["scheduleEnd"] = $scheduleEnd;
    }
    if ($scheduleEndHour != null) {
      $form["scheduleEndHour"] = $scheduleEndHour;
    }
    if ($scheduleEndMinute != null) {
      $form["scheduleEndMinute"] = $scheduleEndMinute;
    }
    if ($scheduleEndAmpm != null) {
      $form["scheduleEndAmpm"] = $scheduleEndAmpm;
    }
    if ($scheduleMessage != null) {
      $form["scheduleMessage"] = $scheduleMessage;
    }
    if ($schedulePendingMessage != null) {
      $form["schedulePendingMessage"] = $schedulePendingMessage;
    }

    return $form;
  }
};






