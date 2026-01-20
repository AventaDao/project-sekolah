<?php

namespace App\Helpers;

use App\Services\ActivityLogger;

class ActivityLogHelper
{
    public static function log($action, $type = 'general', $data = [])
    {
        return app('activity_logger')->logGeneral($action, $type, $data);
    }

    public static function logAuth($action, $data = [])
    {
        return app('activity_logger')->logAuthentication($action, $data);
    }

    public static function logDoc($action, $docId, $data = [])
    {
        return app('activity_logger')->logDocument($action, $docId, $data);
    }

    public static function logApprove($action, $approvalId, $status, $data = [])
    {
        return app('activity_logger')->logApproval($action, $approvalId, $status, $data);
    }

    public static function logUser($action, $userId, $data = [])
    {
        return app('activity_logger')->logUser($action, $userId, $data);
    }

    public static function logForm($action, $formData = [])
    {
        return app('activity_logger')->logForm($action, $formData);
    }
}
