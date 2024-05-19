<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Barre de Recherche</title>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <label for="destination">Destination</label>
                        <input type="text" class="form-control" name="destination" id="destination" placeholder="Destination" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="arrivee">Arrivée</label>
                        <input type="date" class="form-control" id="arrivee" name="arrivee">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="depart">Départ</label>
                        <input type="date" class="form-control" id="depart" name="depart">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="personnes">Nom</label>
                        <input type="text" class="form-control" name="nomlogement" id="nomlogement" placeholder="Nom du logement">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="personnes">cPostal</label>
                        <input type="text" class="form-control" name="codepostal" id="codepostal" placeholder="code Postal">
                    </div>
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                 </div>
            </form>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6" style="height: 500px; overflow-y: auto;">
            <div class="card mb-3" onclick="centerMap('Logement 1', 48.8566, 2.3522)">
                <img src="monlogement.jpg" class="card-img-top">
                    <h5 class="card-title">Logement 1</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p><b>1 rue de la brigade criminelle</b></p>
                    <p><b>55000 Bar-le-Duc</b></p>
                    <p>Nombre de pièces : 5</p>
            </div>
            <div class="card mb-3" onclick="centerMap('Logement 2', 48.8566, 2.3522)">
                <img src="contemporaine.jpg" class="card-img-top">
                   <h5 class="card-title">Logement 2</h5>
                   <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                   <p><b>1 rue de la brigade criminelle</b></p>
                    <p><b>55000 Bar-le-Duc</b></p>
                    <p>Nombre de pièces : 5</p>
            </div>
            <div class="card mb-3" onclick="centerMap('Logement 3', 48.8566, 2.3522)">
                <img src="contemporaine.jpg" class="card-img-top">
                <h5 class="card-title">Logement 3</h5>
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <p><b>1 rue de la brigade criminelle</b></p>
                 <p><b>55000 Bar-le-Duc</b></p>
                 <p>Nombre de pièces : 5</p>
            </div>
            <div class="card mb-3" onclick="centerMap('Logement 4', 48.8566, 2.3522)">
                <img src="contemporaine.jpg" class="card-img-top">
                   <h5 class="card-title">Logement 4</h5>
                   <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                   <p><b>1 rue de la brigade criminelle</b></p>
                    <p><b>55000 Bar-le-Duc</b></p>
                    <p>Nombre de pièces : 5</p>
            </div>
            <div class="card mb-3" onclick="centerMap('Logement 5', 48.8566, 2.3522)">
                <img src="contemporaine.jpg" class="card-img-top">
                   <h5 class="card-title">Logement 5</h5>
                   <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                   <p><b>1 rue de la brigade criminelle</b></p>
                    <p><b>55000 Bar-le-Duc</b></p>
                    <p>Nombre de pièces : 5</p>
            </div>
        </div>
        <div class="col-md-6">
            <h2>Map</h2>
            <div id="map" style="height: 50%;"></div>
        </div>
    </div>
 </div>


 <div class="container mt-5">
    <ul class="pagination justify-content-center">
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Suivant</a>
        </li>
    </ul>
</div>

 

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>



<script>
    
    var map = L.map('map').setView([48.8566, 2.3522], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    function centerMap(nomLogement, lat, lon) {
        map.setView([lat, lon], 12);
    }
</script>

</body>
</html>
