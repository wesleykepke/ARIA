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

    if ( ! is_null($this->id) ) {
      $form["id"] = $this->id;
    }
    if ( ! is_null($this->title) ) {
      $form["title"] = $this->title;
    }
    if ( ! is_null($this->description) ) {
      $form["description"] = $this->description;
    }
    if ( ! is_null($this->labelPlacement) ) {
      $form["labelPlacement"] = $this->labelPlacement;
    }
    if ( ! is_null($this->descriptionPlacement) ) {
      $form["descriptionPlacement"] = $this->descriptionPlacement;
    }
    if ( ! is_null($this->fields) ) {
      $form["fields"] = $this->fields;
    }
    if ( ! is_null($this->useCurrentUserAsAuthor) ) {
      $form["useCurrentUserAsAuthor"] = $this->useCurrentUserAsAuthor;
    }
    if ( ! is_null($this->postAuthor) ) {
      $form["postAuthor"] = $this->postAuthor;
    }
    if ( ! is_null($this->postCategory) ) {
      $form["postCategory"] = $this->postCategory;
    }
    if ( ! is_null($this->postContentTemplate) ) {
      $form["postContentTemplate"] = $this->postContentTemplate;
    }
    if ( ! is_null($this->postContentTemplateEnabled) ) {
      $form["postContentTemplateEnabled"] = $this->postContentTemplateEnabled;
    }
    if ( ! is_null($this->postFormat) ) {
      $form["postFormat"] = $this->postFormat;
    }
    if ( ! is_null($this->postTitleTemplate) ) {
      $form["postTitleTemplate"] = $this->postTitleTemplate;
    }
    if ( ! is_null($this->postTitleTemplateEnabled) ) {
      $form["postTitleTemplateEnabled"] = $this->postTitleTemplateEnabled;
    }
    if ( ! is_null($this->confirmation) ) {
      $form["confirmation"] = $this->confirmation;
    }
    if ( ! is_null($this->notifications) ) {
      $form["notifications"] = $this->notifications;
    }
    if ( ! is_null($this->button) ) {
      $form["button"] = $this->button;
    }
    if ( ! is_null($this->cssClass) ) {
      $form["cssClass"] = $this->cssClass;
    }
    if ( ! is_null($this->enableAnimation) ) {
      $form["enableAnimation"] = $this->enableAnimation;
    }
    if ( ! is_null($this->enableHoneypot) ) {
      $form["enableHoneypot"] = $this->enableHoneypot;
    }
    if ( ! is_null($this->limitEntries) ) {
      $form["limitEntries"] = $this->limitEntries;
    }
    if ( ! is_null($this->limitEntriesCount) ) {
      $form["limitEntriesCount"] = $this->limitEntriesCount;
    }
    if ( ! is_null($this->limitEntriesMessage) ) {
      $form["limitEntriesMessage"] = $this->limitEntriesMessage;
    }
    if ( ! is_null($this->scheduleForm) ) {
      $form["scheduleForm"] = $this->scheduleForm;
    }
    if ( ! is_null($this->scheduleStart) ) {
      $form["scheduleStart"] = $this->scheduleStart;
    }
    if ( ! is_null($this->scheduleStartHour) ) {
      $form["scheduleStartHour"] = $this->scheduleStartHour;
    }
    if ( ! is_null($this->scheduleStartMinute) ) {
      $form["scheduleStartMinute"] = $this->scheduleStartMinute;
    }
    if ( ! is_null($this->scheduleStartAmpm) ) {
      $form["scheduleStartAmpm"] = $this->scheduleStartAmpm;
    }
    if ( ! is_null($this->scheduleEnd) ) {
      $form["scheduleEnd"] = $this->scheduleEnd;
    }
    if ( ! is_null($this->scheduleEndHour) ) {
      $form["scheduleEndHour"] = $this->scheduleEndHour;
    }
    if ( ! is_null($this->scheduleEndMinute) ) {
      $form["scheduleEndMinute"] = $this->scheduleEndMinute;
    }
    if ( ! is_null($this->scheduleEndAmpm) ) {
      $form["scheduleEndAmpm"] = $this->scheduleEndAmpm;
    }
    if ( ! is_null($this->scheduleMessage) ) {
      $form["scheduleMessage"] = $this->scheduleMessage;
    }
    if ( ! is_null($this->schedulePendingMessage) ) {
      $form["schedulePendingMessage"] = $this->schedulePendingMessage;
    }

    return $form;
  }
};






