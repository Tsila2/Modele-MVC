<?php

namespace App\Controllers;
use App\Models\ApiModel;
use Core\Controller;


class ApiController extends Controller
{
    private $apiModel;

    public function __construct()
    {
        $this->apiModel = new ApiModel();
    }
    public function carlist()
    {
        try {
            $cars = $this->apiModel->getCarList();
            $this->sendJsonResponse($cars, 200);
        } catch (\Exception $e) {
            $this->sendJsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    
    /**
     * Sends a JSON response with the given data and HTTP status code.
     *
     * This method sets the HTTP response status code, sets the content type to JSON,
     * encodes the provided data as a JSON string, and outputs it.
     *
     * @param mixed $data The data to be encoded as JSON and sent in the response.
     * @param int $statusCode The HTTP status code for the response (default is 200).
     *
     * @return void
     */
    private function sendJsonResponse($data, $statusCode = 200)
    {
        // Set HTTP response status
        http_response_code($statusCode);

        // Set content type to JSON
        header('Content-Type: application/json');

        // Encode data as JSON and print it
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }
}