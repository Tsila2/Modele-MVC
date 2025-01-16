<?php

namespace App\Controllers;
use App\Models\CarModel;
use Core\Controller;

class CarController extends Controller
{

    private $carModel;

    public function __construct()
    {
        $this->carModel = new CarModel();
    }
    public function index()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('location:' . BASE_URL . 'home?msg=2');
        }
        $this->view('car/index');
    }

    public function addcar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                "id_type" => $_POST['type'],
                "registration" => $_POST['registration'],
                "name_car" => $_POST['name'],
                "mark" => $_POST['mark'],
                "price_day" => $_POST['price_day'],
                "available" => true
            ];

            if ($this->carModel->createCar($data)) {
                echo "Data inserted successfully";
            } else {
                echo "Data insertion error";
            }
        } else {
            echo "No data found";
        }
    }

    public function carlist()
    {
        $url = BASE_URL.'api/carlist';
        $cars = $this->fetchCarDataFromApi($url);
        $this->view('car/list', ['cars' => $cars]);
    }

    public function update($id)
    {
        $car = $this->carModel->getCarById($id);
        $types = $this->carModel->getCarListType();
        $this->view('car/modif', ['car' => $car, 'types' => $types]);
    }

    public function carupdate($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data = [
                "id_type" => $_POST['type'],
                "registration" => $_POST['registration'],
                "name_car" => $_POST['name'],
                "mark" => $_POST['mark'],
                "price_day" => $_POST['price_day']
            ];

            $update = $this->carModel->updateCarById($id, $data);

            if ($update) {
                header('location: ' . BASE_URL . 'car/carlist');
            } else {
                echo "ERROR inserting data";
            }

        } else {
            echo "No data sent";
        }
    }

    public function delete($id)
    {
        $delete = $this->carModel->deleteCarById($id);

        if ($delete) {
            header('location: ' . BASE_URL . 'car/carlist');
        } else {
            echo "ERROR deleting data";
        }
    }

    /**
     * Fetches car data from the given API URL.
     *
     * This method initializes a cURL session, sets the URL, and retrieves the data.
     * If an error occurs during the cURL execution, it will be displayed.
     * The method returns the decoded JSON response as an associative array.
     *
     * @param string $url The API URL to fetch car data from.
     * @return array|null The decoded JSON response as an associative array, or null on failure.
     */
    public function fetchCarDataFromApi($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $output = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        curl_close($ch);

        return json_decode($output, true);
    }

}
