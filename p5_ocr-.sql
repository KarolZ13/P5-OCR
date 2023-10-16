-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 16 oct. 2023 à 17:05
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `p5_ocr-`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'PHP', NULL),
(2, 'IA', NULL),
(3, 'DEV', NULL),
(4, 'MICROSOFT', NULL),
(5, 'PYTHON', NULL),
(6, 'DEVOPS', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `is_valid` tinyint(1) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_post` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `is_valid`, `id_user`, `id_post`, `created_at`, `updated_at`) VALUES
(8, 'Excellent article ! J\'ai appris tellement de choses utiles en le lisant. Merci pour le partage de ces connaissances précieuses.', 1, 1, 14, '2023-09-04 22:00:00', '2023-10-02 07:51:26'),
(10, 'J\'adore la façon dont cet article explique les concepts complexes en les rendant accessibles à tous. Vraiment informatif !', 1, 3, 12, '2023-09-06 22:00:00', '2023-10-16 12:22:02'),
(13, 'Je suis un développeur expérimenté, mais je trouve toujours des astuces utiles dans vos articles. Continuez le bon travail !', 1, 6, 9, '2023-09-09 22:00:00', '2023-10-02 07:51:26'),
(23, 'Cet article sur les astuces CSS est tout simplement génial. Mes projets web ont gagné en élégance grâce à vous.', 1, 1, 7, '2023-09-11 22:00:00', '2023-10-02 07:51:26'),
(24, 'Cet article est très informatif pour les développeurs débutants.', 1, 1, 7, '2023-10-15 22:00:00', '2023-10-15 22:00:00'),
(25, 'J\'ai appris beaucoup de nouvelles astuces grâce à cet article.', 1, 2, 9, '2023-10-15 22:00:00', '2023-10-15 22:00:00'),
(26, 'Le code source fourni est très utile pour comprendre le concept.', 1, 3, 10, '2023-10-15 22:00:00', '2023-10-15 22:00:00'),
(27, 'J\'aurais aimé voir plus d\'exemples concrets dans l\'article.', 0, 4, 11, '2023-10-15 22:00:00', '2023-10-15 22:00:00'),
(28, 'C\'est l\'un des meilleurs articles que j\'ai lu sur ce sujet.', 1, 5, 12, '2023-10-15 22:00:00', '2023-10-15 22:00:00'),
(29, 'Le développement web évolue rapidement, et cet article le reflète bien.', 1, 6, 13, '2023-10-15 22:00:00', '2023-10-15 22:00:00'),
(30, 'Merci pour les informations précieuses. Je vais les appliquer dans mon projet.', 1, 9, 14, '2023-10-15 22:00:00', '2023-10-15 22:00:00'),
(31, 'Cet article m\'a aidé à résoudre un problème que je rencontrais depuis longtemps.', 1, 17, 7, '2023-10-15 22:00:00', '2023-10-15 22:00:00'),
(32, 'Le contenu est bien structuré et facile à suivre.', 1, 1, 9, '2023-10-15 22:00:00', '2023-10-15 22:00:00'),
(33, 'J\'aimerais voir plus de sujets liés au développement mobile sur ce site.', 1, 2, 10, '2023-10-15 22:00:00', '2023-10-15 22:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `chapo` text DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_categories` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `chapo`, `picture`, `status`, `id_user`, `id_categories`, `created_at`, `updated_at`) VALUES
(7, 'Microsoft met fin à Visual Studio pour Mac', 'Microsoft entend abandonner Visual Studio pour Mac dans un an. Destination recommandée, VS Code arrivera-t-il à parité d’ici là ?\r\n\r\nVS Code sera-t-il au niveau de Visual Studio dans un an ? Une annonce récente de Microsoft soulève la question.\r\n\r\nLe groupe américain a l’intention d’abandonner Visual Studio pour Mac. Le support doit cesser au 31 août 2024. D’ici là, il n’y aura plus de mises à jour de fonctionnalités.\r\n\r\nTrois solutions de remplacement suggérées : une VM Windows, une VM cloud… ou VS Code. Avec, pour ce dernier, les extensions adéquates. En particulier C# Dev Kit et .NET MAUI… actuellement en preview.\r\n\r\nMicrosoft se garde bien de mentionner une autre option : Rider. En l’état, cet IDE concurrent made in Jetbrains apparaît comme une destination de choix. L’usage gratuit se limite au monde académique et à certains projets open source. Il n’en existe pas d’édition communautaire. Visual Studio en a une, avec des conditions d’utilisation moins restrictives.\r\n\r\nVisual Studio était arrivé sur Mac en 2016. L’édition 2022 a introduit une UI native et des optimisations pour les puces Apple Silicon. Mais elle reste fonctionnellement en retrait face à Visual Studio pour Windows.', 'Microsoft entend abandonner Visual Studio pour Mac dans un an. Destination recommandée, VS Code arrivera-t-il à parité d’ici là ?', 'Visual-Studio-Mac-684x513.jpeg', '1', 1, 4, '2023-09-05 22:00:00', '2023-10-02 12:12:15'),
(9, 'Python, mais pas que : ces langages devenus plus populaires en une décennie', 'Entre 2013 et 2023, comment a évolué la popularité des langages de programmation ? Bilan avec un point intermédiaire en 2018.\r\n\r\nSQL est-il un langage de programmation ? Stack Overflow est de ceux qui estiment que non. Cela se traduit dans le compte rendu de l’enquête annuelle qu’il mène auprès de sa communauté.\r\n\r\nPour la onzième année consécutive, JavaScript est le plus populaire (= le plus utilisé) des langages de programmation, nous affirme-t-on. Le taux de développeurs qui déclarent l’exploiter (63,61 %) est effectivement sans égal dans le cadre de ce sondage.\r\n\r\nSi on remonte onze ans en arrière, donc jusqu’à l’édition 2013 de l’enquête, SQL (59,6 %) devançait JavaScript (56,6 %). Lequel était tout de même, selon la méthodologie Stack Overflow, déjà le plus populaire des langages de programmation.\r\n\r\nLangages de balisage compris, l’enquête en englobe aujourd’hui une cinquantaine. Il y a dix ans, elle – ou tout au moins son compte rendu – n’en couvrait que dix. Ils figurent dans le tableau ci-dessous, classés dans l’ordre de leur popularité en 2013, et avec l’évolution de cet indice en 2018 et 2023.\r\n\r\nLes valeurs en croissance sont repérées en gras. On notera que l’échantillon était beaucoup plus réduit en 2013 (8042 répondants) qu’en 2018 (78 334) et en 2023 (87 585).\r\n\r\n2013	2018	2023\r\nSQL	59,6	57	48,66\r\nJavaScript	56,6	69,8	63,61\r\nC#	44,7	34,4	22,42\r\nJava	42,5	45,3	30,55\r\nPHP	34,8	30,7	18,58\r\nC++	27,6	25,4	22,42\r\nC	26,9	23	19,34\r\nPython	21,9	38,8	49,28\r\nObjective-C	11	7	2,31\r\nRuby	10,4	10,1	6,23\r\nPython est le seul à connaître deux progressions consécutives. À l’inverse, sept des dix langages ont connu un « double déclin ». La popularité de C# a diminué de moitié en dix ans, comme pour PHP. Celle d’Objective-C a été divisée par près de cinq.\r\n\r\nLangages les plus appréciés : Rust déjà devant en 2018\r\nParmi les développeurs qui utilisent une technologie, combien veulent continuer ? C’est l’un des autres indicateurs qu’évalue Stack Overflow. Introduit en 2015 sous le nom « Love », il s’appelle désormais « Admire », mais la méthode de calcul reste la même.\r\n\r\nCi-dessous, l’évolution de l’indice pour les dix langages qui étaient les mieux placés en 2015.\r\n\r\nLire aussi : Développeurs : ce qu’ils utilisent… et ce qu’ils plébiscitent\r\n2015	2018	2023\r\nSwift	77,6	65,1	61,42\r\nC++	75,6	46,7	49,77\r\nRust	73,8	78,9	84,66\r\nGo	72,5	65,6	62,45\r\nClojure	71	59,6	68,51\r\nScala	70,6	58,5	52,27\r\nF#	70,1	59,6	57,36\r\nHaskell	69,5	53,6	52,21\r\nC#	67,2	60,4	62,87\r\nPython	66,6	68	65,52\r\n \r\n\r\nSur cet indice, Rust est le seul langage à avoir connu deux hausses successives. Python, C#, Swift et Go se sont maintenus au-dessus des 60 % tout du long, avec une baisse plus marquée pour les deux derniers.\r\n\r\nSept des dix langages les plus populaires en 2013 ne faisaient alors pas partie des plus « aimés ». Ils n’apparaissaient toutefois pas dans le haut du classement. Le tableau ci-dessous présente l’évolution sur cinq ans pour une partie d’entre eux.\r\n\r\n2018	2023\r\nJavaScript	61,9	57,83\r\nSQL	57,5	64,26\r\nJava	50,7	44,11\r\nRuby	47,4	47,69\r\nPHP	41,6	41,83', 'Entre 2013 et 2023, comment a évolué la popularité des langages de programmation ? Bilan avec un point intermédiaire en 2018.', 'AdobeStock_598240416-684x513.jpeg', '1', 3, 5, '2023-07-22 22:00:00', '2023-10-02 12:12:15'),
(10, 'Développeurs : ce qu’ils utilisent… et ce qu’ils plébiscitent', 'Stack Overflow a introduit, dans son enquête annuelle, un indicateur qui rend compte du décalage entre les technologies que les développeurs utilisent et celles qu’ils plébiscitent.\r\n\r\nLes développeurs préfèrent-ils les fichiers Markdown au couple Jira-Confluence ? La dernière édition du sondage annuel que Stack Overflow mène auprès de sa communauté comporte des données à ce sujet.\r\n\r\nC’est la première fois que l’option Markdown figure dans la catégorie « outils asynchrones ».\r\n\r\nAutre nouveauté pour 2023 : des indicateurs « Desired » et « Admired » pour chaque technologie. Ils correspondent respectivement à « a travaillé avec l’an dernier » et « veut travailler avec l’an prochain ».\r\n\r\nCe système en remplace un plus complexe qui était en place depuis 2015. Il se fondait sur trois indicateurs :\r\n\r\n> Loved (équivalent de « a travaillé avec » et « veut travailler avec »)\r\n> Dreaded (« a travaillé avec » et « ne veut pas travailler avec »)\r\n> Wanted (« n’a pas travaillé avec » et « veut travailler avec »)\r\n\r\nLe calcul de l’indice de popularité des technologies n’a quant à lui pas changé. Il repose toujours sur la formule (« Desired » OR « Admired »).\r\n\r\nEn comparant ces métriques, on s’aperçoit que les technologies les plus populaires ne sont pas toujours les plus plébiscitées. En voici quelques illustrations.\r\n\r\nLangages de programmation et de script\r\nSur l’indice global de popularité, JavaScript est en tête pous la 11e année consécutive (63,61 %). Il devance HTML/CSS (52,97 %) et Python (49,28 %). Ce dernier double SQL (48,66 %), qui reste toutefois plus populaire chez les développeurs professionnels.\r\n\r\nAucun ne figure au top des langages que les développeurs souhaiteraient utiliser (« Admired »). Rust (84,66 %), Elixir (73,13 %) et Zig (71,33 %) occupent le podium.\r\n\r\nBases de données\r\nSur l’indice global de popularité, PostgreSQL (45,55 %) devance MySQL (41,09 %) et SQLite (30,9 %). Il ne figure qu’au quatrième rang chez ceux qui apprennent à coder (MySQL est leader sur cette population).\r\n\r\nLire aussi : Python, mais pas que : ces langages devenus plus populaires en une décennie\r\nPostgreSQL est aussi la technologie la plus « désirée » (71,32 %). Datomic (70,49 %) et Redis (69,92 %) affichent des taux comparables.\r\n\r\nPlates-formes cloud\r\nSur l’indice global de popularité, AWS (48,62 %) a quelques longueurs d’avance sur Azure (26,03 %) et Google Cloud (23,86 %). L’écart est plus important chez les développeurs professionnels (53,08 % pour AWS vs 27,8 % pour Azure et 23,95 % pour Google Cloud). Il l’est beaucoup moins chez les apprenants (19,43 % pour AWS contre 19,37 % pour Google Cloud… et 10,99 % pour Azure).\r\n\r\nSur l’indicateur « Desired », aucun des trois hyperscalers n’atteint les taux de Hetzner (70,09 %), Vercel (69,18 %) et Cloudflare (66,19 %).\r\n\r\nFrameworks et technologies web\r\nSur l’indice global de popularité, Node.js (42,65 %) domine. Suivent React (40,58 %) et jQuery (21,98 %). React a une – très courte – tête d’avance chez les développeurs professionnels.\r\n\r\nSur l’indicateur « Desired », là encore, d’autres technos se distinguent. En l’occurrence, Phoenix (82,08 %), Svelte (74,5 %) et Solid.js (71,71 %).\r\n\r\nIDE\r\nQue ce soit sur l’indice global, chez les développeurs pros ou chez les apprenants, même top 3. Visual Studio Code (plus de 70 % dans tous les cas) devance Visual Studio (autour de 30 %) et IntelliJ IDEA (environ 25 %).\r\n\r\nC’est Neovim qui s’en sort le mieux sur l’indicateur « Desired » (81,43 %). Derrière, on trouve Rad Studio (77,56 %) et Rider (73,81 %).\r\n\r\nOutils asynchrones\r\nSur l’indice de popularité, Jira est nettement en tête chez les pros, qui représentent l’essentiel de l’échantillon (58928 répondants sur 71878). Ainsi, il l’est également au global : 52,37 %. Suivent Confluence (34,16 %)… et les fichiers Markdown (26,17 %).\r\n\r\nLa popularité des fichiers Markdown est un peu moins marquée chez les apprenants, mais seul GitHub Discussions fait mieux. Notion arrive en troisième.\r\n\r\nLes fichiers Markdown sont en outre les plus « admirés » (81,83 %). Linear (74,03 %) et GitHub Discussions (70,19 %) complètent le top 3.\r\n\r\nLire aussi : Pourquoi les développeurs privilégient l’open source\r\nOutils synchrones\r\nPremier l’an dernier sur l’indice global de popularité, Zoom recule au troisième rang (45,25 %). Teams (51,71 %) et Slack (47,59 %) lui sont passés devant. Chez les apprenants, qui représentent une petite part de l’échantillon (ici, 4391 répondants sur 84152), Discord est en tête (68,12 %), devant WhatsApp (43,52 %) et Zoom (39,26 %).\r\n\r\nDiscord se trouve aussi parmi les outils les plus « admirés » (72,01 %). Seul Matrix (72,73 %) fait mieux. Signal (71,9 %) n’est pas loin.\r\n\r\nOutils IA pour la recherche\r\nChatGPT, Bing AI, WolframAlpha : chez les pros comme chez les apprenants, même top 3 en popularité. Le chatbot d’OpenAI dépasse les 80 %, contre environ 20 % pour l’IA intégrée au moteur de recherche de Microsoft.\r\n\r\nChatGPT est aussi le plus « admiré » (77,73 %). WolframAlpha est dans le top 3 (68,18 %), devancé néanmoins par un assistant made in Californie : Phind (77,46 %).\r\n\r\nOutils IA pour le développement\r\nMême réflexion que sur la partie recherche : peu importe le public, les mêmes technologies se distinguent sur l’indice de popularité. Au global, GitHub Copilot (54,77 %) devance Tabnine (12,88 %) et AWS CodeWhisperer (5,14 %).\r\n\r\nIl est aussi le plus « admiré », à 72,32 %, contre 65,08 % pour Codeium et 54,73 % pour Whispr AI.', 'Stack Overflow a introduit, dans son enquête annuelle, un indicateur qui rend compte du décalage entre les technologies que les développeurs utilisent et celles qu’ils plébiscitent.', 'développeur-code-écran-logiciel-684x513.png', '1', 1, 1, '2023-09-13 22:00:00', '2023-10-16 12:23:39'),
(11, 'Des tests au CI : AXA et la gestion des applications legacy', 'L’équipe tech d’AXA évoque quelques défis rencontrés lors de la gestion d’applications héritées.\r\n\r\nComment générer de la livedoc ? Chez AXA, on utilise notamment le langage Gherkin couplé à un outil dotnet.\r\n\r\nLes équipes techniques avaient fait un point sur cette approche l’an dernier. Elles s’y sont récemment référées dans le cadre d’un autre sujet : la gestion des applications legacy.\r\n\r\nY est notamment abordée la nécessité de tests unitaires pour sécuriser le processus de reverse engineering qu’impliquent les plus vieilles applications. Dans cette démarche, l’équipe tech d’AXA s’appuie sur les équipes business en récupérant, dans la mesure du possible, leurs propres tests pour enrichir les siens… et générer sa livedoc.\r\n\r\nAXA systématise l’intégration continue\r\nPar « vieille » application, on entend ici celles qui ont plus de 5 ans. Avec elles, il n’est généralement pas question de refonte : on oscille entre décommissionnement et maintenabilité. Il faut cependant permettre au minimum une reprise et maîtriser les risques des éventuelles évolutions sécuritaires/légales à venir.\r\n\r\nPour le legacy plus récent (3 à 5 ans), il s’agit de définir la cible finale : quelle architecture répondra aux normes de développement et apportera de la valeur business ? Comment, une fois cette cible fixée, y arriver par itération en tenant compte des investissements en cours et des contraintes techniques ?\r\n\r\nAvant toute modification, on s’assurera que le projet compile. Puis on mettra en place, si ce n’est pas déjà le cas, une intégration continue. Elle constituera, en particulier, une base pour de la surveillance automatique de sécurité et de qualité. AXA cite trois outils positionnés sur ce segment : SonarQube, Checkmarx et Lifecycle.\r\n\r\n« Ce qui est difficile : réussir à découper les tâches de remise à niveau d’une application, témoigne un développeur. Quand il s’agit de migrer un framework par exemple, on arrive à un point où on ne peut plus le faire par petits bouts et la seule option est d’y dédier un ou plusieurs sprints avec grosse MEP à la fin ». Une situation difficile à « vendre » au métier.', 'L’équipe tech d’AXA évoque quelques défis rencontrés lors de la gestion d’applications héritées.', 'AdobeStock_109243977-684x513.jpeg', '1', 3, 1, '2023-09-13 22:00:00', '2023-10-02 12:12:15'),
(12, 'GitHub : l’IA ne va pas remplacer les développeurs', 'Quel impact aura l’intelligence artificielle générative sur la productivité des développeurs et l’économie ? GitHub a son idée.\r\n\r\nDans quelle mesure l’IA générative impacte les développeurs et l’économie mondiale ?\r\n\r\nGitHub, plateforme de développement détenue par Microsoft, a son idée. L’entreprise l’exprime dans un rapport réalisé avec Keystone.AI et la Harvard Business School.\r\n\r\nL’intelligence artificielle aide les développeurs, mais ne les remplace pas. C’est en tout cas, le message que veut faire passer GitHub au sein de son écosystème.\r\n\r\nL’activité de près de 935 000 développeurs et utilisateurs de GitHub Copilot, assistant de programmation conçu avec OpenAI, a été analysée.\r\n\r\nQuels résultats ont été mis en exergue ?\r\n\r\nL’IA générative, des milliards $ pour l’économie mondiale\r\nEn moyenne, les utilisateurs de l’assistant de programmation acceptent près de 30% des suggestions de code et gagnent ainsi en productivité. En outre, le taux d’acceptation et la productivité augmentent lorsque les développeurs se familiarisent avec l’outil.\r\n\r\nDe surcroît, les gains de productivité obtenus avec l’aide d’un tel assistant contribueraient à une augmentation de 1 500 milliards de dollars du PIB mondial d’ici 2030.\r\n\r\n« Ces estimations sont conservatrices », prévient GitHub. « Ce sont des projections ponctuelles qui ne tiennent pas compte de la demande croissante de développement de logiciels due à la plus grande efficacité et à la numérisation continue qui découlent de l’adoption de l’IA générative. » La perspective est « complémentaire d’autres projections et sources concernant l’impact économique attendu de l’IA générative. »\r\n\r\nAux États-Unis, 9 développeurs sur 10 interrogés disent utiliser des outils d’intelligence artificielle à des fins de programmation (GitHub Copilot, Alphacode de DeepMind, Polycoder, AWS CodeWhisperer…). Et ce dans le cadre de leur activité professionnelle et hors de ce cadre.\r\n\r\nDu côté DevSecOps, selon un concurrent de GitHub, 65% des développeurs disent utiliser l’IA et le machine learning (ML) pour leurs tests de sécurité et les vérifications de code.\r\n\r\nQu’en est-il de la « valeur » au-delà du développement logiciel ?\r\n\r\nSelon une étude récente du cabinet de conseil et d’audit McKinsey, 63 cas d’usage commercial de l’IA générative appliqués à de multiples secteurs pourraient générer une valeur totale comprise entre 2 600 milliards $ et 4 400 milliards $ par an. Ces montants viendraient s’ajouter aux 11 000 à 17 700 milliards $ de valeur économique annuelle issue de l’IA non générative et de l’analyse avancée à l’échelle mondiale, selon les prévisions du groupe.', 'Quel impact aura l’intelligence artificielle générative sur la productivité des développeurs et l’économie ? GitHub a son idée.', 'développeur-code-écran-logiciel-684x513.png', '1', 1, 2, '2023-09-10 22:00:00', '2023-10-02 12:12:15'),
(13, 'Pourquoi les développeurs privilégient l’open source', 'Open source, Cloud computing et Machine learning sont considérés comme les technologies les plus éprouvées par les développeurs.\r\n\r\nQuelles sont les technologies perçues comme des valeurs sûres par les développeurs ?\r\n\r\nLa question a été posée à 2000 d’entre eux dans le cadre d’un sondage promu par la plateforme dédiée à la programmation informatique Stack Overflow.\r\n\r\nL’Open source domine le classement des 10 technologies les plus « éprouvées ».\r\n\r\nOpen source, Cloud et ML dans le top 10\r\n1. Open source\r\n2. Cloud computing\r\n3. Apprentissage automatique (Machine learning)\r\n4. Robotique\r\n5. Internet des objets\r\n\r\n6. Impression 3D\r\n7. Informatique sans serveur (serverless)\r\n8. Traitement du langage naturel\r\n9. Biométrie\r\n10. Outils de prototypage rapide\r\n\r\nEn France, selon une autre analyse (Markess) le marché du logiciel libre et open source pèse près de 6 milliards €. Le secteur devrait croître en moyenne de 7,8% par an d’ici 2027 pour atteindre 8,7 milliards €.\r\n\r\nAu niveau national, le nombre d’emplois équivalents temps plein (ETP) augmenterait de 26 400 d’ici 2027, passant de 63 800 à 90 200 ETP qui développent et intègrent des solutions open source.\r\n\r\nDéveloppeurs, devops, marketeurs, architectes et consultants métier constituent le top 5 des profils les plus recherchés par l’écosystème open source. Aussi, l’IoT, les API et les conteneurs forment le top 3 des domaines de compétences les plus prisés.\r\n\r\nDans l’enquête Stack Overflow, contrairement à l’open source, les technologies low code et no code, la nanotechnologie et l’informatique quantique sont envisagées comme les « plus expérimentales » par les développeurs.\r\n\r\nQu’en est-il des technologies assistées par l’IA ?\r\n\r\nElles sont encore estimées comme « émergentes ». Cependant, les programmes à base d’IA se positionnent en tête de liste des applications les plus susceptibles d’être utilisées massivement par un public large, selon les développeurs du panel.\r\n\r\nLe succès d’une IA générative comme ChatGPT semble le démontrer.  Fin novembre dernier, l’entreprise américaine de recherche en intelligence artificielle OpenAI annonçait le lancement public et en accès libre du chatbot.\r\n\r\nDepuis, ChatGPT bat le record de croissance la plus rapide d’une base d’utilisateurs réguliers.  Deux mois seulement après son lancement, l’agent conversationnel attirait 100 millions d’utilisateurs « actifs ».', 'Open source, Cloud computing et Machine learning sont considérés comme les technologies les plus éprouvées par les développeurs.', 'shutterstock_331439570-684x513.jpg', '1', 3, 1, '2023-09-05 22:00:00', '2023-10-02 12:12:15'),
(14, 'DevOps : ces plates-formes qui reconfigurent le marché', 'Les plates-formes DevOps font désormais l’objet d’un Magic Quadrant. Qui s’y distingue et pour quelles raisons ?\r\n\r\nExit les toolchains DevOps, place aux plates-formes ? Gartner estime que cette approche n’est pas encore majoritaire*. Mais le cabinet américain juge la tendance suffisamment forte pour consacrer un Magic Quadrant aux produits qui relèvent de ce segment de marché. Il les traitait jusqu’alors sous la forme d’un Market Guide.\r\n\r\nD’un format à l’autre, l’axe directeur n’a pas changé : on assiste à une consolidation des outils, autant pour éviter les redondances que les difficultés d’orchestration ou les dettes techniques. L’argument des coûts est moins mis avant…\r\n\r\nConséquence des chevauchements fonctionnels que cela implique, certains fournisseurs de plates-formes DevOps ici distingués sont classés dans d’autres Quadrants. Par exemple, celui de la sécurité applicative ou celui des outils de gestion de projet (« Enterprise Agile Planning Tools » ; voir ci-dessous).\r\n\r\nMagic Quadrant Enterprise Agile Planning Tools\r\n\r\nGitLab est le seul à figurer dans les deux Quadrants en question. Il fait partie des quelques fournisseurs de plates-formes DevOps à proposer des fonctionnalités natives de sécurité applicative, aux côtés, notamment, de GitHub et JFrog.\r\n\r\nLes offreurs sont évalués sur deux axes. L’un prospectif (« vision »), centré sur les stratégies (sectorielle, géographique, commerciale, marketing, produit…). L’autre centré sur la capacité à répondre effectivement à la demande (« exécution » : expérience client, performance avant-vente, qualité des produits/services…).\r\n\r\nLa situation sur l’axe « vision » :\r\n\r\n 	Fournisseur\r\n1	Microsoft\r\n2	GitLab\r\n3	Harness\r\n4	Atlassian\r\n5	JetBrains\r\n6	AWS\r\n7	VMware\r\n8	Google Cloud\r\n9	Red Hat\r\n10	JFrog\r\n11	CloudBees\r\n12	Bitrise\r\n13	CircleCI\r\n14	Codefresh\r\n \r\n\r\nSur l’axe « exécution » :\r\n\r\n 	Fournisseur\r\n1	GitLab\r\n2	Microsoft\r\n3	Atlassian\r\n4	Red Hat\r\n5	JFrog\r\n6	VMware\r\n7	CloudBees\r\n8	CircleCI\r\n9	Harness\r\n10	JetBrains\r\n11	AWS\r\n12	Google Cloud\r\n13	Bitrise\r\n14	Codefresh\r\n \r\n\r\nChez Atlassian, Jira et Confluence font la paire\r\nLa plate-forme d’Atlassian regroupe des capacités de Bitbucket, Confluence, Jira Software, Jira Service Management et Opsgenie. Gartner lui donne des bons points pour son écosystème (« plus de 5000 applications et intégrations » sur la marketplace) et sa prise en charge de multiples profils utilisateurs (personas). Ainsi que pour la partie collaboration/gestion de projets, symbolisées par les jonctions « efficaces » entre Jira Software et Confluence.\r\n\r\nLire aussi : DevSecOps : GitLab muscle le développement distant\r\nPas de sécurité applicative native chez Atlassian, qui s’appuie sur des partenaires tels que Snyk, Sonatype et Synopsys (tous trois classés au Quadrant de l’AST). Gartner le fait remarquer, tout comme il souligne le faible niveau d’adoption des fonctionnalités CI/CD (Bitbucket Pipelines en version cloud et Bamboo Data Center on-prem). Point de vigilance également concernant l’édition serveur, dont la fin de vie est imminente (février 2024)… et les questions de coûts qui pourraient se poser lors du passage aux éditions Cloud et Data Center.\r\n\r\nGitLab et son modèle open core\r\nAu contraire d’Atlassian, GitLab se distingue sur les capacités de sécurité natives, de la génération de SBOM (CycloneDX) au contrôle des commits aligné sur le framework SLSA. Bons points également sur la parité SaaS/on-prem et l’ouverture de la plate-forme, qui fonctionne sur un modèle open core.\r\n\r\nPar opposition à Atlassian, GitLab n’a pas droit à une bonne appréciation sur la partie collaboration/gestion de connaissances. En point d’orgue, l’expérience d’édition sur GitLab Wikis, « limitée » pour les non-développeurs. Gartner regrette aussi le manque de flexibilité sur les licences (impossible d’en associer plusieurs à une instance ou à un namespace). Et le support limité des cas d’usage touchant à la gestion d’environnements (création à la demande, visibilité sur les coûts…).\r\n\r\nGitHub et Azure DevOps : gare à la confusion chez Microsoft\r\nMicrosoft a deux produits à son catalogue : GitHub et Azure DevOps, mutuellement intégrés à plusieurs niveaux et contractualisables en une licence.\r\n\r\nCet ensemble a pour lui sa communauté d’utilisateurs (plus de 100 millions de développeurs sur GitHub ; popularité de VS Code)… et les capacités d’innovation qui en découlent. Il a aussi l’IA Copilot, qui suscite un « grand intérêt » selon Gartner. Bon point également pour Codespaces (environnements de développement cloud avec compute configurable).\r\n\r\nDeux produits, c’est un risque de doublons… que Gartner ne manque pas de pointer, en plus des écarts fonctionnels, y compris entre les versions cloud et on-prem. Autres remarques : les possibilités limitées en matière de localisation des données sur GitHub Enterprise Cloud et l’absence de support natif, sur GitHub dans son ensemble, des métriques de performances (fréquence de déploiement, délai d’exécution, temps de restauration…).\r\n\r\n* 25 % des entreprises utilisent une telle plate-forme en 2023, d’après Gartner. Qui envisage que ce taux sera de 75 % en 2027.', 'Les plates-formes DevOps font désormais l’objet d’un Magic Quadrant. Qui s’y distingue et pour quelles raisons ?', 'AdobeStock_533003131-684x513.jpeg', '1', 1, 6, '2023-07-22 22:00:00', '2023-10-02 12:12:15'),
(32, 'CodeWhisperer vs GitHub Copilot : cap sur les codebases internes', 'À quand un assistant de codage capable de contextualiser ses recommandations en fonction d’une codebase interne ? AWS vient d’émettre une forme de déclaration d’intention à ce sujet : l’édition Enterprise de CodeWhisperer inclura une telle fonctionnalité.\r\n\r\nLe groupe américain ne répond pas à la question du « quand ». Pour le moment, il invite les utilisateurs intéressés à se signaler en prévision du lancement d’une phase expérimentale.\r\n\r\nDes tests ont déjà été conduits dans certaines entreprises. AWS en mentionne une : Persistent Systems, groupe indien de services et conseil en informatique. Les développeurs utilisant CodeWhisperer ont, en moyenne, bouclé leurs tâches « 28 % plus vite » grâce à cette nouvelle option, nous affirme-t-on.\r\n\r\nÀ ce stade, on nous en dit peu sur le socle technique. La promesse, dans les grandes lignes : connectez les ressources internes que vous souhaitez, planifiez des tâches pour créer les personnalisations, puis gérez-les et distribuez-les aux devs à partir de la console AWS.\r\n\r\nGitHub expérimente aussi pour Copilot\r\nGitHub travaille également sur ce volet, dans le cadre d’un projet dénommé Copilot View.\r\n\r\nLe défi est identifié : trouver un équilibre entre pertinence (quelles ressources sont pertinentes vis-à-vis de la tâche en cours ?) et performance (comment ne pas ajouter trop de latence ?).\r\n\r\nLa réponse, elle, n’est pas fixée. GitHub laisse plusieurs pistes ouvertes. En particulier entre l’approche REALM et celle de kNN-LM. La première consiste, sur le principe du RAG, à intégrer les informations pertinentes dans les requêtes faites à Copilot. La seconde ne fait intervenir ces informations que par après, pour influencer la probabilité de générer tel ou tel résultat.\r\n\r\nLe recours à un index vectoriel ne fait en revanche pas de doute. GitHub a identifié plusieurs bibliothèques qu’il juge performantes pour la recherche par la méthode des plus proches voisins. Nommément, SPANN, FAISS et ScaNN.\r\n\r\nPour ce qui est de la vectorisation même, GitHub n’a pas encore tranché entre le recours à un modèle externe ou à l’intégration de capacités d’embedding dans Copilot. Il hésite sur d’autres points comme la localisation de l’index (côté serveur ou client ?).', 'AWS promet une édition Enterprise de CodeWhisperer permettant la connexion de dépôts internes. GitHub travaille aussi sur le sujet.', 'computer-code-684x513.png', '1', 1, 3, '2023-10-16 14:56:44', '2023-10-16 14:58:37'),
(33, 'JetBrains passe de l’open source au commercial pour Rust', 'Avec RustRover, JetBrains joue-t-il fair-play ? Les avis sont partagés quant à cet IDE récemment lancé en phase expérimentale. Pas tant pour des questions de fonctionnalités que de modèle économique.\r\n\r\nJetBrains compte effectivement en faire une offre commerciale. Et la vendre aussi bien seule que dans le cadre du pack All Products. Ce au plus tard dans un an.\r\n\r\nEn parallèle, il abandonne son extension open source permettant la prise en charge de Rust dans IntelliJ IDEA et CLion. Celle-ci existe toujours, sous licence MIT, laissant la possibilité à la communauté d’en reprendre le développement. JetBrains, en tout cas, ne corrigera plus de bugs et n’apportera plus de nouvelles fonctionnalités.\r\n\r\nCompatible CLion… pour le moment\r\nL’éditeur s’engage à ce que RustRover soit à parité avec ses autres IDE (l’UI, notamment, est la même, comme la keymap). On pourra l’utiliser de manière autonome, mais aussi en tant qu’extension pour IDEA Ultimate. Pendant la preview, il est également possible de l’installer sur CLion – une compatibilité que JetBrains n’est pas certain de maintenir.\r\n\r\nRustRover est disponible en versions Arm et x86 64 bits pour Windows, Mac et Linux. Configuration recommandée : 8 Go de RAM et 5 Go de SSD. Si on dispose d’une installation du plug-in sur un autre IDE JetBrains, la migration des projets est automatique.\r\n\r\nRustRover inclut des éléments spécifiques au développement web (client HTTP, accès base de données, support de Docker…).RustRover web\r\n\r\nPour le débogage, on commence avec LLDB… et la perspective d’intégrer, à terme, GDB.\r\n\r\ncoloration syntaxe\r\ncoloration syntaxique\r\nL’intégration de linters externe (Cargo Check et Clippy) est effective. On peut aussi ajouter des extensions tierces.\r\n\r\n', 'JetBrains abandonne son plug-in Rust open source à la faveur d’un IDE commercial, lancé en phase expérimentale.', 'AdobeStock_317488108_Editorial_Use_Only-684x513.jpeg', '1', 9, 4, '2023-10-16 14:56:44', '2023-10-16 14:58:57');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `is_enable` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `avatar`, `is_admin`, `is_enable`) VALUES
(1, 'Karol', 'Zielinski', 'karol.zielinski@laposte.net', '$2y$10$4GJ6wnftdZKiJriB.8.J4.c03Dw9is3BZltKFmDGvci6KwLLz5362', 'avatar8.jpg', 1, 1),
(2, 'Jean', 'Dupont', 'jean.dupont@gmail.com', '$2y$10$l4le4ekTmW7hG/dqWmebpeRqbJkReMAeK6xVQVbryDuOyhlPR4Fzm', 'avatar2.jpg', 0, 1),
(3, 'Francois', 'Mauton', 'francois.mauton@gmail.com', '$2y$10$4GJ6wnftdZKiJriB.8.J4.c03Dw9is3BZltKFmDGvci6KwLLz5362', 'avatar3.jpg', 1, 1),
(4, 'Pierre', 'Laure', 'pierre.laure@gmail.com', '$2y$10$TMad2Fl9RdRxnlcrbQDlje/uGpuVRGGv5HfcrIyxtA2Wky0Palv26', 'avatar5.jpg', 0, 1),
(5, 'Paul', 'LASSO', 'paul.lasso@gmail.com', '$2y$10$Jk4jW11hT/.dIJyANs2ktOSmNyTjWdD6wTKN7mxSWFfogsvc3XIIC', 'avatar5.jpg', NULL, NULL),
(6, 'Francois', 'Jean', 'jf@gmail.com', '$2y$10$ufL1nZ5kpF0BGNE3seuzDOTOAv7Abi29fYjSu7lHwhat66XqDRnti', 'avatar4.jpg', 0, 1),
(9, 'Julien', 'MOPPA', 'julien.moppa@gmail.com', '$2y$10$2im.2pKhae36HX5QbkY4q.n7rDktY/WSMY1FvtQuO1gcFnxZ54tL6', NULL, 1, 1),
(17, 'Julien', 'LAMOTTE', 'julien.lamotte@gmail.com', '$2y$10$9X//o0bDJ.1dL89ckRBgWupMjKz5qnUqxanY3rWTzlkROJD6hPBU6', NULL, 0, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_post` (`id_post`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_categories` (`id_categories`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
