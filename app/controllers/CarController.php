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
        $cars = $this->carModel->getCarList();
        $this->view('car/list', ['cars' => $cars]);
    }

    public function update($id)
    {
        $car = $this->carModel->getCarById($id);
      $types= $this->carModel->getCarListType();
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

    
}
