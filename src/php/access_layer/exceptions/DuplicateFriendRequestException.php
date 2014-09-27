<?php

class DuplicateFriendRequestException extends Exception {

  private 
    $requestingUserId,
    $approvingUserId;

  public function __construct($requestingUserId, $approvingUserId) {
    $this->requestingUserId = $requestingUserId;
    $this->approvingUserId = $approvingUserId; 
  }

  public function __toString() {
    return "ERROR: <DuplicateFriendRequestException> requestingUserId: " 
      . $this->requestingUserId . ", approvingUserId: " . $this->approvingUserId;
  }
}

