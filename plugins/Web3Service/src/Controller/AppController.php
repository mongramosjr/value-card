<?php

namespace Web3Service\Controller;

use App\Controller\AppController as BaseController;

class AppController extends BaseController
{
    const WEB3_STATUS_ERROR = 400; // Failed - General failure
    const WEB3_STATUS_UNAUTHORIZED = 401; // Faile - request failed
    const WEB3_STATUS_FAIL = 402; // Faile - request failed
    const WEB3_STATUS_CANCEL = 205; // Cancel - response requires that the requester cancel the request
    const WEB3_STATUS_PENDING = 202; // Pending - request accepted but not completed yet
    const WEB3_STATUS_SUCCESS = 200; // Ok - everything worked as expected

}
