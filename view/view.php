<?php
class view
{

  //en tete du site
  private function header()
  {
    echo '<html>
        <head>
            <meta charset="utf-8">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
            <link href="css/style.css" rel="stylesheet">
            <link rel="shortcut icon" href="images/maison.ico" type="image/x-icon">
            <link src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.10.1/main.min.css" rel="stylesheet"/>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="theme-color" content="#712cf9">
        </head>
        <body>
        <style>
    .suggestion-item {
        padding: 5px;
        border: 1px solid #ccc;
        margin-top: 5px;
    }

    .suggestion-item a {
        text-decoration: none;
        color: #333;
    }
  </style>
        <header class="p-3 mb-3 border-bottom">
            <div class="container">
              <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="index.php?action=accueil" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                  <img src="../assets/img/logoText.png" class="bi me-2" height="32" role="img" aria-label="Bootstrap" style="padding-right: 30px;"></svg>
                </a>
        
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                  <li><a href="index.php?action=accueil" class="nav-link px-2 link-secondary">Accueil</a></li>
                  <li><a href="index.php?action=rechercherLogement" class="nav-link px-2 link-body-emphasis">Réserver</a></li>
                </ul>
        
                <div>
                ';
    if (!isset($_SESSION['connexion']) && !isset($_SESSION['connexion_commercial'])) {
      echo '
                 <div style="font-size : 12px; margin-right : 12px"><a class="dropdown-item" href="index.php?action=loginProprio">Vous êtes propriétaire ? </a></div>
                 </div>
                 <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" style="position: relative;">
                  <input id="searchInput" type="search" class="form-control" placeholder="Recherche..." aria-label="Search" id="searchInput">
                  <div id="suggestions" style="position: absolute; top: 100%; left: 0; z-index: 100; background-color: #fff; border: 1px solid #ccc; display: none;"></div>
                  </form>

         
                 <div class="dropdown text-end">
                   <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                     <img src="/images/ppdefault.png" alt="mdo" width="32" height="32" class="rounded-circle">
                   </a>
                   <ul class="dropdown-menu text-small" style="">
                   
                   <script>
                   var suggestions = {
                       "Recherche de bien": "index.php?action=rechercherLogement",
                       "Recherche de logement": "index.php?action=rechercherLogement",
                       "Gérer mes annonces": "index.php?action=mesAnnonces",
                       "Gérer mes Reservations": "index.php?action=mesReservations",
                       "Voir mes Reservations": "index.php?action=mesReservations",
                       "Voir les Politique": "index.php?action=seepolitique"
                   };
               
                   const searchInput = document.getElementById("searchInput");
                   const suggestionsDiv = document.getElementById("suggestions");
               
                   function showSuggestions(inputValue) {
                       suggestionsDiv.innerHTML = "";
               
                       if (inputValue.length === 0) {
                           suggestionsDiv.style.display = "none";
                           return;
                       }
               
                       suggestionsDiv.style.display = "block";
               
                       let count = 0;
               
                       for (const [key, value] of Object.entries(suggestions)) {
                           if (count >= 3) {
                               break;
                           }
               
                           if (key.toLowerCase().includes(inputValue.toLowerCase())) {
                               const suggestionLink = document.createElement("a");
                               suggestionLink.href = value;
                               suggestionLink.textContent = key;
                               suggestionLink.classList.add("suggestion");
               
                               const suggestionItem = document.createElement("div");
                               suggestionItem.classList.add("suggestion-item");
                               suggestionItem.appendChild(suggestionLink);
               
                               suggestionsDiv.appendChild(suggestionItem);
                               count++;
                           }
                       }
                   }
               
                   searchInput.addEventListener("input", (event) => {
                       const inputValue = event.target.value;
                       showSuggestions(inputValue);
                   });
               
                   document.addEventListener("click", (event) => {
                       if (!suggestionsDiv.contains(event.target)) {
                           suggestionsDiv.style.display = "none";
                       }
                   });
               </script>
                   ';
    } else {
      echo '
      </div>
      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
        <input id="searchInput" type="search" class="form-control" placeholder="Recherche..." aria-label="Search">
      </form>

      <div class="dropdown text-end">
        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small" style="">
        
        <script>
        var suggestions = {
            "Recherche de bien": "index.php?action=rechercherLogement",
            "Recherche de logement": "index.php?action=rechercherLogement",
            "Gérer mes annonces": "index.php?action=mesAnnonces",
            "Gérer mes Reservations": "index.php?action=mesReservations",
            "Voir mes Reservations": "index.php?action=mesReservations",
            "Voir les Politique": "index.php?action=seepolitique"
        };
    
        const searchInput = document.getElementById("searchInput");
        const suggestionsDiv = document.getElementById("suggestions");
    
        function showSuggestions(inputValue) {
            suggestionsDiv.innerHTML = "";
    
            if (inputValue.length === 0) {
                suggestionsDiv.style.display = "none";
                return;
            }
    
            suggestionsDiv.style.display = "block";
    
            let count = 0;
    
            for (const [key, value] of Object.entries(suggestions)) {
                if (count >= 3) {
                    break;
                }
    
                if (key.toLowerCase().includes(inputValue.toLowerCase())) {
                    const suggestionLink = document.createElement("a");
                    suggestionLink.href = value;
                    suggestionLink.textContent = key;
                    suggestionLink.classList.add("suggestion");
    
                    const suggestionItem = document.createElement("div");
                    suggestionItem.classList.add("suggestion-item");
                    suggestionItem.appendChild(suggestionLink);
    
                    suggestionsDiv.appendChild(suggestionItem);
                    count++;
                }
            }
        }
    
        searchInput.addEventListener("input", (event) => {
            const inputValue = event.target.value;
            showSuggestions(inputValue);
        });
    
        document.addEventListener("click", (event) => {
            if (!suggestionsDiv.contains(event.target)) {
                suggestionsDiv.style.display = "none";
            }
        });
    </script>
        
        
        ';
    }

    if (isset($_SESSION["connexion"])) {
      echo '<li><a class="dropdown-item" href="index.php?action=profil">Mon profil</a></li>
                    <li><a class="dropdown-item" href="index.php?action=mesReservations">Mes réservations</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="index.php?action=deconnexion">Déconnexion</a></li>';
    } elseif (isset($_SESSION["connexion_commercial"])) {
      echo ' <li><a class="dropdown-item" href="index.php?action=profil">Mon profil</a></li>
      <li><a class="dropdown-item" href="index.php?action=mesAnnonces">Mes annonces</a></li>
      <li><a class="dropdown-item" href="index.php?action=LesDemandes">Les demandes</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="index.php?action=deconnexion">Déconnexion</a></li>';
    } else {
      echo ' <li><a class="dropdown-item" href="index.php?action=connexion">Connexion</a></li>
      <li><a class="dropdown-item" href="index.php?action=inscription">Inscription</a></li>';
    }
    echo '                    
                  </ul>
                </div>
              </div>
            </div>
          </header>
          ';
  }

  private function footer()
  {
    echo '
    <div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-body-secondary">© '.date('Y').' Realestate, Inc</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
    </a>

    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="index.php?action=seepolitique" class="nav-link px-2 text-body-secondary">Politique de confidentialité</a></li>
      <li class="nav-item"><a href="index.php?action=seepolitique" class="nav-link px-2 text-body-secondary">Conditions d\'utilisation</a></li>
    </ul>
  </footer>
</div>
  
    </body>
        </html>';
  }

  public function error404()
  {
    $this->header();
    echo '<div class="container text-center">';
    echo '<img class="img-fluid" width="600" height="600" src="https://img.freepik.com/vecteurs-libre/illustration-du-concept-erreur-monster-404_114360-1879.jpg?w=1060&t=st=1700061116~exp=1700061716~hmac=cce4975ffba53485ff0fe4c160aee6c75451d2cfa31d6908f7c2e3401b35fb61">';
    echo '<h4 class="text-center">Une erreur est survenue, vous pouvez vous rediriger à la page d\'accueil <a href="index.php?action=accueil">ici</a></h4>';
    echo '</div>';
    $this->footer();
  }

  function error403()
  {
    $this->header();
    echo '<div class="container text-center">';
    echo '<img class="img-fluid" width="600" height="600" src="https://www.icône.com/images/icones/3/0/entree-interdite.png">';
    echo '<h4 class="text-center">Interdiction d\'accéder à cette page, vous pouvez vous rediriger à la page d\'accueil <a href="index.php?action=accueil">ici</a></h4>';
    echo '</div>';
    $this->footer();
  }


  public function accueil($logements = null, $messageError = null)
  {
    $this->header();
    echo '<main>
    <section class="py-5 text-center container">
    ';
    echo '
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <h1 class="fw-light mb-4">Rechercher</h1>
          <div class="mb-3 p-3 rounded bg-light">
          <form method="post" action="index.php?action=rechercherLogement" onsubmit="return validerFormulaire()">
            <div class="mb-3">
              <label for="inputRecherche" class="form-label">Recherche:</label>
              <div class="input-group">
                <span class="input-group-text" id="inputGroup-sizing-lg"><i class="fa-solid fa-magnifying-glass"></i></span>
                <input type="text" placeholder="Code postal" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" id="inputRecherche" name="cpostaleorville">
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                <label for="datedebut" class="form-label">Date d\'arrivée:</label>
                <input type="date" id="datedebut" name="datedebut" class="form-control">
              </div>
              <div class="col">
                <label for="datefin" class="form-label">Date de départ:</label>
                <input type="date" id="datefin" name="datefin" class="form-control">
              </div>
            </div>
            <div class="text-center">
                <button class="btn btn-outline-secondary" name="rechercherLogement" type="submit">Rechercher</button>
            </div>
            </form>
          </div>
          <p class="lead text-body-secondary" style="padding-top:15px">
            Rechercher des biens via l\'outil de recherche ou parcourer les différents biens proposer sur le site
          </p>
          <p>
            <a href="index.php?action=rechercherLogement" class="btn btn-primary my-2">Paroucrir tout les biens</a>
            <a href="index.php?action=loginProprio" class="btn btn-secondary my-2">Zone Propriétaire</a>
          </p>
        </div>
      </div>
    </section>
      <div class="album py-5 bg-body-tertiary">
        <div class="container">
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';
    foreach ($logements as $logement) {

      $id_logement = $logement['id_logement'];
      $premiere_photo = $logement['premiere_photo'];
      $id_commercial = $logement['id_commercial'];
      $nom_logement = $logement['nom_logement'];
      $nombre_pieces = $logement['nombre_pieces'];
      $rue_logement = $logement['rue_logement'];
      $cp_logement = $logement['cp_logement'];
      $ville_logement = $logement['ville_logement'];
      $DateAjout = $logement['DateAjout'];

      echo '<div class="col">
                <div class="card shadow-sm">
                    <img src="/images/' . ($premiere_photo ? $premiere_photo : 'placeholder.jpg') . '" class="bd-placeholder-img card-img-top" width="100%" height="225">
                    <div class="card-body">
                        <p class="card-text">' . $nom_logement . ' <br> ' . $rue_logement . ' <br>' . $ville_logement . '</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">';
      if (isset($_SESSION["connexion_commercial"]) && $_SESSION["connexion_commercial"] == $id_commercial) {
        echo '
                                <a href="index.php?action=mesAnnonces" class="btn btn-sm btn-outline-secondary">Edit</a>
                                ';
      }
      echo '
                                <a href="index.php?action=location&id=' . $id_logement . '" class="btn btn-sm btn-outline-secondary">Voir Plus</a>
                            </div>
                            <small class="text-body-secondary">' . $DateAjout . '</small>
                        </div>
                    </div>
                </div>
            </div>';
    };

    echo '
          </div>
        </div>
      </div>
    
    </main>
    <script>
  function validerFormulaire() {
    var recherche = document.getElementById("inputRecherche").value;
    var dateDebut = document.getElementById("datedebut").value;
    var dateFin = document.getElementById("datefin").value;

    if (recherche === "" && dateDebut === "" && dateFin === "") {
      alert("Veuillez remplir au moins un champ avant de rechercher.");
      return false;
    }
    return true;
  }
</script>
    ';
    $this->footer();
  }
  public function afficherLogements($logements)
  {
    $this->header();
    echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';

    if (empty($logements)) {
      echo '<div class="col">
                  <p>Aucun logement trouvé.</p>
                </div>';
    } else {
      foreach ($logements as $logement) {
        $id_logement = $logement['id_logement'];
        $premiere_photo = $logement['premiere_photo'];
        $id_commercial = $logement['id_commercial'];
        $nom_logement = $logement['nom_logement'];
        $nombre_pieces = $logement['nombre_pieces'];
        $rue_logement = $logement['rue_logement'];
        $cp_logement = $logement['cp_logement'];
        $ville_logement = $logement['ville_logement'];
        $DateAjout = $logement['DateAjout'];

        echo '<div class="col">
                      <div class="card shadow-sm">
                          <img src="/images/' . ($premiere_photo ? $premiere_photo : 'placeholder.jpg') . '" class="bd-placeholder-img card-img-top" width="100%" height="225">
                          <div class="card-body">
                              <p class="card-text">' . $nom_logement . ' <br> ' . $rue_logement . ' <br>' . $ville_logement . '</p>
                              <div class="d-flex justify-content-between align-items-center">
                                  <div class="btn-group">
                                      <a href="location.php?id=' . $id_logement . '" class="btn btn-sm btn-outline-secondary">View</a>
                                      <a href="editlocation.php?id=' . $id_logement . '" class="btn btn-sm btn-outline-secondary">Edit</a>
                                  </div>
                                  <small class="text-body-secondary">' . $DateAjout . '</small>
                              </div>
                          </div>
                      </div>
                    </div>';
      }
    }

    echo '</div>';
  }

  public function afficherMessageSuccess($message)
  {
    echo '<div class="container">';
    echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
    echo '</div>';
  }

  public function afficherMessageErreur($message)
  {
    echo '<div class="container">';
    echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
    echo '</div>';
  }
  public function afficherMessageWarning($message)
  {
    echo '<div class="container">';
    echo '<div class="alert alert-warning" role="alert">' . $message . '</div>';
    echo '</div>';
  }

  public function afficherLoginSuccess($message)
  {
    echo '<div class="container">';
    echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
    echo '</div>';
  }

  public function afficherLoginError($message)
  {
    echo '<div class="container">';
    echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
    echo '</div>';
  }
  public function inscription($messageSuccess = null, $messageError = null, $messageWarning = null)
  {
    $this->header();

    echo '<div class="container">';

    if ($messageSuccess) {
      $this->afficherMessageSuccess($messageSuccess);
?>
      <script>
        setTimeout(function() {
          window.location.href = 'index.php?action=connexion';
        }, 1500);
      </script>
    <?php
    }
    if ($messageError) {
      $this->afficherMessageErreur($messageError);
    }
    if ($messageWarning) {
      $this->afficherMessageWarning($messageWarning);
    }

    echo '<div class="container d-flex align-items-center py-4 bg-body-tertiary">     
    <div class="form-signin w-100 m-auto">
  <form method="POST" action="index.php?action=inscription">
    <img class="mb-4" src="../assets/img/logoform.png"  alt="" width="100" height="100">
    <h1 class="h3 text-center mb-4">Inscription</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" name="login" placeholder="Login" required>
      <label for="floatingInput">Login</label>
    </div>
    <br>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
      <label for="floatingPassword">Password</label>
    </div>
    <br>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="password2" placeholder="Confirm" required>
      <label for="floatingPassword">Confirm password</label>
    </div>
    <br>
    <button class="btn btn-primary w-100 py-2" type="submit" name="inscription">S\'inscrire</button>
    <p class="mt-5 mb-3 text-body-secondary text-center">Déjà un compte ? <a href="index.php?action=connexion">Connectez-vous</a></p>
  </form>
</div>
';
  }

  public function connexion($messageSuccess = null, $messageError = null)
  {
    $this->header();
    echo '<div class="container">';

    if ($messageSuccess) {
      $this->afficherLoginSuccess($messageSuccess);
    ?>
      <script>
        setTimeout(function() {
          window.location.href = 'index.php?action=accueil';
        }, 1500);
      </script>
    <?php
    }
    if ($messageError) {
      $this->afficherLoginError($messageError);
    }

    echo '<div class="container d-flex align-items-center py-4 bg-body-tertiary">     
      <div class="form-signin w-100 m-auto">
    <form method="POST">
      <img class="mb-4" src="../assets/img/logoform.png"  alt="" width="100" height="100">
      <h1 class="h3 text-center mb-4">Connexion</h1>
  
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" name="login" placeholder="Login" required>
        <label for="floatingInput">Login</label>
      </div>
      <br>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
        <label for="floatingPassword">Password</label>
      </div>
      <br>
      <button class="btn btn-primary w-100 py-2" name="connexion" type="submit">Se connecter</button>
      <p class="mt-5 mb-3 text-body-secondary text-center">Pas inscrit ? <a href="index.php?action=inscription">Inscrivez-vous</a></p>
    </form>
  </div>
  </div>
  ';
    $this->footer();
  }

  public function rechercherLogement($logements = null,$logc = null,$pagi = null)
  {
    $this->header();
    //print_r($logements);
    echo '
    <form method="POST">
    <div class="container w-50 bg-light">
  <div class="row my-5">
    <div class="col-md-6">
      <label for="arrivee">Arrivée</label>
      <input type="date" class="form-control" id="arrivee" name="arrivee" value="'.$logc[0].'">
    </div>
    <div class="col-md-6">
      <label for="depart">Départ</label>
      <input type="date" class="form-control" id="depart" name="depart" value="'.$logc[1].'">
    </div>
    <div class="col-md-4">
      <label for="cp">Code Postal</label>
      <input type="text" class="form-control" id="cpostaleorville" name="cpostaleorville" value="'.$logc[2].'">
    </div>
    <div class="col-md-4">
      <label for="nomlogement">Nom Logement</label>
      <input type="text" class="form-control" id="nomLogement" name="nomLogement" value="'.$logc[3].'">
    </div>
    <div class="col-md-4">
      <label for="nbpieces">Nombre de pièces</label>
      <input type="text" class="form-control" id="nbpieces" name="nbpieces" value="'.$logc[4].'">
    </div>
    <div class="col-md-6">
      <label for="ruelogement">Rue</label>
      <input type="text" class="form-control" id="ruelogement" name="ruelogement" value="'.$logc[5].'">
    </div>
    <div class="col-md-6">
      <label for="villelogement">Ville</label>
      <input type="text" class="form-control" id="villelogement" name="villelogement" value="'.$logc[6].'">
    </div>
    <div class="col-12 text-center">
      <button class="btn btn-primary my-3" name="researchLogement" type="submit">Rechercher</button>
    </div>
  </div>
</div>
</form>
    <br><br><br>';

    echo '<div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5>Liste de Logements</h5>
          </div>
          <div class="card-body" style="overflow-y: scroll; max-height: 500px;">
          <ul class="list-group list-group-flush">';

    foreach ($logements as $logement) {
      echo '<div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="images/' . (empty($logement['premiere_photo']) ? 'placeholder.jpg' : $logement['premiere_photo']) . '" class="img-fluid rounded-start" style="max-width: 100%; max-height: 200px;" alt="Logement Image">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">' . substr($logement['nom_logement'], 0, 60) . '</h5>
                    <p class="card-text">' . $logement['ville_logement'] . '</p>
                    <p class="card-text">' . $logement['cp_logement'] . '</p>
                    <p class="card-text">' . $logement['nombre_pieces'] . ' pièces</p>
                    <a href="index.php?action=location&id=' . $logement['id_logement'] . '" class="btn btn-primary">Voir plus</a>
                </div>
            </div>
        </div>
    </div>';
    }

    echo '
          </div>
          </ul>
        </div>  
      </div>
      
      
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h5>Carte</h5>
          </div>
          <div class="card-body">
           
            <p>';
            if (!empty($logements)){
                echo '<div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q='.$logements[0]['ville_logement'].'+'.$logements[0]['cp_logement'].'+(immovc)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/population/">Calculate population in area</a></iframe></div>';
            } else {
                echo '<div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=bar-le-duc+55000+(immovc)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/population/">Calculate population in area</a></iframe></div>';
            }
            
            echo '</p>
          </div>
        </div>
      </div>
    </div>
    </div>';
    echo '<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center my-4">';
    if ($pagi[3] > 1) {
      echo '<li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">('.$pagi[3]-1 .') &laquo;</span>
              </a>
            </li>';
    }
    $debutAffichage = max(1, $pagi[3] - 1);
    $finAffichage = min($debutAffichage + 2, $pagi[2]);
    for ($i = $debutAffichage; $i <= $finAffichage; $i++) {
      echo '<li class="page-item"><a class="page-link" href="#">' . $i . '</a></li>';
    }
    if ($pagi[3] < $pagi[2]) {
      echo '<li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo; ('.$pagi[3]+1 .')</span>
              </a>
            </li>';
  }
  echo '</ul>
      </nav>


      <script>
      function garderNombres(texte) {
        return texte.replace(/\D/g, "");
      }
      document.addEventListener("DOMContentLoaded", () => {
        const paginationLinks = document.querySelectorAll(".page-link");
  
        paginationLinks.forEach(link => {
          link.addEventListener("click", event => {
            event.preventDefault();
  
            var page = event.target.textContent;
            page = garderNombres(page)

            const searchParams = new URLSearchParams(window.location.search);
            const params = {};
            for (const param of searchParams.entries()) {
              params[param[0]] = param[1];
            }
  

            params["page"] = page;
  

            const url = "index.php?" + new URLSearchParams(params).toString();
  
            window.location.href = url;
          });
        });
      });
    </script>

      ';

    $this->footer();
  }

  public function location($idlog = null, $prix = null, $photoLogementtrier = null, $infocom = null, $pieces = null, $equipements = null)
  {
    $this->header();

    echo '<div class="container">';
    echo '<style>
        .seller-info {
            text-align: right;
        }

        .seller-info img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }

        .property-info h2 {
            margin-top: 0;
        }
    </style>';

    echo '
    <div class="container mt-4">
    <h1>Détails du logement</h1>

    <div class="row">
        <div class="col-md-6">
            <div id="carouselExampleIndicators" class="carousel slide">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">';

    foreach ($photoLogementtrier as $photo) {
      $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/images/' . $photo['chemin_photo'];

      echo '<div class="carousel-item';
      echo ($photo === $photoLogementtrier[0]) ? ' active">' : '">';

      if (file_exists($imagePath)) {
        echo '<img src="/images/' . $photo['chemin_photo'] . '" class="d-block w-100" style="height:400px;" alt="photo">';
      } else {
        echo '<img src="/images/placeholder.jpg" class="d-block w-100" style="height:400px;" alt="placeholder">';
      }

      echo '</div>';
    }
    echo '</div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
        </div>
        <div class="col-md-6">
            <div class="seller-info mt-3">';
    if (empty($infocom["pp"])) {
      echo '<img src="/images/ppdefault.png" alt="Photo de profil">';
    } else {
      echo '<img src="/images/' . $infocom["pp"] . '" alt="Photo de profil">';
    }
    echo '
                <h3>' . $infocom["prenom_commercial"] . " " . $infocom["nom_commercial"] . '</h3>
                <p>Inscrit Depuis : ' . $infocom["DateAjoutDiff"] . '</p>
            </div>
            <a class="btn btn-primary btn-lg p-4 px-5 fs-2 text" style="margin-inline-start: 40%;margin-top: 10%;" href="index.php?action=process_paiement&log_id=' . $idlog['id_logement'] . '">Réserver</a>
        </div>
    </div>
    <div class="property-info mt-4">
        <h2>' . $idlog['nom_logement'] . '</h2>
        <p>' . $idlog['nb_pieces'] . ' pièces · ' . $idlog['rue_logement'] . ' · Code postal : ' . $idlog['cp_logement'] . ' · Ville : ' . $idlog['ville_logement'] . ' · ' . $idlog['DateAjoutDiff'] . '</p>
        <h3>' . $prix . '€/J Minimum<h3>
        
    </div>

    <div class="mt-4">
        <h3>Description du logement</h3>
        ';
    if (empty($idlog['DescriptionLogement'])) {
      echo '<p class="fs-6">Le logement n\'a pas de description</p>';
    } else {
      echo '<p class="fs-6">' . $idlog['DescriptionLogement'] . '</p>';
    }
    echo '
    </div>
    ';
    echo '
    <div class="row mt-4">
    <div class="col-md-6">
        <h3>Pièces</h3>
        <ul class="list-group">';
    foreach ($pieces as $piece) {
      echo '<li class="list-group-item">' . $piece['libelle_piece'] . ' - Surface : ' . $piece['surface'] . 'm²</li>';
    }
    echo '</ul>
    </div>
    ';
    if (count($equipements) > 0) {
      echo '<div class="col-md-6">
            <h3>Équipements</h3>
            <ul class="list-group">';
      foreach ($equipements as $equipement) {
        echo '<li class="list-group-item">' . $equipement['nom_equipement'] . '</li>';
      }

      echo '</ul><br></div>';
    } else {
      echo '<div class="col-md-6">
            <h3>Équipements</h3>
            <p>Ce logement n\'est pas meublé.</p>
          </div>';
    }
    echo '
</div>
<br>
';
    if (empty($idlog["rue_logement"]) || strtolower($idlog["rue_logement"]) == "nonedefault") {
      echo '<p>Ce logement n\'a pas de rue disponible donc il n\'y aura pas de map.</p>';
    } else {
      echo '

<div class="ratio ratio-16x9">
  <div style="width: 100%"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=' . urlencode($idlog["rue_logement"]) . ',' . urlencode($idlog["cp_logement"]) . ' ' . urlencode($idlog["ville_logement"]) . '+()&amp;t=k&amp;z=18&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a href="https://www.maps.ie/population/">Calculate population in area</a></iframe></div>
</div>


  ';
    }

    echo '
</div>
  ';

    $this->footer();
  }



  public function loginProprio($messageSuccess = null, $messageError = null)
  {
    echo '<html>
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link href="css/style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#712cf9">
    </head>
    <body class="bg-dark bg-gradient">';
    echo '<div class="container">';

    if ($messageSuccess) {
      $this->afficherLoginSuccess($messageSuccess);
    ?>
      <script>
        setTimeout(function() {
          window.location.href = 'index.php?action=accueil';
        }, 1500);
      </script>
    <?php
    }
    if ($messageError) {
      $this->afficherLoginError($messageError);
    }
    echo '<div class="position-absolute top-50 start-50 translate-middle">    
    <form method="POST">
      <img class="mb-4 " src="../assets/img/logoform.png"  alt="" width="100" height="100">
      <h1 class="h3 text-center text-light mb-4">Administrateur</h1>
  
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" name="loginProprio" placeholder="Login" required>
        <label for="floatingInput">Login</label>
      </div>
      <br>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" name="passwordProprio" placeholder="Password" required>
        <label for="floatingPassword">Password</label>
      </div>
      <br>
      <button class="btn btn-primary w-100 py-2" name="connexionProprio" type="submit">Se connecter</button>
    </form>
  </div> 
  </div>
  
  ';
  }

  public function signupProprio($messageSuccess = null, $messageError = null, $messageWarning = null)
  {
    echo '<html>
    <head>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link href="css/style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#712cf9">
    </head>
    <body class="bg-dark bg-gradient">';
    echo '<div class="container">';

    if ($messageSuccess) {
      $this->afficherMessageSuccess($messageSuccess);
    ?>
      <script>
        setTimeout(function() {
          window.location.href = 'index.php?action=loginProprio';
        }, 1500);
      </script>
    <?php
    }
    if ($messageError) {
      $this->afficherMessageErreur($messageError);
    }
    if ($messageWarning) {
      $this->afficherMessageWarning($messageWarning);
    }

    echo '<div class="position-absolute top-50 start-50 translate-middle">    
    <form method="POST">
      <img class="mb-4 " src="../assets/img/logoform.png"  alt="" width="100" height="100">
      <h1 class="h3 text-center text-light mb-4">Administrateur</h1>
  
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" name="pseudoProprio" placeholder="Login" required>
        <label for="floatingInput">Login</label>
      </div>
      <br>
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" name="nomProprio" placeholder="Nom" required>
        <label for="floatingInput">Nom</label>
      </div>
      <br>
      <div class="form-floating">
        <input type="text" class="form-control" id="floatingInput" name="prenomProprio" placeholder="Prénom" required>
        <label for="floatingInput">Prénom</label>
      </div>
      <br>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" name="mdpProprio" placeholder="Password" required>
        <label for="floatingPassword">Password</label>
      </div>
      <br>
      <div class="form-floating">
        <input type="password" class="form-control" id="floatingPassword" name="mdpProprio2" placeholder="Confirm" required>
        <label for="floatingPassword">Confirm password</label>
      </div>
      <br>
      <button class="btn btn-primary w-100 py-2" name="inscriptionProprio" type="submit">Inscrire</button>
    </form>
  </div> 
  ';
    $this->footer();
  }

  public function profil($infoClient = null, $infoCommercial = null)
  {
    $this->header();

    if (isset($_SESSION['connexion'])) {
      echo '
      <div class="container">
      <div class="card">
      <h1 class="card-header text-center">Client</h1>
      <div class="card-body">
        <label for="editLoginClient">Pseudo</label>
        <input class="form-control" id="editLogin" type="text" name="editLoginClient" placeholder="' . $infoClient['login_client'] . '" readonly>
        <br>
        <label for="editPasswordClient">Nouveau mot de passe</label>
        <input class="form-control" id="editPassword" type="password" name="editPasswordClient" placeholder="●●●●●●●●" readonly>
        <br>
        <label for="editPassword2Client">Confirmation</label>
        <input class="form-control" id="editPassword2" type="password" name="editPassword2Client" placeholder="●●●●●●●●" readonly>
        <br><br><br>
        <button onclick="retirerReadonlyProfil()" id="modifierButton" class="btn btn-secondary position-absolute bottom-0 end-0" style="margin-right : 20px; margin-bottom : 10px">Modifier</button>
        <button onclick="confirmButton()" id="confirmButton" class="btn btn-success" style="display : none;">Confirmer</button>
      </div>
    </div>';
    } elseif (isset($_SESSION['connexion_commercial'])) {
      echo '
      <div class="container">
      <div class="card">
      <h1 class="card-header text-center">Commercial</h1>
      <div class="card-body">
        <label for="editLoginCommercial">Pseudo</label>
        <input class="form-control" id="editLogin" type="text" name="editLoginCommercial" placeholder="' . $infoCommercial['login_commercial'] . '" readonly>
        <br>
        <label for="editPasswordCommercial">Nouveau mot de passe</label>
        <input class="form-control" id="editPassword" type="password" name="editPasswordCommercial" placeholder="●●●●●●●●" readonly>
        <br>
        <label for="editPassword2Commercial">Confirmation</label>
        <input class="form-control" id="editPassword2" type="password" name="editPasswordCommercial" placeholder="●●●●●●●●" readonly>
        <br><br><br>
        <button onclick="retirerReadonlyProfil()" id="modifierButton" class="btn btn-secondary position-absolute bottom-0 end-0" style="margin-right : 20px; margin-bottom : 10px">Modifier</button>
        <button onclick="confirmButton()" id="confirmButton" class="btn btn-success" style="display : none;">Confirmer</button>
      </div>
    </div>';
    }
    $this->footer();
    echo '<script src="js/script.js"></script>';
  }

  public function process_paiement($plageLog = null, $prix = null, $loginfo = null, $message = null)
  {
    $this->header();
    //print_r($loginfo);
    echo '
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>
    <main id="st1">
    <div class="container mt-5">';
    if (isset($message)) {
      echo '<div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">Erreur sur les informations de facturation</h4>
      <p>' . $message . '</p>
      <hr>
      <p class="mb-0">Vous devez refaire votre reservation</p>
    </div>';
    }
    echo '
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h2 class="my-3">Sélectionner vos dates de réservation</h2>
                <input type="text" id="dateRangePicker" class="form-control mb-4 text-center" placeholder="Sélectionnez une plage de dates">
                <h3 id="textinfores" class="my-3">Cette Reservation pour 0 jours vous coutera 0€</h3>
                <button id="saveButton" class="btn btn-primary btn-lg">Valider la réservation</button>
                <div id="priceDetails" class="card mt-5 start-50 translate-middle my-5" style="width: 18rem;top: 40px">
                    <div class="card-header">
                        Détails des prix
                    </div>
                    <ul id="priceSummary" class="list-group list-group-flush">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </main>

    <main id="st2">

    <div class="container my-5 w-50">

    <div class="row g-5">
      <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Votre Panier</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 id="nomlog" class="my-0">' . $loginfo["nom_logement"] . '</h6>
              <small class="text-body-secondary"></small>
            </div>
            <span id="totalprice" class="text-body-secondary">300€</span>
          </li>
          <div id="divpromo">
          </div>
          <li class="list-group-item d-flex justify-content-between">
            <span>Total (EUR)</span>
            <strong id="pricetxt">295€</strong>
          </li>
        </ul>

        <form class="card p-2">
          <div class="input-group">
            <input id="codeInputZone" type="text" class="form-control" placeholder="Promo code">
            <button onclick="verifCode()" id="CodePromoButton" type="button" class="btn btn-secondary">Utiliser</button>
          </div>
        </form>
      </div>
      <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Adresse de facturation</h4>
        <form method="POST">
          <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">Prénom</label>
              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required="">
              <div class="invalid-feedback">
                Un prénom valide est requis.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Nom de famille</label>
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required="">
              <div class="invalid-feedback">
                Un nom de famille valide est requis.
              </div>
            </div>


            <div class="col-12">
              <label for="email" class="form-label">E-mail</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Veuillez saisir une adresse électronique valide.
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Adresse</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required="">
              <div class="invalid-feedback">
                Veuillez indiquer votre adresse de livraison.
              </div>
            </div>


            <div class="col-md-5">
              <label for="country" class="form-label">Pays</label>
              <select class="form-select" id="country" name="country" required="">
                <option value="">Choisir...</option>
                <option>États-Unis</option>
                <option value="AF">Afghanistan</option>
                <option value="AX">Aland Islands</option>
                <option value="AL">Albania</option>
                <option value="DZ">Algeria</option>
                <option value="AS">American Samoa</option>
                <option value="AD">Andorra</option>
                <option value="AO">Angola</option>
                <option value="AI">Anguilla</option>
                <option value="AQ">Antarctica</option>
                <option value="AG">Antigua and Barbuda</option>
                <option value="AR">Argentina</option>
                <option value="AM">Armenia</option>
                <option value="AW">Aruba</option>
                <option value="AU">Australia</option>
                <option value="AT">Austria</option>
                <option value="AZ">Azerbaijan</option>
                <option value="BS">Bahamas</option>
                <option value="BH">Bahrain</option>
                <option value="BD">Bangladesh</option>
                <option value="BB">Barbados</option>
                <option value="BY">Belarus</option>
                <option value="BE">Belgium</option>
                <option value="BZ">Belize</option>
                <option value="BJ">Benin</option>
                <option value="BM">Bermuda</option>
                <option value="BT">Bhutan</option>
                <option value="BO">Bolivia</option>
                <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
                <option value="BA">Bosnia and Herzegovina</option>
                <option value="BW">Botswana</option>
                <option value="BV">Bouvet Island</option>
                <option value="BR">Brazil</option>
                <option value="IO">British Indian Ocean Territory</option>
                <option value="BN">Brunei Darussalam</option>
                <option value="BG">Bulgaria</option>
                <option value="BF">Burkina Faso</option>
                <option value="BI">Burundi</option>
                <option value="KH">Cambodia</option>
                <option value="CM">Cameroon</option>
                <option value="CA">Canada</option>
                <option value="CV">Cape Verde</option>
                <option value="KY">Cayman Islands</option>
                <option value="CF">Central African Republic</option>
                <option value="TD">Chad</option>
                <option value="CL">Chile</option>
                <option value="CN">China</option>
                <option value="CX">Christmas Island</option>
                <option value="CC">Cocos (Keeling) Islands</option>
                <option value="CO">Colombia</option>
                <option value="KM">Comoros</option>
                <option value="CG">Congo</option>
                <option value="CD">Congo, Democratic Republic of the Congo</option>
                <option value="CK">Cook Islands</option>
                <option value="CR">Costa Rica</option>
                <option value="CI">Cote D\'Ivoire</option>
                <option value="HR">Croatia</option>
                <option value="CU">Cuba</option>
                <option value="CW">Curacao</option>
                <option value="CY">Cyprus</option>
                <option value="CZ">Czech Republic</option>
                <option value="DK">Denmark</option>
                <option value="DJ">Djibouti</option>
                <option value="DM">Dominica</option>
                <option value="DO">Dominican Republic</option>
                <option value="EC">Ecuador</option>
                <option value="EG">Egypt</option>
                <option value="SV">El Salvador</option>
                <option value="GQ">Equatorial Guinea</option>
                <option value="ER">Eritrea</option>
                <option value="EE">Estonia</option>
                <option value="ET">Ethiopia</option>
                <option value="FK">Falkland Islands (Malvinas)</option>
                <option value="FO">Faroe Islands</option>
                <option value="FJ">Fiji</option>
                <option value="FI">Finland</option>
                <option value="FR">France</option>
                <option value="GF">French Guiana</option>
                <option value="PF">French Polynesia</option>
                <option value="TF">French Southern Territories</option>
                <option value="GA">Gabon</option>
                <option value="GM">Gambia</option>
                <option value="GE">Georgia</option>
                <option value="DE">Germany</option>
                <option value="GH">Ghana</option>
                <option value="GI">Gibraltar</option>
                <option value="GR">Greece</option>
                <option value="GL">Greenland</option>
                <option value="GD">Grenada</option>
                <option value="GP">Guadeloupe</option>
                <option value="GU">Guam</option>
                <option value="GT">Guatemala</option>
                <option value="GG">Guernsey</option>
                <option value="GN">Guinea</option>
                <option value="GW">Guinea-Bissau</option>
                <option value="GY">Guyana</option>
                <option value="HT">Haiti</option>
                <option value="HM">Heard Island and Mcdonald Islands</option>
                <option value="VA">Holy See (Vatican City State)</option>
                <option value="HN">Honduras</option>
                <option value="HK">Hong Kong</option>
                <option value="HU">Hungary</option>
                <option value="IS">Iceland</option>
                <option value="IN">India</option>
                <option value="ID">Indonesia</option>
                <option value="IR">Iran, Islamic Republic of</option>
                <option value="IQ">Iraq</option>
                <option value="IE">Ireland</option>
                <option value="IM">Isle of Man</option>
                <option value="IL">Israel</option>
                <option value="IT">Italy</option>
                <option value="JM">Jamaica</option>
                <option value="JP">Japan</option>
                <option value="JE">Jersey</option>
                <option value="JO">Jordan</option>
                <option value="KZ">Kazakhstan</option>
                <option value="KE">Kenya</option>
                <option value="KI">Kiribati</option>
                <option value="KP">Korea, Democratic People\'s Republic of</option>
                <option value="KR">Korea, Republic of</option>
                <option value="XK">Kosovo</option>
                <option value="KW">Kuwait</option>
                <option value="KG">Kyrgyzstan</option>
                <option value="LA">Lao People\'s Democratic Republic</option>
                <option value="LV">Latvia</option>
                <option value="LB">Lebanon</option>
                <option value="LS">Lesotho</option>
                <option value="LR">Liberia</option>
                <option value="LY">Libyan Arab Jamahiriya</option>
                <option value="LI">Liechtenstein</option>
                <option value="LT">Lithuania</option>
                <option value="LU">Luxembourg</option>
                <option value="MO">Macao</option>
                <option value="MK">Macedonia, the Former Yugoslav Republic of</option>
                <option value="MG">Madagascar</option>
                <option value="MW">Malawi</option>
                <option value="MY">Malaysia</option>
                <option value="MV">Maldives</option>
                <option value="ML">Mali</option>
                <option value="MT">Malta</option>
                <option value="MH">Marshall Islands</option>
                <option value="MQ">Martinique</option>
                <option value="MR">Mauritania</option>
                <option value="MU">Mauritius</option>
                <option value="YT">Mayotte</option>
                <option value="MX">Mexico</option>
                <option value="FM">Micronesia, Federated States of</option>
                <option value="MD">Moldova, Republic of</option>
                <option value="MC">Monaco</option>
                <option value="MN">Mongolia</option>
                <option value="ME">Montenegro</option>
                <option value="MS">Montserrat</option>
                <option value="MA">Morocco</option>
                <option value="MZ">Mozambique</option>
                <option value="MM">Myanmar</option>
                <option value="NA">Namibia</option>
                <option value="NR">Nauru</option>
                <option value="NP">Nepal</option>
                <option value="NL">Netherlands</option>
                <option value="AN">Netherlands Antilles</option>
                <option value="NC">New Caledonia</option>
                <option value="NZ">New Zealand</option>
                <option value="NI">Nicaragua</option>
                <option value="NE">Niger</option>
                <option value="NG">Nigeria</option>
                <option value="NU">Niue</option>
                <option value="NF">Norfolk Island</option>
                <option value="MP">Northern Mariana Islands</option>
                <option value="NO">Norway</option>
                <option value="OM">Oman</option>
                <option value="PK">Pakistan</option>
                <option value="PW">Palau</option>
                <option value="PS">Palestinian Territory, Occupied</option>
                <option value="PA">Panama</option>
                <option value="PG">Papua New Guinea</option>
                <option value="PY">Paraguay</option>
                <option value="PE">Peru</option>
                <option value="PH">Philippines</option>
                <option value="PN">Pitcairn</option>
                <option value="PL">Poland</option>
                <option value="PT">Portugal</option>
                <option value="PR">Puerto Rico</option>
                <option value="QA">Qatar</option>
                <option value="RE">Reunion</option>
                <option value="RO">Romania</option>
                <option value="RU">Russian Federation</option>
                <option value="RW">Rwanda</option>
                <option value="BL">Saint Barthelemy</option>
                <option value="SH">Saint Helena</option>
                <option value="KN">Saint Kitts and Nevis</option>
                <option value="LC">Saint Lucia</option>
                <option value="MF">Saint Martin</option>
                <option value="PM">Saint Pierre and Miquelon</option>
                <option value="VC">Saint Vincent and the Grenadines</option>
                <option value="WS">Samoa</option>
                <option value="SM">San Marino</option>
                <option value="ST">Sao Tome and Principe</option>
                <option value="SA">Saudi Arabia</option>
                <option value="SN">Senegal</option>
                <option value="RS">Serbia</option>
                <option value="CS">Serbia and Montenegro</option>
                <option value="SC">Seychelles</option>
                <option value="SL">Sierra Leone</option>
                <option value="SG">Singapore</option>
                <option value="SX">Sint Maarten</option>
                <option value="SK">Slovakia</option>
                <option value="SI">Slovenia</option>
                <option value="SB">Solomon Islands</option>
                <option value="SO">Somalia</option>
                <option value="ZA">South Africa</option>
                <option value="GS">South Georgia and the South Sandwich Islands</option>
                <option value="SS">South Sudan</option>
                <option value="ES">Spain</option>
                <option value="LK">Sri Lanka</option>
                <option value="SD">Sudan</option>
                <option value="SR">Suriname</option>
                <option value="SJ">Svalbard and Jan Mayen</option>
                <option value="SZ">Swaziland</option>
                <option value="SE">Sweden</option>
                <option value="CH">Switzerland</option>
                <option value="SY">Syrian Arab Republic</option>
                <option value="TW">Taiwan, Province of China</option>
                <option value="TJ">Tajikistan</option>
                <option value="TZ">Tanzania, United Republic of</option>
                <option value="TH">Thailand</option>
                <option value="TL">Timor-Leste</option>
                <option value="TG">Togo</option>
                <option value="TK">Tokelau</option>
                <option value="TO">Tonga</option>
                <option value="TT">Trinidad and Tobago</option>
                <option value="TN">Tunisia</option>
                <option value="TR">Turkey</option>
                <option value="TM">Turkmenistan</option>
                <option value="TC">Turks and Caicos Islands</option>
                <option value="TV">Tuvalu</option>
                <option value="UG">Uganda</option>
                <option value="UA">Ukraine</option>
                <option value="AE">United Arab Emirates</option>
                <option value="GB">United Kingdom</option>
                <option value="US">United States</option>
                <option value="UM">United States Minor Outlying Islands</option>
                <option value="UY">Uruguay</option>
                <option value="UZ">Uzbekistan</option>
                <option value="VU">Vanuatu</option>
                <option value="VE">Venezuela</option>
                <option value="VN">Viet Nam</option>
                <option value="VG">Virgin Islands, British</option>
                <option value="VI">Virgin Islands, U.s.</option>
                <option value="WF">Wallis and Futuna</option>
                <option value="EH">Western Sahara</option>
                <option value="YE">Yemen</option>
                <option value="ZM">Zambia</option>
                <option value="ZW">Zimbabwe</option>
              </select>
              <div class="invalid-feedback">
                Veuillez sélectionner un pays valide.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Code Postal</label>
              <input type="text" class="form-control" id="zip" name="zip" placeholder="" required="">
              <div class="invalid-feedback">
                Code postal requis.
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <input hidden type="text" class="form-control" id="idlogg" name="idlogg" placeholder="" required="" value="' . $loginfo['id_logement'] . '">
            <div class="invalid-feedback">
              Erreur sur le logement
            </div>
          </div>
          
          <div class="col-md-3">
            <input hidden type="text" class="form-control" id="datedeb" name="datedeb" placeholder="" value="">
            <div class="invalid-feedback">
              Erreur sur la date début
            </div>
          </div>

          <div class="col-md-3">
            <input hidden type="text" class="form-control" id="datefin" name="datefin" placeholder="" value="">
            <div class="invalid-feedback">
              Erreur sur la date fin
            </div>
          </div>

          <div class="col-md-3">
            <input hidden type="text" class="form-control" id="prixpay" name="prixpay" placeholder="" value="">
            <div class="invalid-feedback">
              Erreur prix
            </div>
          </div>

          <hr class="my-4">

          <div class="form-check">
            <input type="checkbox" class="form-check-input" name="confirmchbx" id="same-address">
            <label class="form-check-label" for="same-address">Confirmer les conditions d\'utilisation et les conditions de vente</label>
          </div>

          <hr class="my-4">

          <h4 class="mb-3">Paiement</h4>

          <div class="my-3">
            <div class="form-check">
              <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked="" required="">
              <label class="form-check-label" for="credit">Carte de crédit</label>
            </div>
            <div class="form-check">
              <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required="">
              <label class="form-check-label" for="paypal">PayPal</label>
            </div>
          </div>
          <div id="paytype">
          <div class="row gy-3">
            <div class="col-md-6">
              <label for="cc-name" class="form-label">Nom sur la carte</label>
              <input type="text" class="form-control" id="cc-name" placeholder="" required="">
              <small class="text-body-secondary">Nom complet tel qu\'il figure sur la carte</small>
              <div class="invalid-feedback">
                Le nom sur la carte est obligatoire
              </div>
            </div>

            <div class="col-md-6">
              <label for="cc-number" class="form-label">Numéro de carte de crédit</label>
              <input type="text" class="form-control" id="cc-number" placeholder="" required="">
              <div class="invalid-feedback">
                Le numéro de la carte de crédit est requis
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-expiration" class="form-label">Expiration</label>
              <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
              <div class="invalid-feedback">
                Date d\'expiration requise
              </div>
            </div>

            <div class="col-md-3">
              <label for="cc-cvv" class="form-label">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
              <div class="invalid-feedback">
                Code de sécurité requis
              </div>
            </div>

          </div>
          <div>

          <hr class="my-4">

          <!-- <button onclick="lanceverif()" class="w-100 btn btn-primary btn-lg" type="button">Poursuivre le paiement</button> -->
          <button name="okbtn" class="w-100 btn btn-primary btn-lg" type="submit">Poursuivre le paiement</button>
          </form>
        </div>
    </div>
</div>

</main>



    <script>
    document.getElementById("st1").style.display = "block";
    document.getElementById("st2").style.display = "none";
    let = varlog = ' . JSON_ENCODE($loginfo["id_logement"]) . ';
    const plageLog = ' . json_encode($plageLog) . ';
    let selectedDates = [];
    let startDate;
    let endDate;
    const minDate = plageLog.length > 0 ? plageLog[0] : "today";
    const dateRangePicker = flatpickr("#dateRangePicker", {
        mode: "range",
        minDate: minDate,
        dateFormat: "Y-m-d",
        disable: [
            function(date) {
                const formattedDate = date.toISOString().split("T")[0];
                return !plageLog.includes(formattedDate);
            }
        ],
        onChange: function(selectedDatesArray, dateStr, instance) {
            selectedDates = selectedDatesArray;
            updateTotalCost();
        }
    });

    function updateTotalCost() {
        const totalPriceElement = document.getElementById("textinfores");
        const priceSummaryElement = document.getElementById("priceSummary");
        if (selectedDates.length === 2) {
            startDate = selectedDates[0];
            endDate = selectedDates[1];
            const totalDays = Math.floor((Date.parse(endDate) - Date.parse(startDate)) / (24 * 60 * 60 * 1000)) + 1;
            const totalPrice = totalDays * ' . reset($prix) . ';
            totalPriceElement.textContent = `Cette réservation pour ${totalDays} jours vous coûtera ${totalPrice}€`;
            generatePriceSummary(startDate, endDate);
            document.getElementById("totalprice").innerText = totalPrice + "€";
            //document.getElementById("nomlog").innerText = nomlog;
            document.getElementById("pricetxt").innerText = totalPrice + "€";
            if(endDate == "" || endDate == null) {
              document.getElementById("datefin").value = startDate;
            }else{
              document.getElementById("datefin").value = endDate;
            }
            document.getElementById("datedeb").value = startDate;
        } else {
          
            totalPriceElement.textContent = "Cette Reservation pour x jours vous coutera xxx€";
            priceSummaryElement.innerHTML = "";
        }
    }

    function generatePriceSummary(startDate, endDate) {
      const priceSummaryElement = document.getElementById("priceSummary");
      const priceMap = ' . json_encode($prix) . ';
      let totalPrice = 0;

      let currentPrice = null;
      let currentDays = 0;

      for (let date = new Date(startDate); date <= new Date(endDate); date.setDate(date.getDate() + 1)) {
          const formattedDate = date.toISOString().split("T")[0];
          if (plageLog.includes(formattedDate)) {
              const price = priceMap[formattedDate];
              if (currentPrice === null) {
                  currentPrice = price;
                  currentDays = 1;
              } else if (currentPrice === price) {
                  currentDays++;
              } else {
                  const priceItem = `<li class="list-group-item">x${currentDays} jour(s) à ${currentPrice}€ la journée</li>`;
                  priceSummaryElement.innerHTML += priceItem;
                  totalPrice += currentPrice * currentDays;
                  currentPrice = price;
                  currentDays = 1;
              }
          }
      }

      if (currentPrice !== null) {
          const priceItem = `<li class="list-group-item">x${currentDays} jour(s) à ${currentPrice}€ la journée</li>`;
          priceSummaryElement.innerHTML += priceItem;
          totalPrice += currentPrice * currentDays;
      }

      priceSummaryElement.innerHTML += `<li class="list-group-item font-weight-bold">Total: ${totalPrice}€</li>`;
      document.getElementById("prixpay").value = totalPrice;
  }

    document.getElementById("saveButton").addEventListener("click", function() {
        if (selectedDates.length === 2) {
            const startDate = selectedDates[0].toISOString().split("T")[0];
            const endDate = selectedDates[1].toISOString().split("T")[0];
            if (plageLog.includes(startDate) && plageLog.includes(endDate)) {
                document.getElementById("st1").style.display = "none";
                document.getElementById("st2").style.display = "block";
            } else {
                alert("Veuillez sélectionner une plage de dates valide disponible.");
            }
        } else {
            alert("Veuillez sélectionner une plage de dates valide.");
        }
    });

    function verifCode(){
    
      var code = $("#codeInputZone").val();
      var logId = varlog;
      $.ajax({
        url: "model/apiajax.php",
        type: "GET",
        data: { code: code, LogId: logId },
        dataType: "json",
        success: function(response) {
            if(response.valid) {
                // Le code est valide
                //$("#result").text("Le code est valide. Type : " + response.type + ", Réduction : " + response.reduction);
                var htmlToInsert = `
                <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                <div class="text-success">
                  <h6 class="my-0">Promo code</h6>
                  <small>`+code+`</small>
                </div>`;
                if(response.type == 1){
                htmlToInsert += `<span class="text-success">−`+response.reduction+`€</span>`;
                }
                htmlToInsert += `
              </li>`;
              document.getElementById("divpromo").innerHTML = htmlToInsert;
              var prixText = $("#pricetxt").text();
              var montantActuel = parseFloat(prixText);
              var nouveauMontant = montantActuel - response.reduction;
              $("#pricetxt").text(nouveauMontant + "€");
            } else {
                //$("#result").text("Le code n\'est pas valide.");
                var htmlToInsert = `
                <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                <div class="text-danger">
                  <h6 class="my-0">Promo code</h6>
                  <small>code invalid</small>
                </div>`;
                htmlToInsert += `<span class="text-success">−0€</span>`;
                htmlToInsert += `
              </li>`;
              document.getElementById("divpromo").innerHTML = htmlToInsert;
            }
        },
        error: function() {
            console.log("Une erreur s\"est produite lors de la vérification du code.");
        }
    });

    }
    var messerr = "";
    $(document).ready(function() {
      $(\'input[name="paymentMethod"]\').change(function() {
        if ($(\'#paypal\').is(\':checked\')) {
          $(\'#paytype\').html(`<button id="paypalBtn" class="w-100 btn btn-primary btn-lg">Connexion à PayPal</button>`);
          $(\'#paytype\').on(\'click\', \'#paypalBtn\', function() {
            $(this).html(`<div class="spinner-border text-success" role="status"></div> Paiement par PayPal...`);
            setTimeout(function() {
              sd();
            }, 3000);
          });
        } else {
          document.getElementById("paytype").innerHTML = `<div class="row gy-3"><div class="col-md-6"><label for="cc-name" class="form-label">Nom sur la carte</label><input type="text" class="form-control" id="cc-name" placeholder="" required=""><small class="text-body-secondary">Nom complet tel qu\'il figure sur la carte</small><div class="invalid-feedback">Le nom sur la carte est obligatoire</div></div><div class="col-md-6"><label for="cc-number" class="form-label">Numéro de carte de crédit</label><input type="text" class="form-control" id="cc-number" placeholder="" required=""><div class="invalid-feedback">Le numéro de la carte de crédit est requis</div></div><div class="col-md-3"><label for="cc-expiration" class="form-label">Expiration</label><input type="text" class="form-control" id="cc-expiration" placeholder="" required=""><div class="invalid-feedback">Date d\'expiration requise</div></div><div class="col-md-3"><label for="cc-cvv" class="form-label">CVV</label><input type="text" class="form-control" id="cc-cvv" placeholder="" required=""><div class="invalid-feedback">Code de sécurité requis</div></div></div><hr class="my-4"><button class="w-100 btn btn-primary btn-lg">Poursuivre le paiement</button> `;
        }
      });
    });

    function lanceverif(){
    
      if ($(\'#paypal\').is(\':checked\')) {
        $(this).html(`<div class="spinner-border text-success" role="status"></div> Paiement par PayPal...`);
        setTimeout(function() {
          sd();
        }, 3000);
      } else {
        document.getElementById("paytype").innerHTML = `<div class="row gy-3"><div class="col-md-6"><label for="cc-name" class="form-label">Nom sur la carte</label><input type="text" class="form-control" id="cc-name" placeholder="" required=""><small class="text-body-secondary">Nom complet tel qu\'il figure sur la carte</small><div class="invalid-feedback">Le nom sur la carte est obligatoire</div></div><div class="col-md-6"><label for="cc-number" class="form-label">Numéro de carte de crédit</label><input type="text" class="form-control" id="cc-number" placeholder="" required=""><div class="invalid-feedback">Le numéro de la carte de crédit est requis</div></div><div class="col-md-3"><label for="cc-expiration" class="form-label">Expiration</label><input type="text" class="form-control" id="cc-expiration" placeholder="" required=""><div class="invalid-feedback">Date d\'expiration requise</div></div><div class="col-md-3"><label for="cc-cvv" class="form-label">CVV</label><input type="text" class="form-control" id="cc-cvv" placeholder="" required=""><div class="invalid-feedback">Code de sécurité requis</div></div></div><hr class="my-4"><button class="w-100 btn btn-primary btn-lg">Poursuivre le paiement</button> `;
      }

    }

    function sd(){
      var verificasuite = true;
      messerr = "";
      if(document.getElementById("firstName").value == ""){
        verificasuite = false;
        messerr += "Veuillez renseigner votre prénom.\n";
      }
      if (document.getElementById("lastName").value == "") {
      
        verificasuite = false;
        messerr += "Veuillez renseigner votre nom.\n";

      }

      if (document.getElementById("email").value == "" || !document.getElementById("email").value.includes("@") ||!document.getElementById("email").value.includes(".")) {
        verificasuite = false;
        messerr += "Veuillez renseigner un email valide.\n";
      }

      if (document.getElementById("country").value == "" || document.getElementById("country").value == "Choisir...") {
        verificasuite = false;
        messerr += "Veuillez renseigner votre pays.\n";

      }

      if (!document.getElementById("same-address").checked) {
        verificasuite = false;
        messerr += "Veuillez Confirmer les conditions d\'utilisation et les conditions de vente.\n";

      }
      if (!document.getElementById("zip").value == "") {
        verificasuite = false;
        messerr += "Veuillez Confirmer le code postal \n";

      }
      sd();
      if (verificasuite) {
      if (formulaire.checkValidity()) {
        formulaire.submit();
      } else {
        document.querySelector("#paytype").insertAdjacentHTML("beforeend",`<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Erreur dans le formulaire</div></div>`);
      }
    } else {
    
      document.querySelector("#paytype").insertAdjacentHTML("beforeend",`<div class="alert alert-danger d-flex align-items-center" role="alert"><svg class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg><div>Erreur dans le formulaire : \n`+ messerr +`</div></div>`);
    
    }
    }
    </script>
    ';
    $this->footer();
  }

  public function mesAnnonces($annonces)
  {
    $this->header();
    echo '<div class="col-lg-6 col-md-8 mx-auto">
    <h1 class="text-center mb-4">Mes annonces</h1>';
    echo '<div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';
    foreach ($annonces as $annonce) {
      $imagePath = isset($annonce['premiere_photo']) ? '/images/' . $annonce['premiere_photo'] : '/images/placeholder.jpg';
      echo '
            <div class="card">
                <img src="' . $imagePath . '" class="card-img-top" alt="..." width="300px" height="200px">
                <div class="card-body">
                    <h5 class="card-title">' . $annonce['nom_logement'] . '</h5>
                    <p class="card-text">' . $annonce['rue_logement'] . ' à ' . $annonce['ville_logement'] . ' - ' . $annonce['cp_logement'] . '</p>
                    <form method="post">
                    <a href="index.php?action=modifierAnnonce&id=' . $annonce['id_logement'] . ' ".><button type="button" class="btn btn-primary">Modifier</button></a>
                    <a href="index.php?action=modifierPeriodeLogement&id=' . $annonce['id_logement'] . ' ".><button type="button" class="btn btn-secondary">Gérer les périodes</button></a>
                    </form>
                </div>
            </div>';
    }
    echo '
    </div>
        </div>
    </div>';
    $this->footer();
  }

  public function modifierPeriodeLogement($plageLog = null,$periodecomp = null , $message = null , $typemessage = null)
  {
    $this->header();
    //print_r($_POST);
    echo '
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
      <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <form method="POST">
      <div class="container w-50 text-center">
      <h1 class="text-center mb-4">Ajouter Une Periode</h1>
      ';

      if($message && $typemessage == "success"){
        echo '<div class="alert alert-success" role="alert">'. $message. '</div>';
      }
      if($message && $typemessage == "danger"){
        echo '<div class="alert alert-danger" role="alert">'. $message. '</div>';
      }
      if($message && $typemessage == null){
        echo '<div class="alert alert-secondary" role="alert">'. $message. '</div>';
      }
      echo'
      <input type="text" id="dateRangePickerEdit" class="form-control mb-4 text-center" name="dateadd" placeholder="Sélectionnez une plage de dates">
      <input type="text" id="inputprixperiode" class="form-control mb-4 text-center" name="inputprixperiode" placeholder="donner un prix exemple 124.24">
      <input hidden type="text" id="inputidlog" class="form-control mb-4 text-center" name="inputidlog" placeholder="">
      <button type="submit" class="btn btn-primary justify-content-center" name="addNewPeriode">Ajouter une date</button>
      </div>
      </form>
  
      <script>
      const plageLog = ' . json_encode($plageLog) . ';
      let selectedDates = [];
      const dateRangePickerEdit = flatpickr("#dateRangePickerEdit", {
          mode: "range",
          minDate: "today",
          dateFormat: "Y-m-d",
          enable: [
              function(date) {
                  const formattedDate = date.toISOString().split("T")[0];
                  return !plageLog.includes(formattedDate);
              }
          ],
          onChange: function(selectedDatesArray, dateStr, instance) {
              selectedDates = selectedDatesArray;
              console.log(selectedDates);
          }
      });
      </script>
      <hr class="my-4">
      <div class="container">
      ';
      foreach ($periodecomp as $periode) {
        echo '
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Période du ' . $periode['date_debut'] . ' au ' . $periode['date_fin'] . '</h5>
                <p class="card-text">Prix de location : ' . ($periode['prix_location'] ?: 'Non défini') . '</p>
                <form method="POST">
                    <input type="hidden" name="id_periode" value="' . $periode['id_periode'] . '">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nouveau prix" name="nouveau_prix" step="0.01">
                        <button class="btn btn-warning" type="submit" name="modifierprixperiode">Modifier le prix</button>
                    </div>
                </form>
                <form method="POST">
                    <input type="hidden" name="id_periode" value="' . $periode['id_periode'] . '">
                    <button class="btn btn-danger" type="submit" name="supprimeperiode">Supprimer la période</button>
                </form>
            </div>
        </div>
        ';
    }
    $this->footer();
  }

  public function mesReservations($annonces, $message = null, $type = null)
  {
    $this->header();
    echo '<div class="col-lg-6 col-md-8 mx-auto">
    <h1 class="text-center mb-4">Mes réservations</h1>';
    if (isset($message) && $message != "") {
      if ($type != null && $type == "success") {
        echo '<div class="alert alert-success" role="alert">
        ' . $message . '
      </div>';
      } else if ($type == "danger") {
        echo '<div class="alert alert-danger" role="alert">
        ' . $message . '
      </div>';
      }
    }
    echo '<div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';
        foreach ($annonces as $annonce) {
          $imagePath = isset($annonce['premiere_photo']) ? '/images/' . $annonce['premiere_photo'] : '/images/placeholder.jpg';
      
          $statusText = '';
          $statusClass = '';
      
          if ($annonce["accept"] == 0) {
              $statusText = 'Non traité';
              $statusClass = 'text-secondary';
          } elseif ($annonce["accept"] == 1) {
              $statusText = 'Accepté';
              $statusClass = 'text-success';
          } elseif ($annonce["accept"] == 2) {
              $statusText = 'Refusé';
              $statusClass = 'text-danger';
          }
      
          echo '
              <div class="card">
                  <img src="' . $imagePath . '" class="card-img-top" alt="..." width="300px" height="200px">
                  <div class="card-body">
                      <h5 class="card-title">' . $annonce['nom_logement'] . '</h5>
                      <p class="card-text">' . $annonce['rue_logement'] . ' à ' . $annonce['ville_logement'] . ' - ' . $annonce['cp_logement'] . '</p>';
                    if (!$annonce["accept"] == 1 || !$annonce["accept"] == 2){
                    echo '<a href="index.php?action=mesReservations&delid=' . $annonce['id_reservation'] . '" class="btn btn-secondary">Annuler</a>';
                    }
                    echo '</div>
                  <div class="card-footer text-right ' . $statusClass . '">
                      ' . $statusText . '
                  </div>
              </div>
          ';
      }
    echo '
    </div>
        </div>
    </div>';
    $this->footer();
  }

  public function modifierAnnonce($infolog = null, $prix = null, $messageSuccess = null,  $messageError = null)
  {
    $this->header();
    echo '<div class="col-lg-6 col-md-8 mx-auto">
      <h1 class="text-center mb-4">Modifier mon annonce</h1>';
    if ($messageSuccess) {
      $this->modifierAnnonceMessageSuccess($messageSuccess);
    ?>
      <script>
        setTimeout(function() {
          window.history.back();
        }, 1000);
      </script>
<?php
    }
    if ($messageError) {
      $this->modifierAnnonceMessageError($messageError);
    }
    echo '<form method="POST" action="index.php?action=modifierAnnonce&id=' . $infolog['id_logement'] . ' ">
    <div class="container d-flex align-items-center py-4 bg-body-tertiary border">
      <div class="form-signin w-100 m-auto ">
      <h4 class="text-center mb-4">Logement</h4>
        <div class="form-floating">
        <input type="hidden" name="idForUpdate" value="' . $infolog['id_logement'] . '">
          <input type="text" class="form-control" id="modifName" name="modifName" placeholder="" value="' . $infolog['nom_logement'] . '">
          <label for="modifName">Nom</label>
        </div>
        <br>
        <div class="form-floating">
          <input type="text" class="form-control" id="modifRue" name="modifRue" placeholder="" value="' . $infolog['rue_logement'] . '">
          <label for="modifRue">Rue</label>
        </div>
        <br>
        <div class="form-floating">
          <input type="text" class="form-control" id="modifCP" name="modifCP" placeholder="" value="' . $infolog['cp_logement'] . '">
          <label for="modifCP">Code postal</label>
        </div>
        <br>
        <div class="form-floating">
          <input type="text" class="form-control" id="modifVille" name="modifVille" placeholder="" value="' . $infolog['ville_logement'] . '">
          <label for="modifVille">Ville</label>
        </div>
        <br>
        <div class="form-floating">
          <input type="text" class="form-control" id="modifNbPiece" name="modifNbPiece" placeholder="" value="' . $infolog['nb_pieces'] . '">
          <label for="modifNbPiece">Nombre de pièces</label>
        </div>
        <br>

          </div>
          </div>
          <br>
          <br>';

    echo '
        <input class="btn btn-primary w-100 py-2" type="submit" name="updateLogement" value="Modifier">
      </div>
      </form>';
    $this->footer();
  }

  public function modifierAnnonceMessageSuccess($message)
  {
    echo '<div class="alert alert-success" role="alert">' . $message . '</div>';
  }

  public function modifierAnnonceMessageError($message)
  {
    echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
  }


  public function confirmReservation($datedeb, $datefin, $jsondataclient, $ok, $infocom, $prixpay)
  {
    $this->header();
    $jsondataclient = json_decode($jsondataclient, true);
    echo '
    <div class="container">
        <div class="text-center mt-5">
            <img src="images/confirm480.png" class="img-thumbnail" alt="Logo confirmé">
            <h2 class="mt-3">Votre paiement a été confirmé</h2>
            <a href="index.php?action=mesReservations" class="btn btn-primary mt-4">Voir mes réservations</a>
        </div>
        
        <div class="mt-5 fw-bold">
            <h3>Récapitulatif de la réservation</h3>
            <p>Date de début : ' . $datedeb . '</p>
            <p>Date de fin : ' . $datefin . '</p>
            <p>Prix Payer : ' . $prixpay . '€</p>
            <hr class="my-4">
            <p>Logement : ' . $ok["nom_logement"] . ', nb pieces : ' . $ok["nb_pieces"] . ', rue_logement : ' . $ok["rue_logement"] . '</p>
            <p>code postal : ' . $ok["cp_logement"] . ', ville : ' . $ok["ville_logement"] . '</p>
            <hr class="my-4">
            <p>Votre Email : ' . $jsondataclient["email"] . '</p>
            <p>Votre nom , prénom : ' . $jsondataclient["lastName"] . ' ' . $jsondataclient["firstName"] . '</p>
        </div>
    </div>';
    $this->footer();
  }

  public function LesDemandes($demande = null, $message = null, $colormessage = null) {
    $this->header();
    echo '<div class="container">';
    if ($message !== null && $colormessage !== null) {
        echo '<div class="alert alert-' . $colormessage . '">' . $message . '</div>';
    }

    if (!empty($demande)) {
        foreach ($demande as $reservation) {
            $infoClient = json_decode($reservation['infoClient'], true);
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Réservation pour le logement #' . $reservation['id_logement'] . '</h5>';
            echo '<p class="card-text">Du ' . $reservation['date_debut_demande'] . ' au ' . $reservation['date_fin_demande'] . '</p>';
            echo '<p class="card-text">Nom : ' . $infoClient['firstName'] . ' ' . $infoClient['lastName'] . '</p>';
            echo '<p class="card-text">Email : ' . $infoClient['email'] . '</p>';
            echo '<p class="card-text">Adresse : ' . $infoClient['address'] . ', ' . $infoClient['zip'] . ' ' . $infoClient['country'] . '</p>';
            echo '<p class="card-text">Prix payé : ' . $reservation['prixpay'] . '</p>';
            echo '<form method="POST">';
            echo '<input type="hidden" name="reservation_id" value="' . $reservation['id_reservation'] . '">';

            echo '<button type="submit" class="btn btn-success" name="validationreservation">Accepter</button>';
            echo '<button type="submit" class="btn btn-danger" name="refuserreservation">Refuser</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>Aucune demande en attente pour le moment.</p>';
    }
    echo '</div>';
    $this->footer();
}

  

  public function seepolitique(){
    $this->header();

    echo '
    <div class="container">
    <h1>Politique de confidentialité</h1>
<p>Dernière mise à jour : 18 décembre 2023</p>
<p>La présente politique de confidentialité décrit nos politiques et procédures en matière de collecte, d\'utilisation et de divulgation de vos informations lorsque vous utilisez le service et vous informe de vos droits en matière de confidentialité et de la manière dont la loi vous protège.</p>
<p>Nous utilisons vos données personnelles pour fournir et améliorer le service. En utilisant le service, vous acceptez la collecte et l\'utilisation des informations conformément à la présente politique de confidentialité.</p>
<h2>Interprétation et définitions</h2>
<h3>Interpretation</h3>
<p>Les mots dont la lettre initiale est en majuscule ont des significations définies dans les conditions suivantes. Les définitions suivantes ont la même signification, qu\'elles apparaissent au singulier ou au pluriel.</p>
<h3>Définitions</h3>
<p>Aux fins de la présente politique de protection de la vie privée:</p>
<ul>
<li>
<p><strong>Compte</strong> désigne un compte unique créé pour vous afin d\'accéder à notre service ou à des parties de notre service.</p>
</li>
<li>
<p><strong>Affiliation</strong> désigne une entité qui contrôle, est contrôlée par ou est sous contrôle commun avec une partie, le terme "contrôle" désignant la propriété de 50 % ou plus des actions, participations ou autres titres donnant droit à un vote pour l\'élection des administrateurs ou d\'autres responsables de la gestion.</p>
</li>
<li>
<p><strong>Entreprise</strong> (d&eacute;nomm&eacute;e &quot;l\'entreprise&quot;, &quot;nous&quot;, &quot;notre&quot; ou &quot;nos&quot; dans le pr&eacute;sent accord) se r&eacute;f&egrave;re &agrave; realestate, bar le duc 55000.</p>
</li>
<li>
<p><strong>Cookies</strong> sont de petits fichiers placés sur votre ordinateur, votre appareil mobile ou tout autre appareil par un site web, contenant les détails de votre historique de navigation sur ce site web parmi ses nombreuses utilisations.</p>
</li>
<li>
<p><strong>Pays</strong> se réfère à :  la France</p>
</li>
<li>
<p><strong>Appareil</strong> désigne tout appareil pouvant accéder au Service, tel qu\'un ordinateur, un téléphone portable ou une tablette numérique.</p>
</li>
<li>
<p><strong>Données personnelles</strong> est toute information qui se rapporte à une personne identifiée ou identifiable.</p>
</li>
<li>
<p><strong>Service</strong> fait référence au site web.</p>
</li>
<li>
<p><strong>Prestataire de services</strong> désigne toute personne physique ou morale qui traite les données pour le compte de la Société. Il s\'agit de sociétés tierces ou de personnes employées par la société pour faciliter le service, pour fournir le service au nom de la société, pour fournir des services liés au service ou pour aider la société à analyser la manière dont le service est utilisé.</p>
</li>
<li>
<p><strong>Données d\'utilisation</strong> se réfère aux données collectées automatiquement, soit générées par l\'utilisation du service, soit provenant de l\'infrastructure du service elle-même (par exemple, la durée de la visite d\'une page).</p>
</li>
<li>
<p><strong>Site web</strong> se réfère à des biens immobiliers, accessibles à partir de <a href="immovc.axiz.io" rel="external nofollow noopener" target="_blank">immovc.axiz.io</a></p>
</li>
<li>
<p><strong>Vous</strong> désigne la personne qui accède au service ou l\'utilise, ou la société ou autre entité juridique au nom de laquelle cette personne accède au service ou l\'utilise, selon le cas.</p>
</li>
</ul>
<h2>Collecte et utilisation de vos données personnelles</h2>
<h3>Types de données collectées</h3>
<h4>Données personnelles</h4>
<p>Lors de l\'utilisation de notre service, nous pouvons vous demander de nous fournir certaines informations personnellement identifiables qui peuvent être utilisées pour vous contacter ou vous identifier. Les informations personnellement identifiables peuvent inclure, mais ne sont pas limitées à:</p>
<ul>
<li>
<p>Adresse e-mail</p>
</li>
<li>
<p>Prénom et nom de famille</p>
</li>
<li>
<p>Numéro de téléphone</p>
</li>
<li>
<p>Adresse, État, Province, Code postal, Ville</p>
</li>
<li>
<p>Données d\'utilisation</p>
</li>
</ul>
<h4>Données d\'utilisation</h4>
<p>Les données d\'utilisation sont collectées automatiquement lors de l\'utilisation du service.</p>
<p>Les données d\'utilisation peuvent inclure des informations telles que l\'adresse de protocole Internet de votre appareil (par exemple l\'adresse IP), le type de navigateur, la version du navigateur, les pages de notre service que vous visitez, l\'heure et la date de votre visite, le temps passé sur ces pages, les identifiants uniques de l\'appareil et d\'autres données de diagnostic.</p>
<p>Lorsque vous accédez au service par ou via un appareil mobile, nous pouvons collecter certaines informations automatiquement, y compris, mais sans s\'y limiter, le type d\'appareil mobile que vous utilisez, l\'identifiant unique de votre appareil mobile, l\'adresse IP de votre appareil mobile, votre système d\'exploitation mobile, le type de navigateur Internet mobile que vous utilisez, les identifiants uniques de l\'appareil et d\'autres données de diagnostic.</p>
<p>Nous pouvons également collecter des informations que votre navigateur envoie lorsque vous visitez notre service ou lorsque vous accédez au service par ou via un appareil mobile.</p>
<h4>Technologies de suivi et cookies</h4>
<p>Nous utilisons des cookies et des technologies de suivi similaires pour suivre l\'activité sur notre service et stocker certaines informations. Les technologies de suivi utilisées sont des balises, des tags et des scripts pour collecter et suivre les informations et pour améliorer et analyser notre service. Les technologies que nous utilisons peuvent inclure:</p>
<ul>
<li><strong>Cookies ou témoins de navigation.</strong> Un cookie est un petit fichier placé sur votre appareil. Vous pouvez configurer votre navigateur pour qu\'il refuse tous les cookies ou pour qu\'il vous indique quand un cookie est envoyé. Toutefois, si vous n\'acceptez pas les cookies, il se peut que vous ne puissiez pas utiliser certaines parties de notre service. À moins que vous n\'ayez ajusté les paramètres de votre navigateur pour qu\'il refuse les cookies, notre service peut utiliser des cookies.</li>
<li><strong>Balises web.</strong> Certaines sections de notre service et de nos courriels peuvent contenir de petits fichiers électroniques connus sous le nom de balises web (également appelées "clear gifs", "pixel tags" et "single-pixel gifs") qui permettent à l\'entreprise, par exemple, de compter les utilisateurs qui ont visité ces pages ou ouvert un courriel et d\'établir d\'autres statistiques liées au site web (par exemple, enregistrer la popularité d\'une certaine section et vérifier l\'intégrité du système et du serveur).</li>
</ul>
<p>Les cookies peuvent &ecirc;tre &quot;persistants&quot; ou &quot;de session&quot;. Les cookies persistants restent sur votre ordinateur personnel ou votre appareil mobile lorsque vous êtes hors ligne, tandis que les cookies de session sont supprimés dès que vous fermez votre navigateur web. Pour en savoir plus sur les cookies, consultez le site <a href="https://www.privacypolicies.com/blog/privacy-policy-template/#Use_Of_Cookies_Log_Files_And_Tracking" target="_blank">Site web des politiques de protection de la vie privée</a> article.</p>
<p>Nous utilisons des cookies de session et des cookies persistants aux fins décrites ci-dessous:</p>
<ul>
<li>
<p><strong>Cookies nécessaires / essentiels</strong></p>
<p>Type : Cookies de session</p>
<p>Administré par : Nous</p>
<p>Objectif : Ces cookies sont essentiels pour vous fournir les services disponibles sur le site web et vous permettre d\'utiliser certaines de ses fonctionnalités. Ils contribuent à l\'authentification des utilisateurs et à la prévention de l\'utilisation frauduleuse des comptes d\'utilisateurs. Sans ces cookies, les services que vous avez demandés ne peuvent pas être fournis, et nous n\'utilisons ces cookies que pour vous fournir ces services.</p>
</li>
<li>
<p><strong>Politique en matière de cookies / Avis Acceptation des cookies</strong></p>
<p>Type : Cookies persistants</p>
<p>Administré par : Nous</p>
<p>Objectif : ces cookies permettent de déterminer si les utilisateurs ont accepté l\'utilisation de cookies sur le site web.</p>
</li>
<li>
<p><strong>Cookies de fonctionnalité</strong></p>
<p>Type : Cookies persistants</p>
<p>Administré par : Nous</p>
<p>Objectif : Ces cookies nous permettent de nous souvenir des choix que vous faites lorsque vous utilisez le site web, par exemple de vos données de connexion ou de vos préférences linguistiques. L\'objectif de ces cookies est de vous offrir une expérience plus personnelle et de vous éviter d\'avoir à réintroduire vos préférences à chaque fois que vous utilisez le site web.</p>
</li>
</ul>
<p>Pour plus d\'informations sur les cookies que nous utilisons et sur les choix qui s\'offrent à vous en la matière, veuillez consulter notre Politique en matière de cookies ou la section Cookies de notre Politique de confidentialité.</p>
<h3>Utilisation de vos données personnelles</h3>
<p>La société peut utiliser les données à caractère personnel aux fins suivantes:</p>
<ul>
<li>
<p><strong>Fournir et maintenir notre service</strong>, y compris pour contrôler l\'utilisation de notre service.</p>
</li>
<li>
<p><strong>Pour gérer votre compte:</strong> pour gérer votre inscription en tant qu\'utilisateur du service. Les données personnelles que vous fournissez peuvent vous donner accès à différentes fonctionnalités du service qui sont disponibles pour vous en tant qu\'utilisateur enregistré.</p>
</li>
<li>
<p><strong>Pour l\'exécution d\'un contrat:</strong> le développement, la conformité et l\'exécution du contrat d\'achat des produits, articles ou services que vous avez achetés ou de tout autre contrat conclu avec nous par l\'intermédiaire du service.</p>
</li>
<li>
<p><strong>Pour vous contacter:</strong> Vous contacter par courrier électronique, appels téléphoniques, SMS ou autres formes équivalentes de communication électronique, telles que les notifications push d\'une application mobile concernant les mises à jour ou les communications informatives relatives aux fonctionnalités, produits ou services contractuels, y compris les mises à jour de sécurité, lorsque cela est nécessaire ou raisonnable pour leur mise en œuvre.</p>
</li>
<li>
<p><strong>Pour vous fournir</strong> des nouvelles, des offres spéciales et des informations générales sur d\'autres biens, services et événements que nous proposons et qui sont similaires à ceux que vous avez déjà achetés ou pour lesquels vous vous êtes renseigné, sauf si vous avez choisi de ne pas recevoir ces informations.</p>
</li>
<li>
<p><strong>Pour gérer vos demandes:</strong> pour répondre aux demandes que vous nous adressez et les gérer.</p>
</li>
<li>
<p><strong>Pour les transferts d\'entreprise:</strong> Nous pouvons utiliser vos informations pour évaluer ou conduire une fusion, une cession, une restructuration, une réorganisation, une dissolution ou toute autre vente ou transfert de tout ou partie de nos actifs, que ce soit en tant qu\'entreprise en activité ou dans le cadre d\'une faillite, d\'une liquidation ou d\'une procédure similaire, dans laquelle les données personnelles que nous détenons sur les utilisateurs de nos services font partie des actifs transférés.</p>
</li>
<li>
<p><strong>À d\'autres fins</strong>: Nous pouvons utiliser vos informations à d\'autres fins, telles que l\'analyse des données, l\'identification des tendances d\'utilisation, la détermination de l\'efficacité de nos campagnes promotionnelles et l\'évaluation et l\'amélioration de notre service, de nos produits, de nos services, de notre marketing et de votre expérience.</p>
</li>
</ul>
<p>Nous pouvons partager vos informations personnelles dans les situations suivantes:</p>
<ul>
<li><strong>Avec des Fournisseurs de Service :</strong> Nous pouvons partager vos informations personnelles avec des Fournisseurs de Service pour surveiller et analyser l\'utilisation de notre Service, pour vous contacter.</li>
<li><strong>Pour des transferts commerciaux :</strong> Nous pouvons partager ou transférer vos informations personnelles dans le cadre de, ou lors de négociations concernant, toute fusion, vente des actifs de la société, financement, ou acquisition de tout ou partie de notre entreprise par une autre société.</li>
<li><strong>Avec des Filiales :</strong> Nous pouvons partager vos informations avec nos affiliés, auquel cas nous exigerons que ces affiliés respectent cette Politique de Confidentialité. Les affiliés comprennent notre société mère et toute autre filiale, partenaires de coentreprise ou autres sociétés que nous contrôlons ou qui sont sous notre contrôle commun.</li>
<li><strong>Avec des partenaires commerciaux :</strong> Nous pouvons partager vos informations avec nos partenaires commerciaux pour vous proposer certains produits, services ou promotions.</li>
<li><strong>Avec d\'autres utilisateurs :</strong> lorsque vous partagez des informations personnelles ou interagissez autrement dans les zones publiques avec d\'autres utilisateurs, de telles informations peuvent être consultées par tous les utilisateurs et être diffusées publiquement.</li>
<li><strong>Avec Votre consentement :</strong> Nous pouvons divulguer vos informations personnelles à toute autre fin avec Votre consentement.</li>
</ul>
<h3>Conservation de Vos Données Personnelles</h3>
<p>La Société ne conservera Vos Données Personnelles que pendant la durée nécessaire aux fins énoncées dans cette Politique de Confidentialité. Nous conserverons et utiliserons également Vos Données Personnelles dans la mesure nécessaire pour nous conformer à nos obligations légales (par exemple, si nous sommes tenus de conserver Vos données pour nous conformer aux lois applicables), résoudre des litiges, et faire respecter nos accords et politiques juridiques.</p>
<p>La Société conservera également des Données d\'Utilisation à des fins d\'analyse interne. Les Données d\'Utilisation sont généralement conservées pour une période plus courte, sauf lorsque ces données sont utilisées pour renforcer la sécurité ou améliorer la fonctionnalité de Notre Service, ou lorsque Nous sommes légalement tenus de conserver ces données pour des périodes plus longues.</p>
<h3>Transfert de Vos Données Personnelles</h3>
<p>Vos informations, y compris les Données Personnelles, sont traitées dans les bureaux d\'exploitation de la Société et dans tout autre lieu où les parties impliquées dans le traitement sont situées. Cela signifie que ces informations peuvent être transférées vers — et conservées sur — des ordinateurs situés à l\'extérieur de Votre État, province, pays ou autre juridiction gouvernementale où les lois sur la protection des données peuvent différer de celles de Votre juridiction.</p>
<p>Votre consentement à cette Politique de Confidentialité suivi de Votre soumission de telles informations représente Votre accord à ce transfert.</p>
<p>La Société prendra toutes les mesures raisonnablement nécessaires pour s\'assurer que Vos données sont traitées de manière sécurisée et conformément à cette Politique de Confidentialité, et aucun transfert de Vos Données Personnelles ne sera effectué vers une organisation ou un pays à moins que des contrôles adéquats ne soient en place, y compris la sécurité de Vos données et autres informations personnelles.</p>
<h3>Suppression de Vos Données Personnelles</h3>
<p>Vous avez le droit de supprimer ou de demander que Nous vous aidions à supprimer les Données Personnelles que Nous avons collectées à Votre sujet.</p>
<p>Notre Service peut vous donner la possibilité de supprimer certaines informations vous concernant depuis le Service.</p>
<p>Vous pouvez mettre à jour, modifier ou supprimer Vos informations à tout moment en vous connectant à Votre Compte, si vous en avez un, et en visitant la section des paramètres du compte qui vous permet de gérer Vos informations personnelles. Vous pouvez également nous contacter pour demander l\'accès, la correction ou la suppression de toute information personnelle que Vous nous avez fournie.</p>
<p>Veuillez noter, cependant, que Nous pouvons avoir besoin de conserver certaines informations lorsque nous avons une obligation légale ou une base légale pour le faire.</p>
<h3>Divulgation de Vos Données Personnelles</h3>
<h4>Transactions commerciales</h4>
<p>Si la Société est impliquée dans une fusion, une acquisition ou une vente d\'actifs, Vos Données Personnelles peuvent être transférées. Nous vous fournirons un avis avant que Vos Données Personnelles ne soient transférées et ne deviennent sujettes à une Politique de Confidentialité différente.</p>
<h4>Application de la loi</h4>
<p>Dans certaines circonstances, la Société peut être tenue de divulguer Vos Données Personnelles si cela est requis par la loi ou en réponse à des demandes valides des autorités publiques (par exemple, un tribunal ou un organisme gouvernemental).</p>
<h4>Autres exigences légales</h4>
<p>La Société peut divulguer Vos Données Personnelles dans le but légitime de :</p>
<ul>
<li>Se conformer à une obligation légale</li>
<li>Protéger et défendre les droits ou les biens de la Société</li>
<li>Prévenir ou enquêter sur des comportements illégaux en lien avec le Service</li>
<li>Protéger la sécurité personnelle des Utilisateurs du Service ou du public</li>
<li>Se protéger contre une responsabilité légale</li>
</ul>
<h3>Sécurité de Vos Données Personnelles</h3>
<p>La sécurité de Vos Données Personnelles est importante pour Nous, mais rappelez-vous qu\'aucune méthode de transmission sur Internet ou de stockage électronique n\'est sécurisée à 100 %. Bien que Nous nous efforcions d\'utiliser des moyens commercialement acceptables pour protéger Vos Données Personnelles, Nous ne pouvons garantir leur sécurité absolue.</p>
<h2>Confidentialité des Enfants</h2>
<p>Notre Service ne s\'adresse à personne de moins de 13 ans. Nous ne collectons sciemment aucune information d\'identification personnelle auprès de quiconque de moins de 13 ans. Si Vous êtes un parent ou un tuteur et que Vous savez que Votre enfant Nous a fourni des Données Personnelles, veuillez Nous contacter. Si Nous apprenons que Nous avons collecté des Données Personnelles auprès de quiconque de moins de 13 ans sans vérification du consentement parental, Nous prendrons des mesures pour supprimer ces informations de Nos serveurs.</p>
<p>Si Nous devons nous appuyer sur le consentement comme base légale pour traiter Vos informations et que Votre pays exige le consentement d\'un parent, Nous pouvons exiger le consentement de Vos parents avant de collecter et d\'utiliser ces informations.</p>
<h2>Liens vers d\'Autres Sites Web</h2>
<p>Notre Service peut contenir des liens vers d\'autres sites web qui ne sont pas exploités par Nous. Si Vous cliquez sur un lien tiers, Vous serez dirigé vers le site de ce tiers. Nous Vous recommandons vivement de consulter la Politique de Confidentialité de chaque site que Vous visitez.</p>
<p>Nous n\'avons aucun contrôle sur le contenu, les politiques de confidentialité ou les pratiques des sites web tiers ou des services.</p>
<h2>Changements à cette Politique de Confidentialité</h2>
<p>Nous pouvons mettre à jour Notre Politique de Confidentialité de temps à autre. Nous Vous informerons de tout changement en publiant la nouvelle Politique de Confidentialité sur cette page.</p>
<p>Nous Vous informerons également par e-mail et/ou par un avis visible sur Notre Service, avant que le changement ne devienne effectif et en mettant à jour la date de "Dernière mise à jour" en haut de cette Politique de Confidentialité.</p>
<p>Il est recommandé de consulter périodiquement cette Politique de Confidentialité pour prendre connaissance de tout changement. Les changements apportés à cette Politique de Confidentialité sont effectifs lorsqu\'ils sont publiés sur cette page.</p>
<h2>Contactez-Nous</h2>
<p>Si vous avez des questions concernant cette Politique de Confidentialité, Vous pouvez Nous contacter :</p>
<ul>
<li>Par e-mail : realestate@axiz.io</li>
</ul>
</div>
    
    ';


    $this->footer();
  }


  public function deconnexion()
  {
    if (isset($_SESSION["connexion"])) {
      unset($_SESSION["connexion"]);
    }
    if (isset($_SESSION["connexion_commercial"])) {
      unset($_SESSION["connexion_commercial"]);
    }
  }
}
?>