<?php session_start(); ?>
<!DOCTYPE html>
<html lang="">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://kit.fontawesome.com/a4e771fc9a.js" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="./images/a-03.ico" type="image/x-icon">
  <title>Jumler Academy</title>
</head>

<body>
<?php
if (!empty($_SESSION["msg"])) {
  echo "" . $_SESSION["msg"] . "";
  $_SESSION["msg"] = "";
  session_unset();
  session_destroy();
}
?>
  <header>
    <div class="navbar">
      <!-- ... your existing content ... -->
      <div class="logo">
        <img src="./images/a-01-white.png" alt="logo">
      </div>
      <div class="contact-button">
        <button id="open-modal">Se connecter</button>
      </div>
    </div>
    <div class="container-modal">

    </div>
    <!-- Contact Modal -->
    <div id="contact-modal" class="modal">

      <!-- se connecter -->
      <div class="modal-content" id="connecter">
        <span class="close-button" id="close-modal">&times;</span>
        <h2>Se connecter</h2>
        <form action="controller/connecter.php" name="connecter" method="POST" >

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
          </div>

          <div class="form-group">
            <label for="message">Mot de passe:</label>
            <input type="password" name="password" required>
          </div>

          <button type="submit">Se connecter</button>
        </form>
        <div>
          <p class="switch" style="text-align:center;cursor: pointer;">S'inscrire</p>
        </div>
      </div>
      <!-- End se connecter -->

      <!-- s'inscrire -->
      <div class="modal-content" id="inscrire">
        <span class="close-button" id="close-modal">&times;</span>
        <h2>S'inscrire</h2>
        <form action="controller/inscrire.php" name="inscrire" method="POST" onsubmit="submitForm(event)">
          <div class="form-group">
            <label for="name">Nom et prénom:</label>
            <input type="text" id="name" name="name" required>
          </div>

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
          </div>

          <div class="form-group">
            <label for="phone">Numero de telephone:</label>
            <input type="tel" id="phone" name="phone" required>
          </div>

          <div class="form-group">
            <label for="message">Mot de passe:</label>
            <input type="password" id="password" name="password" required>
          </div>
          <div class="form-group">
            <label for="message">Confirmation du mot de passe:</label>
            <input type="password" id="Cpassword" name="Cpassword" required>
            <span id="alert"></span>
          </div>

          <button type="submit">S'inscrire</button>
        </form>
        <div>
          <p class="switch" style="text-align:center;cursor: pointer;">Se connecter</p>
        </div>
      </div>
      <!-- End s'inscrire -->

    </div>
  </header>

  <main>
    <div class="texts">
      <div class="title">
        <h1>Maitriser l'art de la boucherie avec jumler academy</h1>
      </div>
      <div class="into">
        <h3>Notre formation en 100 heures vous enseignera:</h3>
      </div>
      <div class="info">
        <ul>
          <li>
            Les techniques de decoupe, transformation et pesee des viandes
          </li>
          <li>
            Les regles d'hygiene et securite alimentaire
          </li>
          <li>
            La gestion du stock et le rendement en boucherie
          </li>
          <li>
            Formation sur 6 mois, 2 seances de 4 heures par semaine
          </li>
        </ul>
      </div>
      <div class="box-info">
        <p>Avec un stage pour mettre en pratique vos competence</p>
      </div>
      <div class="box-info">
        <p>Investissez dans votre future aujourd'hui</p>
      </div>
      <div class="phone">
        <a href="tel:+212622306020">&#9990; +212 6 22 30 60 20</a>
      </div>
    </div>
    <div class="container">
      <div class="image">
        <img src="./images/1.jpg" alt="">
      </div>
      <div class="image">
        <img src="./images/2.jpg" alt="">
      </div>
      <div class="image">
        <img src="./images/3.jpg" alt="">
      </div>
    </div>
  </main>
  <div class="wa" title="clique ici pour s'inscrire">
    <a href="https://api.whatsapp.com/send?phone=+212622306020&text=Hello%20from%20my%20website" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-whatsapp"></i></a>
  </div>
  <footer>
    <p>&copy;2023All Rights Reserved</p>
  </footer>
</body>

</html>

<script>
  // Get the modal and buttons
  const contactModal = document.getElementById('contact-modal');
  const openModalButton = document.getElementById('open-modal');
  const closeModalButton = document.getElementById('close-modal');

  // Open the modal when the button is clicked
  openModalButton.addEventListener('click', () => {
    contactModal.style.display = 'block';
  });

  // Close the modal when the close button is clicked
  closeModalButton.addEventListener('click', () => {
    contactModal.style.display = 'none';
  });

  // Close the modal if the background is clicked
  window.addEventListener('click', (event) => {
    if (event.target === contactModal) {
      contactModal.style.display = 'none';
    }
  });

  //whatsapp widget Animation
  var wa = document.querySelector('.wa');
  window.addEventListener("mousemove", () => {
    wa.classList.add("anime");
    setTimeout(() => {
      wa.classList.remove("anime");
    }, 1000)
  })


  // switch forms handler
  var connecter = document.getElementById("connecter");
  var inscrire = document.getElementById("inscrire");
  var switcher = document.querySelectorAll(".switch");

  inscrire.style.display = "none";

  switcher.forEach(element => {

    element.addEventListener("click", () => {

      if (inscrire.style.display == "none") {
        connecter.style.display = "none";
        inscrire.style.display = "block";
      } else {
        inscrire.style.display = "none";
        connecter.style.display = "block";
      }

    })
  });

  var pwd = document.getElementById("password");
  var cpwd = document.getElementById("Cpassword");
  var alert = document.getElementById("alert");
  alert.style.display = "none";

  cpwd.addEventListener("keyup",(e)=>{
    if(pwd.value != cpwd.value){
      alert.style.display = "block";
      alert.style.color = "red"
      alert.innerText = "Le mot de passe ne correspond pas!";
    }else{
      alert.style.display = "none";
    }
  })

  function submitForm(event){
    if(pwd.value != cpwd.value){
        event.preventDefault();
      }
  }

  var removeAlert = document.querySelector('.alert');
  setTimeout(() => {
    removeAlert.style.display = "none";
  }, 5000);
</script>