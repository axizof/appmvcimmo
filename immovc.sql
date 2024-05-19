-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 20 mai 2024 à 00:53
-- Version du serveur : 10.6.18-MariaDB
-- Version de PHP : 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `peyo5877_immovc`
--

-- --------------------------------------------------------

--
-- Structure de la table `Client`
--

CREATE TABLE `Client` (
  `id_client` int(11) NOT NULL,
  `login_client` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Client`
--

INSERT INTO `Client` (`id_client`, `login_client`, `password`) VALUES
(1, 'Enzo', '$2y$10$SrEbNtYMEeZIeo3tfdDo4u6ZY494eCyJ4aNKnle1DyQsCV7t3Mvj2'),
(2, 'Cars2', '$2y$10$EOoNUarpmFcbEsMAsm5Wlu6U0jcEXTK51ul1z/ad02JgnbHsNHg2S'),
(3, 'a.bah', '$2y$10$nT2SVL1WjE9ctppMeuB5hOblWacI77Ddevc5081wxfwwuNJKQ9LrG'),
(4, 'a.bahh', '$2y$10$r0rLDF6nHBozc1xGMHI2W.rWTPkK33.wfo9ohkCy3mcGSbWihdgFW'),
(5, 'test', '$2y$10$yMm6es1jvKwm3Ptsl/0mLeaLC19hDn05bewemEV4P77n1DR/YbyyC'),
(6, 'test2', '$2y$10$nw1y.f6EBCGuMtUn8CuHsuSaWcFr.y71eHu92Rkv3U5GTKZgkilEi');

-- --------------------------------------------------------

--
-- Structure de la table `Commercial`
--

CREATE TABLE `Commercial` (
  `id_commercial` int(11) NOT NULL,
  `login_commercial` varchar(100) NOT NULL,
  `nom_commercial` varchar(200) NOT NULL,
  `prenom_commercial` varchar(200) NOT NULL,
  `salt` binary(16) DEFAULT NULL,
  `hashed_password` varchar(64) NOT NULL,
  `DateCreation` timestamp NULL DEFAULT current_timestamp(),
  `pp` varchar(500) DEFAULT 'ppdefault.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Commercial`
--

INSERT INTO `Commercial` (`id_commercial`, `login_commercial`, `nom_commercial`, `prenom_commercial`, `salt`, `hashed_password`, `DateCreation`, `pp`) VALUES
(7, 'Enzo', 'Cailac', 'Enzo', 0xac1ea7428fee50f8cb6c9186e2e16d1c, '56fd5da4971c598fe75cc355d3b4f8a70dbc89593edaead4ecfacf26a78ea9f7', '2023-12-02 17:37:46', 'ppdefault.png'),
(8, 'Alpha', 'Bah', 'Alpha', 0x8d5deb59be94f96a937472bc1420c65f, '38e5b5eb1f34b617c15ce9ea9c7a84040dd02b79b18111e6af2ba4e3b79f2311', '2023-12-02 17:37:46', 'ppdefault.png'),
(13, 'Test', 'je', 'test', NULL, '$2y$10$xhG.0OxgSbCKD5IdW2qbnuPhJjq32L0de5U5Wu.v1xLC/uPA5gmS2', '2023-12-02 17:37:46', 'ppdefault.png'),
(14, 'Cars', 'Voiture', 'Rouge', NULL, '$2y$10$NcifmQevUjblx4oPh6Hute9dacWoTNedApfA/sdFETYbRqQG1WhIe', '2023-12-13 07:39:41', 'ppdefault.png');

-- --------------------------------------------------------

--
-- Structure de la table `Conversation_Etat_Lieux`
--

CREATE TABLE `Conversation_Etat_Lieux` (
  `id_conversation` int(11) NOT NULL,
  `id_commercial` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `chemin_photo` text DEFAULT NULL,
  `id_etat` int(11) NOT NULL,
  `noteco` int(11) DEFAULT NULL,
  `notecli` int(11) DEFAULT NULL,
  `id_piece` int(11) DEFAULT NULL,
  `id_equipement` int(11) DEFAULT NULL,
  `datepost` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Conversation_Etat_Lieux`
--

INSERT INTO `Conversation_Etat_Lieux` (`id_conversation`, `id_commercial`, `id_client`, `message`, `chemin_photo`, `id_etat`, `noteco`, `notecli`, `id_piece`, `id_equipement`, `datepost`, `type`) VALUES
(20, 14, NULL, 'Hhtj', NULL, 5, 3, NULL, 274, 192, '2024-05-02 15:37:33', 'entree'),
(21, 0, 7, 'ghrhrhg', NULL, 5, 4, NULL, 274, 192, '2024-05-02 15:37:33', 'entree'),
(22, 14, NULL, 'Hhtj', NULL, 5, 4, NULL, 274, 192, '2024-05-02 15:37:33', 'entree'),
(23, 14, NULL, 'Gkrkfufu', '6633b97ec83c4_photo.jpg', 5, 4, NULL, 274, 192, '2024-05-02 16:04:14', 'entree'),
(24, 14, NULL, 'Brjthe', NULL, 5, 3, NULL, 274, 192, '2024-05-02 18:39:37', 'entree'),
(25, 14, NULL, 'Gghju', NULL, 5, 3, NULL, 274, 192, '2024-05-02 18:46:52', 'entree'),
(26, 14, NULL, 'Gghju', NULL, 5, 3, NULL, 274, 192, '2024-05-02 18:46:52', 'entree'),
(27, 14, NULL, 'Bonjour', NULL, 5, 2, NULL, 274, 192, '2024-05-02 18:48:36', 'entree'),
(28, 14, NULL, 'Ghu', NULL, 5, 4, NULL, 274, 193, '2024-05-02 18:51:04', 'entree'),
(29, 14, NULL, 'test xommentaire', '6633e4e73d8ea_photo.jpg', 5, 2, NULL, 274, 192, '2024-05-02 19:09:27', 'entree'),
(30, 14, NULL, 'meuble conforme', '6633e6c9bab7f_photo.jpg', 5, 4, NULL, 274, 192, '2024-05-02 19:17:29', 'entree'),
(31, NULL, NULL, NULL, NULL, 5, 2, NULL, 274, NULL, '2024-05-02 19:18:04', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Equipement`
--

CREATE TABLE `Equipement` (
  `id_equipement` int(11) NOT NULL,
  `nom_equipement` varchar(100) NOT NULL,
  `id_piece` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Equipement`
--

INSERT INTO `Equipement` (`id_equipement`, `nom_equipement`, `id_piece`) VALUES
(129, 'Lit', 111),
(130, 'Armoire', 111),
(131, 'Table de chevet', 111),
(132, 'Lampadaire', 111),
(133, 'Réfrigérateur', 112),
(134, 'Cuisinière', 112),
(135, 'Évier', 112),
(136, 'Table à manger', 112),
(137, 'Toilettes', 113),
(138, 'Lavabo', 113),
(139, 'Baignoire', 113),
(140, 'Miroir', 113),
(141, 'Canapé', 114),
(142, 'Table basse', 114),
(143, 'Télévision', 114),
(144, 'Étagère', 114),
(145, 'Lit', 115),
(146, 'Armoire', 115),
(147, 'Table de chevet', 115),
(148, 'Lampadaire', 115),
(149, 'Réfrigérateur', 116),
(150, 'Cuisinière', 116),
(151, 'Évier', 116),
(152, 'Table à manger', 116),
(153, 'Toilettes', 117),
(154, 'Lavabo', 117),
(155, 'Baignoire', 117),
(156, 'Miroir', 117),
(157, 'Canapé', 118),
(158, 'Table basse', 118),
(159, 'Télévision', 118),
(160, 'Étagère', 118),
(161, 'Lit', 119),
(162, 'Armoire', 119),
(163, 'Table de chevet', 119),
(164, 'Lampadaire', 119),
(165, 'Réfrigérateur', 120),
(166, 'Cuisinière', 120),
(167, 'Évier', 120),
(168, 'Table à manger', 120),
(169, 'Toilettes', 121),
(170, 'Lavabo', 121),
(171, 'Baignoire', 121),
(172, 'Miroir', 121),
(173, 'Canapé', 122),
(174, 'Table basse', 122),
(175, 'Télévision', 122),
(176, 'Étagère', 122),
(177, 'Lit', 123),
(178, 'Armoire', 123),
(179, 'Table de chevet', 123),
(180, 'Lampadaire', 123),
(181, 'Réfrigérateur', 124),
(182, 'Cuisinière', 124),
(183, 'Évier', 124),
(184, 'Table à manger', 124),
(185, 'Toilettes', 125),
(186, 'Lavabo', 125),
(187, 'Baignoire', 125),
(188, 'Miroir', 125),
(189, 'Canapé', 126),
(190, 'Table basse', 126),
(191, 'Télévision', 126),
(192, 'Étagère', 274),
(193, 'Lit', 274);

-- --------------------------------------------------------

--
-- Structure de la table `Etat_Lieux`
--

CREATE TABLE `Etat_Lieux` (
  `id_etat` int(11) NOT NULL,
  `id_reservation` int(11) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Etat_Lieux`
--

INSERT INTO `Etat_Lieux` (`id_etat`, `id_reservation`, `statut`) VALUES
(5, 35, 5);

-- --------------------------------------------------------

--
-- Structure de la table `LogementPeriode`
--

CREATE TABLE `LogementPeriode` (
  `id_periode` int(11) NOT NULL,
  `id_logement` int(11) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `prix_location` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `LogementPeriode`
--

INSERT INTO `LogementPeriode` (`id_periode`, `id_logement`, `date_debut`, `date_fin`, `prix_location`) VALUES
(1, 19, '2023-11-01', '2023-12-15', 150.00),
(2, 40, '2023-11-01', '2023-12-22', 200.00),
(3, 36, '2023-12-19', '2023-12-23', 300.00),
(4, 59, '2023-12-12', '2023-12-15', 150.00),
(5, 65, '2024-01-01', '2023-12-15', 180.00),
(6, 65, '2023-12-12', '2023-12-31', 190.00),
(7, 55, '2023-12-17', '2023-12-31', 200.00),
(8, 69, '2024-01-01', '2024-01-31', 140.00),
(9, 61, '2024-01-01', '2023-12-26', 156.00),
(10, 54, '2023-12-07', '2023-12-26', 172.00),
(11, 58, '2023-12-12', '2023-12-29', 164.00),
(12, 52, '2023-12-13', '2023-12-31', 129.00),
(13, 63, '2023-12-13', '2023-12-31', 159.00),
(14, 41, '2023-12-01', '2024-02-29', 175.00),
(15, 30, '2023-12-01', '2023-12-24', 148.00),
(16, 48, '2024-02-01', '2024-02-06', 200.00),
(17, 48, '2024-02-07', '2024-02-09', NULL),
(18, 48, '2024-01-02', '2024-01-10', 124.00),
(20, 47, '2024-02-01', '2024-02-29', 160.00),
(21, 47, '2023-12-19', '2023-12-29', 150.00),
(22, 47, '2024-01-03', '2024-01-17', 147.00),
(23, 47, '2024-04-02', '2024-04-10', 200.00),
(31, 48, '2024-01-12', '2024-01-31', 120.00),
(32, 47, '2024-01-19', '2024-01-31', 120.00),
(34, 47, '2024-04-12', '2024-06-14', 123.00);

-- --------------------------------------------------------

--
-- Structure de la table `Logements`
--

CREATE TABLE `Logements` (
  `id_logement` int(11) NOT NULL,
  `nom_logement` varchar(200) NOT NULL,
  `nb_pieces` int(11) NOT NULL,
  `rue_logement` varchar(100) NOT NULL,
  `cp_logement` int(11) NOT NULL,
  `ville_logement` varchar(200) NOT NULL,
  `id_commercial` int(11) DEFAULT NULL,
  `DateAjout` timestamp NOT NULL DEFAULT current_timestamp(),
  `DescriptionLogement` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Logements`
--

INSERT INTO `Logements` (`id_logement`, `nom_logement`, `nb_pieces`, `rue_logement`, `cp_logement`, `ville_logement`, `id_commercial`, `DateAjout`, `DescriptionLogement`) VALUES
(16, 'Maison Verte', 7, '24 rue de la Couronne', 55000, 'Bar-le-Duc', 7, '2023-11-29 15:37:53', NULL),
(17, 'Appartement Vert', 3, '456 Rue de la Paix', 55000, 'Lyon', 8, '2023-11-29 15:37:53', NULL),
(18, 'Studio Rouge', 1, '789 Rue de la Joie', 55090, 'Marseille', 7, '2023-11-29 15:37:53', NULL),
(19, 'Maison bleue', 11, '80 rue du fou', 78000, 'Paris', 14, '2023-11-29 15:37:53', NULL),
(27, 'Loue Maison T5 , 250m2', 6, '24 Bd de la Fontanelle', 82210, 'Saint-Nicolas-de-la-Grave', 13, '2023-09-09 04:02:36', 'Maison entièrement restauré sur Saint Nicolas de la Grave 82210\nSitué au calme sans aucun vis à vis ,tout en restant proche des toutes les commodités en 2min (centre-ville ; écoles ; médecin ; commerce alimentaire etc...)Exterieur : grand terrain arboré , 2 grande terrasses , 1 cabanon assez grand pour y ranger du matériel .Interieur :-1 Grand salon avec un meuble d\'époque restauré + une cheminé en marbre italien-1 Salle à manger à tenant à la cuisine avec un cheminé en pierre (qui chauffe très bien) avec une baie vitré à galandage donnant sur une grande terrasse-1 Cuisine ouverte avec ilot central+ placard mural (beaucoup de rangement )+Four+plaque et Haute-4 grande chambres avec placard/dressing-1 salle de bain avec double vasque et baignoire balnéo + grand miroir-1 salle d\'eau Douche à l\'italienne-1 WC-1 Buanderie-2 celliersFenêtre double vitrage partout + Volet roulant dans chaque piècesChauffage avec Clim réversible + Cheminé (les mur étant épais la maison garde bien la chaleur)Montant du loyer : 1250€'),
(28, 'Appartement meublé à louer Montmorency', 1, '5 Av. Maria Bis', 95160, 'Montmorency', 13, '2023-01-11 03:32:21', '★ Au cœur de Montmorency, à proximité immédiate de la place du Marché (Mercredi et Dimanche Matin)★ Quartier et bien sécurisés★ Chambre: Lit double avec commode - portant - table de chevet avec vue sur la ville.★ Salon : banquette Canapé lit 1 place - Table d\'appoint★ Vue panoramique sur Paris (Tour Eiffel /Gratte Ciel de la Défense) et sa région.★ Cuisine: Réfrigérateur, Micro-onde, Four, Machine à café expresso cecotec cumbia, Bouilloire - Plaque Induction★ Salle de bain'),
(30, 'À louer - Magnifique T3 meublé de 48 m² à Toulouse (31400)', 3, '82-90 Rue Adonis', 31400, 'Toulouse', 13, '2023-06-06 20:39:23', 'Disponible à partir du 15/01/2024, situé au premier étage du bâtiment principal du 31 rue du Chant du Merle à Toulouse (31400), le cabinet FALGARDE GESTION SA a le plaisir de vous proposer à la location, ce magnifique appartement T3 de 48 m², entièrement rénové, équipé et décoré avec énormément de goût. L’entrée se fait via une porte-fenêtre ouvrant sur un séjour et coin repas, une cuisine totalement aménagée et équipée donne sur une petite terrasse. Un long dégagement dessert une petite chambre/bureau, des WC indépendants, une grande salle d’eau avec douche à l’italienne et une chambre avec placard.Vous allez être charmé par sa décoration, ses prestations haut-de-gamme et le beau mélange de l’ancien couplet à des matériaux modernes.Cet appartement est équipé d’une climatisation réversible, double vitrage PVC à toutes les fenêtres, volets roulants électriques à la chambre.Situé dans un quartier calme, proche des commerces de l\'avenue Jean Rieux et des transports en commun (Linéo 8).Les informations sur les risques auxquels ce bien est exposé sont disponibles sur le site Géorisques : www.georisques.gouv.frDPEC(128) / GES A (3)Les coûts sont estimés en fonction des caractéristiques du logement et pour une utilisation standard sur 5 usages (chauffage, eau chaude sanitaire, climatisation, éclairage, auxiliaires) entre472€ et 638€ par an (Prix moyens des énergies indexés au 1 janvier 2021 /abonnements compris)Loyer : 1138€Provision sur charges mensuelle : 80€ (charges générales, eau froide & ordures ménagères)Dépôt de garantie : 2276€Honoraires de location : 682.80€ TTC selon taux de TVA actuellement en vigueur (20.00%).Afin de venir découvrir ce bien immobilier idéalement situé, nous vous proposons de contacter Mme MASMEJEAN Claire du Cabinet FALGARDE GESTION SA, 41, Rue de la découverte, CS37621, 31 676 LABEGE Cedex. N° siren 819 602 962. Titulaire de la carte professionnelle TG N°CPI31012016 000009 281 délivrée par la Chambre de Commerce et d\'Industrie de Toulouse, le 03/05/2022'),
(31, 'Appartement t2 a colomiers (31770)', 2, '65 Rue du Prat Bis', 31770, 'Colomiers', 13, '2023-06-06 05:13:56', 'A louer. Centre Ville de COLOMIERS, 8 allée du Gévaudan, bel appartement de type 2 de 43.79 m² , dans une copropriété sécurisée de 2005, de bon standing et très bien entretenue. Ce bien est situé au 3ème et dernier étage avec ascenseur. Vous serez charmés par son grand séjour lumineux, ouvrant sur une terrasse. Le coin cuisine est aménagé et semi équipé (hotte, plaque vitrocéramique 2 feux et frigo top). La chambre est grande et dispose d\'un placard. Il dispose d\'une salle de bains avec baignoire et meuble vasque et les WC sont indépendants. L\'appartement bénéficie également d\'un emplacement de parking privatif en sous-sol.Le plus une belle vue sur les Pyrénées depuis la terrasse.Accès rapide à la rocade. Commerces et transports en commun à proximité.Libre le 16/12/2023.Les informations sur les risques auxquels ce bien est exposé sont disponibles sur le site Géorisques : www.georisques.gouv.frDPE D(197)/GES B (7) réalisé le 14/01/2021Estimation consommation moyenne annuelle d\'énergie (prix moyens des énergies indexés au 15 Août 2015) : 452€Loyer : 531.98 €Provision sur charges : 50.00 € (charges générales d\'entretien et de parties communes, eau froide & TOM)Dépôt de garantie : 531.98 €Honoraires de location : 319.19 € TTC selon taux de TVA actuellement en vigueur (20%)Afin de venir découvrir ce bien immobilier idéalement situé, nous vous proposons de contacter Mme MASMEJEAN Claire du Cabinet FALGARDE GESTION SA, 41, Rue de la découverte, CS37621, 31 676 LABEGE Cedex. N° siren 819 602 962. Titulaire de la carte professionnelle TG N°CPI31012016 000009 281 délivrée par la Chambre de Commerce et d\'Industrie de Toulouse, le 03/05/2022'),
(32, 'Coup de coeur, secteur DAUX, villa d\'architecte de type 5', 5, '4 Imp. de la Tuilerie', 31700, 'Daux', 13, '2023-02-12 09:28:40', '10 minutes de BLAGNAC, sur la très agréable commune de DAUX, le cabinet FALGARDE GESTION a le privilège de vous proposer à la vente cette chaleureuse villa de type 5.Nichée dans un véritable écrin de verdure, cette maison, complètement atypique, car en bois, est en harmonie totale avec son environnement. Elle bénéficie d\'une surface habitable d\'environ 200 m2. Le jardin, d\'environ 3 000 m2, est paysagé et entretenu avec soin.La maison proposée est ainsi agencée au rez-de-chaussée d\'un vaste plateau avec une spectaculaire structure cathédrale, incluant une cuisine équipée et aménagée avec goût, d\'une salle à manger lumineuse et d\'un séjour intime. Ce large espace de vie est baigné de lumière de par de nombreuses et grandes ouvertures. Le coin nuit bien distinct, propose deux chambres, chacune bénéficiant d\'une salle d\'eau privative, ainsi que d\'une immense suite parentale, avec un dressing, et une grande salle de bain.A l\'étage, nous sommes agréablement surpris par la découverte d\'une mezzanine d\'environ 50 m2. Cet espace, ouvert sur le séjour, peut tout à fait être aménagé en deux chambres supplémentaires.Le garage, accessible au sous-sol, est vaste, et bien isolé.En ce qui concerne les extérieurs, la maison offre une terrasse ombragée, avec un store banne électrique, et d\'une tonnelle en bois favorisant la grimpe de la végétation environnante. De cette espace, nous surplombant une magnifique piscine et son petit terrassement intime. Sur le côté de la maison se trouve un boulodrome.Véritable havre de paix, les atouts de ce bien immobilier sont particulièrement nombreux, tels le calme, l\'espace et l\'environnement verdoyant!- année de construction : 2009,- chauffage au sol par pompe à chaleur de type aérothermique (système de 2016 facture à l\'appui),- double vitrage avec volets électriques,- piscine sécurisée par un store électrique,- assainissement de type fosse septique- ossature bois et bardage en red cedar de type Red Cedar,- aspiration centralisée,- porte de garage électrique,- montant de la taxe foncière 2023 de 2 761 euros,- fibre en bas de la parcelle, maison non raccordée,- Dossier technique réalisé le 25 Septembre 2023 possibilité de le consulter à la demande,DPE: B (90 kWh/m2/an) GES: A (2 Kg CO2/m2/an) Conso annuelle estimée entre 1 100 et 1 530 euros/an (Prix moyens des énergies indexés au 1er janvier 2021 (abonnements compris)).- nombreux rangements.Les prestations sont de qualité et l\'aménagement est réalisé avec goût! Il s\'agit d\'une villa soignée, avec beaucoup de factures relatives à l\'entretien. Maison à découvrir sans plus tarder!Le prix de vente de ce bien immobilier est de 565 000 euros TTC ( Prix Net Vendeur : 550 000 euros), Les honoraires d\'agence s\'élèvent à 15 000 euros TTC à la charge du vendeur, soit 12 990 euros HT (selon l\'application de la TVA en vigueur).Si vous souhaitez visiter cette maison, nous vous proposons de contacter Mme Morgane GENTHIAL, responsable du service de Transactions Immobilières de l\'Agence FALGARDE GESTION, 41, Rue de la Découverte, 31 676 LABEGE, Titulaire de l\'attestation de collaborateur N°ADC31012022000002568 rattachée à la carte professionnelle TG N°CPI 3101 2016 000 009 281 délivrée par la Chambre de Commerce et d\'Industrie de Toulouse, le 03/05/2022'),
(33, '2 pièces refait à neuf à louer', 2, '16 Rue de la Comète', 75011, 'Paris', 13, '2023-08-22 23:01:25', 'Métro St Maur, rue Servan\nAppartement 6ème étage avec ascenseur.Jolie vue sur Paris, pas de vis à vis, expo Ouest.Entièrement refait à neuf.Meublé et équipé avec des matériaux de qualitéGrand réfrigérateur-congélateur, four micro ondes grill, plaque de cuisson induction,Machine NespressoRangementsImmeuble avec gardien, ascenseur.Possibilité de rentrer véloInternet compris'),
(34, 'T2 meublé dispo entre HYERES et TOULON', 2, '2 Rue de la Liberté', 83260, 'LaCrau', 13, '2023-03-01 15:39:29', 'Dans une maison de 4 appartements située à LA CRAU j\'ai un T2 disponible jusqu\'au 30 juin 2024.L\'appartement a une superficie de 35 m² et il y a 4 couchages (un lit en 140 dans la chambre séparée et un clic clac en 140 dans le salon). Peut convenir à une colocationL\'appartement est meublé et tout équipé : plaque deux feux, four micro-ondes, lave linge, frigo, TV, clim. réversible et internet par wifi (fibre).Toute la vaisselle, les ustensiles de cuisine, la machine à café, l\'aspirateur, la planche et le fer à repasser sont à votre dispositionLoyer mensuel jusqu\'au 30 juin 2024 : 630 € hors eau et électricitéPour une location à l\'année me consulterJe reste à votre disposition si vous souhaitez plus d\'infos ainsi que des photos supplèmentaires'),
(35, 'A louer à l\'année un T2 avec terrasse + garage à Hyères', 2, '7 All. Lavoisier', 83400, 'Hyres', 13, '2023-07-07 06:38:45', 'A louer à l\'année agréable T2 non meublé de 43m2 au 1er d\'une villa dans résidence sécurisée avec garage fermé en sous sol.Entrée avec placardCuisine ouverte sur séjour avec accès à terrasse expo sud en partie couverte de 10m2Chambre avec placardSalle de doucheWC séparéChauffage électrique individuelDisponible à partir du 1er décembre 2023Loyer 790 euros + 60 euros de charges sauf électricitéPremier contact par mail avec présentation svp'),
(36, 'Appartement 2 pièces 37 m²', 2, '2-8 Av. des Mimosas', 83400, 'Hyres', 13, '2023-09-24 10:38:25', 'Appartement 2 pièces 37 m²\nA LOUER - T2 de 36.58m2 lumineux avec vue dégagée, entièrement rénové dans une petite copropriété avec ascenseur à proximité du centre ville de HYERES comprenant une entrée avec placard, cuisine aménagée et équipée ouverte sur séjour, chambre avec placard, salle d\'eau, wc séparé. Une cave et une place de stationnement en sous-sol. Environnement calme. Chauffage et eau chaude individuels électriques. Eau froide collective. Libre de suite. \'Les informations sur les risques auquels ce bien est exposé sont disponibles sur le site Géorisques: www.georisques.gouv.fr\'Surface : 37 m²Loyer : 730 € / mois (charges comprises)Montant des charges : 69 € / moisModalité de récupération des charges locatives : Prévisionnelles mensuelles avec régularisation annuelleHonoraires à la charge du locataire : 494 € dont 114 € pour l’état des lieuxDépôt de garantie : 661 €Date de réalisation du diagnostic énergétique : 02/11/2023Consommation énergie primaire : 199 kWh/m²/anConsommation énergie finale : Non communiquéMontant estimé des dépenses annuelles d\'énergie pour un usage standard : entre 490 € et 710 € par an. Prix moyens des énergies indexés sur l\'année 2021 (abonnements compris)'),
(37, 'Appartement 2 pièces 44 m²', 2, '1 Imp. des Myrtilles', 30133, 'LesAngles', 13, '2023-11-27 02:40:52', 'Appartement 2 pièces 44 m²\nA LOUER LES ANGLES - Votre agence COGEFIM vous propose un appartement de type P2 de 44m2 environ environ au 1er étage d\'une résidence fermée et sécurisée. Ce logement se situe à deux pas du centre LECLERC. Il se compose d\'une entrée, séjour, cuisine aménagée et équipée, une chambre, une salle de bains et WC. Le chauffage est individuel au GAZ. Le plus de cet appartement une terrasse de 4m2 environ et une place de parking privative. DISPONIBLESurface : 44 m²Loyer : 567 € / mois (charges comprises)Montant des charges : 58 € / moisHonoraires à la charge du locataire : 444 € dont 110 € pour l’état des lieuxDépôt de garantie : 509 €Consommation énergie primaire : 100 kWh/m²/anConsommation énergie finale : Non communiqué'),
(38, 'Appartement 2 pièces 57 m²', 2, '1 Imp. des Myrtilles', 30133, 'LesAngles', 13, '2023-01-12 09:37:46', 'Appartement Les Angles 2 pièce(s) 57.25 m2\nEnvironnement très calme pour cet appartement situé dans une résidence récente avec ascenseur. Il comprend un séjour avec cuisine ouverte aménagée et équipée , une chambre avec placard, une salle de bains, un wc, une agréable véranda de 12.80m². Une cave et un garage en sous sol. Disponible le 27/11Référence annonce : 4CM1-U4Z-N0VDate de réalisation du diagnostic : 23/05/2019Honoraires à la charge du locataire : 520 € TTC dont 174 € pour l’état des lieuxDépôt de garantie : 692 €Montant des charges : 69 € / mois'),
(39, 'Appartement 2 pièces 45 m²', 2, '2 Imp. du Roc d\'Aude', 30133, 'LesAngles', 13, '2023-11-24 20:53:02', 'Appartement 2 pièces 45 m²\nLES ANGLES: agréable appartement T2 lumineux, secteur des PRIADES, résidence sécurisée et au 2ème et dernier étage sans ascenseur,.De beaux volumes , cuisine équipée,1 chambre avec placard, entrée, salle de bain et wc séparé, joli balcon au calme.Climatisation réversible. Parking sécurisé, CAVE privative. .Proche de toutes commodités et au calme.Disponible le 21 décembre 2023Surface : 45 m²Loyer : 596 € / mois (charges comprises)Montant des charges : 34 € / moisModalité de récupération des charges locatives : Prévisionnelles mensuelles avec régularisation annuelleHonoraires à la charge du locataire : 495 € dont 135 € pour l’état des lieuxDépôt de garantie : 562 €Consommation énergie primaire : 157 kWh/m²/anConsommation énergie finale : Non communiquéMontant estimé des dépenses annuelles d\'énergie pour un usage standard : entre 470 € et 690 € par an. Prix moyens des énergies indexés sur l\'année 2021 (abonnements compris)Zone soumise à encadrement des loyers.Loyer de base : 562 €.Loyer de référence majoré (loyer de base à ne pas dépasser) : 562 €.Les informations sur les risques auxquels ce bien est exposé sont disponibles sur le site Géorisques : www.georisques.gouv.fr'),
(40, 'Beau F3 , rez de jardin donnant sur le Golf', 3, '110 Rue des Écoles', 73420, 'Viviers-du-Lac', 13, '2023-03-30 08:42:55', 'Beau F3 , rez de jardin donnant sur le Golf avec 50m2 de terrasse privative.\nAppartement en très bon état, juste repeint. Equipé d’une chaudiere gaz a condensation.Salon cuisine avec bar - hotte et plaque de cuisson. 1 chambre parent et une chambre enfant donnant toutes sur la terrasse. Grande salle de bain.Grand garage fermé + cave + place parking extérieure.Conso energétique très faibleFrais de copro estimé 75€/moisDépot de garantie : 1 mois de loyer'),
(41, 'Appart T3 de 63,80 m2 meublé à louer à l\'année', 3, '358 Rte de Verel', 73230, 'Saint-Alban-Leysse', 13, '2023-03-30 17:35:46', 'Dpt Savoie (73), Saint Alban Leysse. Appartement T3 À louer de 63,80 m2 + Cave + place de parking extérieur à loué meublé ! Situé au RDC dans une copropriété, idéalement situé au sud, sud/est. A 5min du centre-ville de saint Alban Leysse et 10 minutes de Chambéry. Cet appartement se compose : D’un halle d’entré avec espaces de rangement. D’une pièce principale très lumineuse de 28 m2 avec cuisine ouverte, donnant sur le salon et salle à manger avec 3 accès à une grandes terrasse extérieur de 93m². 2 chambres : Une première de 10 m2, et une plus grande de 11m² toutes les deux munies de grands placards intégrés. Elles ont directement accès à la terrasse. Une Salle de bain avec baignoire. Et enfin un WC séparé. Cet appartement bénéficie d’une cave sur le même palier. Vous apprécierez en outre son orientation SUD OUEST vous permettant de profiter pleinement de son espace extérieur. Commerces, écoles, médecins, bus, tout est accessible à pied. 1100 € loyer TCC charges (entretiens des grands espaces vert et commun + EDF + Eau chaude + Eau froide + Chauffage compris dans les charges) Libre au 2 Décembre. Contact pour visites uniquement par mail ou SMS. Une caution de 2 x loyer + cautionnaires sera demandée. Plus de photos sur demande.'),
(42, 'Beau 2 pièces 36 m2 meublé proche centre Cannes', 2, '14 Bd Delaup', 6400, 'Cannes', 13, '2023-11-18 05:41:46', 'A louer beau 2 pièces meublé de 36 m2 au rez de chaussée.\nIl se situe dans une petite rue calme dans le quartier de la République, à 10 mns à pied de la Gare.Des stationnements gratuits se trouvent dans les rues avoisinantes et des parkings payants sont proches.Il comprend :- une salle d’eau avec une grande douche, une machine à laver et des toilettes.- une chambre avec porte japonaise, un lit queen-size, son matelas haut de gamme, un petit dressing et une fenêtre- une cuisine avec four, micro-ondes, plaques de cuisson, hotte, placards et frigo.- un séjour avec 2 tables, un canapé-lit et sa méridienne, un meuble TV et si besoin une grande TV.la fenêtre donne sur une autre rue calme avec un effet 1er étage (mais l’appartement est au RDC).- du parquet en bois dans toutes les pièces et tous les murs ont été repeints à neuf par un professionnelL’appartement dispose d’une box TV SFR, d’internet haut débit par fibre, du chauffage dans toutes les pièces et de l’eau en collectif (tout est compris dans les charges).Loyer : 900 euros dont 200 euros de chargesCaution : 1 400 euros encaissables à la signature du bail meublé d’un an minimumJe recherche de préférence une personne seule et avec des références sérieuses.Me contacter par messagerie svp. Merci.'),
(43, 'Appartement 1 pièce 18 m²', 1, '24 Av. du Maroc', 93430, 'Villetaneuse', 13, '2023-01-15 08:09:32', 'Nouvelle Résidence Étudiante à Pierrefitte-sur-Seine - Ouverture le 3 janvier 2024\nRésidence Étudiante à Pierrefitte-sur-Seine !Découvrez notre résidence étudiante de choix à Pierrefitte-sur-Seine, où le confort, la convivialité et la commodité se combinent pour créer un environnement idéal pour votre vie étudiante. Qui ouvrira ses portes le 3 Janvier 2024Caractéristiques du Logement :Type : StudioSuperficie : à partir de 18 m²Cuisine équipée avec réfrigérateur, plaques de cuisson et micro-ondesSalle d\'eau privée avec doucheInternet haut débit inclusMobilier moderne et fonctionnelEspace de rangement généreuxLoyer à partir de 635 euros et frais de dossier à hauteur de 499 eurosServices de la Résidence :Un accès sécurisé 24h/24 pour vous assurer une tranquillité d\'esprit.Salle de fitnessSalle communeLocal à vélosPersonnel amical et disponible pour vous aiderEnvironnement convivial et propice aux étudesUne localisation Idéale :Notre résidence se trouve à quelques pas des transports en commun, des commerces locaux et des campus universitaires. Vous serez au cœur de tout ce dont vous avez besoin pour réussir vos études.Votre nouvelle maison étudiante vous attend à Pierrefitte-sur-Seine. Les places sont limitées, alors n\'attendez pas pour réserver la vôtre !N\'attendez pas, réservez dès maintenant votre logement étudiant au sein de la résidence Green Fabrik à Pierrefitte-sur-Seine et profitez d\'un environnement propice à la réussite de vos études.Vivez confortablement, étudiez efficacement, réservez simplement dès aujourd\'hui sur notre site internet.Référence annonce : green-fabrik_C176'),
(44, 'Citadelle Vauban : studio meublé + parking couvert, avec balcon, cave, secteur Canon d\'Or / Citadelle', 1, '4 All. du Grand Jeu d\'Arc', 59130, 'Lambersart', 13, '2023-09-26 05:25:47', 'Bonjour,\nA louer sur Lambersart / Citadelle Vauban, studio de 23m² entièrement refait à neuf par des professionnels, quartier Canon d\'Or, à 5 min à pieds de la Citadelle, V\'lille à 2 min, avec place de parking couverte (ouverture du parking avec télécommande), un balcon de 3m² avec salon de jardin et transat et une cave (cave en rez de chaussée et pas sous sol).Grande baie vitrée et une porte vitrée qui donne sur le balcon, volet roulant sur toute la longeur de la baie vitrée.Proche tous commerces et transport en commun.Les équipements constituant le meublé sont neufs :Micro-ondeAppareil racletteMachine à laverVaisselles et couvertsCasseroles SitramCafétiére à capsule KrupsRéfrigérateur avec compartiment freezerPlaque inductionBZ (neuf, tout juste déballé, matelas Simon 35kg/m3 fabriqué en France)Bureau avec lampe de bureau + chaiseTable basse sur roulettePlacard de rangement avec penderie.Eau chaude par ballon d\'eau chaude Atlantis, radiateur électiques a accumulateur de chaleur (pas des « grilles pains »). Dans la salle de bain : sèche serviette & soufflant, miroir éclairage led, rangement, baignoire, toilette suspendue.Le loyer inclus le parking couvert. Il y a un concierge dans la résidence et un local à vélos (le local ferme à clé).La gestion se fait par notaire (les loyers sont versés chez le notaire, la rédaction du bail se fait également par le notaire).J\'ai fait rénover et meubler ce studio exactement comme si je devais y habiter moi même, le quartier est très calme, le studio se trouve au 4ieme et dernier étage, très lumineux et sans vis à vis.A deux pas de la Citadelle Vauban, en passant par la Citadelle, on tombe directement sur le Boulevard Vauban où se trouve l\'ensemble de l\'Université Catholique de Lille, tout proche du centre de Lille et du vieux Lille.Loyer de 695 € charges comprises de 60 €uros (eau froide, taxe ordure ménagère, entretien de la résidence, ascenseur)'),
(45, 'ST BRIEUC ST-MICHEL, vaste T3 avec terrasse', 3, '23 Cité Gourien', 22000, 'Saint-Brieuc', 13, '2023-08-31 01:06:07', 'SAINT BRIEUC SAINT MICHEL, dans une petite copropriété de caractère, entièrement rénovée avec gout, , très bel appartement de type III de 90m² comprenant: une entrée, un grand salon séjour avec cuisine aménagée et équipée, le tout ouvrant sur une terrasse de 30m², deux belles chambres, salle d\'eau, rangements. BELLE LUMINOSITE ET SITUATION , BEAUX VOLUMES...Rare.Résidence de STANDING.Surface : 90 m²Loyer : 1075 € / mois (charges comprises)Loyer Hors charge: 990€Montant des charges : 85 € / mois ( consommation eau, et entretien et élec des communs)Modalité de récupération des charges locatives : Prévisionnelles mensuelles avec régularisation annuelleHonoraires à la charge du locataire : 715.50 € dont 270 € pour l’état des lieuxDépôt de garantie : 990€Date de réalisation du diagnostic énergétique : 14/10/2023Consommation énergie primaire : 107 kWh/m²/anConsommation énergie finale : 46 kWh/m²/anMontant estimé des dépenses annuelles d\'énergie pour un usage standard : entre 651 € et 881 € par an. Prix moyens des énergies indexés sur l\'année 2021 (abonnements compris)Les informations sur les risques auxquels ce bien est exposé sont disponibles sur le site Géorisques : www.georisques.gouv.frCoup de cœur.'),
(46, 'T2 neuf - eco quartier guillaumet', 2, '10 Rue Jean-Joseph Sanfourche', 31500, 'Toulouse', 13, '2023-06-18 11:34:07', 'Au cœur du nouveau quartier Guillaumet, découvrez ce charmant T2 de 43,57 m² avec un balcon de 6 m².Situé au 3e étage, l\'appartement se compose d\'un séjour avec une cuisine semi-équipée (plaque, hotte), d\'un dégagement avec placard, d\'une belle chambre, d\'une salle d\'eau et de toilettes séparées.Une place de parking en sous-sol est également comprise.Les charges comprennent l\'eau chaude et le chauffage.Le logement est idéalement situé, à 5 minutes du métro Jolimont (ligne A).Honoraires à la charge du locataire : 479 €. Dépôt de garantie : 590 €. Montant des charges : 80 €/mois avec régularisation annuelle.Logement disponible à la visite au 13 décembre, nous prenons en compte les dossiers dès maintenant.'),
(47, 'Studio 1 pièce 78 m²', 5, '55-37 Rue Rohaut', 80000, 'Amiens', 14, '2023-07-27 06:56:26', 'Studio meublé et équipé - Face Université de Picardie\nA LOUER, Studio de 18m² entièrement meublé et équipé. Prestations de qualité et nombreux services adaptés à la vie étudiante: accès internet fibre gratuit et illimité (une box par logement), accès à la laverie 24/24 - 7J/7(payant), salle de vie commune, local à vélos, salle fitness, distribution de courrier, présence rassurante et sécurisante d\'un responsable de résidence.Située à quelques minutes de l’université de Picardie, de L’IUT, de l’UFR Sport, et du CNAM, la résidence étudiante CAMPUS CLAUDEL profite d\'un quartier commerçant à proximité.A seulement 10 minutes en voiture du centre-ville, vous pourrez bénéficier de l’effervescence de la ville notamment du quartier Saint-Leu, idéal pour vos sorties.Frais de dossier : 249€2 mois de cautionRéférence annonce : campus-claudel_C34Consommation énergétique : 119 kWh/m²/anEmission de gaz à effet de serre : 27 CO2/m²/an'),
(48, 'Meublé 5 pièces 97 m²', 5, '2 Basse Tenue de Grillaud', 44300, 'Nantes', 14, '2023-11-25 22:08:11', 'Collines du Cens - Appartement T5 avec balcon et parking\nVenez découvrir ce très bel appartement de Type 5 entièrement rénové par une architecte d\'intérieur, situé dans un quartier résidentiel proche de toutes les commodités (transports, écoles et commerces) au 8ème étage d\'une résidence calme et sécurisée avec ascenseur.Il se compose d\'une grande entrée avec placard, d\'une pièce de vie avec cuisine équipée donnant sur un balcon exposé Est, d\'un salon pouvant servir de chambre.Le dégagement de la partie nuit distribue 3 chambres, une salle de bains, une salle d\'eau, un placard, 2 beaux dressings et des wc séparés.Une place de parking complète ce bien.Le bien comprend 2 lots, et il est situé dans une copropriété de 607 lotsLes informations sur les risques auxquels ce bien est exposé sont disponibles sur le site Géorisques : www.georisques.gouv.frLoyer mensuel charges comprises : 1 780 €Provision mensuelle pour charges locatives avec régularisation annuelle : 80 €Dépôt de garantie : 3 400 €Honoraires à la charge du locataire : 873 €Honoraires d\'agence : 4,28 % TTC du loyer annuel HC, à la charge du locataireContactez votre conseiller SAFTI : Sébastien MACARY, Tél. : [Coordonnées masquées], E-mail : [Coordonnées masquées] - EI - Agent commercial immatriculé au RSAC de NANTES sous le numéro 494 792 120Référence annonce : 1130852Date de réalisation du diagnostic : 28/08/2023Montant estimé des dépenses annuelles d\'énergie pour un usage standard : entre 830 € et 1170 € par an. Prix moyens des énergies indexés sur l\'année 2021 (abonnements compris)'),
(49, 'Magnifique appartement T3 - lumineux et rénové - 78m2', 3, '137 Bd Paul Langevin', 66000, 'Perpignan', 13, '2023-11-19 00:32:19', 'Le logement :\nSitué au 2eme étage d’une résidence sécurisée avec ascenseur, ce magnifique appartement entièrement meublé et traversant dispose de deux chambres, d’une cuisine ouverte toute équipée donnant sur le salon, d’une entrée, d’une salle de bain avec douche et machine à laver / sèche-linge et de toilettes séparées.L’appartement a été entièrement rénové en 2021.Il est disponible à la location dès le 1er janvier 2024.L’environnement :Situé à proximité immédiate de la gare principale, tous les commerces sont disponibles à proximité. Une location d’une place de parking est possible dans le parking de la gare juste en face.Vous :D’un naturel sérieux et fiable, vous disposez d’un revenu minimum de 2050 euros net mensuel et êtes prêt à louer le bien dès le 1er janvier 2024.Les dossiers les plus fiables (deux sources de revenus, garant…) seront favorisés.Prises d’information et visites :Via le site Le bon coin, merci de décrire en quelques mots votre situation à votre premier message.Les visites ont lieu les lundis et vendredis soir du mois de décembre.A bientôt'),
(50, 'Montpellier, Saint Anne – T1bis atypique', 1, '12 Rue Meyrueis', 34000, 'Montpellier', 13, '2023-09-20 11:25:09', 'LOUÉ VIDE / NON MEUBLÉ\nMONTPELLIER SAINT-ANNE - STUDIO T1 BIS RDC :A la location, studio T1 bis de 31.71m2 en rez-de-chaussée d\'un immeuble en copropriété quartier Sainte-Anne à Montpellier. Le studio se comporte d\'une belle pièce à vivre avec murs en pierres et poutres au plafond, et d\'un coin cuisine semi équipée (hotte, frigo top, plaque vitrocéramique, placards de rangement), le tout éclairé par une grande double fenêtre avec barreaux, donnant sur la rue. Un coin nuit avec placard aménagé et branchement machine à laver, avec fenêtre donnant sur cour. Enfin une salle d\'eau (douche à l\'italienne, vasque sur meuble de rangement, W.C.) complète le bien.TRÈS BON EMPLACEMENT, PLEIN CENTRE VILLE/ÉCUSSON, ATYPIQUEHONORAIRES AGENCE : 317.10 €FRAIS ETAT DES LIEUX : 95.13 €TOTAL HONORAIRES : 412.23 €DÉPÔT DE GARANTIE : 570 €LOYER HORS CHARGES MENSUEL : 570 € + PROVISION / CHARGES MENSUELLE : 40 € - payables mensuellement comprenant : eau, charges d\'immeuble, et taxe d\'enlèvement des ordures ménagères. La régularisation se fait de manière annuelle.TOTAL / MOIS 610 € CHARGES COMPRISESZone soumise à encadrement des loyers.Loyer de référence majoré (loyer de base à ne pas dépasser) : 688.11 €Loyer de base (de référence) : 573.95 €DPE D 172 / A 5 : réalisé avant le 1er Juillet 2021'),
(51, 'Bel appartement F3+ à louer', 3, '2 Rue Bernard Palissy', 54500, 'Vandoeuvre-ls-Nancy', 13, '2023-06-12 19:33:54', 'Idéalement prévu pour 2 locations, cet lumineux appartement non meublé de 84 m2 avec balcon, sécurisé par vidéosurveillance situé au 4ē étage d\'un immeuble de Vandœuvre Les Nancy, vous séduira par toutes les possibilités qu\'il offre:- Proximité du Vélodrome, des facs de Sciences et de médecine, proches de commodités et centre commercial.- Composition : 1 entrée avec dressing, 2 belles chambres de 13 et 10,50 m2 , 1 grand séjour -salle à manger pouvant offrir une possible 3ēme chambre de 10,50m2 si besoin, 1 cuisine indépendante récente et toute équipée de 13m2, 1 salle d\'eau et buanderie, 1 WC indépendant et une cave.- Parkings à proximité ou possibilité de louer en sus une place privée au sous-sol.- Sécurité assurée par gardiennage et vidéosurveillance.Les charges comprennent l\'eau chaude et froide, le chauffage, l\'électricité , l\'entretien des communs, le gardiennage..- Loyers toutes charges comprises :-chambre 1: 490 eur ( 320 eur+ 170 eur de charges) et ch 2: 460 eur ( 290 eur+ 170 eur de charges)- Locations à partir du 1er Janvier 2024M\'appeler, svp, dès maintenant pour voir les possibilités..Appartement idéal pour fratrie ou étudiants se connaissant.'),
(52, 'Appartement 3 pièces 67 m²', 3, '24 Rue de Wasselonne', 67000, 'Strasbourg', 13, '2023-05-20 03:41:30', 'ORANGERIE - 3 pces repeint terrasse vue sur le lac\nIMMOVAL vous propose : Rue François-Xavier Richter, au 2e étage avec ascenseur, un joli 3 pces repeint de 66.92m² avec cave en sous-sol. Il se compose d\'une entrée avec placard, d\'un beau séjour avec terrasse vue dégagée sur le lac, d\'un dégagement desservant 2 chambres de 12m², une salle de bain avec rangement et un wc séparé. Chauffage et eau chaude individuels électriques. Disponible de suite.Les informations sur les risques auxquels ce bien est exposé sont disponibles sur le site Géorisques : www. georisques. gouv. frRéférence annonce : 63915-IMMOVALDate de réalisation du diagnostic : 28/08/2023Honoraires à la charge du locataire : 869 € TTC dont 200 € pour l’état des lieuxDépôt de garantie : 850 €Montant des charges : 140 € / moisModalité de récupération des charges locatives : provision avec régularisation annuelleA propos de la copropriété :Pas de procédure en coursMontant estimé des dépenses annuelles d\'énergie pour un usage standard : entre 640 € et 910 € par an. Prix moyens des énergies indexés sur l\'année 2021 (abonnements compris)'),
(53, 'Appartement 3 pièces 69 m²', 3, '41 Rue Jeanne-d\'Arc', 51100, 'Reims', 13, '2023-04-10 13:03:47', 'Appartement 3 pièces 69 m²\nEn résidence avec gardien, beau type 3 comprenant entrée, placards, séjour sur balcon, exposition sud, cuisine, dégagement, 2 chambres, salle de bains, wc.Chauffage collectif gazClés 300Surface : 69 m²Loyer : 815 € / mois (charges comprises)Montant des charges : 215 € / moisModalité de récupération des charges locatives : Prévisionnelles mensuelles avec régularisation annuelleDate de réalisation du diagnostic énergétique : 27/11/2023Consommation énergie primaire : 190 kWh/m²/anConsommation énergie finale : Non communiquéMontant estimé des dépenses annuelles d\'énergie pour un usage standard : entre 800 € et Non communiqué € par an. Prix moyens des énergies indexés sur l\'année 2021 (abonnements compris)Les informations sur les risques auxquels ce bien est exposé sont disponibles sur le site Géorisques : www.georisques.gouv.fr'),
(54, 'Appartement 3 pièces 61 m²', 3, '175 Rue Gabriel', 83000, 'Toulon', 13, '2023-11-21 14:05:48', 'CHAMPS DE MARS\nProche universités et toutes commodités, beau type 3 traversant, situé au 3ème étage avec ascenseur, comprenant un hall d\'entrée, un séjour, deux chambres, une cuisine équipée donnant sur petit balcon, une salle de bains, un wc, un cellier, une place de parking privative. A VOIR. Honoraires d\'agence état des lieux compris : 715.20 euros Montant estimé des dépenses annuelles d\'énergie pour un usage standard : entre 580.0 € et 830.0 € pour 2021.Référence annonce : 2957Consommation énergétique : 109 kWh/m²/anEmission de gaz à effet de serre : 23 CO2/m²/anHonoraires à la charge du locataire : 715 € TTC dont 183 € pour l’état des lieuxDépôt de garantie : 745 €Montant des charges : 110 € / moisModalité de récupération des charges locatives : provision avec régularisation annuelle'),
(55, 'Appartement 2 pièces 48 m²', 2, '48 Bd de Pont de Vivaux', 13001, 'Marseille', 13, '2023-08-29 17:40:54', 'APPARTEMENT T2 REFAIT A NEUF\nIdéalement situé secteur République, Sadi Carnot. Appartement de type 2 situé au 4ème étage avec ascenseur. Il est composé d\'un séjour avec un coin une cuisine aménagé (plaques, hotte, meubles), une chambres avec placards et une salle d\'eau avec WC.Il est proche des commerces et des transports.Référence annonce : MARSEILLE2SC1Consommation énergétique : 208 kWh/m²/anEmission de gaz à effet de serre : 6 CO2/m²/anHonoraires à la charge du locataire : 625 € TTCDépôt de garantie : 695 €Montant des charges : 70 € / mois'),
(56, 'T3 Meublé haut de gamme - 63m² - 2 Chbs', 3, '1 Place de l\'Hippodrome', 69001, 'Lyon', 13, '2023-09-08 02:47:59', '/!\\ DISPONIBLE A PARTIR DU 1er DECEMBRE /!\\\nAppartement de 63m² dans immeuble de canuts (1820), idéalement situé dans le 1er arrondissement au pied des pentes, en plein cœur du quartier historique de la Croix-Rousse.Vue dégagée sur le jardin des plantes et le théâtre antique de Croix-Rousse situés au pied de l\'immeuble, pas de vis à vis en façade est.A 100m de l\'arrêt de bus de la mairie du 1er (Lignes 13, 18 et S6) de la place Rouville, et de la place Sathonay.A 5 minutes à pieds de la place des terreaux, moins de 10 minutes du métro Hôtel de ville, 3 minutes des quais de Saône, 3 minutes de la place Rouville, 7 minutes de la gare Saint-Paul et 20 minutes de Bellecour.A mi-chemin entre les plus agréables marchés de Lyon (Croix-Rousse et Saint-Antoine)Quartier très agréable, entre les pentes de la croix-rousse et la presqu\'ile, nombreux commerces, restaurants et lieux de vie à proximité.Appartement entièrement rénové, avec des prestations soignées, des poutres apparentes, une double exposition sud / est, une vue dégagée sur le jardin des plantes et ses arbres centenaires.Situé au 5 ème étage avec ascenseur, dans un immeuble très calme, bien entretenu, avec des parties communes alliant le cachet de l\'ancien et un entretien soigné.Une grande pièce de vie avec salon et cuisine ouverte de 26 m², 2 Chambres de 13 m² et 10 m² (équipées chacune de lits doubles, mais pouvant être aménagées en chambre pour enfants pour l\'une des deux ou en bureau), une salle de bain avec douche et des WC indépendants.Une cour intérieure abrite un garage à vélos.Entièrement équipé de meubles, de matériels, d\'accessoires et d\'électroménagers neufs, rénové, meublé et décoré avec soin.Chauffage individuel électrique neuf.Possibilité de louer une place de stationnement dans un parking collectif sécurisé situé à 100 m (en fonction des disponibilités).Idéal cadre en mutation ou en mission, jeune couple avec enfant(s).La location est proposée toutes charges comprises (charges forfaitaires)Plan et photos ci-joints.Plus d\'informations sur demande par email.Agences et professionnels s\'abstenir définitivement.Loyer Total : 1 500 €Charges forfaitaires : 200 €Soit un coût total mensuel : 1 700 €Zone soumise à encadrement des loyers.Loyer de référence : 880,10 €Loyer de référence majoré : 957,60 €Complément de loyer : 542,20 €Le complément de loyer est justifié par la nature des prestations offertes par le logement qui vont bien au-delà du strict minimum exigible dans le cadre de la location meublée :Connexion Internet par fibre, Aspirateur sans fil, fer à repasser et planche, Télévision grand format, linges de lit, linges de toilettes, lave-vaisselle, four classique, four micro-onde, machine à laver le linge, cafetière expresso, Poste radio, Grille pain, Nombreux accessoires de cuisine, garage vélo dans la cour.'),
(57, 'Appartement 4 pièces 97 m²', 4, '20-24 Rue des Pommiers', 49700, 'Dou-en-Anjou', 13, '2023-01-12 06:09:10', 'Appartement 4 pièces 97 m²\nA LOUER DOUE Bel appartement, idéalement situé, comprenant, trois chambres, salon séjour, cuisine simple, dressing, salle de bains, dégagement et WC. Chauffage fuel compris.REF: 2794 DPE: GDisponible le 03/01/24Contactez Véronique, votre référente Location du secteur au [Coordonnées masquées] .Notre agence L\'ADRESSE ANJOU MAINE vous accompagne dans tous vos projets : achat, vente, location, gestion, syndic, neuf.Les informations sur les risques auxquels ce bien est exposé sont disponibles sur le site : Géorisques: www.georisques.gouv.frSurface : 97 m²Loyer : 617 € / mois (charges comprises)Montant des charges : 90 € / moisModalité de récupération des charges locatives : Prévisionnelles mensuelles avec régularisation annuelleHonoraires à la charge du locataire : 527 € dont 291 € pour l’état des lieuxDépôt de garantie : 527 €Date de réalisation du diagnostic énergétique : 21/11/2023Consommation énergie primaire : 352 kWh/m²/anConsommation énergie finale : Non communiquéLogement à consommation énergétique excessive : classe G'),
(58, 'Appartement 3 pièces 62 m²', 3, '10 Rue des Voisins', 64270, 'Salies-de-Barn', 13, '2023-11-15 13:51:14', 'Appartement T3 À Louer\nAppartement charmant avec balcon, construit en 1900, d\'une superficie de 62m² en excellent état. Situé à Salies-de-Béarn, Pyrénées-Atlantiques. Comprenant 2 chambres , 1 salon et 1 salle d\'eau. Prix demandé : 650 EUR.Référence annonce : SCPL-UYQ-1FLDate de réalisation du diagnostic : 27/10/2023Honoraires à la charge du locataire : 558 € TTC dont 186 € pour l’état des lieuxDépôt de garantie : 1300 €Montant estimé des dépenses annuelles d\'énergie pour un usage standard : entre 894 € et 1210 € par an. Prix moyens des énergies indexés sur l\'année 2019 (abonnements compris)'),
(59, 'Appartement 2 pièces 39 m²', 2, '3-1 Rue José Maria de Heredia', 34000, 'Montpellier', 13, '2020-02-10 04:48:48', 'Appartement 2 pièces 39 m²\nExclusivité ! Montpellier - Boutonnet - Aiguelongue ! Proche Facultés de Pharmacie, dans résidence récente de standing et en dernier étage, superbe appartement F2. Beau séjour exposé sud donnant sur terrasse de 18m2, cuisine équipée, chambre avec placard, salle d\'eau. Prestations de qualité. Clim réversible. Possibilité parking sous-sol (63 +5 = 68 EUR). A saisir !Surface habitable 39.41 M2 /DPE CLASSE ÉNERGIE C 117 - CLASSE CLIMAT A 3 /LOYER 696 EUR par mois Charges Comprises dont :- Charges locatives (provisions avec régularisation annuelle) : 40 EUR par mois- DISPONIBILITÉ : IMMÉDIATE -- Rue des Jasmins -/ Zone soumise à encadrement des loyers :- Loyer de référence majoré (loyer de base à ne pas dépasser) : 656.31 EUR- Loyer de base : 546.27 EUR- Complément de loyer : 0.00 EURACTEUR SUD[Coordonnées masquées]Surface : 39 m²Loyer : 696 € / mois (charges comprises)Montant des charges : 40 € / moisModalité de récupération des charges locatives : Prévisionnelles mensuelles avec régularisation annuelleHonoraires à la charge du locataire : 512.33 € dont 117.90 € pour l’état des lieuxDépôt de garantie : 656 €Date de réalisation du diagnostic énergétique : 16/11/2023Consommation énergie primaire : 117 kWh/m²/anConsommation énergie finale : Non communiquéZone soumise à encadrement des loyers.Loyer de base : 546.27 €.Loyer de référence majoré (loyer de base à ne pas dépasser) : 656.31 €.'),
(60, 'Appartement 2 pièces 35 m²', 2, '4-10 Rue de la Pommeraie', 66500, 'Prades', 13, '2023-03-01 18:01:09', 'Appartement 2 pièces 35 m²\nSitué au troisième étage d\'un immeuble sans ascenseur, venez découvrir cet appartement deux pièces. Il est composé d\'une cuisine équipée ouverte sur un séjour, une chambre avec placard, une salle de bain et un WC. Contactez Mme SIRAJ au [Coordonnées masquées] !  Contactez nous ! LDJ IMMOBILIERSurface : 35 m²Loyer : 390 € / mois (charges comprises)Montant des charges : 20 € / moisHonoraires à la charge du locataire : 385 € dont 105 € pour l’état des lieuxDépôt de garantie : 370 €Consommation énergie primaire : Non communiquéConsommation énergie finale : Non communiqué'),
(61, 'Appartement 3 pièces 59 m²', 3, '3 Chem. du Verdier', 71120, 'Charolles', 13, '2023-06-22 05:08:10', 'Appartement 3 pièces - Charolles\nVenez profiter de la vue dégagée donnant sur un parc verdoyant et arboréAppartement se composant deux chambres , séjour ouvert sur balcon, nombreux placards, salle d\'eau avec douche.Loué avec une cave.Pratique: école et lycée à 5 minutes à pied.Ascenseur : nonStationnement : nonCharges avec chauffage inclus.0 frais d\'agence0 frais de dossierDépôt de garantie, 1 mois, payable en deux foisLes informations sur les risques auxquels ce bien est exposé sont disponibles sur le site Géorisques : www.georisques.gouv.frRéférence annonce : PARA106004023LConsommation énergétique : 204 kWh/m²/anEmission de gaz à effet de serre : 47 CO2/m²/anDépôt de garantie : 308 €Montant des charges : 177 € / mois'),
(62, 'Duplex 4 pièces 92 m²', 4, '42 Rue Pétrus Maussier', 42000, 'Saint-tienne', 13, '2023-03-08 23:27:37', 'Duplex 4 pièces 92 m²\nF4 DUPLEX MEUBLE rénové situé au 17 rue Bergson ST-ETIENNE CARNOT au 3ème étage d\'un petit immeuble, proximité immédiate Cité du Design et toutes commodités (tram, commerces, gare), idéal colocation.Entrée avec placard, cuisine équipée (four, plaques, hotte, LV, frigo) ouverte sur lumineux séjour, 1 grande chambre avec placard (côté rue), 1 grande chambre avec placard (côté cour), 1 chambre à l\'étage, sdb avec douche à l\'italienne, double vasque et MAL, wc séparé, chauff ind gaz, double vitrage, interphone, libre de suite.classe énergie D (DPE D en date du 13/01/22 estimation coûts annuels d\'énergie entre 1410euros et 1980euros prix moyens des énergies au 01/01/21)Visite virtuelle: https://view.ricohtours.com/70418c45-f941-4b6a-b617-6f9356076aee?type=compactLoyer: 654euros Charges: 45euros DDG: 1308euros Honoraires: 490,50euros (dont 275euros pour l\'EDL)Loire Investissement [Coordonnées masquées]Surface : 92 m²Loyer : 699 € / mois (charges comprises)Montant des charges : 45 € / moisModalité de récupération des charges locatives : Prévisionnelles mensuelles avec régularisation annuelleHonoraires à la charge du locataire : 490.50 €Dépôt de garantie : 1308 €Date de réalisation du diagnostic énergétique : 13/01/2022Consommation énergie primaire : 227 kWh/m²/anConsommation énergie finale : Non communiqué'),
(63, 'Appartement 3 pièces 67 m²', 3, '69 Rue du Pressoir Médiéval', 12400, 'Saint-Affrique', 13, '2023-05-29 21:17:43', 'Appartement 3 pièces 67 m²\nLocation Saint Affrique, centre-ville, à louer appartement type 3 en 2e étage, 67m² habitables, deux chambres, salon séjour, cuisine semi-équipée (plaque gaz et hotte).Disponible le 01/12/2023.Loyer : 480.00 € Dont provision sur charges : 45 € par mois (régularisation annuelle). Honoraires charge locataire : 281,88 € TTC dont Frais de visite / dossier / rédaction du bail 156,60 € TTC et honoraires état des lieux : 125,28 € TTC. Dépôt de garantie : 435 €.Surface : 67 m²Loyer : 480 € / mois (charges comprises)Montant des charges : 45 € / moisModalité de récupération des charges locatives : Prévisionnelles mensuelles avec régularisation annuelleHonoraires à la charge du locataire : 281.88 € dont 125.28 € pour l’état des lieuxDépôt de garantie : 435 €Date de réalisation du diagnostic énergétique : 14/11/2011Consommation énergie primaire : 139 kWh/m²/anConsommation énergie finale : Non communiqué'),
(64, 'Studio 1 pièce 28 m²', 1, '37 Rue des Bergers', 67290, 'Tieffenbach', 13, '2023-06-23 14:34:25', 'Studio 1 pièce 28 m²\nNouveauté à Tieffenbach - Studio de 28,32m2 - idéal pour respirer l\'air de la campagne !DIsponible 1er janvier 2024 !Loyer hors charges : 285 eurosLoyer charges comprises : 320 euros, comprenant l\'eau froide, l\'entretien des communs, l\'électricité des communs et l\'antenne collectiveAgencement :- 1 pièce de vie- 1 salle d\'eau- 1 cuisine avec lave vaisselle neuf, four, régrigérateur, hotte, plaque de cuisson, lave lingeles +++ :- 1 place de parking extérieure couverteSurface : 28 m²Loyer : 320 € / mois (charges comprises)Montant des charges : 35 € / moisModalité de récupération des charges locatives : Prévisionnelles mensuelles avec régularisation annuelleHonoraires à la charge du locataire : 285 € dont 84 € pour l’état des lieuxDépôt de garantie : 285 €Consommation énergie primaire : Non communiquéConsommation énergie finale : Non communiqué'),
(65, 'Appartement 2 pièces 41 m²', 2, '10 Rue Jules Vallès', 31270, 'Cugnaux', 13, '2023-08-25 03:23:56', 'Loggia : 14.4 m²\nDans une résidence récente située Boulevard de Maurens à CUGNAUX 31270, très bel appartement T2 en rez de chaussé surélevé de 41.5 m².L\'appartement se compose d\'une cuisine meublée et équipée (plaques vitrocéramiques, hotte, réfrigérateur et four) ouverte sur un séjour lumineux.La pièce de vie donne sur une agréable terrasse de 14m².Salle de bain agrémentée de meuble sous vasque, miroir, baignoire avec faïence et machine à laver.Une belle chambre.Tous les logements bénéficient notamment de larges baies vitrées, d’une grande terrasse habillée de claustras ajourés et offrent de multiples rangements. Chaque logement est également équipé d’une chaudière individuelle au gaz et d’un visiophone.2 Places de parking.Le montant moyen estimé des dépenses annuelles d’énergie pour un usage standard est de 283 euros (année de référence des prix de l’énergie utilisés pour établir cette estimation : 2015)A proximité :À 15 km au sud de Toulouse, la ville de Cugnaux s’impose comme l’une des plus attractives du sud-ouest toulousain, proche de la nature et à proximité des grands centres économiques de l’agglomération.A 5 km, la zone d’activités de Portet-sur-Garonne, à 6 km, Thales Alinea Space et à 15 min d’Airbus.A proximité : Arrêt de bus ligne 57 et 47, métro ligne A, accès au périphérique à 5 minutes.Loyer : 468.91 euros + 50 euros de charges ( entretien des parties communes et provision sur l\'eau froide avec régularisation annuelle )LOYER CC : 518.91 euros.Dépôt de garantie : 568.91 eurosHonoraires de location : 539.5 dont EDLE : 124.50 euros.LOGEMENT DISPONIBLE LE 08/12/23Référence annonce : AUD-1708-01-17Honoraires à la charge du locataire : 539 € TTCMontant des charges : 50 € / moisModalité de récupération des charges locatives : provision avec régularisation annuelle');
INSERT INTO `Logements` (`id_logement`, `nom_logement`, `nb_pieces`, `rue_logement`, `cp_logement`, `ville_logement`, `id_commercial`, `DateAjout`, `DescriptionLogement`) VALUES
(66, 'Appartement 4 pièces 87 m²', 4, '410 Rue aux Chiens', 45160, 'Olivet', 13, '2023-02-19 17:47:55', 'Appartement 4 pièces 87 m²\nA LOUER COLOCATION A OLIVETL\'appartement dispose de trois chambres, ce qui en fait un choix idéal pour un groupe d\'amis, des étudiants ou des jeunes professionnels qui souhaitent vivre ensemble. Chaque colocataire aura sa propre chambre privée pour plus d\'intimité.De plus, l\'appartement est également à proximité des commerces et transports en commun. Vous trouverez des supermarchés, des boutiques, des restaurants et d\'autres commodités à une distance de marche raisonnable. Cela facilite les courses quotidiennes et offre une variété d\'options pour les sorties et les loisirs.En termes d\'aménagements commun, l\'appartement peut offrir une cuisine entièrement aménagée et équipée, une salle de bains, un salon confortable et éventuellement une buanderie. Les détails spécifiques dépendront de l\'appartement réel que vous recherchez.Une place de parking mise à disposition pour les colocataires.Disponible de suiteLoyer : 440 € dont 50€ de charges (eau chaude et froide, électricité, chauffage et internet.)Dépôt de garantie : 390€Honoraire : 90€ dont 60€ pour la réalisation de l\'état des lieux d\'entrée.Les informations sur les risques auxquels ce bien est exposé sont disponibles sur le site Géorisques : www.georisques.gouv.frCette chambre en colocation vous est proposée à la location par votre agence La Clé d\'Arc. Contactez Elisa, chargée de ce bien, pour le visiter sans attendre !Surface : 87 m²Loyer : 440 € / mois (charges comprises)Montant des charges : 50 € / moisModalité de récupération des charges locatives : Prévisionnelles mensuelles avec régularisation annuelleHonoraires à la charge du locataire : 90 € dont 60 € pour l’état des lieuxDépôt de garantie : 390 €Date de réalisation du diagnostic énergétique : 20/03/2022Consommation énergie primaire : 309 kWh/m²/anConsommation énergie finale : Non communiquéMontant estimé des dépenses annuelles d\'énergie pour un usage standard : entre 1490 € et 2060 € par an. Prix moyens des énergies indexés sur l\'année 2021 (abonnements compris)Les informations sur les risques auxquels ce bien est exposé sont disponibles sur le site Géorisques : www.georisques.gouv.fr'),
(67, 'Duplex/Triplex 1 pièce 20 m²', 1, '10-3 Chem. de Park Minn', 29740, 'Plobannalec-Lesconil', 13, '2023-04-20 19:21:15', 'Plobannalec, au bourg, studio entièrement rénové\nAu bourg de Plobannalec, studio meublé rénové. Il comprend une cuisine aménagée et équipée, séjour, salle d\'eau et wc, chambre en mezzanine. Il dispose également d\'une cour et d\'une dépendance. L\'appartement sera disponible au 1er septembre. Mandat n°1372. CLASSE ENERGIE : E. CLASSE CLIMAT : B. Estimation des coûts annuels d\'énergie : entre 430 € et 640 €. Dépôt de garantie : 800 €. Loyer : 400 € + 30 € de provision pour charges (eau et copro). Honoraires locataire : constitution du dossier, visites, bail : 276 € + état des lieux : 60 €Les informations sur les risques auxquels ce bien est exposé sont disponibles sur le site Géorisques: www.georisques.gouv.frRéférence annonce : 1372Date de réalisation du diagnostic : 12/08/2022Montant des charges : 30 € / mois'),
(68, 'Appartement 4 pièces 73 m²', 4, '24 Rue des Olivettes', 92220, 'Bagneux', 13, '2023-05-21 03:26:22', 'Appartement 4 pièces 73 m²\nQUARTIER SCHWEITZER-BARBANSON-PAUL VAILLANT COUTURIERÀ louer : quartier Schweitzer-Barbanson-Paul Vaillant Couturier, Guy Hoquet BAGNEUX vous propose cet appartement de 4 pièces de 73 m² à BAGNEUX (92220).Il est situé au 3e étage d\'un immeuble de quatre étages. Il comporte trois chambres.On trouve des écoles de tous niveaux (de la maternelle au lycée) à moins de 10 minutes à pied. Il y a un arrêt de bus à trois minutes de l\'appartement. Pour vos loisirs, vous pourrez compter sur une bibliothèque à proximité. Des restaurants, des commerces, des boulangeries, des supermarchés, des épiceries et deux boucheries sont accessibles.Le loyer mensuel de cet appartement est de 1 380 € CC, avec 90 € de provision sur charges. Un dépôt de garantie de 1 290 € est demandé.Envie d\'en savoir plus sur cet appartement en location ? Prenez contact avec votre agence Guy Hoquet BAGNEUX.Surface : 73 m²Loyer : 1380 € / mois (charges comprises)Montant des charges : 90 € / moisDépôt de garantie : 1290 €Date de réalisation du diagnostic énergétique : 02/11/2023Consommation énergie primaire : Non communiquéConsommation énergie finale : Non communiquéMontant estimé des dépenses annuelles d\'énergie pour un usage standard : entre 1360 € et 1900 € par an. Prix moyens des énergies indexés sur l\'année 2021 (abonnements compris)Les informations sur les risques auxquels ce bien est exposé sont disponibles sur le site Géorisques : www.georisques.gouv.fr'),
(69, 'Appartement 3 pièces 45 m²', 3, '5 Trav. Fontmerle', 6600, 'Antibes', 13, '2023-08-04 14:49:31', 'Appartement 3 pièces 45 m²\nA louer T3 de 42m2 meublé en plein coeur du centre ville d\'Antibes, proche gare des bus et gare SNCF , l\'appartement récemment rénové se situe au 17 avenue Gambetta au 2eme étage sans ascenseur. Il se compose d\'une grande entrée avec placard, d\'un beau séjour lumineux, d\'une cuisine aménagée et équipée, de deux chambres dont une avec grand dressing, d\'une salle de bain et d\'un wc indépendant. Une cave complète les prestations du logement.LIBRE POUR LE 20 NOVEMBRE 2023Contactez vite Océane au [Coordonnées masquées]Surface : 45 m²Loyer : 966 € / mois (charges comprises)Montant des charges : 50 € / moisHonoraires à la charge du locataire : 585 € dont 135 € pour l’état des lieuxDépôt de garantie : 1000 €Date de réalisation du diagnostic énergétique : 04/09/2018Consommation énergie primaire : 173 kWh/m²/anConsommation énergie finale : Non communiqué'),
(70, 'Appartement 4 pièces 105 m²', 4, '35 Rue du Maréchal Niel', 31300, 'Toulouse', 13, '2023-08-06 00:01:33', 'Location Toulouse - Arènes / rue des Arcs St Cyprien. Dans une résidence calme et sécurisée, spacieux et lumineux appartement T4 bis de 105,5m2 à louer. Le logement se compose d\'une entrée desservant un double séjour donnant sur un balcon, une grande cuisine indépendante aménagée et équipée avec balcon, trois chambres avec placards, un dressing et une salle d\'eau.Ses atouts: appartement très lumineux, climatisation, garage sous sol avec cellier.Référence annonce : 0010312033-5367860Date de réalisation du diagnostic : 19/04/2021Honoraires à la charge du locataire : 1371 € TTCDépôt de garantie : 1062 €Montant des charges : 110 € / moisModalité de récupération des charges locatives : provision avec régularisation annuelle');

-- --------------------------------------------------------

--
-- Structure de la table `Photos`
--

CREATE TABLE `Photos` (
  `id_photo` int(11) NOT NULL,
  `chemin_photo` varchar(200) NOT NULL,
  `id_equipement` int(11) DEFAULT NULL,
  `id_piece` int(11) DEFAULT NULL,
  `id_logement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Photos`
--

INSERT INTO `Photos` (`id_photo`, `chemin_photo`, `id_equipement`, `id_piece`, `id_logement`) VALUES
(17, 'Paris.jpg', NULL, NULL, 16),
(18, 'Chambre.jpg', NULL, 111, 16),
(19, 'Lyon.jpg', NULL, NULL, 17),
(20, 'Chambre2.jpg', NULL, 115, 17),
(21, 'Chambre.jpg', NULL, 115, 17),
(22, 'Chambre2.jpg', NULL, 123, 19),
(23, 'Chambre2.jpg', NULL, 119, 18),
(24, 'Cuisine.jpg', NULL, 112, 16),
(25, 'Cuisine.jpg', NULL, 116, 17),
(26, 'Cuisine.jpg', NULL, 120, 18),
(27, '', NULL, 124, 19),
(28, 'Salon.jpg', NULL, 114, 16),
(29, 'Salon.jpg', NULL, 118, 17),
(30, 'Salon.jpg', NULL, 126, 19),
(32, '831f27a1ccd89ce1855d4e1cabad5e4c23f28d76.jpg', NULL, NULL, 27),
(33, 'ea24b0c3c3208b6e78b9504ec667e8a0eb1a4047.jpg', NULL, NULL, 27),
(34, '3060ce422cc6b46dd0e15b01f0407137aca3645d.jpg', NULL, NULL, 27),
(35, 'ab00c785feeda5ec6cbffc78424f2027beaa0052.jpg', NULL, NULL, 28),
(36, '5537940fdf19d530af7fb51fdd591bad1174e758.jpg', NULL, NULL, 28),
(37, 'a92431a674d6430bdeb15b8f8e8d593b86986712.jpg', NULL, NULL, 28),
(38, 'bc7c828cd29198e5f6af18aa0a1327571208017a.jpg', NULL, NULL, 30),
(39, '9c424de4a0b4a7b44b668418a6fc4158470de45d.jpg', NULL, NULL, 30),
(40, 'e6429c990ed525ec526c89f73ad1b3bb3cda2b58.jpg', NULL, NULL, 30),
(41, '9e38e3c86d11fc2fbd7be4e529b81ca9de150fa3.jpg', NULL, NULL, 31),
(42, '39405af363086ac941987785573e469c383d3563.jpg', NULL, NULL, 31),
(43, '9ac29d41ba46a0c36b3a68d6bc3f285fa3534c46.jpg', NULL, NULL, 31),
(44, 'cf739eccf0f1d80e171d070cb44a64d6441c0248.jpg', NULL, NULL, 32),
(45, 'b85ec04ccb14889e738b4aa36548e0acc5dd73cb.jpg', NULL, NULL, 32),
(46, 'a3b4d86a8294b562c13db8b27bfbf6e59a1f46c6.jpg', NULL, NULL, 32),
(47, '42e22020b2aba4cf93d831a8d7cb9811acb3643b.jpg', NULL, NULL, 33),
(48, 'ee7864ae757518e9a866b3d27039f7ffdfa7e7e0.jpg', NULL, NULL, 33),
(49, '3c86f27f2d8ff281d0cd911442c22494a8b224f7.jpg', NULL, NULL, 33),
(50, 'f132f782c0cb6cd29dc2774a10784b9a9bddebd9.jpg', NULL, NULL, 34),
(51, '0cf97e5d5150a3ff4946494b44d25274ca2b5ca4.jpg', NULL, NULL, 34),
(52, '40930c7dfe7d114a5068c6d1e3af10c1f340dcf0.jpg', NULL, NULL, 34),
(53, 'c9437151cb612361368f03cb32095d0882a2a23a.jpg', NULL, NULL, 35),
(54, '6cd4918851c1b81d4da0fa64938953e5362ec5d9.jpg', NULL, NULL, 35),
(55, '72091e7a622a4d76810ce2f57567c934a674ccac.jpg', NULL, NULL, 35),
(56, '1a3acc6fec1c3428f07ef8f3a5de335a52719125.jpg', NULL, NULL, 36),
(57, 'bdbb7cd6562ddc619d830eaced495ab64332a09d.jpg', NULL, NULL, 36),
(58, '5ca9862cfbb80d4b0b5dc255099d3ed54471f554.jpg', NULL, NULL, 36),
(59, 'e655f3eb26dfad55370c3d0746f4152f5e2ec64c.jpg', NULL, NULL, 37),
(60, '62a36649dd474824c60499cc72b96c799579d963.jpg', NULL, NULL, 37),
(61, 'e3ef5d911decb4736d751161e950504bedbb26ee.jpg', NULL, NULL, 37),
(62, '79419b86989619b54b2048ccf380080095055ad3.jpg', NULL, NULL, 38),
(63, 'e5ed8a0864823c0f3fe240a0c790f1ef60f60472.jpg', NULL, NULL, 38),
(64, '95a4b11e98550bd2d5792a4fe7ec52bb7b8a266c.jpg', NULL, NULL, 38),
(65, '8ef33d71226470d211ff0543692af7a1efa91e4b.jpg', NULL, NULL, 39),
(66, '95f9f143315efb13738ae117543ef5b5177b3c97.jpg', NULL, NULL, 39),
(67, 'ff1fad284a09fe017269e767ebcbbb2635b026f0.jpg', NULL, NULL, 39),
(68, '0f583d7fb53d091c6108e3ff17e632fa86c32d60.jpg', NULL, NULL, 40),
(69, '8135279b24f7c9d615d42595eb23306628e08ee3.jpg', NULL, NULL, 40),
(70, 'e5f6220fb684f124b12f16bd3db26be128585c68.jpg', NULL, NULL, 40),
(71, '6e3d0cfc6716116d4d393b1df90c2c0f60994209.jpg', NULL, NULL, 41),
(72, 'c82b86448333720aebc7758ad097133b8f2183be.jpg', NULL, NULL, 41),
(73, '9f5ab2ee6a09b561c9c406d4547ff14b2696cd86.jpg', NULL, NULL, 41),
(74, '2c472358008257a5f4668991c3d7779bbb12deea.jpg', NULL, NULL, 42),
(75, '46aba58f60adb1eedb14e1053f533e7c90c9f25a.jpg', NULL, NULL, 42),
(76, '373635b1dcb37e32cd785533417b4f1500afbce5.jpg', NULL, NULL, 42),
(77, '6640b93ae012519c509c955a6e2e64d3659591db.jpg', NULL, NULL, 43),
(78, '6aed689058b5d9277afebed28db854dc6177212c.jpg', NULL, NULL, 43),
(79, 'a9f7b0d7444039833b765cbb46f636f4f79687f8.jpg', NULL, NULL, 43),
(80, '692b7b5ad69fa7a0aff9f526b781e79dc44b596d.jpg', NULL, NULL, 44),
(81, '9e3c76e850c7d3b4119c16ce30052fe94ee0d916.jpg', NULL, NULL, 44),
(82, 'e17c4cb763f85790885b0476133fd11d53c45cf9.jpg', NULL, NULL, 44),
(83, '7b805fe34d3eea0a5ade9cb1e3b605b129566498.jpg', NULL, NULL, 45),
(84, '58d11b9f873de17fc3c1117f539b5e0fd1ec5e29.jpg', NULL, NULL, 45),
(85, 'f163412742c71b64738eaea833e8401dd6960087.jpg', NULL, NULL, 45),
(86, '4300c5226ea8b8113a9c3d5ff0373a9ee4bb0240.jpg', NULL, NULL, 46),
(87, '8711f08898b75cc353114171574cc34c38b699f0.jpg', NULL, NULL, 46),
(88, 'f66a98e0854d36278f1eafbd48836baf92611ab7.jpg', NULL, NULL, 46),
(89, '08db31cb51e0c1cfdda24bbc2438d824bf1ada98.jpg', NULL, NULL, 47),
(90, '7e2a50c9beca3611f4b70634dd91fd8474628d47.jpg', NULL, NULL, 47),
(91, '7602bb2abdd0224a9ee0f32f31305d6b8ed92a95.jpg', NULL, NULL, 47),
(92, '43773cdce35f6df0f5d30f7d21be337344bb91de.jpg', NULL, NULL, 48),
(93, 'ce8523891a24b19c72d6eafe917ebb553f6f4686.jpg', NULL, NULL, 48),
(94, 'e41687e378f17fbd58c40f162be057387b0c90a0.jpg', NULL, NULL, 48),
(95, '999226edfc72d95e40814f1073fc8314fb561c1a.jpg', NULL, NULL, 49),
(96, '75d5a89dd43d5f6dd8635b004ba8f3c6631bf07e.jpg', NULL, NULL, 49),
(97, 'ba3d54ba97f783c14ac2d97482d85527add97e1b.jpg', NULL, NULL, 49),
(98, 'bc21a9123943fef4ab79749357e1b7ed66c92367.jpg', NULL, NULL, 50),
(99, 'e941cca9d940477c4af4bff9120396ee92c712c0.jpg', NULL, NULL, 50),
(100, '542c7bbfa821fe2e9bee56ada916cf43a11a7ffc.jpg', NULL, NULL, 50),
(101, '8ffa3eab4f06aaefc20e476ddacec12e4d2f0292.jpg', NULL, NULL, 51),
(102, 'c946d4e747a94cc95eb2e02a50b3b7eb93609505.jpg', NULL, NULL, 51),
(103, '6f914e0eabf02378dc310a442a88a19a6ec9e436.jpg', NULL, NULL, 51),
(104, 'f62fb08babf089f3bfb3fd3fd2d15b3d09cb72ce.jpg', NULL, NULL, 52),
(105, 'ca1a553d6b447b2baa36198335b394ce8986da8d.jpg', NULL, NULL, 52),
(106, '10dd9be292f507e6cb4b154a2fa79c850a8eb4e7.jpg', NULL, NULL, 52),
(107, '0c307d57bc11f57a3f273aa7b9d6a115f8824058.jpg', NULL, NULL, 53),
(108, '389f230e8950ab563c0fb97d373cda953896af65.jpg', NULL, NULL, 53),
(109, 'a306f38cc825705bc8da81ff31538a1fb72fb84d.jpg', NULL, NULL, 53),
(110, '47604db57ad5db2caa234c1adfc599a6680e87e5.jpg', NULL, NULL, 54),
(111, '018fc41bbd52d76d3d56f38fc95a94c641527e84.jpg', NULL, NULL, 54),
(112, 'dc05d07f23e5fbf560cae75b2e6e9befc003270c.jpg', NULL, NULL, 54),
(113, 'a7c6b4c524a26bad7ac620b4fe6c943ab674e97e.jpg', NULL, NULL, 55),
(114, '3108c28570c01875638366f0d6596a3ea9ecdca8.jpg', NULL, NULL, 55),
(115, '3fc2c6389ffd997fa3818f5e3e8a57b0c90fcc54.jpg', NULL, NULL, 55),
(116, '031abe6a239ff2a200150b3c2e4abb77368558ca.jpg', NULL, NULL, 56),
(117, '916ab80ca3a253fa1a5a6b16e55b5fc8c3e5b1c5.jpg', NULL, NULL, 56),
(118, 'd831ff7de3a16ab6993283f6e6c1f2fe216b72ae.jpg', NULL, NULL, 56),
(119, '749f1a3399c065c1828a5cc06d9c9a71464a6f58.jpg', NULL, NULL, 57),
(120, '111d3b5ae0b7557acf72f2195939fad8668b0989.jpg', NULL, NULL, 57),
(121, '4706894a36b133910253f5844426e6ad341b8a93.jpg', NULL, NULL, 57),
(122, 'd3d6ecbd5c0a651ff25d3db1b4400bffa860063c.jpg', NULL, NULL, 58),
(123, '40e3e6eee83bd62d1dbe5ecc43def42a33089672.jpg', NULL, NULL, 58),
(124, '91075fe4f9d96f936ddbb354aaa37ea84ceac5d5.jpg', NULL, NULL, 58),
(125, '4fc2306320e3fd82b035fdc26cd2e6890d28052f.jpg', NULL, NULL, 59),
(126, '0abc4e232407700b5eef92f2eba6ba19018c1b07.jpg', NULL, NULL, 59),
(127, '863378694b9bc47f2b68fe0e1bddcd0bd4d0123d.jpg', NULL, NULL, 59),
(128, 'df535068be1b3cc925853e87b2288d7b7bf1f383.jpg', NULL, NULL, 60),
(129, '74db867f14d28e86225132b76db3a6ddfd7c60ae.jpg', NULL, NULL, 60),
(130, '20135db7fb4fe79d2301f991ce1e278015b95716.jpg', NULL, NULL, 60),
(131, 'a42c9960ef4e448f326c26c3f00d3a615d177a36.jpg', NULL, NULL, 61),
(132, 'aaebf6c931fe069614c700c96cc9cfa3688026bd.jpg', NULL, NULL, 61),
(133, '3628b3f505a8eb282dd5c4e8809df18630591f45.jpg', NULL, NULL, 61),
(134, 'd1935059a1ed4a12588e69fcf52ccb76a2f79b53.jpg', NULL, NULL, 62),
(135, 'b9baf20a887158d9a43cd84a0c588259c94fa46f.jpg', NULL, NULL, 62),
(136, 'bf374ea6409e85b3a3889b7cb2c972619dbc6bf4.jpg', NULL, NULL, 62),
(137, 'a047657df16005fd6461ea8242aeb6dadb18d37c.jpg', NULL, NULL, 63),
(138, '2c14386022566c1f94ac75862252530dcde918a6.jpg', NULL, NULL, 63),
(139, '513eb2b39d2eab6c9d3e23c5a19383e83d6eb077.jpg', NULL, NULL, 63),
(140, 'a5bb26e6349e8c2bac2f4ff90a8d088c6c154c76.jpg', NULL, NULL, 64),
(141, '36f41f7ccc4fde9bae76d3482a667f426e56a29b.jpg', NULL, NULL, 64),
(142, '1bb702899f45465521941ff8a1b2ea8b25d00890.jpg', NULL, NULL, 64),
(143, '337b8db82a1f694e1d70fd34aca792e6422f094f.jpg', NULL, NULL, 65),
(144, '10d0c34ec0beb531fb1db804bdeca6149cb48882.jpg', NULL, NULL, 65),
(145, '04c117d79fff8989cd9757fde75753974cbf093d.jpg', NULL, NULL, 65),
(146, '6e27d462304ee724249c1027c0299b65c21847cd.jpg', NULL, NULL, 66),
(147, 'b3910afedc7e052873202f4afefffe3275b3ee78.jpg', NULL, NULL, 66),
(148, '5cfb3bcc701b846b2aad5a22acbb9cc35c7932a1.jpg', NULL, NULL, 66),
(149, '5db928db09f7d2dc2248a01eb2e18125cb29adea.jpg', NULL, NULL, 67),
(150, '7a3c0b210b16bb46ec8e768ede7783ef410ecafb.jpg', NULL, NULL, 67),
(151, 'a2b83a0bf8d2cc5627024bc974a267f4fa11ae1e.jpg', NULL, NULL, 67),
(152, '00f93a0f4fa734290edd54aab002fb9902483aa5.jpg', NULL, NULL, 68),
(153, '4a52618b1310b8bbd068d8fab2a7b72f81b4574f.jpg', NULL, NULL, 68),
(154, '90d0bbceec2af48a58c3a839ca07cdefb8899981.jpg', NULL, NULL, 68),
(155, '3b0028103691c86cee4f33807273b4252864f8fc.jpg', NULL, NULL, 69),
(156, '0caf3dc743ca51a3cb4a4d8292b336e151304846.jpg', NULL, NULL, 69),
(157, 'gh0a505bb96cdc1b9cf43fce8dd9eec72a364afa.jpg', NULL, NULL, 69),
(158, 'ebb4f1c788cb15d1817d06c0c87a21035616807f.jpg', NULL, NULL, 70),
(159, 'f2e591754c5c4fda55904d835e61b64dd4826dec.jpg', NULL, NULL, 70),
(160, '3131f6c15afca4fd23933725dc6f2b709471a6a3.jpg', NULL, NULL, 70),
(161, '850abd085b_123792_chambres8.jpg', NULL, 272, 47);

-- --------------------------------------------------------

--
-- Structure de la table `Pieces`
--

CREATE TABLE `Pieces` (
  `id_piece` int(11) NOT NULL,
  `libelle_piece` varchar(200) NOT NULL,
  `surface` double(6,2) NOT NULL,
  `id_logement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Pieces`
--

INSERT INTO `Pieces` (`id_piece`, `libelle_piece`, `surface`, `id_logement`) VALUES
(111, 'Chambre 16-1', 10.50, 16),
(112, 'Cuisine 16-2', 15.20, 16),
(113, 'Salle de bain 16-3', 5.80, 16),
(114, 'Salon 16-4', 20.30, 16),
(115, 'Chambre 17-1', 12.60, 17),
(116, 'Cuisine 17-2', 14.70, 17),
(117, 'Salle de bain 17-3', 6.90, 17),
(118, 'Salon 17-4', 18.10, 17),
(119, 'Chambre 18-1', 11.20, 18),
(120, 'Cuisine 18-2', 13.40, 18),
(121, 'Salle de bain 18-3', 7.30, 18),
(122, 'Salon 18-4', 21.80, 18),
(123, 'Chambre 19-1', 9.70, 19),
(124, 'Cuisine 19-2', 16.20, 19),
(125, 'Salle de bain 19-3', 8.40, 19),
(126, 'Salon 19-4', 19.60, 19),
(141, 'Salon 27-1', 17.49, 27),
(142, 'Salon 27-1', 18.54, 27),
(143, 'Salon 27-1', 7.90, 27),
(144, 'Chambre 27-1', 14.66, 27),
(145, 'salle de bain 27-1', 7.49, 27),
(146, 'celliers 27-1', 9.37, 27),
(147, 'Salon 28-1', 10.31, 28),
(148, 'Salon 28-1', 10.19, 28),
(149, 'Chambre 28-1', 16.31, 28),
(153, 'Salon 30-1', 10.85, 30),
(154, 'Chambre 30-1', 13.25, 30),
(155, 'Salon 31-1', 17.97, 31),
(156, 'Chambre 31-1', 20.18, 31),
(157, 'salle de bain 31-1', 11.38, 31),
(158, 'Salon 32-1', 18.47, 32),
(159, 'Chambre 32-1', 10.69, 32),
(160, 'Chambre 32-1', 13.68, 32),
(161, 'salle de bain 32-1', 20.90, 32),
(162, 'Salon 34-1', 14.60, 34),
(163, 'Salon 34-1', 8.29, 34),
(164, 'Chambre 34-1', 11.24, 34),
(165, 'Salon 35-1', 17.41, 35),
(166, 'Chambre 35-1', 17.18, 35),
(167, 'Salon 36-1', 13.71, 36),
(168, 'Chambre 36-1', 11.45, 36),
(169, 'Salon 37-1', 11.33, 37),
(170, 'Chambre 37-1', 23.57, 37),
(171, 'salle de bain 37-1', 13.34, 37),
(172, 'Salon 38-1', 12.39, 38),
(173, 'Chambre 38-1', 15.42, 38),
(174, 'salle de bain 38-1', 12.35, 38),
(175, 'Salon 39-1', 17.03, 39),
(176, 'Chambre 39-1', 15.20, 39),
(177, 'salle de bain 39-1', 16.76, 39),
(178, 'Balcon 39-1', 14.70, 39),
(179, 'Salon 40-1', 14.33, 40),
(180, 'Salon 40-1', 15.99, 40),
(181, 'Chambre 40-1', 7.30, 40),
(182, 'salle de bain 40-1', 20.34, 40),
(183, 'Salon 41-1', 14.32, 41),
(184, 'Salon 41-1', 22.62, 41),
(185, 'Chambre 41-1', 17.74, 41),
(186, 'salle de bain 41-1', 18.16, 41),
(187, 'Salon 42-1', 20.44, 42),
(188, 'Chambre 42-1', 24.75, 42),
(189, 'WC 42-1', 14.00, 42),
(190, 'Salon 43-1', 7.97, 43),
(191, 'Salon 44-1', 13.49, 44),
(192, 'salle de bain 44-1', 23.38, 44),
(193, 'Balcon 44-1', 16.36, 44),
(194, 'Salon 45-1', 21.08, 45),
(195, 'Salon 45-1', 11.71, 45),
(196, 'Chambre 45-1', 7.39, 45),
(197, 'Salon 46-1', 15.97, 46),
(198, 'Chambre 46-1', 8.43, 46),
(199, 'WC 46-1', 7.00, 46),
(200, 'Balcon 46-1', 8.66, 46),
(201, 'Salon 48-1', 7.50, 48),
(202, 'Salon 48-1', 16.68, 48),
(203, 'Chambre 48-1', 10.67, 48),
(204, 'Chambre 48-1', 20.26, 48),
(205, 'salle de bain 48-1', 10.71, 48),
(206, 'Balcon 48-1', 12.20, 48),
(207, 'Salon 49-1', 16.55, 49),
(208, 'Salon 49-1', 12.22, 49),
(209, 'Chambre 49-1', 24.81, 49),
(210, 'salle de bain 49-1', 22.03, 49),
(211, 'WC 49-1', 15.50, 49),
(212, 'Salon 50-1', 22.84, 50),
(213, 'Salon 51-1', 12.73, 51),
(214, 'Chambre 51-1', 7.22, 51),
(215, 'Chambre 51-1', 9.37, 51),
(216, 'Balcon 51-1', 12.25, 51),
(217, 'Chambre 52-1', 19.34, 52),
(218, 'salle de bain 52-1', 19.04, 52),
(219, 'Salon 53-1', 7.58, 53),
(220, 'Chambre 53-1', 8.69, 53),
(221, 'salle de bain 53-1', 24.86, 53),
(222, 'Balcon 53-1', 19.25, 53),
(223, 'Salon 54-1', 19.11, 54),
(224, 'Chambre 54-1', 19.84, 54),
(225, 'salle de bain 54-1', 15.70, 54),
(226, 'Balcon 54-1', 19.40, 54),
(227, 'Salon 55-1', 22.93, 55),
(228, 'Chambre 55-1', 18.35, 55),
(229, 'Salon 56-1', 10.38, 56),
(230, 'Salon 56-1', 23.75, 56),
(231, 'Chambre 56-1', 21.05, 56),
(232, 'Chambre 56-1', 9.80, 56),
(233, 'salle de bain 56-1', 15.31, 56),
(234, 'WC 56-1', 23.92, 56),
(235, 'Salon 57-1', 8.14, 57),
(236, 'Salon 57-1', 12.22, 57),
(237, 'Chambre 57-1', 23.73, 57),
(238, 'salle de bain 57-1', 19.06, 57),
(239, 'Salon 58-1', 18.95, 58),
(240, 'Chambre 58-1', 7.98, 58),
(241, 'Balcon 58-1', 18.90, 58),
(242, 'Salon 59-1', 24.35, 59),
(243, 'Chambre 59-1', 10.95, 59),
(244, 'Salon 60-1', 18.76, 60),
(245, 'Chambre 60-1', 14.49, 60),
(246, 'salle de bain 60-1', 12.44, 60),
(247, 'Chambre 61-1', 16.12, 61),
(248, 'Balcon 61-1', 23.28, 61),
(249, 'Salon 62-1', 15.96, 62),
(250, 'Chambre 62-1', 22.78, 62),
(251, 'Salon 63-1', 18.51, 63),
(252, 'Salon 63-1', 13.20, 63),
(253, 'Chambre 63-1', 16.27, 63),
(254, 'Salon 64-1', 17.30, 64),
(255, 'Salon 65-1', 11.74, 65),
(256, 'Chambre 65-1', 8.97, 65),
(257, 'salle de bain 65-1', 14.70, 65),
(258, 'Salon 66-1', 22.65, 66),
(259, 'Salon 66-1', 17.51, 66),
(260, 'Chambre 66-1', 16.96, 66),
(261, 'Chambre 66-1', 14.65, 66),
(262, 'salle de bain 66-1', 21.36, 66),
(263, 'Salon 67-1', 8.37, 67),
(264, 'Chambre 67-1', 7.98, 67),
(265, 'Chambre 68-1', 17.37, 68),
(266, 'Salon 69-1', 8.42, 69),
(267, 'Chambre 69-1', 15.03, 69),
(268, 'salle de bain 69-1', 16.23, 69),
(269, 'Salon 70-1', 10.69, 70),
(270, 'Chambre 70-1', 11.34, 70),
(271, 'Balcon 70-1', 13.77, 70),
(272, 'Chambre 47-1', 11.21, 47),
(273, 'Cuisine 47-2', 15.20, 47),
(274, 'Salon 47-3', 18.10, 47);

-- --------------------------------------------------------

--
-- Structure de la table `PromoCode`
--

CREATE TABLE `PromoCode` (
  `idCode` int(11) NOT NULL,
  `Code` varchar(500) NOT NULL,
  `Type` int(11) NOT NULL,
  `Reduction` int(11) NOT NULL,
  `Enabled` tinyint(1) NOT NULL,
  `DateCreation` timestamp NOT NULL DEFAULT current_timestamp(),
  `UseMax` int(11) NOT NULL,
  `LogId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `PromoCode`
--

INSERT INTO `PromoCode` (`idCode`, `Code`, `Type`, `Reduction`, `Enabled`, `DateCreation`, `UseMax`, `LogId`) VALUES
(0, 'PROMO12', 1, 10, 1, '2023-12-13 08:17:29', 10, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Reservation`
--

CREATE TABLE `Reservation` (
  `id_reservation` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_logement` int(11) DEFAULT NULL,
  `date_debut_demande` date DEFAULT NULL,
  `date_fin_demande` date DEFAULT NULL,
  `reponseDemande` varchar(50) DEFAULT NULL,
  `infoClient` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`infoClient`)),
  `accept` int(11) NOT NULL DEFAULT 0,
  `prixpay` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Reservation`
--

INSERT INTO `Reservation` (`id_reservation`, `id_client`, `id_logement`, `date_debut_demande`, `date_fin_demande`, `reponseDemande`, `infoClient`, `accept`, `prixpay`) VALUES
(23, 2, 55, '2023-12-18', '2023-12-20', NULL, '{\"zip\": \"55698\", \"email\": \"jean@gmail.com\", \"address\": \"123 main st\", \"country\": \"CG\", \"lastName\": \"baptiste\", \"firstName\": \"jean\"}', 1, 600),
(25, 2, 47, '2024-02-03', '2024-02-15', NULL, '{\"zip\": \"55698\", \"email\": \"jean@gmail.com\", \"address\": \"123 main st\", \"country\": \"DZ\", \"lastName\": \"baptiste\", \"firstName\": \"jean\"}', 2, 1618.5),
(28, 4, 58, '2023-12-20', '2023-12-22', NULL, '{\"zip\": \"45000\", \"email\": \"roooot@gmail.com\", \"address\": \"1234 Maint St\", \"country\": \"FR\", \"lastName\": \"rooot\", \"firstName\": \"root\"}', 0, 492),
(29, 2, 48, '2024-02-03', '2024-02-05', NULL, '{\"zip\": \"55487\", \"email\": \"jean@gmail.com\", \"address\": \"123 main st\", \"country\": \"BF\", \"lastName\": \"baptiste\", \"firstName\": \"jean\"}', 1, 600),
(31, 2, 47, '2024-02-03', '2024-02-10', NULL, '{\"zip\": \"55698\", \"email\": \"jean@gmail.com\", \"address\": \"123 main st\", \"country\": \"BN\", \"lastName\": \"baptiste\", \"firstName\": \"jean\"}', 1, 1200),
(34, 2, 47, '2024-02-12', '2024-02-14', NULL, '{\"zip\": \"55698\", \"email\": \"jean@gmail.com\", \"address\": \"123 main st\", \"country\": \"AQ\", \"lastName\": \"baptiste\", \"firstName\": \"jean\"}', 2, 450),
(35, 2, 47, '2024-04-29', '2024-05-01', NULL, '{\"zip\": \"55698\", \"email\": \"jhean@gmail.com\", \"address\": \"123 main st\", \"country\": \"AQ\", \"lastName\": \"baptiste\", \"firstName\": \"jean\"}', 2, 1600),
(36, 2, 47, '2024-04-03', '2024-04-05', NULL, '{\"zip\": \"55000\", \"email\": \"jean@gmail.com\", \"address\": \"123 main st\", \"country\": \"JO\", \"lastName\": \"baptiste\", \"firstName\": \"jean\"}', 2, 600),
(37, 2, 47, '2024-02-12', '2024-02-22', NULL, '{\"zip\": \"55000\", \"email\": \"jean@gmail.com\", \"address\": \"123 main st\", \"country\": \"BN\", \"lastName\": \"baptiste\", \"firstName\": \"jean\"}', 2, 1760),
(38, 2, 19, '2023-12-01', '2023-12-08', NULL, '{\"zip\": \"32200\", \"email\": \"sjkhsfd@gmail.com\", \"address\": \"sdfgsdfjklshdf\", \"country\": \"FK\", \"lastName\": \"SDG\", \"firstName\": \"sdfg\"}', 2, 1200),
(40, 2, 55, '2023-12-30', '2023-12-31', NULL, '{\"zip\": \"532\", \"email\": \"jkhsgdfjshdf@gmail.com\", \"address\": \"skdghfsdkjfh\", \"country\": \"DZ\", \"lastName\": \"sjhdkfg\", \"firstName\": \"Couco\"}', 0, 400),
(41, 6, 30, '2023-12-15', '2023-12-24', NULL, '{\"zip\": \"565\", \"email\": \"test@gmail.com\", \"address\": \"sfjgjf\", \"country\": \"AF\", \"lastName\": \"test\", \"firstName\": \"test\"}', 0, 1480);

-- --------------------------------------------------------

--
-- Structure de la table `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `token` varchar(300) NOT NULL,
  `expiration` timestamp NULL DEFAULT NULL,
  `datecree` timestamp NOT NULL DEFAULT current_timestamp(),
  `idclient` int(11) DEFAULT NULL,
  `idcommercial` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `token`
--

INSERT INTO `token` (`id`, `token`, `expiration`, `datecree`, `idclient`, `idcommercial`) VALUES
(1, 'a8cac7ddac47c97a8f69baa51c5c7e90341db009ed357d73b385db9b9209c58e', '2024-01-11 15:41:54', '2024-01-10 15:41:54', 2, NULL),
(2, 'bd896e30c88a3eb95f2a5d2b859ef9ce52304fca4a46f8ad222acfa79aac0a8e', '2024-01-11 15:51:54', '2024-01-10 15:51:54', NULL, 14),
(3, 'f8914575d4ebbb7549bc8280fa76480db904a7850a5c2562174125591f3e036d', '2024-01-17 09:37:49', '2024-01-16 09:37:49', 2, NULL),
(4, 'dbae5bf73e2be1fb8d431ac914460cd8bf0276fc97f0712191e5dbcfef51d2f5', '2024-03-29 09:35:27', '2024-03-28 09:35:27', 2, NULL),
(8, 'ba158029004a870c2b99368e22aee1857cc32f659197e0026eed803e42cab0e1', '2024-03-29 09:47:24', '2024-03-28 09:47:24', 2, NULL),
(9, 'c72b020652edec0ecf9606fc7cda2186a35b1a8d76c5a8eeeb53229258952db9', '2024-03-29 15:02:25', '2024-03-28 15:02:25', 2, NULL),
(10, 'e87487afecc5ff1f99b8b2a0a430282267571c0971e473d51aa184b6e6868c35', '2024-03-29 15:13:38', '2024-03-28 15:13:38', 2, NULL),
(11, '7f74c23549f78584b6c7683614ecd8f0ecf6234cfd206176dbe708feb9a5b604', '2024-03-29 15:13:42', '2024-03-28 15:13:42', 2, NULL),
(12, 'e48d342589d7aeb771dbff76a4f04dd0d18db2f3d7556ce4071bdb3b85bb20bd', '2024-03-29 15:15:32', '2024-03-28 15:15:32', 2, NULL),
(13, '411d18cb0b8b8869bfed4d3fbeb0e923b4895aa839eee662449da99b2b68b60e', '2024-03-29 15:32:39', '2024-03-28 15:32:39', 2, NULL),
(14, 'f95be293fd28c88f6511d7c3e34105be7e7c71b7d1ab3bd65db32ffa7406f6b3', '2024-03-29 16:02:19', '2024-03-28 16:02:19', 2, NULL),
(15, 'b9a40f2937bd171d921ed2088346c5ed6d2b7ce81f371937b356c49aa524fc2a', '2024-03-29 16:15:17', '2024-03-28 16:15:17', 2, NULL),
(16, 'adbe54650e03e00d2eeac8827494f3ded0a247fb652eb31c9c596205c7258be2', '2024-03-29 16:15:20', '2024-03-28 16:15:20', 2, NULL),
(17, '3f88ccc08d7c0d48cdb3377e7555d35ac7b8fcb2b46630c3eac2474b68c2d180', '2024-03-29 16:15:23', '2024-03-28 16:15:23', 2, NULL),
(18, '5b23e08ca8bb6e26b0251699a7360e401269dfac9342e6b0c2aecf9f73f96986', '2024-03-29 16:15:23', '2024-03-28 16:15:23', 2, NULL),
(19, 'e5b3353948c0dc94f6ca2d94824c6449174180aaa0a501178e9aea183c4f34eb', '2024-03-29 16:15:24', '2024-03-28 16:15:24', 2, NULL),
(20, '3ac05f583c10b33ab77193f203d90aea11d5639bee13ca2ad0e1582f6585ad58', '2024-03-29 16:15:25', '2024-03-28 16:15:25', 2, NULL),
(21, '3d7a7377428c355c0bb9560ad31edd5b1ca2f8f6e2cf69a6767d712f131d1550', '2024-03-29 16:15:25', '2024-03-28 16:15:25', 2, NULL),
(22, '42c478aa219fd75b1bce74e533c6f9bebd1913e244088d475f1d3ba3f717704f', '2024-03-29 16:15:25', '2024-03-28 16:15:25', 2, NULL),
(23, 'c1d925c22cc7c7a262fb96df84b9c0cb5203690e0920a15e4e86964a4a00e387', '2024-03-29 16:15:26', '2024-03-28 16:15:26', 2, NULL),
(24, 'ea5250e5948f4e228ade256dbd5680d9dba85e630033ad07ffbd6b38d8af1b46', '2024-03-29 16:15:26', '2024-03-28 16:15:26', 2, NULL),
(25, 'bf301fbffe2ec40f62c9f1e730bb73aa1195bbec80b6ce16ccfd7a1e59c6e670', '2024-03-29 16:15:26', '2024-03-28 16:15:26', 2, NULL),
(26, '45531d5caf50049904a614e88eab686aaf66b51905823d205178e16cc59f58c6', '2024-04-05 08:56:00', '2024-04-04 08:56:00', 2, NULL),
(28, 'a75b2da8f3242213d7cfc69f3ec01d3520665036d5f98790e5bd7e8c7a46c66c', '2024-04-05 13:49:20', '2024-04-04 13:49:21', 2, NULL),
(29, '2cf08f00013e359d4c66724873c190158ffdd368cea471f4b88138b58d143619', '2024-04-05 14:23:21', '2024-04-04 14:23:21', NULL, 14),
(30, '5a0abc237bdae69bcbd42632cf6a87279500e5efad4229b61393686b8222a3d0', '2024-04-05 14:24:45', '2024-04-04 14:24:45', NULL, 14),
(31, 'ab1297f8f687e3d9d42e17f3c1152b2a7a45901eda7361a08b848449f2757eb0', '2024-04-05 14:26:12', '2024-04-04 14:26:12', NULL, 14),
(32, '6b1d639c05bdab6a9e93a2e6f4a8edba45b08b57a6b23a9f447c412b26b4fa9e', '2024-04-05 14:28:07', '2024-04-04 14:28:07', NULL, 14),
(33, '09e59a7e19f52ae2bc0541c183791dd6c1ef0f9d2f3725adecd6966d2d6530d7', '2024-04-05 14:28:20', '2024-04-04 14:28:20', NULL, 14),
(34, 'c916bf5f8e46d8beeeee59170089ccfc28e53cd788d92601944b8fed60ed1eec', '2024-04-05 14:29:17', '2024-04-04 14:29:17', NULL, 14),
(35, 'ea3ff2e9a3e0f0fdd029cc614a2bbe477e5bdd9582dfe565fc3ddf1ea2b34cf7', '2024-04-05 14:29:42', '2024-04-04 14:29:42', NULL, 14),
(36, 'd5c97e71aee34bd5c36083fe9bc45b95a66f7953d394291375102d8df0b4f4e1', '2024-04-05 14:30:23', '2024-04-04 14:30:23', NULL, 14),
(37, '56b0f065c9c268d6228aeff283edf40af16e5aed93bb2830fd7a4d167520d8bf', '2024-04-05 14:31:16', '2024-04-04 14:31:16', NULL, 14),
(38, 'c145f40e8bacad7611c3950a4a249bdc9875d3ada271c14b2a44b221c71aa443', '2024-04-05 14:34:06', '2024-04-04 14:34:06', NULL, 14),
(39, 'ddc2231f05e81d1599336242414cdcb9fc300bf4c7b7e447e4f120d05d769f52', '2024-04-05 14:34:12', '2024-04-04 14:34:12', NULL, 14),
(40, '20f64a5047c72cc0ddbc4e5533ed41a81c7a93e587b6934ffcf01801fabf8d0b', '2024-04-05 14:37:49', '2024-04-04 14:37:49', NULL, 14),
(41, '3d5cdda486df5781053b35fd59f203b804662938d0739bec7f9757a4824b0fb6', '2024-04-05 14:38:01', '2024-04-04 14:38:02', NULL, 14),
(42, '28eff75cfa0a5ff09c694a358c3cf0c6d7018245191d51be271145e421544322', '2024-04-05 14:38:40', '2024-04-04 14:38:41', NULL, 14),
(43, 'c53f5bcc4285717cf827c15082481b24e1f0332acece4fe5e6045e36d3d52b9d', '2024-04-05 14:38:56', '2024-04-04 14:38:57', NULL, 14),
(44, '5006e149299a0129b0d45212af11b980ad01a24b1501db27800400d6b53ed663', '2024-04-05 14:39:32', '2024-04-04 14:39:33', NULL, 14),
(45, '3fc1f12f4203884892e861deda30befd8b9744d2649302f84ba71b4c0434a588', '2024-04-05 14:42:30', '2024-04-04 14:42:31', NULL, 14),
(46, '88ad4e871396f543ae81f70f43d0b0eb74e496c3a11492b3133a929fb240bd25', '2024-04-05 14:42:37', '2024-04-04 14:42:38', NULL, 14),
(47, '913f2ae8de112f80f1af89964e634aa6ed98aa75a81bf4145fb886d22ac351e9', '2024-04-05 14:43:26', '2024-04-04 14:43:26', NULL, 14),
(48, 'd7bbcfea9595e706a44a41c9b8f1f4719d6d8129ad52985fbf6424ad9d2900bc', '2024-04-05 14:43:28', '2024-04-04 14:43:28', NULL, 14),
(49, '8f7cec33fe5601811b9a5bf60833c7a4f75fd63a50ed47d2e6b7b261e3367563', '2024-04-05 14:44:51', '2024-04-04 14:44:51', NULL, 14),
(50, '72857e949d94d19d1e0aed4563899ceb46ffcf78d19f3f709c5d8797cfa1feb8', '2024-04-05 14:47:01', '2024-04-04 14:47:01', NULL, 14),
(51, '58453967a435f56345c8428c8501c666af937f900ace39f79d04a22d195bb9e3', '2024-04-05 14:48:54', '2024-04-04 14:48:54', NULL, 14),
(52, '193ebf09a272cbe5aeebdacc0a7e0c9bdf340fcc9dfb4db30a04bd29021ec6ec', '2024-04-05 14:51:20', '2024-04-04 14:51:20', NULL, 14),
(53, 'e23bbc822b1b8bbc013da16974ebdeb074febc45805c19c87c5c81e38fe0d346', '2024-04-05 14:59:51', '2024-04-04 14:59:51', NULL, 14),
(54, 'b3bdcc2a6e5e0f4e6e0f7e46d90112095588a09f9e25dad641c2f5fdfca5a1c1', '2024-04-05 15:04:31', '2024-04-04 15:04:31', NULL, 14),
(55, '7db288c66e32e80ca1185cb06dafe9bae00a4a5f33186c57224f1a5824ee7476', '2024-04-05 15:05:17', '2024-04-04 15:05:17', NULL, 14),
(56, '83595240e318c34568b73e19feb7b8f86b2eb062d67ea40281e404515eb0aa37', '2024-04-05 15:07:05', '2024-04-04 15:07:05', NULL, 14),
(57, '9e9460ee3d5db4e7c125409c04f92042b984312a5f6552d161f9e1b4e21c1970', '2024-04-05 15:07:47', '2024-04-04 15:07:47', NULL, 14),
(58, 'ab3799378b23779af6620d683e551d39f98533148705a1bdc86f4298ba4d9d00', '2024-04-05 15:12:20', '2024-04-04 15:12:20', NULL, 14),
(59, '9fb8689f527d0f321807303714828237044e9d40e64ec2fd79497671c61aa5b2', '2024-04-05 15:14:50', '2024-04-04 15:14:51', NULL, 14),
(60, '943f762d1bbb70f3c472167c2f7246f9f25e10ef034cc929e43725f8c3ee23a6', '2024-04-05 15:17:16', '2024-04-04 15:17:16', NULL, 14),
(61, 'e7b3c49b50117267562ebc47bb093a29d0270fce865f16f8c8656540b4615a02', '2024-04-05 15:17:22', '2024-04-04 15:17:22', NULL, 14),
(62, 'b166c80560a3ff2d97b9c5b1d1a584a84f2be101231bd7bb4e8bc9a08afbfdc7', '2024-04-09 05:54:38', '2024-04-08 05:54:38', NULL, 14),
(63, '8e5b9c10e08fa362e54935a37bd0d0bc15d549dcb5f384ac44f05ef9c5f90c03', '2024-04-09 05:56:19', '2024-04-08 05:56:19', NULL, 14),
(64, '84230a4b0bcb945207f7478ad577743973825301fa5c1904c9a9efa913755174', '2024-04-09 06:03:44', '2024-04-08 06:03:44', NULL, 14),
(65, '6d27e7d18ebda1b6b2d194ca9fc28fa6541bf0aaca0d3561a2d1b576f9ef1dfa', '2024-04-09 06:07:58', '2024-04-08 06:07:58', NULL, 14),
(66, 'bdd4844f7656e3b5dacb918eb5b69957de84b8a936ea050126d2c733d5416808', '2024-04-09 06:08:14', '2024-04-08 06:08:14', NULL, 14),
(67, '4f2b69634203fffbe78473afed9b23e02b2553dab8631344a2fdbee36f0d31de', '2024-04-09 06:08:18', '2024-04-08 06:08:18', NULL, 14),
(68, '8cbf13d0c7d5f8558adb678ebcd0c9d63732d441853e2eba73b2fd8b588aab69', '2024-04-09 06:08:30', '2024-04-08 06:08:30', NULL, 14),
(69, '1bacf8e549ee57a33f5a9c5e201082851118a81cb7cf7d484a0974d7c40ed9bb', '2024-04-09 06:15:17', '2024-04-08 06:15:17', NULL, 14),
(70, 'd5ddf2ffbf405c4ea14ace2c1594ed5eac58bcc5d7f576a828b38f26259b0263', '2024-04-09 06:23:06', '2024-04-08 06:23:06', NULL, 14),
(71, '9414f1314f58edcfe6d42350525416caba044f7f583cb28afe0621fc794b3349', '2024-04-09 06:23:54', '2024-04-08 06:23:54', NULL, 14),
(72, '8069c3c5a0a26c2df193e5a163505604f85a7623e6dc38ef8a298001f47ecf82', '2024-04-09 06:29:56', '2024-04-08 06:29:56', NULL, 14),
(73, '414f6142f9923241753a4337f70a64dd30a45d22f920261c2429a3ea3b000994', '2024-04-09 06:30:41', '2024-04-08 06:30:41', NULL, 14),
(74, '6673c24cc15346d182e460b80e5348070d0bbeb2b90660b234d388d759bcd305', '2024-04-11 06:16:21', '2024-04-10 06:16:21', NULL, 14),
(75, '5b72016d4e225df8be5b001058ddd217a26c1ca895fcb861e3e7117866e188db', '2024-04-11 06:16:59', '2024-04-10 06:16:59', NULL, 14),
(76, 'e9fa26ed60f9907c38782c132fecbf2d123ca60fa2838322363b0fb03168add9', '2024-04-11 06:17:38', '2024-04-10 06:17:38', NULL, 14),
(77, 'c16a7f0ce2900b53805f36972a0317244ebf61dd60118fab164f4328bd454c18', '2024-04-11 06:25:10', '2024-04-10 06:25:10', NULL, 14),
(78, '8c34b4d7fbe85cde33158c36f062a496cba85ec482d7db269edb6c46317030d4', '2024-04-11 07:23:08', '2024-04-10 07:23:08', NULL, 14),
(79, 'e9160080c155783e7f1bc19481b1c50879fb6bb5da492866533cdb69eafc47a8', '2024-04-11 07:56:47', '2024-04-10 07:56:47', NULL, 14),
(80, '62bae6360eee5f0416d019537ac2694e7cf4d78f8488b1478ce54ad514fc0739', '2024-04-11 07:59:04', '2024-04-10 07:59:04', NULL, 14),
(81, '1dd7ce5bdea5a4ff54a8c79c0559b5e143c1987b789af80bde2880ddd668e3ae', '2024-04-11 08:28:45', '2024-04-10 08:28:45', NULL, 14),
(82, '0ff50209a67c02b044dbcbe9b11e0e62b6c9037331489306094d9d17eda7724a', '2024-04-11 08:29:21', '2024-04-10 08:29:21', 2, NULL),
(83, 'b63e55b501d8cf20c7411ce1ec4ab3cba775356ad18e3795f9b55d320882d969', '2024-04-11 08:52:39', '2024-04-10 08:52:39', NULL, 14),
(84, '36d8cd58451fbb346abb948fcad0578f79362aad4a72ff97e933e2a946872bf9', '2024-04-11 08:52:59', '2024-04-10 08:52:59', NULL, 14),
(85, 'bca43b5af074c121c43ba895bf80f570a013fa7aa19db8d0211efe4d214d1619', '2024-04-11 08:53:20', '2024-04-10 08:53:20', NULL, 14),
(86, 'b62ca76518093a185ae29bc80b34c04a04f6f4b608305efd367eb380f2ce2853', '2024-04-11 08:53:29', '2024-04-10 08:53:29', NULL, 14),
(87, '270e0983e5397d7b2f74610aea6f1178645133e9720d8ee7b21aa7e0fdfc17d2', '2024-04-11 08:57:45', '2024-04-10 08:57:45', NULL, 14),
(88, '360dbf44b126b6fe763b63b29f45fc30bcfdff9c3592bcf4b17e3b69d0d40016', '2024-04-11 09:10:05', '2024-04-10 09:10:05', NULL, 14),
(89, 'dcf8c2795119af232ffe500a3a8990937fa1da11e0404c730aecb2b12fabbe7a', '2024-04-11 09:16:45', '2024-04-10 09:16:45', NULL, 14),
(90, 'f840b2584d85c0bd5475131c17beab7ef7f84766812c355be61bfc6bf0af47ca', '2024-04-11 09:19:42', '2024-04-10 09:19:42', NULL, 14),
(91, 'f97ea2112629d806606af73c38d47a115ffdd4f97a7d18ef13abc05758f1468c', '2024-04-11 09:22:16', '2024-04-10 09:22:16', NULL, 14),
(92, '21cc7b6537ba601b45a9ee272af23011aa7ced59626b6995a38b2a15c33a51d5', '2024-04-11 09:35:17', '2024-04-10 09:35:17', NULL, 14),
(93, '762ca0303f3693260e6b49e98768f501f47056a10e5557f10728c18134203556', '2024-04-11 09:39:42', '2024-04-10 09:39:42', NULL, 14),
(94, '6e5186e4c3014a0e205f223d88ec2881fba4e378e9c0a45395b45af8ba32d0fd', '2024-04-30 21:17:27', '2024-04-29 21:17:27', NULL, 14),
(95, 'eadf74600b0d34f3da89bb61cfdac3429b48216b33b247177047b04749d0ad02', '2024-04-30 22:13:17', '2024-04-29 22:13:17', NULL, 14),
(96, '60b50a33707c3cfefec19b9926ef1e8bc2e8a45fb3d46d75a8f39c969548afbf', '2024-04-30 22:13:35', '2024-04-29 22:13:35', NULL, 14),
(97, '78b66049f835af640452a9e2fd496754748ee116312f3dd1bb3d9e7b764f5fcd', '2024-04-30 22:15:33', '2024-04-29 22:15:33', NULL, 14),
(98, 'fb504b6de1905b4aa0971754cd1bfe78bf95a71937d36d9554fbb60b4ad87610', '2024-04-30 22:19:34', '2024-04-29 22:19:34', NULL, 14),
(99, '328ebb83f36494f4e35fc2a3312f8bea3af3fa5772ef0145c3f98bb9061e4dca', '2024-04-30 22:48:42', '2024-04-29 22:48:42', NULL, 14),
(100, 'b01bfd9851922977307a0ce525b6b0530ea0da8a7f04391e08ea81b652324ba3', '2024-04-30 23:07:58', '2024-04-29 23:07:58', NULL, 14),
(101, '973bfae058d389236dbc2bfd4955d0a1b34fc14634882405b88b7e1eed20df7f', '2024-04-30 23:09:44', '2024-04-29 23:09:44', NULL, 14),
(102, 'd7f914df5ba41bb72aef275b354806b192a81950e8e736a2928d8371aee8e407', '2024-05-01 01:04:00', '2024-04-30 01:04:00', NULL, 14),
(103, '791b3e75bd8e73e1961cc1432de2bbbf4e10e48eedbbdaa7e1ef702bf4d6a845', '2024-05-01 01:06:12', '2024-04-30 01:06:12', NULL, 14),
(104, '1618107cfba0d3d791c948c64d17a25b756c9c2c088ed5b4d26fcefcb01abc0c', '2024-05-01 01:16:38', '2024-04-30 01:16:38', NULL, 14),
(105, 'f785a1bd57f02951d02be02fe04af6ddbacfda254fadb44543fdac952ad80e4d', '2024-05-01 13:19:22', '2024-04-30 13:19:22', NULL, 14),
(106, 'b8c987da3d599edadac43c9d3f447d29e17810af8c3f587b6fd1ff72ea14b2b5', '2024-05-01 13:20:10', '2024-04-30 13:20:10', NULL, 14),
(107, 'd0e82fd07c0cc5463e8aea554b8754cf70e1893b59e28d0577dfa26ac868c998', '2024-05-01 13:21:42', '2024-04-30 13:21:42', NULL, 14),
(108, 'fab454946b83f05212b4ebf6e84fc358c48bb23d25716984e841de4997aa68a1', '2024-05-01 13:34:55', '2024-04-30 13:34:55', NULL, 14),
(109, 'fcf10d67a73d4f5506d3ae5e2721e32708f3e6dba5caad17611a07aeeed030fe', '2024-05-01 13:43:55', '2024-04-30 13:43:55', NULL, 14),
(110, '1ca5a9cad32687cba2e444a80d62a3438a88735771eb3d337110d022551dc6ae', '2024-05-01 13:46:50', '2024-04-30 13:46:50', NULL, 14),
(111, '60d7c764768e098a5dd124738adb878815788a1c08a65c4e7e1c9f54915e6f0a', '2024-05-01 13:48:06', '2024-04-30 13:48:06', NULL, 14),
(112, '329008b6bd7e00e7a4ac47bf343a2d68c97c9a0fe22505cfdea278f7bd97bbdd', '2024-05-01 13:48:34', '2024-04-30 13:48:34', NULL, 14),
(113, '2a70882584e81005ee3ce31d6dc4c501114521a0404dda5e89d42c41da12c4f6', '2024-05-01 13:50:16', '2024-04-30 13:50:16', NULL, 14),
(114, '1ffd78c943c6d87779b34db374f22ad0fdeda738de9328fe3ac22fc1b4f25481', '2024-05-01 13:51:37', '2024-04-30 13:51:37', NULL, 14),
(115, '9e1ffd162b617d4d3284d2a7ff4521a2628f8fc2d54ab94a63cebff4c8a35bee', '2024-05-01 13:56:39', '2024-04-30 13:56:39', NULL, 14),
(116, 'e801c74eeea3e0346ea5faae3a4cc48cbf7675cadc8f184eb731b2437f6a0b07', '2024-05-01 13:58:38', '2024-04-30 13:58:38', NULL, 14),
(117, 'f0ef691c3d0c53a1f09ab9e7c760f88447d76b5dcc861cc5da82360cc0e7cd73', '2024-05-01 14:02:20', '2024-04-30 14:02:20', NULL, 14),
(118, '2f6c636f40a3d7d29d98035a0b5fe965cdfbc139e3a2340fc97cbf21f7a78959', '2024-05-01 14:04:19', '2024-04-30 14:04:19', NULL, 14),
(119, 'bbc52885141575cac3fb72f81d5f02f7ede18862d91b8027cf9ecc0662b3e310', '2024-05-01 14:09:05', '2024-04-30 14:09:05', NULL, 14),
(120, '8ec18831569aa0d9fccd3340cbd3b52670509f62c7487c6af8214dc3c40a7db8', '2024-05-01 14:10:37', '2024-04-30 14:10:37', NULL, 14),
(121, 'e6a4469153890beda91b35a47b94ca6acf7a129c167aa65054f711080421fa00', '2024-05-01 14:13:32', '2024-04-30 14:13:32', NULL, 14),
(122, '9f0bf92a137f61a8a598e5a53bcd265ad713289677eb3549a20929a0e96df457', '2024-05-01 15:12:49', '2024-04-30 15:12:49', NULL, 14),
(123, '64f288850a42db558b4f34a3d8fe4fe6edd0a47e5b9d34c64668971658ab136c', '2024-05-01 17:27:39', '2024-04-30 17:27:39', NULL, 14),
(124, 'ea7217b88021e68170be6a7ab6884ba9bf9ee0dccec7f07e9a361f55690e7063', '2024-05-01 17:29:09', '2024-04-30 17:29:09', NULL, 14),
(125, 'bd68cf332d965582a23abcb18c0674ebac85c613cb0369dadeb202dd28f96305', '2024-05-01 17:43:08', '2024-04-30 17:43:08', NULL, 14),
(126, 'b356fdffd0b1e02a8c38703def4c0722512a8cf59eee9de87c9f9dcddc8d843c', '2024-05-01 17:57:56', '2024-04-30 17:57:56', NULL, 14),
(127, 'e4f19b5807ccdc9fa8ebb51c9932130e3cdcb91cfbf054cbaa9571a08632222c', '2024-05-01 17:58:12', '2024-04-30 17:58:12', NULL, 14),
(128, '62a204a8a645515fdf77d12b2474c8cf4abc94a2aeb4f8484f6ebe7791729415', '2024-05-01 17:59:28', '2024-04-30 17:59:28', NULL, 14),
(129, 'c4f830bd475b660c8b6d25ba3e53f3e768b9215bc828c9e901dd2003727c34f1', '2024-05-01 18:01:12', '2024-04-30 18:01:12', NULL, 14),
(130, '65fab8f6295fb75f2143c6c6414ef1c07ec8a0e37c50288e7dda2673eeec3984', '2024-05-01 18:05:03', '2024-04-30 18:05:03', NULL, 14),
(131, '64ddcfecb0b058a38d32aeb0d6ba187b08b17030c67f27a2c1827961d42fb11c', '2024-05-01 18:08:09', '2024-04-30 18:08:09', NULL, 14),
(132, '662de854c8e72c529510f054c6438326f77385c5c0ce91f266553bf00a344b89', '2024-05-01 18:34:30', '2024-04-30 18:34:30', NULL, 14),
(133, '9fb81d9ad2903f3e59a8bf5449f17b53878f7a5143262f5bf451552748813715', '2024-05-01 18:41:02', '2024-04-30 18:41:02', NULL, 14),
(134, '66bedaa6fb4f4ddc30ff09c47963201b9ad6fbe855a08727f4cdd6b9e160cdea', '2024-05-01 21:37:15', '2024-04-30 21:37:15', NULL, 14),
(135, 'dcc82100a62bf6fa57bfe0c7aa8c39c608786fba23b536f4fed3c5c3f307f5cc', '2024-05-01 22:01:44', '2024-04-30 22:01:44', NULL, 14),
(136, '5aeac56bab0fbc81d72f0038a0735723cfe9c5f1c1e572641950901f54846ae9', '2024-05-01 22:25:41', '2024-04-30 22:25:41', NULL, 14),
(137, '4fb3ac54b2f2795f63219f69d5f1cae878220b970fdab1bd1e47f3c1bbf4ae49', '2024-05-01 22:25:43', '2024-04-30 22:25:43', NULL, 14),
(138, '1d20ac3632f10385758cadaf2dc475ea40b79fbe1725b502b039386f853c3109', '2024-05-01 22:27:34', '2024-04-30 22:27:34', NULL, 14),
(139, '33f7c7f5ab0de0b9168caeab2096d05862b779d5d08a9f7130506c8404431148', '2024-05-01 22:32:55', '2024-04-30 22:32:55', NULL, 14),
(140, 'fd45f378430500534d9ef32a5d68f438ec3c1db4da109d06f9cc62d0e1307f1c', '2024-05-01 22:34:29', '2024-04-30 22:34:29', NULL, 14),
(141, '704ea7a3bfef112a158cf51d4c4a729656f840e152c057f296f146fec239de61', '2024-05-01 22:35:26', '2024-04-30 22:35:26', NULL, 14),
(142, '21eacbddf6e750494b57f1416c15faf2b90915dcc4cf483990d6a54170243d5e', '2024-05-01 22:42:14', '2024-04-30 22:42:14', NULL, 14),
(143, '2e01c81e07096da5212814b0065cae0eb338fe3d540971735b8a9d58add2ae16', '2024-05-01 22:51:16', '2024-04-30 22:51:16', NULL, 14),
(144, 'a16318577ab4602451e400453d6d125a4c63a68e18d0dec2b1e4f892a06064dc', '2024-05-01 23:25:12', '2024-04-30 23:25:12', NULL, 14),
(145, '128aeea8a2a5043cae436a03ab167fd77d44560ab89dbd1f0dceaf94a24c12c4', '2024-05-02 00:45:06', '2024-05-01 00:45:06', NULL, 14),
(146, '0e247c385e2f30032ce95a76e0ee8cf105489fbbcab0fd7a8cc6529705103855', '2024-05-02 00:50:07', '2024-05-01 00:50:07', NULL, 14),
(147, '51495ec25777d26aa70daa51ff90d6f8f7735eee49820671095b27596ae06315', '2024-05-02 00:52:02', '2024-05-01 00:52:02', NULL, 14),
(148, 'd2e991bcb8bb1002313c45df4eafc909ac48148fbe7a1833bfa7e78a3d02140d', '2024-05-02 00:55:20', '2024-05-01 00:55:20', NULL, 14),
(149, '188d50b0a28002f384a54b94ff4dd83a90a4a06731e217d1a7f0f29eaedf6313', '2024-05-02 00:59:51', '2024-05-01 00:59:51', NULL, 14),
(150, '6d4a2aa61c4d6136ce14226e088c4aec2a2fdd4655b23cb92573c82e885584a9', '2024-05-02 13:14:41', '2024-05-01 13:14:41', NULL, 14),
(151, '66288dd3b0adf7ebf6195e8c6d0287d67ceea993b246aa65ebb0304979f3a306', '2024-05-02 13:24:42', '2024-05-01 13:24:42', NULL, 14),
(152, '47644ecb7a9517710e887ca9ccc0fe6f82e2214b0ed101db9385970a2f65afb4', '2024-05-02 13:27:56', '2024-05-01 13:27:56', NULL, 14),
(153, 'c64d3e5ab1e1d6e4581053e205e695b2c2a964e09f62b2e53af43f657ff9405e', '2024-05-02 13:56:37', '2024-05-01 13:56:37', NULL, 14),
(154, 'a8ab201ca6dc71c4ec01345ce26754ea75c3329b5613684ab5f0f59a165c67f5', '2024-05-02 15:32:48', '2024-05-01 15:32:48', NULL, 14),
(155, 'f136f52a80c90dda6267cfbc812b1c4849acebe566061fe66533b58401cb4369', '2024-05-02 16:02:00', '2024-05-01 16:02:00', NULL, 14),
(156, '80bea55852cb3ecb718bbdf162a6ac2cd45044852c6a66cc37b0bcda88d80955', '2024-05-02 16:03:24', '2024-05-01 16:03:24', NULL, 14),
(157, '99592a8e2d943ee12cd9e59b629520fb43ccad44d2172f3a2a4d9a8352f6c18c', '2024-05-02 16:10:21', '2024-05-01 16:10:21', NULL, 14),
(158, '22d8c682e04a85162e5c5c04f02387f786d6d2e3403d0627cbeb5da84631afdc', '2024-05-02 16:25:42', '2024-05-01 16:25:42', NULL, 14),
(159, 'e902caebbfa483fe128be46bdf282dab15f3e2decf42d2e3f8d2b6a0f7ff0df9', '2024-05-02 16:34:50', '2024-05-01 16:34:50', NULL, 14),
(160, '8b807da6dda6d919476cda9bdf4d7533aa74f1b5cb28e4c11930b4bfff50a782', '2024-05-02 16:37:52', '2024-05-01 16:37:52', NULL, 14),
(161, 'f74a1c0b620f7f691536ba0e70f84df16c10447ee7bd03a00429e120069a1901', '2024-05-02 16:38:06', '2024-05-01 16:38:06', NULL, 14),
(162, 'cb3c00d94d5a51b6add44f121186a0b8549555b394a95577e9935b93ab1bbd6b', '2024-05-02 16:43:56', '2024-05-01 16:43:56', NULL, 14),
(163, 'f674ea48dc3dd80044f25e3df551c266ca37f752db858a123eaaa2bc3e4d76bc', '2024-05-02 16:46:24', '2024-05-01 16:46:24', NULL, 14),
(164, '56732e6345d44fe0430179e66f39527c461949ac0272e2ceaa3481dfc40523cc', '2024-05-02 17:02:45', '2024-05-01 17:02:45', NULL, 14),
(165, 'ed7c10963dd35d7f332bb9e7a731e1944429e76710a82286f4ae384e02fe908c', '2024-05-02 17:27:48', '2024-05-01 17:27:48', NULL, 14),
(166, '963777af34b7118f937a6faaefb247eb15116a2e98f07f4fdfe710cb42a9553c', '2024-05-02 17:42:08', '2024-05-01 17:42:08', NULL, 14),
(167, '3da54659ee9faa7493af105d97a744eb4b57e4932a8cacda7d5b0418a0ba4161', '2024-05-02 17:44:58', '2024-05-01 17:44:58', NULL, 14),
(168, '9eae1473844ae3fbc3c2daaf6a2ac695a3f5496ba9e82b10e7acf5250af8fa19', '2024-05-02 17:59:28', '2024-05-01 17:59:28', NULL, 14),
(169, '4a92de03f088e90cd7e338892d7cfb8e7166316ef3dbfe47b1d773a9eac4fafe', '2024-05-02 18:12:12', '2024-05-01 18:12:12', NULL, 14),
(170, '67e94a7edf50ac320636a8b8deec2c109c0bac2d799a14d70691913c071d8da4', '2024-05-02 18:16:20', '2024-05-01 18:16:20', NULL, 14),
(171, '5e262c780e077c0dcb74e04e4d465bf3fdeb415e4c2d0145e9feb6687dba6577', '2024-05-02 18:16:34', '2024-05-01 18:16:34', NULL, 14),
(172, '1021dcfdd14b8a17381fcfb24101447efa04575b241563382189899c565090d8', '2024-05-02 18:19:33', '2024-05-01 18:19:33', NULL, 14),
(173, 'd2dc5cf01717838512164103ce741de139fa82fb4078ec79a241dec48676761e', '2024-05-02 18:30:33', '2024-05-01 18:30:33', NULL, 14),
(174, '08f6420a5f88e2fd748e7d79427567fb4967771e43607b4ae5ae1ed3422e9b38', '2024-05-02 18:36:43', '2024-05-01 18:36:43', NULL, 14),
(175, 'abd6288059b5078989075a9bc30b9b2ddb751b6ebe1e66650a69c3231c2f8b70', '2024-05-02 18:36:44', '2024-05-01 18:36:44', NULL, 14),
(176, '8dbf7306e5913bbbf62c92753836bcca0e38892274a59e40c91699c213a5d536', '2024-05-02 18:36:44', '2024-05-01 18:36:44', NULL, 14),
(177, '6cf324fef5c2aeff4ead83ea26e4fcdf2a30796abac936932ebbca92c8df080a', '2024-05-02 18:44:55', '2024-05-01 18:44:55', NULL, 14),
(178, '74be178c1794e6f7b3d197cefc2712d21677a42ddd1c6729ab0b616e1392e099', '2024-05-02 18:45:32', '2024-05-01 18:45:32', NULL, 14),
(179, 'f493f2015e71a70ea9f2abdb36aaf0716eaf7af5caa56eb6f298c5c2301385a4', '2024-05-02 18:47:41', '2024-05-01 18:47:41', NULL, 14),
(180, 'c9ebbcee8c593c427fd5cca506c8e63f28ee82875a5d12453082ab9f106dc343', '2024-05-02 21:38:36', '2024-05-01 21:38:36', NULL, 14),
(181, '496fd6425d6091ee2243cc946ca68b6e09fd914c516e5ab5c5687fc6efa32202', '2024-05-02 21:52:19', '2024-05-01 21:52:19', NULL, 14),
(182, '46ff9283f6190b838af851dd4bb9f74ed0df2f82b501155cfbd036f5961fde9a', '2024-05-02 21:57:12', '2024-05-01 21:57:12', NULL, 14),
(183, '27f20a96f79464883c9da24cda14c18be54bef3cdbfa1ec7d7203727727e64e2', '2024-05-02 21:59:14', '2024-05-01 21:59:14', NULL, 14),
(184, 'af4ee0b8dbfe620f6706bbad73201849ce2e363b284a467a3bcbf4c1111c1d63', '2024-05-02 22:01:27', '2024-05-01 22:01:27', NULL, 14),
(185, '03e1b96b2cf7371a58dc98aada1859d1e9cf52344fb420fe068ac0d4086d1eb2', '2024-05-02 22:12:44', '2024-05-01 22:12:44', NULL, 14),
(186, 'b146b76238edc64c1b908deacda7210d4e6de2dc8e714ea8814cc409d14043e1', '2024-05-02 22:21:51', '2024-05-01 22:21:51', NULL, 14),
(187, 'f0dd21a4bca9a18685851dac647d11f3a32f6ca86fc3bfb47cc676ebb21c797e', '2024-05-02 22:22:42', '2024-05-01 22:22:42', NULL, 14),
(188, 'cd88d4e573bb5f8e1fce80d0dbdf5c88741d4b40424552d74c82a6e9d37c110c', '2024-05-02 22:23:23', '2024-05-01 22:23:23', NULL, 14),
(189, 'ffc60f3ba38dd16079f28d3d1bbd82fa5c2983c068889591c09da2b4442e3eb1', '2024-05-02 22:23:38', '2024-05-01 22:23:38', NULL, 14),
(190, 'a865da96cb25155e3f2142593e1e289d853ddcc7d6071c7a80e16151301b2d5c', '2024-05-02 22:27:42', '2024-05-01 22:27:42', NULL, 14),
(191, '240d26ed88c5ab3a8bd32bd00e4bc963cd95bdd8e68d5aac125f04119cf4796b', '2024-05-02 22:33:26', '2024-05-01 22:33:26', NULL, 14),
(192, 'e8f74505fa80f5cd12cf650179ce67ae6d59d4c594da9c5a55cca488cef028d6', '2024-05-02 22:34:02', '2024-05-01 22:34:02', NULL, 14),
(193, 'd8fd41cfb328bf0eb47746c49164778f3bb041780c057b442b67e549022ee196', '2024-05-02 22:35:16', '2024-05-01 22:35:16', NULL, 14),
(194, '4232b1739a49b2688068251de705315b97afd4956426ccb2cf29981b839dec9c', '2024-05-02 23:01:00', '2024-05-01 23:01:00', NULL, 14),
(195, '537d96aa379dc472c8b572eea077e9e4609df9b6a096d7c5827f1b76c0153c8c', '2024-05-02 23:15:58', '2024-05-01 23:15:58', NULL, 14),
(196, '81ab0b0aafd7bdeaa1487496953cada78c87b64da989db2998fd74e1c676c403', '2024-05-02 23:18:26', '2024-05-01 23:18:26', NULL, 14),
(197, 'fd27011184ae387eb6f3fcce1f584477b93c0e90bedd26aa578ebca8f9d38e36', '2024-05-02 23:32:35', '2024-05-01 23:32:35', NULL, 14),
(198, '20c546500dfdf40b4e511927228066935c53c16049f60f1dafee14d113cb8b37', '2024-05-02 23:35:03', '2024-05-01 23:35:03', NULL, 14),
(199, '777333f9314532c23813bb8177d67305ebe70103074bf9fdb4cf30a28c1617dd', '2024-05-02 23:43:49', '2024-05-01 23:43:49', NULL, 14),
(200, '36eb43c43e244b0b964fd336553cc3cc9191dfd3deace0e696d1cadd1acac291', '2024-05-02 23:59:00', '2024-05-01 23:59:00', NULL, 14),
(201, '986157b268a63834e773b148f6cf14c538d6fc2a2c22c53afe13daa84ff4bd53', '2024-05-03 00:04:27', '2024-05-02 00:04:27', NULL, 14),
(202, '35b651ad080326e61a3794c350c030226a1d284dd960de1a610d8145ac305291', '2024-05-03 00:05:24', '2024-05-02 00:05:24', NULL, 14),
(203, '0587cdac557f7c710d15ab0c9b19202f1380aba34d270a16d409e51bff4847e5', '2024-05-03 00:07:28', '2024-05-02 00:07:28', NULL, 14),
(204, '801538b2535943e07a790da63d2e5f8439f39c8e3398a85c0c7fcd4f165a2db3', '2024-05-03 00:09:05', '2024-05-02 00:09:05', NULL, 14),
(205, '90a3f093ef7c4ab0465f4270fca3d9e8958a0941c29bac30d2a8460ce49ca5e4', '2024-05-03 00:16:40', '2024-05-02 00:16:40', NULL, 14),
(206, '94f44ebeb0f0f28ec07da82b688ca80405d5c8bde1d01e2f560c1d7f3bf79eee', '2024-05-03 00:17:11', '2024-05-02 00:17:11', NULL, 14),
(207, '0acd6907b6255f177e676d17d0123586ef4a6b5df62e85d093215364c6d34449', '2024-05-03 00:19:26', '2024-05-02 00:19:26', NULL, 14),
(208, '4bd65d06d49af2e18f32e2644d75d4a9ba81fb7f55135cf6cfce86edc9ead231', '2024-05-03 12:12:35', '2024-05-02 12:12:35', NULL, 14),
(209, '2341aa7471ec73224f2a0890ddcc332ba42e79abf01877871bef4ea91a7275f1', '2024-05-03 12:22:15', '2024-05-02 12:22:15', NULL, 14),
(210, '098f6901cfc5a60194afcb5eca3d4553d7394bda20ad504d48724fc84cec4c1a', '2024-05-03 12:27:42', '2024-05-02 12:27:42', NULL, 14),
(211, 'dd57ede4a3da47225d295f0ba69094d768e7ec8d863445b362f756a95fdc181d', '2024-05-03 13:08:44', '2024-05-02 13:08:44', NULL, 14),
(212, '0c69781fa602cbbdaa5f26453610119378568a06cf931514118237aef270910b', '2024-05-03 13:16:42', '2024-05-02 13:16:42', NULL, 14),
(213, '406dd3e81c86694e110583c44cf4783d0c2e397aa9604e8cbaf5b7cf5a612a85', '2024-05-03 13:24:48', '2024-05-02 13:24:48', NULL, 14),
(214, 'f4d808d094c55a8bbc5cc09dbc6380d13e226680d3fb1e8dddba22df2f795ff9', '2024-05-03 13:26:07', '2024-05-02 13:26:07', NULL, 14),
(215, '27b7ba9cae0dd275d763ce7988b8d00ba9c8b7a37c496a487b65c8c5470ed73c', '2024-05-03 13:41:02', '2024-05-02 13:41:02', NULL, 14),
(216, '75e2c8a22f6cecf215002b5be14ce4b75673a9a8a9076ead058d2d6786ccc32c', '2024-05-03 13:45:41', '2024-05-02 13:45:41', NULL, 14),
(217, 'a3fd6396f4c919d7500cdecda3a517c27b41bc7cb7ed07caebcf3d9abd8e42a9', '2024-05-03 14:02:57', '2024-05-02 14:02:57', NULL, 14),
(218, 'c18c69f2c37d0598f32dcfef0ef8c2cd01eecf4473c2999177a3d6e9992c0373', '2024-05-03 14:10:21', '2024-05-02 14:10:21', NULL, 14),
(219, '54c1f80c3967ee22101743cc445bfd797cbbebfa5d815a7c49be98f96b239fc2', '2024-05-03 14:15:31', '2024-05-02 14:15:31', NULL, 14),
(220, 'f2952492fb3f7d0b185be367de422440807a442e0908be4682a65474f70082e9', '2024-05-03 14:16:31', '2024-05-02 14:16:31', NULL, 14),
(221, '39eba29930a4f725f5e93a2cc1f10ce3d04f7b69b947382e3455ed56d9e70c94', '2024-05-03 14:27:04', '2024-05-02 14:27:04', NULL, 14),
(222, 'aec8a717e2787ed9510a5bb8dae50767add91f20d228a57334e54ea20004c356', '2024-05-03 14:31:07', '2024-05-02 14:31:07', NULL, 14),
(223, 'ce00d54f786e068518802be722b98f676aac562dfdc0a3a4e0ee4711affababb', '2024-05-03 14:32:42', '2024-05-02 14:32:42', NULL, 14),
(224, 'f9ff7d730c2e5a61ff5d05f6907b37873a6b9f5a983df05963aef73dc37a9d37', '2024-05-03 14:42:52', '2024-05-02 14:42:52', NULL, 14),
(225, 'c39808fe47fcd35f967800f2fd7a53802cb1b12537b3a3fd79ac25039e204855', '2024-05-03 14:46:21', '2024-05-02 14:46:21', NULL, 14),
(226, '22a96e1d60539776b37ccbea8034932e8d7f9875ccdc1856ef9c9548e971b6d8', '2024-05-03 15:21:55', '2024-05-02 15:21:55', NULL, 14),
(227, '1c67a94bb0aad8711869ad951f0a5e687fe1952217636f287efbf4583977ea55', '2024-05-03 15:23:21', '2024-05-02 15:23:21', NULL, 14),
(228, 'd90f33f320e8711f6d5629acb0f7bd64934c2fa1297c27c5ea1c93dfd14826da', '2024-05-03 15:36:39', '2024-05-02 15:36:39', NULL, 14),
(229, 'd17530aef2ac89115b6d5c8537bb918835b9dedd9d4ff604601be111086f53b8', '2024-05-03 15:51:50', '2024-05-02 15:51:50', NULL, 14),
(230, '3ffa3542ebbcce046b3075b8008a6d76e8467f4f4cb70c0439c8b6272e5478c9', '2024-05-03 15:54:31', '2024-05-02 15:54:31', NULL, 14),
(231, '5df232cda15f338959a326e3f4534ab19f08b7f39d1dd2e7c5a43c984ff0df23', '2024-05-03 16:01:35', '2024-05-02 16:01:35', NULL, 14),
(232, '43cd20adad6ecb7731776485519c2ee1ce20c1fe73ca8455245b7ee9ef46f25a', '2024-05-03 16:23:34', '2024-05-02 16:23:34', NULL, 14),
(233, '5ba32df7d35c34d11953cc637ec901fc072cc2a62fdad734cc56f28b04d3cffe', '2024-05-03 16:49:10', '2024-05-02 16:49:10', NULL, 14),
(234, '823168273b3b6850219ce7f314b9489814283cfc900588e0123af6f871d10553', '2024-05-03 16:50:14', '2024-05-02 16:50:14', NULL, 14),
(235, '1556f9b78785267eca88d6e03fa650bd4d038f2111a11b42d4fba2ad52f85ff4', '2024-05-03 16:50:26', '2024-05-02 16:50:26', NULL, 14),
(236, 'fd2f09a37867bf561ed67f013c1d561cc3612fdb70221e7db9d13f50735026b2', '2024-05-03 16:50:26', '2024-05-02 16:50:26', NULL, 14),
(237, 'bb65c1d24455a717e37a56c3f5bbf1492d27acb87484e3dbcd5f635e8ac5091b', '2024-05-03 16:55:13', '2024-05-02 16:55:13', NULL, 14),
(238, '889cfec6f11b25f4ed7895244b9c681df73c9166ff7882bf512127bf1e4f9dea', '2024-05-03 16:56:06', '2024-05-02 16:56:06', NULL, 14),
(239, '7b934d3a44e3f0211dc29918cdb463b0f945c620877c4c7a7ab1f8b55c4cc05a', '2024-05-03 16:56:19', '2024-05-02 16:56:19', NULL, 14),
(240, '85e029182f3986152f1b0770a7c104ba142716deff840de95a14eabf1234d9a0', '2024-05-03 17:07:46', '2024-05-02 17:07:46', NULL, 14),
(241, '98fd4b726ac96e0e8cb535b509b2ecd861fd01ca4cd6c20ec06cfd33c3b862b8', '2024-05-03 17:15:26', '2024-05-02 17:15:26', NULL, 14),
(242, 'f31818b7567a6578a6f0f0aa1c8ef3b2691de607a1d66e0659f3387d960fdbb9', '2024-05-03 17:25:49', '2024-05-02 17:25:49', NULL, 14),
(243, '5cec60edbcd46a52742fa0e2fc109fbf449ab2abfbe2dac5a5360bc6e1e84e44', '2024-05-03 17:41:42', '2024-05-02 17:41:42', NULL, 14),
(244, 'd8ed03f8fe0b28e53e77d5be7d8ff47e6a6926dfcc8a98403dfb1dade6137c8b', '2024-05-03 17:48:59', '2024-05-02 17:48:59', NULL, 14),
(245, '941a89e3eb723999df6706ebd2b5e27af8f5c8fb67e2986b2f74cb7bdd83ed82', '2024-05-03 17:49:12', '2024-05-02 17:49:12', NULL, 14),
(246, 'fd55a04d20bdf24678fa2301b35165641673fbe7bdb494eb99ac3077c9a63970', '2024-05-03 17:50:07', '2024-05-02 17:50:07', NULL, 14),
(247, 'e6f949a727dcd8526bf80b1521a1d38945e125f3fc4900a3e1518c15716ef5f1', '2024-05-03 17:50:13', '2024-05-02 17:50:13', NULL, 14),
(248, 'c2b82ab764c7a42cfc501b33504dcfb0638b53e351453811ef2aabd76bbeabbd', '2024-05-03 18:38:09', '2024-05-02 18:38:09', NULL, 14),
(249, 'd724212851f209c18274934703996b2fac2ac0ac7e426f1e3eb7f00edc81ece1', '2024-05-03 18:38:22', '2024-05-02 18:38:22', NULL, 14),
(250, 'e0177de965659db8736fbf93524e53bab4569bd963c6db47ea68458d29c7f061', '2024-05-03 18:38:54', '2024-05-02 18:38:54', NULL, 14),
(251, '86e724b97c1fc1fdf5dee2c92497355bdb8522e4074c02797169d3779bb260cb', '2024-05-03 18:41:23', '2024-05-02 18:41:23', NULL, 14),
(252, 'df2d9d3b37024e86e73802c96abc7cb6ecacfb5ab450d59bc1f2948ffedad397', '2024-05-03 18:41:29', '2024-05-02 18:41:29', NULL, 14),
(253, '505eb0b46a81d64bc7a56cea4f060db746eb5c7e47175c20a07d882f070bbea7', '2024-05-03 18:41:37', '2024-05-02 18:41:37', NULL, 14),
(254, '48878e722d817c5e427a0a22cb120e7ddb043f90e5648c06eabfc31cf0eb171a', '2024-05-03 18:46:18', '2024-05-02 18:46:18', NULL, 14),
(255, 'cdd7f011fe6e2438ddb1ac483af9cec2536eb99b67db0bea41b758a733a1d451', '2024-05-03 18:46:31', '2024-05-02 18:46:31', NULL, 14),
(256, '67624ffdc6f272b44086d24f0cd8b5bbc5a096ceeac776127bc24baea99d5224', '2024-05-03 19:08:18', '2024-05-02 19:08:18', NULL, 14),
(257, 'c9a18ab967d1d7ab3296103242fa3c34679d1ee327019cda95042c0a8289b356', '2024-05-03 19:08:29', '2024-05-02 19:08:29', NULL, 14),
(258, 'b5e1532b1cd01a028dc32be9eeed15f8236de9ceddc6bd4206d91f41f3d68e49', '2024-05-03 19:16:38', '2024-05-02 19:16:38', NULL, 14),
(259, '600f9e6cff025da4c3d7ccc1fc4f2afb7875bb910417e58ae1fe2502086fa6ec', '2024-05-03 19:16:44', '2024-05-02 19:16:44', NULL, 14),
(260, '72142258557965e2b7a54bb2e4b2c0d33a6398e7184fcb67fc3f4dc73a3725bf', '2024-05-05 14:42:44', '2024-05-04 14:42:44', NULL, 14),
(261, 'f56811fab722e03e0f32877f27850e0bd057660caee438c37586a15ae2538e91', '2024-05-08 16:10:21', '2024-05-07 16:10:21', NULL, 14),
(262, '4bc35b679600645e3b10811a644feed2befba415b0fb294fce1690094c6d076c', '2024-05-08 16:22:43', '2024-05-07 16:22:43', NULL, 14),
(263, '02c4c9f4ceb22a15241b10ee7a8b7e2d630fb094e5e4aa5225c91e9089e2e217', '2024-05-08 16:28:10', '2024-05-07 16:28:10', NULL, 14),
(264, 'd8f1bd4ca3ca890a584af08bbb00c48e844f1b93c6007d87380c70fb7e4dbb56', '2024-05-08 16:42:21', '2024-05-07 16:42:21', 6, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Client`
--
ALTER TABLE `Client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `Commercial`
--
ALTER TABLE `Commercial`
  ADD PRIMARY KEY (`id_commercial`);

--
-- Index pour la table `Conversation_Etat_Lieux`
--
ALTER TABLE `Conversation_Etat_Lieux`
  ADD PRIMARY KEY (`id_conversation`),
  ADD KEY `FK_conversation_etat_lieux_Commercial` (`id_commercial`),
  ADD KEY `FK_conversation_etat_lieux_Client` (`id_client`),
  ADD KEY `FK_conversation_etat_lieux_etat_lieux` (`id_etat`);

--
-- Index pour la table `Equipement`
--
ALTER TABLE `Equipement`
  ADD PRIMARY KEY (`id_equipement`),
  ADD KEY `id_piece` (`id_piece`);

--
-- Index pour la table `Etat_Lieux`
--
ALTER TABLE `Etat_Lieux`
  ADD PRIMARY KEY (`id_etat`),
  ADD KEY `FK_etat_lieux_Reservation` (`id_reservation`);

--
-- Index pour la table `LogementPeriode`
--
ALTER TABLE `LogementPeriode`
  ADD PRIMARY KEY (`id_periode`),
  ADD KEY `id_logement` (`id_logement`);

--
-- Index pour la table `Logements`
--
ALTER TABLE `Logements`
  ADD PRIMARY KEY (`id_logement`),
  ADD KEY `id_commercial` (`id_commercial`);

--
-- Index pour la table `Photos`
--
ALTER TABLE `Photos`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `id_equipement` (`id_equipement`),
  ADD KEY `id_piece` (`id_piece`),
  ADD KEY `id_logement` (`id_logement`);

--
-- Index pour la table `Pieces`
--
ALTER TABLE `Pieces`
  ADD PRIMARY KEY (`id_piece`),
  ADD KEY `id_logement` (`id_logement`);

--
-- Index pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_logement` (`id_logement`);

--
-- Index pour la table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcommercial` (`idcommercial`),
  ADD KEY `idclient` (`idclient`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Client`
--
ALTER TABLE `Client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `Commercial`
--
ALTER TABLE `Commercial`
  MODIFY `id_commercial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `Conversation_Etat_Lieux`
--
ALTER TABLE `Conversation_Etat_Lieux`
  MODIFY `id_conversation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `Equipement`
--
ALTER TABLE `Equipement`
  MODIFY `id_equipement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT pour la table `Etat_Lieux`
--
ALTER TABLE `Etat_Lieux`
  MODIFY `id_etat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `LogementPeriode`
--
ALTER TABLE `LogementPeriode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `Logements`
--
ALTER TABLE `Logements`
  MODIFY `id_logement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pour la table `Photos`
--
ALTER TABLE `Photos`
  MODIFY `id_photo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT pour la table `Pieces`
--
ALTER TABLE `Pieces`
  MODIFY `id_piece` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=275;

--
-- AUTO_INCREMENT pour la table `Reservation`
--
ALTER TABLE `Reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Equipement`
--
ALTER TABLE `Equipement`
  ADD CONSTRAINT `Equipement_ibfk_1` FOREIGN KEY (`id_piece`) REFERENCES `Pieces` (`id_piece`);

--
-- Contraintes pour la table `LogementPeriode`
--
ALTER TABLE `LogementPeriode`
  ADD CONSTRAINT `LogementPeriode_ibfk_1` FOREIGN KEY (`id_logement`) REFERENCES `Logements` (`id_logement`);

--
-- Contraintes pour la table `Logements`
--
ALTER TABLE `Logements`
  ADD CONSTRAINT `Logements_ibfk_1` FOREIGN KEY (`id_commercial`) REFERENCES `Commercial` (`id_commercial`);

--
-- Contraintes pour la table `Photos`
--
ALTER TABLE `Photos`
  ADD CONSTRAINT `Photos_ibfk_1` FOREIGN KEY (`id_equipement`) REFERENCES `Equipement` (`id_equipement`),
  ADD CONSTRAINT `Photos_ibfk_2` FOREIGN KEY (`id_piece`) REFERENCES `Pieces` (`id_piece`),
  ADD CONSTRAINT `Photos_ibfk_3` FOREIGN KEY (`id_logement`) REFERENCES `Logements` (`id_logement`);

--
-- Contraintes pour la table `Pieces`
--
ALTER TABLE `Pieces`
  ADD CONSTRAINT `Pieces_ibfk_1` FOREIGN KEY (`id_logement`) REFERENCES `Logements` (`id_logement`);

--
-- Contraintes pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `Reservation_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `Client` (`id_client`),
  ADD CONSTRAINT `Reservation_ibfk_2` FOREIGN KEY (`id_logement`) REFERENCES `Logements` (`id_logement`);

--
-- Contraintes pour la table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `token_ibfk_1` FOREIGN KEY (`idcommercial`) REFERENCES `Commercial` (`id_commercial`),
  ADD CONSTRAINT `token_ibfk_2` FOREIGN KEY (`idclient`) REFERENCES `Client` (`id_client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
