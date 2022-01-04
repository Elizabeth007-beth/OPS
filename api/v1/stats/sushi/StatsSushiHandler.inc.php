<?php

/**
 * @file api/v1/stats/sushi/StatsSushiHandler.inc.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class StatsSushiHandler
 * @ingroup api_v1_stats
 *
 * @brief Handle API requests for COUNTER R5 SUSHI statistics.
 *
 */

use PKP\core\APIResponse;
use Slim\Http\Request as SlimHttpRequest;

import('lib.pkp.api.v1.stats.sushi.PKPStatsSushiHandler');

class StatsSushiHandler extends PKPStatsSushiHandler
{
    /**
     * Get this API's endpoints definitions
     */
    protected function getGETDefinitions(): array
    {
        $roles = [];
        return array_merge(
            parent::getGETDefinitions(),
            [
                [
                    'pattern' => $this->getEndpointPattern() . '/reports/ir',
                    'handler' => [$this, 'getReportsIR'],
                    'roles' => $roles
                ],
            ]
        );
    }

    /**
     * COUNTER 'Item Master Report' [IR].
     * A customizable report detailing activity at the pre-print level
     * that allows the user to apply filters and select other configuration options for the report.
     */
    public function getReportsIR(SlimHttpRequest $slimRequest, APIResponse $response, array $args): APIResponse
    {
        $args['report'] = new \APP\sushi\IR();
        return $this->getReport($slimRequest, $response, $args);
    }

    /**
     * Get the application specific list of reports supported by the API
     */
    protected function getReportList(): array
    {
        return array_merge(parent::getReportList(), [
            [
                'Report_Name' => 'Item Master Report',
                'Report_ID' => 'IR',
                'Release' => '5',
                'Report_Description' => __('sushi.reports.ir.description'),
                'Path' => 'reports/ir'
            ],
        ]);
    }
}
