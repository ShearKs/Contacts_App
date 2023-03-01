<?php
 //La forma que estaba anteriormente
  // $contacts = [
  //     ["name" => "Pepe", "phone_number" => "2132139"],
  //     ["name" => "Antonio", "phone_number" => "982392"],
  //     ["name" => "Nate", "phone_number" => "329847"],
  //     ["name" => "Rodrigo", "phone_number" => "4353234"],
  //     ["name" => "Marcos", "phone_number" => "12312432"],
  //   ];

  //Lee todos los contactos
  //Comentario nuevoclear
    // if (file_exists("contacts.json")){

    //   $contacts  = json_decode( file_get_contents("contacts.json"),true); 

    // }else{

    //   $contacts = [];
    // }

require "conexion.php";
//Ahora lee los contactos desde la base de datos
$contacts = $conn->query("SELECT * FROM contacts");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.3/darkly/bootstrap.min.css"
    integrity="sha512-ZdxIsDOtKj2Xmr/av3D/uo1g15yxNFjkhrcfLooZV5fW0TT7aF7Z3wY1LOA16h0VgFLwteg14lWqlYUQK3to/w=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"/>
  <script
    defer
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>

  <!-- Static Content -->
  <link rel="stylesheet" href="./static/css/index.css" />

  <title>Contacts App</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand font-weight-bold" href="#">
        <img class="mr-2" src="./static/img/logo.png" />
        ContactsApp
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./add.php">Add Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main>
    <div class="container pt-4 p-3">
      <div class="row">

      <!--Si no hay ningun contacto muestra el siguiente div -->
      <?php if ($contacts->rowCount() == 0): ?>
        <div class="col-md-4 mx-auto">
            <div class="card card-body text-center">
              <p>No contacts saved yet</p>
              <a href="add.php">Add One!</a>
            </div>
          </div>
      <?php endif ?> 
      <!-- Recorre los contactos que hay en la base de datos-->
      <?php foreach ($contacts as $contact): ?>
          <div class="col-md-4 mb-3">
            <div class="card text-center">
              <div class="card-body">
                <h3 class="card-title text-capitalize"><?= $contact["name"] ?></h3>
                <p class="m-2"><?= $contact["phone_number"] ?></p>
                <a href="update.php?id=<?= $contact["id"] ?>" class="btn btn-secondary mb-2">Edit Contact</a>
                <a href="delete.php?id=<?= $contact["id"] ?>"class="btn btn-danger mb-2">Delete Contact</a>
              </div>
            </div>
          </div>
        <?php endforeach ?>
       
      </div>
    </div>
  </main>
</body>
</html>