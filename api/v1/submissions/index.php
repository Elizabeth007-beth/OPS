<?php

/**
 * @defgroup api_v1_submissions Submission API requests
 */

/**
 * @file api/v1/submissions/index.php
 *
 * Copyright (c) 2023 Simon Fraser University
 * Copyright (c) 2023 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @ingroup api_v1_submissions
 *
 * @brief Handle requests for submission API functions.
 *
 */

use APP\core\Application;

$requestPath = Application::get()->getRequest()->getRequestPath();

if (strpos($requestPath, '/files')) {
    return new \PKP\core\PKPApiRoutingHandler(new \PKP\API\v1\submissions\PKPSubmissionFileController());
} else {
    return new \PKP\core\PKPApiRoutingHandler(new \APP\API\v1\submissions\SubmissionController());
}
