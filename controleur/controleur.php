<?php
class controleur
{
    public function accueil()
    {
        $log = (new logements)->GetLogementMain(1);
        (new view)->accueil($log);
    }

    public function erreur404()
    {
        (new view)->error404();
    }

    public function erreur403()
    {
        (new view)->error403();
    }

    public function connexion()
    {
        if (isset($_POST["connexion"])) {
            $login = htmlspecialchars($_POST["login"]);
            $password = htmlspecialchars($_POST["password"]);

            if ((new client)->connexion($login, $password)) {
                (new view)->connexion("Vous êtes bien connecté !");
                if (isset($_SESSION['connexion_commercial'])) {
                    unset($_SESSION['connexion_commercial']);
                }
                $_SESSION["loginClient"] = $login;
                exit();
            } else {
                (new view)->connexion(null, "Les identifiants ne sont pas bons !");
            }
        } else {
            (new view)->connexion();
        }
    }



    public function inscription()
    {
        if (isset($_POST["inscription"])) {
            $login = htmlspecialchars($_POST["login"]);
            $password = $_POST["password"];
            $password2 = $_POST["password2"];
            if (strlen($password) >= 12) { //mdp supérieur à 12 lettres
                if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#@$!%^*?&])[A-Za-z\d#@$!%^*?&]{12,}$/', $password)) { //mdp regex
                    if ($password == $password2) {
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        if (!(new client)->estDejaInscrit($login)) {
                            $inscription = (new client)->inscrireClient($login, $password);
                            if ($inscription) {
                                (new view)->inscription("Inscription réussie ! Vous allez être redirigé");
                            } else {
                                (new view)->inscription(null, "Erreur lors de la tentative d'inscription !");
                            }
                        } else {
                            (new view)->inscription(null, null, "Ce login est déjà prit !");
                        }
                    } else {
                        (new view)->inscription(null, "Les mots de passes ne se correspondent pas !");
                    }
                } else {
                    (new view)->inscription(null, "<b>Le mot de passe doit contenir au minimum:</b><br> - 12 caractères<br> - 1 majuscule <br> - 1 minuscule <br> - 1 caractère spécial");
                }
            } else {
                (new view)->inscription(null, "Le mot de passe doit contenir au minimum 12 caractères");
            }
            exit;
        } else {
            (new view)->inscription();
        }
    }


    public function loginProprio()
    {
        if (isset($_POST["connexionProprio"])) {
            $login = htmlspecialchars($_POST["loginProprio"]);
            $password = $_POST["passwordProprio"];

            if ((new commercial)->connexion($login, $password)) {
                (new view)->loginProprio("Vous êtes bien connecté !");
                if (isset($_SESSION['connexion'])) {
                    unset($_SESSION['connexion']);
                }
                $_SESSION["loginProprio"] = $login;
                exit();
            } else {
                (new view)->loginProprio(null, "Les identifiants sont pas bons !");
            }
        } else {
            (new view)->loginProprio();
        }
    }
    public function signupProprio()
    {
        if (isset($_POST["inscriptionProprio"])) {
            $login = htmlspecialchars($_POST["pseudoProprio"]);
            $password = $_POST["mdpProprio"];
            $password2 = $_POST["mdpProprio2"];
            $nom = htmlspecialchars($_POST["nomProprio"]);
            $prenom = htmlspecialchars($_POST["prenomProprio"]);
            if (strlen($password) >= 12) { //mdp supérieur à 12 lettres
                if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#@$!%^*?&])[A-Za-z\d#@$!%^*?&]{12,}$/', $password)) { //mdp regex
                    if ($password == $password2) {
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        if (!(new commercial)->estDejaInscrit($login)) {
                            $inscription = (new commercial)->inscrireCommercial($login, $nom, $prenom, $password);
                            if ($inscription) {
                                (new view)->signupProprio("Inscription réussie ! Vous allez être redirigé");
                            } else {
                                (new view)->signupProprio(null, "Erreur lors de la tentative d'inscription !");
                            }
                        } else {
                            (new view)->signupProprio(null, null, "Ce login est déjà prit !");
                        }
                    } else {
                        (new view)->signupProprio(null, "Les mots de passes ne se correspondent pas !");
                    }
                } else {
                    (new view)->signupProprio(null, "<b>Le mot de passe doit contenir au minimum:</b><br> - 12 caractères<br> - 1 majuscule <br> - 1 minuscule <br> - 1 caractère spécial");
                }
            } else {
                (new view)->signupProprio(null, "Le mot de passe doit contenir au minimum 12 caractères");
            }
            exit;
        } else {
            (new view)->signupProprio();
        }
    }

    public function profil()
    {
        if (isset($_SESSION['connexion']) || isset($_SESSION['connexion_commercial'])) {
            if (!empty($_SESSION['connexion'])) {
                $infoClient = (new client)->getInfosClient($_SESSION['connexion']);
                (new view)->profil($infoClient);
            } else if (!empty($_SESSION['connexion_commercial'])) {
                $infoCommercial = (new commercial)->getInfosCommercial($_SESSION['connexion_commercial']);
                (new view)->profil(null, $infoCommercial);
            }
        } else {
            $this->erreur404();
        }
    }
    public function deconnexion()
    {
        (new view)->deconnexion();
        if (!isset($_SESSION['connexion']) && !isset($_SESSION['connexion_commercial'])) {
            header('Location: index.php');
        }
    }

    public function rechercherLogement()
    {
            $dateDebut = !empty($_POST['datedebut']) ? $_POST['datedebut'] : null;
            $dateFin = !empty($_POST['datefin']) ? $_POST['datefin'] : null;
            $codePostal = !empty($_POST['cpostaleorville']) ? $_POST['cpostaleorville'] : null;
            $nomlogement = !empty($_POST['nomLogement']) ? $_POST['nomLogement'] : null;
            $nb_pieces = !empty($_POST['nbpieces']) ? $_POST['nbpieces'] : null;
            $rue_logement = !empty($_POST['ruelogement']) ? $_POST['ruelogement'] : null;
            $ville_logement = !empty($_POST['villelogement']) ? $_POST['villelogement'] : null;
            $page = !empty($_GET['page']) ? $_GET['page'] : 1;
            $logc = array();
            $totalLogements = (new logements)->rechercherLogementDisponible2Count($dateDebut, $dateFin, $codePostal,$nomlogement,$nb_pieces,$rue_logement,$ville_logement,$page);
            $limitParPage = 10;
            $nombrePages = ceil($totalLogements / $limitParPage);
            if ($page > $nombrePages && $nombrePages > 0) {
                $page = $nombrePages;
            }
            $pagi = array();
            array_push($pagi, $totalLogements);
            array_push($pagi, $limitParPage);
            array_push($pagi, $nombrePages);
            array_push($pagi, $page);

            array_push($logc, $dateDebut);
            array_push($logc, $dateFin);
            array_push($logc, $codePostal !== null ? $codePostal : '');
            array_push($logc, $nomlogement !== null ? $nomlogement : '');
            array_push($logc, $nb_pieces !== null ? $nb_pieces : '');
            array_push($logc, $rue_logement !== null ? $rue_logement : '');
            array_push($logc, $ville_logement !== null ? $ville_logement : '');
            array_push($logc, $page);
            //print_r(logc);
            $logements = (new logements)->rechercherLogementDisponible2($dateDebut, $dateFin, $codePostal,$nomlogement,$nb_pieces,$rue_logement,$ville_logement,$page);
            (new view)->rechercherLogement($logements,$logc,$pagi);
    }

    public function location()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $ok = (new logements)->getInfosLogement($id);
            $prix = (new logementPeriode)->infoLogementPeriode($id);
            $photoLogementtrier = (new photos)->getAllLogementPhotos($id);
            $infocom = (new commercial)->getInfosCommercialFromLogement($id);
            $pieces = (new piece)->getInfosPiece($id);
            $equipements = (new equipement)->getEquipementsByLogement($id);
            if (empty($ok) || empty($prix)) {
                $this->erreur404();
            } else {
                (new view)->location($ok, $prix, $photoLogementtrier, $infocom, $pieces, $equipements);
            }
        } else {
            $this->erreur404();
        }
    }

    public function validateClientInfo($clientInfo)
    {

        $clientInfo = json_decode($clientInfo, true);
        if (
            isset($clientInfo['firstName']) &&
            isset($clientInfo['lastName']) &&
            isset($clientInfo['email']) &&
            isset($clientInfo['address']) &&
            isset($clientInfo['country']) &&
            isset($clientInfo['zip'])
        ) {
            $validations = [
                'firstName' => '/^[A-Za-z\s]+$/',
                'lastName' => '/^[A-Za-z\s]+$/',
                'email' => '/^\S+@\S+\.\S+$/',
                'address' => '/^[0-9A-Za-z\s]+$/',
                'country' => '/^[A-Za-z]+$/',
                'zip' => '/^\d{1,10}$/'
            ];

            foreach ($validations as $field => $pattern) {
                if (!preg_match($pattern, $clientInfo[$field])) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }

    public function seepolitique(){
        (new view)->seepolitique();
    }

    public function process_paiement($idlog)
    {
        if (isset($_POST["idlogg"]) && isset($_POST["datedeb"])) {
            if ($_POST["datefin"] == "" || $_POST["datefin"] == null) {
                $newdatefin = $_POST["datedeb"];
            } else {
                $newdatefin = $_POST["datefin"];
            }
            $postData = [
                'firstName' => $_POST['firstName'],
                'lastName' => $_POST['lastName'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'country' => $_POST['country'],
                'zip' => $_POST['zip']
            ];
            $jsonData = json_encode($postData);
            if ($this->validateClientInfo($jsonData)) {
                if (isset($_SESSION['connexion'])){
                    $dateDebut = $_POST["datedeb"];
                    $dateFin = $_POST["datefin"];
                    $dateDebutObj = date_create_from_format('D M d Y H:i:s e+', $dateDebut);
                    $dateFinObj = date_create_from_format('D M d Y H:i:s e+', $dateFin);
                    if ($dateDebutObj && $dateFinObj) {
                        $dateDebutFormatee = $dateDebutObj->format('Y-m-d');
                        $dateFinFormatee = $dateFinObj->format('Y-m-d');
                    
                        //echo $dateDebutFormatee . "\n";
                        //echo $dateFinFormatee . "\n";
                    } else {
                        echo "Format de date invalide.\n";
                    }



                    (new reservation)->ajouterReservation($_SESSION['connexion'], $_POST["idlogg"], $dateDebutFormatee, $dateFinFormatee , $jsonData,$_POST["prixpay"] );
                    $ok = (new logements)->getInfosLogement($_POST["idlogg"]);
                    $infocom = (new commercial)->getInfosCommercialFromLogement($_POST["idlogg"]);
                    (new view)->confirmReservation($dateDebutFormatee, $dateFinFormatee, $jsonData, $ok, $infocom, $_POST["prixpay"]);
                } else {
                    $this->erreur403();
                }
            } else {
                $plageReservation = (new reservation)->GetReservationDisponible($idlog);
                $prix = (new reservation)->GetPrixParJour($idlog);
                $loginfo = (new logements)->getInfosLogement($idlog);
                $messagetosend = "Vos informations ne sont pas correcte ou non conforme votre prénom , nom ne doit pas contenir de nombre , votre email doit être confirme comme votre address et votre pays et le code postal ne doit contenir que des nombres";
                (new view)->process_paiement($plageReservation, $prix, $loginfo, $messagetosend);
            }
        } else {
            if (!isset($_SESSION['connexion'])){
                $this->erreur403();
            } else {
                $plageReservation = (new reservation)->GetReservationDisponible($idlog);
                array_shift($plageReservation);
                array_pop($plageReservation);
                $prix = (new reservation)->GetPrixParJour($idlog);
                $loginfo = (new logements)->getInfosLogement($idlog);
                (new view)->process_paiement($plageReservation, $prix, $loginfo);
            }
        }
    }

    public function mesAnnonces()
    {

        if (isset($_SESSION['connexion_commercial'])) {
            $id_comm = $_SESSION['connexion_commercial'];
            $mesAnnonces = (new logements)->afficherMesLogements($id_comm);
            (new view)->mesAnnonces($mesAnnonces);
        } elseif (!isset($_SESSION['connexion_commercial'])) {
            $this->erreur403();
        }
    }
    public function modifierLogementAnnonce()
    {

        if (isset($_SESSION['connexion_commercial'])) {
            $id_comm = $_SESSION['connexion_commercial'];
            $mesAnnonces = (new logements)->afficherMesLogements($id_comm);
            (new view)->mesAnnonces($mesAnnonces);
        } elseif (!isset($_SESSION['connexion_commercial'])) {
            $this->erreur403();
        }
    }

    public function mesReservations()
    {

        if (isset($_SESSION['connexion'])) {
            $id = $_SESSION['connexion'];
            if (isset($_GET["delid"]) && $_SESSION['connexion']){
                $ress = (new reservation)->deleteReservation($_GET["delid"],$_SESSION['connexion']);
                $type = "success";
                if ($ress == true){
                    $message = "La reservation " . $_GET["delid"] . " à biens été supprimer";

                } else {
                    $message = "La reservation " . $_GET["delid"] . " n'existe pas ou ne vous appartient pas";
                    $type = "danger";
                }
                $mesReservations = (new reservation)->afficherReservationClient($id);
                (new view)->mesReservations($mesReservations,$message,$type);
            } else {
                $mesReservations = (new reservation)->afficherReservationClient($id);
                (new view)->mesReservations($mesReservations);
            }
        } else if (!isset($_SESSION['connexion'])) {
            $this->erreur403();
        }
    }

    public function LesDemandes(){
        if (isset($_SESSION['connexion_commercial'])){
            if (isset($_POST) && isset($_POST["refuserreservation"]) && isset($_POST["reservation_id"])){
                (new reservation)->updateReservationStatus($_POST["reservation_id"],2);
                $demande = (new reservation)->getPendingReservationsByCommercial($_SESSION['connexion_commercial']);
                if (!empty($demande)) {
                    (new view)->LesDemandes($demande,"la demande à biens était refusé","success");
                } else {
                    (new view)->LesDemandes($demande,"la demande à biens était refusé , vous n'avez plus de demande actuellement","success");
                }
            } else if (isset($_POST) && isset($_POST["validationreservation"]) && isset($_POST["reservation_id"])){
                (new reservation)->updateReservationStatus($_POST["reservation_id"],1);
                $demande = (new reservation)->getPendingReservationsByCommercial($_SESSION['connexion_commercial']);
                if (!empty($demande)) {
                    (new view)->LesDemandes($demande,"la demande à biens était accepté","success");
                } else {
                    (new view)->LesDemandes($demande,"la demande à biens était accepté , vous n'avez plus de demande actuellement","success");
                }
            } else {
                $demande = (new reservation)->getPendingReservationsByCommercial($_SESSION['connexion_commercial']);
                if (!empty($demande)) {
                    (new view)->LesDemandes($demande);
                } else {
                    (new view)->LesDemandes($demande,"Vous n'avez aucune demande pour vos logement","warning");
                }
            }
        } else {
            $this->erreur403();
        }
    }


    public function modifierAnnonce()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $loginfo = (new logements)->getInfosLogement($id);
            $prix = (new logementPeriode)->getPrix($loginfo['id_logement']);
            if (isset($_SESSION['connexion_commercial']) != $loginfo['id_commercial']) {
                $this->erreur403();
            } else {
                if (isset($_POST['updateLogement'])) {
                    if (!empty($_POST['modifName']) && !empty($_POST['modifRue']) && !empty($_POST['modifCP']) && !empty($_POST['modifVille']) && !empty($_POST['modifNbPiece'])) {
                        $idupdate = $_POST['idForUpdate'];
                        $name = $_POST['modifName'];
                        $rue = $_POST['modifRue'];
                        $cp = $_POST['modifCP'];
                        $ville = $_POST['modifVille'];
                        $nbpiece = $_POST['modifNbPiece'];
                        (new logements)->updateLogementComm($idupdate, $name, $rue, $cp, $ville, $nbpiece);
                        (new view)->modifierAnnonce($loginfo, $prix, "Le logement a bien été modifié");
                    } else {
                        (new view)->modifierAnnonce($loginfo, $prix, null, "Veuillez remplir tous les champs pour modifier votre annonce");
                    }
                } else {
                    (new view)->modifierAnnonce($loginfo, $prix);
                }
            }
        } else {
            $this->erreur404();
        }
    }

    public function modifierPeriodeLogement($logid){
        $loginfo = (new logements)->getInfosLogement($logid);
        //print_r($loginfo);
        //print_r($logid);
        if ($_SESSION['connexion_commercial'] == $loginfo['id_commercial']) {
        if (isset($logid)) {
            if (isset($_POST) && isset($_POST["addNewPeriode"]) && isset($_POST["inputprixperiode"])){
                $periode = (new logementPeriode)->GetPeriodesLogement2($logid);
                $dateString = $_POST["dateadd"];
                $dateArray = explode(" to ", $dateString);
                $premiereDate = "";
                $autreDate = "";
                if (count($dateArray) === 2) {
                    $premiereDate = $dateArray[0];
                    $autreDate = $dateArray[1];
                    $messreponse = (new logementPeriode)->ajouterPeriodeLogement($logid,$premiereDate,$autreDate,$_POST["inputprixperiode"]);
                    //echo "Première date : " . $premiereDate . "<br>";
                    //echo "Autre date : " . $autreDate;
                    if (strpos($messreponse, "Une période pour ce logement existe déjà") !== false) {
                        $periodecomp = (new logementPeriode)->GetPeriodesListComplete($logid);
                        print_r($periodecomp);
                        (new view)->modifierPeriodeLogement($periode,$periodecomp,$messreponse,"danger");
                    }
                    if (strpos($messreponse, "a été ajoutée avec succès pour le logement") !== false) {
                        $periodecomp = (new logementPeriode)->GetPeriodesListComplete($logid);
                        (new view)->modifierPeriodeLogement($periode,$periodecomp,$messreponse,"success");
                    }
                    if (strpos($messreponse, "Une erreur est survenue lors de l'ajout de la période pour le logement") !== false) {
                        $periodecomp = (new logementPeriode)->GetPeriodesListComplete($logid);
                        (new view)->modifierPeriodeLogement($periode,$periodecomp,$messreponse,"danger");
                    }
                } else {
                        $periodecomp = (new logementPeriode)->GetPeriodesListComplete($logid);
                        (new view)->modifierPeriodeLogement($periode,$periodecomp,"Erreur Critique sur les dates","danger");
                }
            } else if (isset($_POST) && isset($_POST["modifierprixperiode"]) && isset($_POST["nouveau_prix"])){
                if (is_numeric($_POST["nouveau_prix"])){
                    $retm = (new logementPeriode)->modifierPrixPeriode($_POST["id_periode"],$_POST["nouveau_prix"]);
                    $periode = (new logementPeriode)->GetPeriodesLogement2($logid);
                    if ($retm){
                        $periodecomp = (new logementPeriode)->GetPeriodesListComplete($logid);
                        (new view)->modifierPeriodeLogement($periode,$periodecomp,"le prix pour la période ".$_POST["id_periode"]." on bien été modifié","success");
                    } else{
                        $periodecomp = (new logementPeriode)->GetPeriodesListComplete($logid);
                        (new view)->modifierPeriodeLogement($periode,$periodecomp,"le prix pour la période ".$_POST["id_periode"]." n'a pas pu être modifier","danger");
                    }  
                } else {
                    $periode = (new logementPeriode)->GetPeriodesLogement2($logid);
                    $periodecomp = (new logementPeriode)->GetPeriodesListComplete($logid);
                    (new view)->modifierPeriodeLogement($periode,$periodecomp,"le prix pour la période ".$_POST["id_periode"]." n'a pas pu être modifier car elle contient des caractère invalides","danger");
                }

            } else if (isset($_POST) && isset($_POST["supprimeperiode"]) && isset($_POST["id_periode"])){
                $retm = (new logementPeriode)->supprimerPeriodeEtReservations($_POST["id_periode"]);
                $periode = (new logementPeriode)->GetPeriodesLogement2($logid);
                if ($retm){
                    $periodecomp = (new logementPeriode)->GetPeriodesListComplete($logid);
                    (new view)->modifierPeriodeLogement($periode,$periodecomp,"la période ".$_POST["id_periode"]." on bien été supprimer","success");
                } else{
                    $periodecomp = (new logementPeriode)->GetPeriodesListComplete($logid);
                    (new view)->modifierPeriodeLogement($periode,$periodecomp,"la période ".$_POST["id_periode"]." n'a pas pu être supprimer","danger");
                }
            } else {
                $periode = (new logementPeriode)->GetPeriodesLogement2($logid);
                $periodecomp = (new logementPeriode)->GetPeriodesListComplete($logid);
                //print_r($periode);
                //print_r($periodecomp);
                (new view)->modifierPeriodeLogement($periode,$periodecomp);
            }
        }
    } else {
        $this->erreur403();
    }
    }
}
