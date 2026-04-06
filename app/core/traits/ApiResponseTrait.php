<?php
/**
 * Trait: ApiResponseTrait
 *
 * Purpose:
 *  - Provides reusable methods for sending JSON API responses.
 *  - Keeps controllers clean and consistent.
 */
trait ApiResponseTrait
{
    /**
     * Send a standarized JSON response
     */
    protected function jsonResponse(mixed $data, int $status = 200, string $message = ''): void
    {
        header('Content-Type: application/json ; charset=utf-8');
        http_response_code($status);

        echo json_encode([
            "success" => $status < 400,
            "message" => $message,
            "data" => $data
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        exit;
    }

}