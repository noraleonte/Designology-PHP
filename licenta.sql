-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2021 at 02:06 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `licenta`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_status`
--

CREATE TABLE `account_status` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_status`
--

INSERT INTO `account_status` (`id`, `status`) VALUES
(1, 'neconfirmat'),
(2, 'confirmat'),
(3, 'interzis');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `course_id`, `title`, `points`, `type`, `url`) VALUES
(26, 26, 'Ce Este Accesibilitatea?', 15, 1, 'ce-este-accesibilitatea?'),
(27, 26, 'Tehnologii Asistive', 13, 1, 'tehnologii-asistive'),
(28, 26, 'Accesibilitate Pentru Cei Cu Deficiente De Vedere', 7, 1, 'accesibilitate-pentru-cei-cu-deficiente-de-vedere'),
(29, 26, 'Accesibilitate Pentru Cei Cu Dizabilitati Motorii', 6, 1, 'accesibilitate-pentru-cei-cu-dizabilitati-motorii'),
(30, 26, 'Accesibilitate Pentru Cei Du Deficiente De Auz', 5, 1, 'accesibilitate-pentru-cei-du-deficiente-de-auz'),
(31, 26, 'Accesibilitate Pentru Persoane Dislexice', 5, 1, 'accesibilitate-pentru-persoane-dislexice'),
(32, 26, 'Accesibilitate Pentru Persoane Din Spectrul Autist', 4, 1, 'accesibilitate-pentru-persoane-din-spectrul-autist'),
(33, 26, 'Accesibilitate Pentru Cei Care Sufera De Anxietate', 5, 1, 'accesibilitate-pentru-cei-care-sufera-de-anxietate'),
(34, 27, 'Termeni Cheie', 11, 1, 'termeni-cheie'),
(35, 27, 'Tipuri De Fonturi', 7, 1, 'tipuri-de-fonturi'),
(36, 27, 'Anatomia Fonturilor', 6, 1, 'anatomia-fonturilor'),
(37, 27, 'Greutate Aliniere Si Spatiere', 10, 1, 'greutate-aliniere-si-spatiere'),
(38, 27, 'Ierarhia Tipografica', 8, 1, 'ierarhia-tipografica'),
(39, 27, 'Alegerea Fonturilor', 8, 1, 'alegerea-fonturilor'),
(41, 29, 'Grila (Grid)', 5, 1, 'grid'),
(42, 29, 'Părțile Gridului', 7, 1, 'partile-gridului'),
(43, 29, 'Regula Treimilor', 5, 1, 'regula-treimilor'),
(44, 29, 'Golden Ratio Sau Proporția De Aur', 5, 1, 'golden-ratio-sau-proportia-de-aur'),
(45, 30, 'Avantajele Si Dezavantaje', 5, 1, 'avantajele-si-dezavantaje'),
(46, 30, 'Incepe Sa Lucrezi In Figma', 4, 1, 'incepe-sa-lucrezi-in-figma'),
(47, 30, 'Primul Fisier', 4, 1, 'primul-fisier'),
(48, 30, 'Forme', 8, 1, 'forme'),
(49, 30, 'Gruparea Elementelor', 6, 1, 'gruparea-elementelor'),
(50, 30, 'Reutilizarea Elementelor', 5, 1, 'reutilizarea-elementelor'),
(51, 30, 'Grid', 6, 1, 'grid'),
(52, 30, 'Comunitate', 5, 1, 'comunitate'),
(53, 30, 'Pluginuri', 5, 1, 'pluginuri'),
(54, 27, 'Ierarhia Tipografică', 0, 2, './minigames/type');

-- --------------------------------------------------------

--
-- Table structure for table `chapter_progress`
--

CREATE TABLE `chapter_progress` (
  `id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chapter_progress`
--

INSERT INTO `chapter_progress` (`id`, `chapter_id`, `user_id`, `completed`, `date`) VALUES
(163, 26, 49, 1, '2021-06-19 21:43:40'),
(164, 27, 49, 1, '2021-06-19 21:43:48'),
(165, 31, 49, 1, '2021-06-19 21:43:54'),
(166, 26, 53, 1, '2021-06-22 23:33:40'),
(167, 41, 49, 1, '2021-06-22 23:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `chapter_type`
--

CREATE TABLE `chapter_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chapter_type`
--

INSERT INTO `chapter_type` (`id`, `type`) VALUES
(1, 'Text și imagini'),
(2, 'Joc');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `content`, `date`, `user_id`, `post_id`) VALUES
(45, 'Nullam sit amet varius mi. Nulla tincidunt gravida massa eu iaculis. Donec pellentesque sapien vel elit accumsan, id tempus metus consequat.', '2021-06-22 23:58:57', 49, 40);

-- --------------------------------------------------------

--
-- Table structure for table `confirmation_codes`
--

CREATE TABLE `confirmation_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `confirmation_codes`
--

INSERT INTO `confirmation_codes` (`id`, `code`, `user_id`, `date_created`) VALUES
(16, 'HpAle7', 49, '2021-05-02 17:55:02'),
(19, '6CAm77', 52, '2021-06-22 22:42:50'),
(20, 'Yi6WTl', 53, '2021-06-22 23:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `introduction` text NOT NULL,
  `cover` varchar(255) NOT NULL,
  `points` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `introduction`, `cover`, `points`, `url`, `color`) VALUES
(26, 'Accesibilitate', 'Accesibilitatea nu este o cerință obligatorie, dar ar trebui să fie una dintre principiile de bază în care să ne ghidăm, pentru că design-ul bun este pentru toată lumea.|Importanța acordată utilizatorului este o parte fundamentală din user experience design. Ceea ce tindem să uităm este că utilizatorul nu este o singură persoană, ci există mai mulți utilizatori cu nevoi și abilități variate./\r\nUn produs digital este bine proiectat dacă își servește toți utilizatorii în mod echitabil. Ceea ce înseamnă că, dacă proiectezi un produs, iar unul sau câțiva utilizatori care fac parte din publicul țintă nu îl pot accesa, sau nu se pot bucura de toate funcționalitățile acestuia, ai dezamăgit acei utilizatori. Asta pune multă greutate pe umerii tăi, de aceea este bine să înțelegi conceptul de accesibilitate.', './img/accesibilitate2.png', 60, 'accesibilitate', '#a9dff4'),
(27, 'Tipografie', '<h3 class=\"left_text\">Utilizarea textului în design</h3></br>\r\nTipografia reprezintă arta și tehnica aranjării textului scris în pagină pentru a-l face lizibil și plăcut estetic. Acest domeniu include alegerea familiilor de fonturi, al dimensiunilor și spațierii.|Interfețele digitale cu care interacționăm zi de zi includ o varietate largă de imagini și elemente vizuale. Cu toate acestea, cel mai des întâlnim conținut sub formă de text scris. Pentru a putea proiecta și dezvolta produse digitale utilizabile, utile și estetice, trebuie să ne asigurăm că și conținutul scris urmează un set de reguli./Există multe moduri în care putem afișa text, și din ce în ce mai multe stiluri pe care blocurile scrise le pot însuși. Aceste stiluri trebuie să fie mereu în concordanță cu mesajul general al produsului și să se afle în armonie cu restul conținutului de pe pagină, indiferent de tipul acestora. În același timp, stilul ales trebuie nu numai să se potrivească cu contextul produsului, ci și să asigure lizibilitate și un flux de utilizare facil și cât mai natural. Pentru a putea face alegeri potrivite legate de conținutul scris, trebuie să înțelegem termeni cheie, concepte de bază legate de anatomia literelor, ierarhia conținutului scris, și multe altele.', './img/typography-cover.png', 50, 'tipografie', '#ed7e7e'),
(29, 'Așezare În Pagină', 'Secretul designului bun stă în modul în care elementele vizuale sunt așezate în pagină, și în felul în care relaționează între ele în funcție de poziționarea lor. Exact despre asta vom vorbi în această secțiune.|\r\nAșezarea sau layout-ul dă sens designului ca un ansamblu, și îl face estetic. Un layout bun ajută la menținerea balanței și consistenței de la o pagină la alta. Mulți designeri trec prin acest proces în mod organic, poziționând elementele intuitiv. În timp ce această abordare poate duce la multe ”accidente” fericite, este bine, totuși, să se țină cont de câteva concepte de bază pentru a asigura rezultatele așteptate.<br><br>\r\nO compoziție bună ar trebui să fie plăcută din punct de vedere estetic, dar trebuie să comunice în mod eficient mesajele cheie, asigurând în același timp un flux intuitiv al utilizatorului pe pagină. În capitolele acestei secțiuni vom prezenta câteva concepte de bază legate de teoria layout design-ului.', './img/layout_cover.png', 22, 'asezare-in-pagina', '#97ccc1'),
(30, 'Tutorial Figma', 'Figma este un software gratis pentru design de interfețe, prototipizare, și nu numai. Figma are multe instrumente foarte utile atunci când vine vorba de design de...orice.|\r\n\r\nAm făcut cunoștință cu acest software în urmă cu ceva timp și m-a ajutat nu numai să proiectez interfețe de aplicații de website-uri, ci și să creez user flow-uri, wireframe-uri, sitemap-uri, diagrame sau pictograme. <br><br>\r\n\r\nSpre deosebire de alte soft-uri de design foarte folosite, Figma nu necesită salvarea fișierelor pe calculatorul personal, deși e posibilă, ci salvează automat totul în cloud. Asta mai înseamnă și că fișierele sunt accesibile de oriunde, oricând, prin contul personal. Este un software versatil, care permite importul fișierelor din alte formate ale programelor similare, dar permite și exportul creațiilor în format PNG, SVG, CSS sau PDF.  <br><br>\r\n\r\nCoworking-ul devine foarte ușor, pentru că există mai multe funcționalități care permit echipelor să colaboreze pe același proiect în același timp. <br><br>\r\n\r\nEste un program foarte ușor de folosit, accesibil și din browser, dar, deși este intuitiv, vom prezenta aici câteva dintre funcționalitățile principale. <br><br>\r\n', './img/cover_figma.png', 48, 'tutorial-figma', '#ffc045');

-- --------------------------------------------------------

--
-- Table structure for table `course_progress`
--

CREATE TABLE `course_progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `progress` int(11) NOT NULL DEFAULT 0,
  `last_active` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_progress`
--

INSERT INTO `course_progress` (`id`, `user_id`, `course_id`, `progress`, `last_active`) VALUES
(54, 49, 27, 0, '2021-05-02 18:16:31'),
(56, 49, 26, 33, '2021-06-19 21:43:35'),
(57, 53, 26, 15, '2021-06-22 23:33:33'),
(58, 49, 29, 5, '2021-06-22 23:58:40'),
(59, 52, 27, 0, '2021-06-23 00:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `date`, `user_id`, `post_id`) VALUES
(81, '2021-06-22 23:58:58', 49, 40),
(82, '2021-06-23 00:00:25', 52, 41);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `topic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `content`, `date`, `user_id`, `topic`) VALUES
(40, 'Vivamus at ornare lorem. Sed vel nibh suscipit, eleifend orci ut, varius mauris. Nulla arcu nunc, consectetur ut arcu vel, auctor interdum arcu. Sed nec tempus erat, a laoreet magna. Maecenas rutrum vulputate aliquet. Vestibulum id imperdiet ante. Aenean dignissim a nisl eu placerat.', '2021-06-22 23:58:20', 53, 2),
(41, 'Integer fermentum dui vitae rhoncus dignissim. Integer vel lectus eget erat sagittis vulputate sit amet at turpis. Aenean eget iaculis sapien, vel vehicula eros. Nullam felis nulla, efficitur a consectetur et, vulputate euismod mi. Pellentesque porttitor leo eget dignissim eleifend. Donec in lobortis leo.', '2021-06-22 23:59:15', 49, 10),
(42, 'Ut eleifend, tellus et dictum mollis, est turpis varius libero, id accumsan libero lectus at ex. Donec egestas rutrum erat, in semper risus semper et. Praesent arcu leo, sagittis et aliquam id, vestibulum non urna. Maecenas id ullamcorper orci. Proin erat arcu, commodo porttitor aliquam in, condimentum ac turpis. Cras quis leo et elit auctor semper ut eu libero. Suspendisse non ornare neque.', '2021-06-23 00:00:10', 52, 7);

-- --------------------------------------------------------

--
-- Table structure for table `rewards`
--

CREATE TABLE `rewards` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `points_necessary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rewards`
--

INSERT INTO `rewards` (`id`, `type`, `category`, `name`, `url`, `points_necessary`) VALUES
(1, 1, 2, 'Newbie', NULL, 10),
(2, 2, 2, NULL, './img/badges/1.png', 30),
(3, 1, 2, 'Avansat', NULL, 40),
(4, 2, 2, NULL, './img/badges/2.png', 60),
(5, 1, 2, 'Expert', NULL, 70),
(6, 2, 2, NULL, './img/badges/3.png', 90),
(7, 1, 2, 'Profesor', NULL, 100),
(8, 1, 2, 'Geniu', NULL, 110),
(9, 2, 2, NULL, './img/badges/4.png', 130),
(10, 1, 2, 'Geniu Absolut', NULL, 140),
(11, 2, 2, NULL, './img/badges/5.png', 160),
(12, 2, 2, NULL, './img/badges/6.png', 180),
(13, 1, 1, 'Timid', NULL, 20),
(14, 1, 1, 'Sociabil', NULL, 50),
(15, 1, 1, 'Popular', NULL, 90),
(16, 1, 1, 'Prieten bun', NULL, 130),
(17, 1, 1, 'Mereu acolo', NULL, 180),
(18, 1, 3, 'Admin', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reward_category`
--

CREATE TABLE `reward_category` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reward_category`
--

INSERT INTO `reward_category` (`id`, `category`) VALUES
(1, 'community'),
(2, 'course'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `reward_type`
--

CREATE TABLE `reward_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reward_type`
--

INSERT INTO `reward_type` (`id`, `type`) VALUES
(1, 'title'),
(2, 'badge');

-- --------------------------------------------------------

--
-- Table structure for table `subsections`
--

CREATE TABLE `subsections` (
  `id` int(11) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `text` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subsections`
--

INSERT INTO `subsections` (`id`, `chapter_id`, `type`, `text`, `image`) VALUES
(101, 26, 2, 'Considerăm că un produs este accesibil atunci când poate fi utilizat pe deplin și conținutul său poate fi accesat ușor de către oricine.', './img/utilizatori-diversi.png'),
(102, 26, 7, 'Asta înseamnă că trebuie să ne îndepărtăm de la ideea situațiilor ideale\r\nși de la ce considerăm noi a fi ”utilizatori obișnuiți”, și să ne îndreptăm\r\natenția către cei care interacționează cu lumea din jur diferit față de cum\r\no facem noi. Această interacțiune specială poate fi cauzată de o deficiență\r\nsau dizabilitate, fie ea fizică sau psihologică, temporară, permanentă sau\r\nprogresivă.</br>\r\nUnele persoane pot avea deficiențe de vedere, altele de auz, motorii, sau\r\ndiferite probleme psihologice cu care se confruntă.', ''),
(103, 26, 6, 'Auz;;;Vedere;;;Motorii', './img/auz.png;./img/nevazatori.png;./img/dizabilitati-motorii.png'),
(104, 26, 7, 'Datoria unui designer sau developer este de a găsi o modalitate pentru a\r\nface călătoria descoperirii unui produs cât mai plăcută, intuitivă și ușoară\r\ncu putință pentru toată lumea, indiferent de situația în care se află.\r\nAccesibilitatea nu este o cerință obligatorie, dar ar trebui să fie una dintre\r\nprincipiile de bază după care să ne ghidăm, pentru că design-ul bun este pentru\r\ntoată lumea.', ''),
(105, 26, 1, 'Pentru a putea crea un produs accesibil, trebuie să înțelegem categoriile de\r\nutilizatori. În principiu, după cum ziceam și în introducere, motivele pentru\r\ncare unii utilizatori ar avea nevoie de produse mai accesibile se împart în\r\nmotive temporare, permanente și progresive.', './img/echipa-designeri.png'),
(106, 26, 6, 'Temporar sau situațional;;;Progresiv;;;Permanent', './img/temporar.png;./img/progresiv.png;./img/permanent.png'),
(107, 26, 7, 'Când vorbim de deficiențe temporare ne putem gândi la cineva care a avut\r\nrecent o operație la ochi sau la cineva cu un picior rupt. Putem să ne gândim\r\nși la situația în care cineva care lucrează într-un call center și are căști pe\r\ncap ar vrea să utilizeze produsul pe care îl dezvoltăm. În același timp, există\r\npersoane care au anumite dizabilități permanente, cum ar fi cei surzi sau cu\r\ndeficiențe de auz, cei nevăzători sau cu deficiențe de vedere sau persoane\r\ncu probleme locomotorii. Este important să ne gândim și la cei care se\r\nconfruntă cu diverse probleme la nivel psihologic, spre exemplu cei care\r\nsuferă de anxietate sau persoanele din spectrul autist. Asupra lor, stimulii\r\nvizuali care există în cadrul aplicației pot avea un impact semnificativ.', ''),
(108, 26, 2, 'De cele mai multe ori, va fi greu să\r\nne gândim de la început la toate, de\r\naceea este bine să se efectueze user\r\ntesting, și să colaborăm, să cerem\r\npăreri.', './img/testare-utilizabilitate.png'),
(109, 26, 7, 'Probabil mulți vă gândiți  <strong> Ok, înțeleg, dar cum mă ajută asta să dezvolt un\r\nprodus mai bun?</strong></br></br>\r\nEi bine, faptul că există mai multe categorii de utilizatori decât ne-am fi\r\ngândit inițial înseamnă probabil că există și mai multe modalități în care\r\nacești accesează și utilizează produsele digitale. În următorul capitol vom\r\nîncerca să înțelegem câteva dintre aceste interacțiuni, și felul în care pot\r\ninfluența funcționalitățile și interfața produsul nostru.', ''),
(110, 27, 2, 'Am stabilit mai înainte că diversitatea\r\nutilizatorilor duce la diversitatea\r\nmodalităților de interacțiune cu\r\nprodusele digitale. De multe ori,\r\nunele categorii de persoane pot avea\r\nnevoie de diverse “unelte” pentru\r\na depăși unele impasuri de care se\r\nlovesc. Aceste unelte se numesc\r\ngeneric tehnologii asistive.', './img/tehnologii-asistive.png'),
(111, 27, 9, '<strong>Definiție: </strong>Tehnologia asistivă este orice device, software sau echipament\r\ncare vine în ajutorul persoanelor care se confruntă cu diferite dificultăți.\r\nUn scaun cu rotile este o tehnologie asistivă. La fel este poate fi și o\r\ntastatură.', ''),
(112, 27, 7, 'Tehnologiile de asistare de tip soft pot fi aplicații sau plugin-uri text-tospeech,\r\ncare îi ajută pe cei nevăzători să înțeleagă conținutul scris al unei\r\naplicații sau pagini web.', ''),
(113, 27, 3, 'Într-o manieră asemănătoare există\r\nși tehnologii care îi ajută pe aceștia\r\nsă scrie, interpretând cuvinte rostite\r\nși transformându-le în text scris.</br>\r\nDe asemenea, există o varietate mare\r\nde aplicații de corectare gramaticală\r\npentru cei dislexici.', './img/tehnologii-asistive2.png'),
(114, 27, 7, 'Există și o serie de dispozitive low-tech sau high-tech cu scopuri specifice\r\npentru a-i ajuta în interacțiunea cu calculatorul pe cei care au nevoie.', ''),
(115, 27, 6, 'Tastatură\r\nadaptată;;;Tastatură\r\nadaptată;;;Alternativă\r\nmouse', './img/adaptare-tastatura-1.jpg;./img/adaptare-tastatura2.jpeg;./img/alternativa-mouse.jpg'),
(116, 27, 7, 'Toate acestea înseamnă că, având nevoie de diferite unelte să interacționeze\r\ncu produsele digitale, aceste persoane au nevoie ca produsele digitale să fie\r\ncât mai accesibilie din punctul de vedere a acelor unelte auxiliare.', ''),
(117, 27, 1, 'Spre exemplu, o mare parte din oameni o să dorească să acceseze un site\r\nweb, să spunem, de pe o tabletă sau un telefon, pentru că este mai ușor\r\nsă interacționeze cu un ecran tactil decât cu o tastatură și un mouse. De\r\naceea, în funcție de publicul țintă, responsiveness este un concept care va\r\ntrebui luat în calcul.', './img/responsiveness.png'),
(118, 27, 9, '<strong>Definiție:</strong> Responsiveness este proprietatea unui produs digital de a se\r\nadapta la dispozitive de dimensiuni și proprietăți diverse, păstrându-și\r\nsau adaptându-și în același timp toate funcționalitățile inițiale.', ''),
(119, 27, 2, 'Poate persoanele cu probleme de\r\nvedere vor folosi soft-uri pentru\r\na citi conținutul unei pagini, sau\r\npentru a putea determina unde se\r\npoziționează anumite elemente. De\r\naceea, este important să se adauge\r\netichete fiecărui element distinctiv,\r\nși descrieri la imagini.', './img/etichetare.png'),
(120, 27, 10, 'Faptul că trebuie să îmi adaptez produsul la nevoile persoanelor cu dizabilități înseamnă că trebuie să renunț la calitate și estetică?', ''),
(121, 27, 7, 'Nicidecum. Trebuie doar să te gândești din mai multe perspective la felul în\r\ncare oameni pot interacționa cu o funcționalitate înainte să o implementezi.\r\nAdevărul este că, atunci când ceva este proiectat în așa fel încât să faciliteze\r\nanumite categorii de persoane, acel ceva ne facilitează activitățile tuturor.\r\nSpre exemplu, o rampă pentru cărucioare nu ajută doar persoanele în\r\ncărucioare, ci și mămicile cu cărucior pentru copii.</br></br>Butoanele de acces care deschid ușile ne ajută pe toți atunci când avem\r\nmâinile ocupate, și cu toții mai întrebăm asistentul virtual de pe telefon cum\r\nva fi vremea afară. Pe scurt, accesibilitatea nu ar trebui să vină în detrimentul\r\nesteticii sau calității. Ba chiar din contră, un produs bun este accesibil, estetic\r\nși funcțional în toate mediile din care se poate accesa. Ansamblul acestor\r\ncaracteristici îl face calitativ.', ''),
(122, 28, 10, 'Folosește culori contrastante.', ''),
(123, 28, 2, 'Elementele contrastante sunt mai ușor de distins în orice context, pentru oricine. Există resurse online care determină cât de potrivite sunt culorile alese de tine potrivit unor standarde.', './img/culori-contrastante.png'),
(124, 28, 7, 'Poți intra pe <a href=\" https://colorable.jxnblk.com/\">colorable.jxnblk.com</a>, unde vei putea testa combinații de culori. Se poate întâmpla ca ție să ți se pară potrivită paleta aleasă, dar diverse tool-uri să îți sugereze altceva, sau să acorde scoruri mai mari unor palete...nu tocmai plăcute vizual. E bine să ții minte că software-ul nu are sensibilitate estetică, știe doar să aprecieze ce este corect și ce nu. Încearcă în asemenea situații să ajustezi nuanțele, sau consultă-te cu alții, cere păreri, și ține cont de intuiția ta de designer în primul rând. Acele aplicații sunt acolo să te ajute, nu să seteze reguli stricte.', ''),
(125, 28, 9, '<strong>Sfat:</strong> Trebuie să ții cont de faptul că paleta de culori tebuie să fie în primul rând armonioasă și plăcută vizual. Nu folosi culori prea stridente doar pentru a obține contrast.', ''),
(126, 28, 10, 'Folosește dimensiuni adecvate ale fonturilor', ''),
(127, 28, 3, 'Dacă vrei ca un conținut scris să fie lizibil, folosește font-uri de dimensiuni mai mari. Nu folosi scris mic, pentru că va fi greu de citit pentru toată lumea. Ierarhia textului rămâne în continuare importantă și nu exagera cu dimensiunile mult prea mari. Totul ține de echilibru.', './img/dimensiunea-fontului.png'),
(128, 28, 10, 'Organizează adecvat conținutul', ''),
(129, 28, 2, 'Organizează bine conținutul de pe pagină, în așa fel încât acesta să aibă consistență și o așezare logică. Informația împrăștiată și greu de urmărit este ușor neglijată. Dacă conținutul tău nu urmează o secvență logică și o așezare adecvată, utilizatorii tăi vor fi copleșiți.', './img/asezare-in-pagina.png'),
(130, 28, 10, 'Grupează elementele de aceeași categorie', ''),
(131, 28, 3, 'Dacă două sau mai multe elemente au legătură între ele, logica spune că acea legătură trebuie făcută vizibilă într-un fel sau altul. Spre exemplu, dacă ai un formular, butonul de <strong>”SUBMIT”</strong> ar trebui să se afle în proximitatea câmpurilor.', './img/grupare-elemente.png'),
(132, 28, 10, 'Folosește etichete și descrieri', ''),
(133, 28, 2, 'Etichetează pictogramele, câmpurile formularelor și butoanele, pentru a fi mai ușor identificate de către persoane și de către tehnologii asistive de tip ”page reader”. Imaginile și videoclipurile ar trebui să aibă o descriere sugestivă.', './img/etichetare2.png'),
(134, 28, 9, '<strong>Sfat: </strong>Etichetele (label) sau placeholdere-le care rămân vizibile într-un fel după activarea unui câmp din formular sunt mai potrivite decât placeholderele care dispar.', ''),
(135, 29, 10, 'Spațiile interactive mai mari', ''),
(136, 29, 3, 'Spațiile interactive, cum ar fi checkbox-urile nu ar trebui să necesite precizie foarte mare. Este mai ușor pentru oricine să dea click pe o zonă mai mare decât să nimerească un punct fix cu mouse-ul.', './img/zone-interactive.png'),
(137, 29, 10, 'Spațiere între elemente', ''),
(138, 29, 2, 'Trebuie să existe spațiu între elementele unei pagini, pentru a putea fi distinse mai ușor.', './img/distanta-elementelor.png'),
(139, 29, 10, 'Conținut consistent', ''),
(140, 29, 7, 'Conținutul paginii nu ar trebui să se schimbe automat și rapid, iar cel interactiv nu ar trebui să se miște sau schimbe deloc. Ar fi bine ca unele funcționalități să suporte, în limita posibilităților interacțiunea cu tastatura, nu doar cu mouse-ul.', ''),
(141, 29, 10, 'Oferă scurtături', ''),
(142, 29, 2, 'Acolo unde se poate, ar putea fi o idee bună să le oferi posibilități de autocompletare a câmpurilor sau meniuri de tip dropdown pentru ca aceștia să nu fie nevoiți să tasteze. Oferă opțiunea de a reține informația relevantă, pentru ca utilizatorul să nu fie nevoit să întroducă de mai multe ori același lucru.', './img/scurtaturi.png'),
(143, 29, 10, 'Alocă timp sufcient', ''),
(144, 29, 4, 'Gândește-te la timpul necesar pentru cineva cu dizabilități motorii să tasteze. Time out-ul sesiunilor online ar trebui gândit în funcție de acel interval de timp.', './img/timpul-acordat.png'),
(145, 30, 10, 'Include subtitrări', ''),
(146, 30, 2, 'Dacă produsul tău include conținut video sau audio, gândește-te la posibilitatea de a include subtitrări sau interpretări, și de a oferi acel conținut în mai multe formate.', './img/subtitrari.png'),
(147, 31, 10, 'Include suport vizual', ''),
(148, 31, 3, 'Nu include blocuri mari de text. În schimb, poți sparge informațiile în bucățele mici, și ar fi ideal să ai un fel de suport vizual pentru informația relevantă. Suportul vizual poate fi imagine, diagramă sau videoclip. Ia în considerare posibilitatea de a pune la dispoziția utilizatorilor și sub alte formate, cum ar fi cel audio sau video.', './img/suport-vizual.png'),
(149, 31, 10, 'Folosește un limbaj uzual', ''),
(150, 31, 3, 'Folosește un limbaj simplu, pe care îl poate înțelege oricine. Păstrează propozițiile simple, nu înflori cu figuri de stil inutile. <i>Call-to-action</i> -urile trebuie să fie specifice și exacte.', './img/limbaj.png'),
(151, 31, 10, 'Reamintește utilizatorul', ''),
(152, 31, 2, 'Dacă produsul tău se bazează pe informație organizată pe mai multe pagini, nu te aștepta de la utilizatori să rețină informații prezentate cu cinci pagini în urmă. Oferă mici mesaje de reamintire, include scurte recapitulări sau sumare. Volumul mare de informație e mai ușor de digerat așa.', './img/reamintire.png'),
(153, 31, 10, 'Folosește font-ul potrivit', ''),
(154, 31, 3, 'Alege fonturi foarte ușor lizibile. De multe ori avem tendința să alegem fonturi speciale, decorative și foarte copleșitoare din punct de vedere vizual, dar când litera d este greu de distins de litera a, nimănui nu îi este ușor să citească acel text. Fiecare font are rolul lui specific, trebuie să te gândești bine la contextul produsului tău.', './img/alegere-font.png'),
(155, 31, 9, '<strong>Sfat:</strong> Pe platforma Google Fonts, și deseori pe platformele asemănătoare, sunt incluse pentru fiecare familie de fonturi descrieri și recomandări de utilizare.', ''),
(156, 32, 10, 'Culori potrivite', ''),
(157, 32, 3, 'Colurile alese, deși trebuie să păstreze o armonie. Deobicei nu e bine să folosim culori prea stridente sau deranjante. Cu toate că trebuie să existe contrast pentru vizibilitate, Relația dintre culorile alese trebuie analizată cu grijă.', './img/armonia-culorilor.png'),
(158, 32, 10, 'Folosește limbaj uzual', ''),
(159, 32, 7, 'Folosește un limbaj simplu, pe care îl poate înțelege oricine. Păstrează propozițiile simple, nu înflori cu figuri de stil inutile.  Păstrează instrucțiunile clare și precise. Nu copleși utilizatorul cu propoziții vagi. Butoanele și elementele interactive trebuie să fie descriptive, iar reacțiile generate de butoane trebuie să fie predictibile.', ''),
(160, 33, 10, 'Alocă timp sufcient', ''),
(161, 33, 2, 'Unele persoane pot avea nevoie de mai mult timp pentru a completa o acțiune. Oferă-le suficient timp, pentru a nu fi supuși la o presiune din acest punct de vedere.', './img/timpul-acordat.png'),
(162, 33, 10, 'Oferă descieri clare și explicații', ''),
(163, 33, 3, 'Explică exact ce se va întămpla după acționarea unui buton, și asigură-te că elementele interactive vin cu instrucțiuni specifice. Nu lăsa utilizatorul să se întrebe ce se va întâmpla. Asigură-te că informația importantă este mereu clară și precisă.', './img/explicatii-detaliate.png'),
(164, 33, 10, 'Oferă suport și posibilitatea de a verifica de două ori', ''),
(165, 33, 2, 'Oferă ajutor sau tutoriale pentru elementele care consideri că ar putea fi copleșitoare. Suportul poate însemna și descrieri foarte detaliate și instrucțiuni foarte clare. De asemenea, oferă-le utilizatorilor șansa să verifice și să modifice ulterior informația introdusă de ei.', './img/suport.png'),
(166, 33, 9, '<strong>Fun fact: </strong>Ai observat că atunci când ți-ai creat contul pe platformă\r\nți-am oferit șansa să verifici de două ori datele introduse în formular?', ''),
(167, 34, 7, 'Cuvântul cel mai des asociat cu tot ce ține de design-ul conținutului de tip text este font. De cele mai multe ori, termenul nu este folosit tocmai corect. În continuare, vom stabili definițiile unor termeni cheie asociați cu arta tipografiei.', ''),
(168, 34, 10, 'Typeface', ''),
(169, 34, 2, 'Tipul de caractere se referă la o familie întreagă de fonturi asemănătoare, diferențiate de orientare sau de grosimea literelor. Spre exemplu, Roboto este un typeface.', './img/typeface.png'),
(170, 34, 10, 'Font', ''),
(171, 34, 7, 'Fontul este un ansamblu de caractere care conține de obicei litere, cifre, semne de punctuație și simboluri.</br></br>\r\nFontul este doar un stil particular dintr-un typeface. Spre exemplu, Roboto Regular este un font din typeface-ul Roboto. Există familii de fonturi variable, sau care oferă o varietate mare fonturi, dar există și typeface-uri cu un singur font.', ''),
(172, 34, 10, 'Dimensiunea fontului', ''),
(173, 34, 2, 'Dimensiunea fontului de obicei poate fi personalizată și reprezintă înălțimea maximă pe care o pot lua caracterele.', './img/font-size.png'),
(174, 34, 10, 'Grosimea sau greutatea fontului (weight)', ''),
(175, 34, 3, 'Această caracteristică determină cât sunt de groase liniile sau elementele componente ale caracterelor. Există familii de fonturi care oferă mai multe posibilități și există fonturi cu grosime fixă.', './img/weight.png'),
(176, 35, 7, 'În funcție de stil și de câteva elemente distinctive, fonturile pot fi împărțite în mai multe categorii.', ''),
(177, 35, 10, 'Serif', ''),
(178, 35, 7, 'Fonturile de tip serif conțin caractere ale căror terminații au elemente decorative. Fonturile de tip serif facilitează citirea textului mic, și sunt utilizate frecvent pentru redactarea blocurilor mari de text.</br></br>Cel mai cunoscut este Times New Roman, care la noi setează standardul pentru documente și lucrări. Există foarte multe fonturi de tip serif, câteva mai cunoscute sunt prezentate în imaginea de mai sus.', ''),
(179, 35, 1, 'Fonturile serif sunt și ele împărțite pe subcategorii, în funcție de stil.', './img/serif-fonts.png'),
(180, 35, 10, 'Old Style', ''),
(181, 35, 3, 'Un tip de fonturi ușor de citit, datorită lipsei contrastelor puternice între greutatea liniilor.', './img/oldstyle-fonts.png'),
(182, 35, 10, 'Tranzițional', ''),
(183, 35, 2, 'Nivel mai ridicat de dramatism, datorită diferenței mari dintre linii. În locul terminațiilor dure, caracterele cu stil tranzițional au terminații rotunjite.', './img/transitional fonts.png'),
(184, 35, 10, 'Modern', ''),
(185, 35, 3, 'Caracterizate de fonturi foarte stilizate, cu contrast și mai ridicat.', './img/modern-fonts.png'),
(186, 35, 10, 'Slab Serif', ''),
(187, 35, 3, 'Reprezintă o trecere între fonturile de tip serif și cele sans-serif. Sunt fonturi care captează atenția. Au un design impunător, cu linii groase și cu foarte puțin contrast.', './img/slab-serif-fonts.png'),
(188, 35, 9, '<strong>Fun fact: </strong>Fonturile de tip slab serif se foloseau pe postere de tip ”WANTED”', ''),
(189, 35, 10, 'Sans Serif', ''),
(190, 35, 7, 'Fonturile sans-serif sunt fonturi mai simple, fără elemente decorative, care nu concurează cu alte elemente de design din contextul lor. Denumirea înseamnă chiar ”fără serif”, cuvântul sans în franceză însemnând ”fără”.', ''),
(191, 35, 3, 'De obicei, aceste tipuri de fonturi sunt asociate cu ideea de modern sau cu simplitatea. Eleganța lor variază în funcție de contextul în care sunt folosite.', './img/sans-serif-fonts.png'),
(192, 35, 7, 'Au apărut mai târziu decât fonturile de tip serif, odată cu primele calculatoare, deoarece elementele decorative de pe fonturile serif făceau textul greu de citit pe ecranele cu rezoluții mici.</br></br>\r\nFonturile sans-serif sunt perfecte pentru titluri mari, de impact și se pot asocia diferitelor situații în funcție de greutate sau spațiere. Nu sunt foarte potrivite pentru blocuri mari de text cu caractere foarte mici.', ''),
(193, 35, 2, 'Helvetica este un font sans serif foarte popular. Foarte des îl veți vedea pe semne și indicatori publici.', './img/helvetica-sans-serif-example.jpg'),
(194, 35, 9, '<strong>Fun fact: </strong>Fontul folosit pe această platformă este Lexend.', ''),
(195, 35, 10, 'Script', ''),
(196, 35, 7, 'Acestea sunt fonturi care simulează scrisul de mână, și pot diferi destul de tare. În general, stilul ”script” este umbrela sub care sunt introduse toate fonturile care leagă literele între ele și simulează o mișcare continuă. Sunt fonturi relativ greu de folosit, deoarece, din cauza diferențelor mari, nu se potrivesc în multe situații și folosite excesiv tins să devină greu de citit.', ''),
(197, 35, 1, '', './img/script-fonts.png'),
(198, 35, 10, 'Fonturi decorative', ''),
(199, 35, 3, 'Sunt fonturi cu personalități foarte puternice, cu elemente decorative deosebite. Ele nu respectă un set de reguli standard, și sunt relativ unice. Fonturile decorative pot deveni foarte abstracte și asemănătoare cu ilustrații, de aceea, de multe ori sunt folosite ca și elemente vizuale individuale. Pot fi foarte utile în afișarea titlurilor, dar folosirea lor excesivă poate strica estetica unei pagini.', './img/decorative-fonts.png'),
(200, 36, 7, 'Fonturile sans-serif sunt perfecte pentru titluri mari, de impact și se pot asocia diferitelor situații în funcție de greutate sau spațiere. Nu sunt foarte potrivite pentru blocuri mari de text cu caractere foarte mici.', ''),
(201, 36, 1, 'În imaginea de mai sus putem observa elementele importante din anatomia literelor. Sunt vizibile atât denumirile din limba engleză, cât și cele în limba română, iar acolo unde nu s-a putut traduce, am păstrat denumirea în engleză, dar imaginea ar trebui să ofere suficient suport pentru a înțelege conceptele de bază.</br></br>\r\nObservăm că minusculele sunt de aceeași înălțime și se așază pe linia de bază, iar majusculele se înalță mai sus decât acestea.</br></br>\r\nUnele minuscule sunt mai înalte decât majusculele, iar ele se ridică până la linia ascendenților. Caracterele care se extind în jos față de linia de bază nu vor depăși niciodată linia descendenților.', './img/anatomie.jpg'),
(202, 36, 9, 'Mai multe detalii despre anatomia literelor și arta desenării literelor veți găsi în cartea The Golden Secrets of Lettering.', ''),
(203, 37, 10, 'Greutate (wheight)', ''),
(204, 37, 7, 'Fonturile ale căror caractere au o greutate mai ridicată sunt mai impunătoare, și foarte potrivite pentru a sublinia o idee importantă. De multe ori se folosesc fonturi de tip bold pentru a sublinia un call-to-action.</br></br>\r\nCaracterele mai subțiri sunt foarte potrivite pentru a sublinia în mod subtil o idee sau o informație, atrăgând în același timp atenția pentru a oferi importanță.</br></br>\r\nSpre exemplu, subiectele sensibile, precum diferite afecțiuni merită multă atenție, dar informația legată de aceste subiecte trebuie transmisă într-un mod sensibil, pentru a oferi o imagine adecvată, aproape calmantă utilizatorului.', ''),
(205, 37, 1, 'În capitolul anterior am amintit faptul că unele categorii de fonturi se diferențiază în funcție de contrastul liniilor care alcătuiesc literele. Acest contrast se referă la diferența grosimii liniilor care alcătuiesc caracterele.', './img/weight2.png'),
(206, 37, 2, 'Există fonturi caracterizate de un contrast ridicat, iar altele cu un contrast mai puțini vizibil și o uniformitate mai mare. Totuși, în aproape orice situație există contrast, chiar dacă el nu este vizibil. De multe ori, diferențele apar pentru că estetica cere acest lucru.', './img/weight-contrast.png'),
(207, 37, 10, 'Spațiul dintre litere', ''),
(208, 37, 3, 'Spațiul dintre litere poate contribui foarte mult la estetica și lizibilitatea textului, și de multe ori, spațierea poate schimba complet aspectul unui bloc de text. Cele mai multe fonturi sunt gândite cu o anumită spațiere, dar acest spațiu se poate modifica în funcție de nevoi.', './img/spacing.png'),
(209, 37, 10, 'Kerning', ''),
(210, 37, 3, 'De multe ori, o spațiere uniformă nu oferă literelor aspectul dorit. Acest lucru se datorează aspectului diferit al literelor, și deseori chiar dacă matematic vorbind spațiul dintre aceste litere este același, aspectul literelor îl face să pară neuniform. Kerning-ul este o combinație de diferite spațieri diferite dintre diferite litere, care în final oferă un aspect uniform.', './img/kerning.png'),
(211, 37, 10, 'Tracking', ''),
(212, 37, 2, 'Spre deosebire de kerning, tracking se referă valori uniforme ale spațiilor și la modificarea acestora în mod unitar cu o valoare anume.', './img/tracking.png'),
(213, 37, 9, '<strong>Sfat:</strong> Pentru fonturi foarte subțiri, o spațiere mai mare poate crește lizibilitatea sau calitatea estetică.', ''),
(214, 37, 10, 'Wordspacing', ''),
(215, 37, 3, 'Wordspacing se referă la spațiul dintre grupuri de litere sau cuvinte. Acest tip de spațiere contribuie la lizibilitatea textului. Spațiile foarte reduse dintre cuvinte reduc lizibilitatea.', './img/wordpacing.png'),
(216, 37, 10, 'Alinierea la stânga', ''),
(217, 37, 2, 'În multe limbi citirea se face de la stânga la dreapta. Ancorarea textului în partea stângă îi poate oferi utilizatorului senzația de familiaritate și echilibru.', './img/align-left.png'),
(218, 37, 10, 'Alinierea la dreapta', ''),
(219, 37, 3, 'Câteodată este contraintuitiv cititul unui text aliniat la dreapta, dar acest tip de aliniere poate fi folosit ca o unealtă utilă pentru echilibrarea unei pagini care conține o imagine cu conținut puternic aliniat la stânga.', './img/align-right.png'),
(220, 37, 10, 'Centrarea textului', ''),
(221, 37, 2, 'Asigură sublinierea unei idei principale importante, și este un tip de aliniere foarte potrivit pentru secvențe scurte de text.', './img/align-center.png'),
(222, 37, 10, 'Alinierea stânga-dreapta', ''),
(223, 37, 3, 'Este tipul de aliniere cel mai indicat pentru blocuri mari de text deoarece conferă uniformitate, consistență și lizibilitate.', './img/align-justify.png'),
(224, 37, 9, '<strong>Sfat: </strong>Atât grosimea literelor, cât și spațierea și alinierea sunt alegeri care depind foarte mult de context și de situații particulare. Este important să încercăm mai multe variante și să cerem păreri de la potențiali utilizatori.', ''),
(225, 38, 7, 'Se referă la prioritizarea informației transmise în funcție de importanță și conținutul mesajului cu ajutorul elementelor vizuale.Există câteva elemente cheie care ajută la divizarea informației în secțiuni mai ușor de procesat.', ''),
(226, 38, 10, 'Titlu', ''),
(227, 38, 2, 'Titlul este cel mai important element dintr-o pagină. Ar trebui să ofere o idee despre informația care urmează a fi transmisă, dar trebuie să fie scurt. Este de obicei un element impunător, ușor de distins și vizibil. Poate fi evidențiat cu ajutorul unui font decorativ sau de tip script, sau cu o diferită culoare.', './img/title.png'),
(228, 38, 9, '<strong>Sfat:</strong> Uneori este suficient doar să se folosească același font cu o grosime mai mare decât în restul paginii.', ''),
(229, 38, 10, 'Subtitlu', ''),
(230, 38, 3, 'Este mai puțin important decât titlul, mai puțin vizibil, dar în continuare destul de important. Este un element opțional, dar ajută la divizarea informației consistente și a titlurilor lungi.', './img/subtitle.png'),
(231, 38, 10, 'Body copy', ''),
(232, 38, 2, 'Este cea mai consistentă parte din informația scrisă, de obicei nu este foarte evidențiat, der rămâne în continuare vizibil. În general conține detalii legate de mesajul transmis de titlu și subtitlu.', './img/body-copy.png'),
(233, 38, 10, 'Call to action', ''),
(234, 38, 3, 'În general, apare ca și un ultim element într-o pagină, după prezentarea informației, dar are cea mai importantă sarcină: cea de a îndemna utilizatorul către o acțiune, ex: ”Programează o vizită!”. Deși de obicei se află printre ultimele elemente din pagină, trebuie evidențiat foarte tare datorită rolului său important. Spre exemplu, poate apărea cu o altă culoare pentru a se delimita de restul conținutului.', './img/call-to-action.png'),
(235, 38, 9, '<strong>Sfat:</strong> Prima dată prezintă informația, și abia după îndeamnă utilizatorul la o acțiune!', ''),
(236, 38, 10, 'Note de subsol', ''),
(237, 38, 2, 'Notele de subsol sunt de asemenea opționale, și de obicei includ elemente cu o importanță scăzută, care nu au fost incluse în restul paginii, dar ar putea interesa pe unii utilizatori.', './img/footnote.png'),
(238, 38, 9, '<strong>Sfat:</strong> Fă tot ce îți stă în putere să faci informația mai ușor de digerat pentru utilizator și experiența citirii informației cât mai plăcută cu putință.', ''),
(239, 38, 10, 'Câteva sfaturi', ''),
(240, 38, 7, '<ul>\r\n<li>Titlurile nu trebuie să fie lungi</li>\r\n<li>Alege titluri reprezentative</li>\r\n<li>Blocul mare de text poate fi divizat în subsecțiuni mai mici</li>\r\n<li>Liniile de separare sau diverse elemente grafice pot ajuta la divizarea textului într-un mod creativ și estetic.</li>\r\n</ul>', ''),
(241, 39, 7, 'Alegerea fonturilor este foarte importantă, deoarece fiecare font transmite o anumită senzație, un anumit sentiment sau o anumită idee. În același timp, potrivirea fonturilor este la fel de importantă, deoarece nu toate fonturile se potrivesc între ele, iar combinația anumitor fonturi poate fi chiar dezavantajoasă din punct de vedere estetic.</br></br>În continuare, vom analiza câteva posibilități de potrivire a fonturilor.', ''),
(242, 39, 9, '<strong>Sfat:</strong> Este nevoie de contrast pentru a sublinia o idee principală.', ''),
(243, 39, 6, 'Sans serif + serif;;;Uppercase + lowercase;;;Script + sans serif boldat', './img/pairing-serif-and-sans-serif.png;./img/pairing-uppercase-lowercase.png;./img/pairing-sans-serif-and-script.png'),
(244, 39, 6, 'Script + slab serif;;;Serif + script;;;Slab serif + serif', './img/pairing-slaf-serif-serif.png;./img/pairing-serif-and-script.png;./img/pairing-slaf-serif-serif.png'),
(245, 39, 9, '<strong>Sfat: </strong>experimentează cu cât mai multe stiluri, de multe ori fonturile te pot surprinde și se pot potrivi acolo unde nu te-ai aștepta. Google Fonts este o resursă foarte bună unde poți găsi fonturi pe care le poți utiliza gratis în proiectele tale.', ''),
(246, 39, 7, 'Este important să se păstreze simplitatea per ansamblu. Este bine să experimentezi și să fii creativ, dar încearcă să te limitezi la 2-3 fonturi pe proiect pentru a păstra o consistență.</br></br>\r\nExplorează mai multe familii de fonturi, de multe ori, aceeași familie îți poate oferi suficient de multe variante încât este suficient să folosești doar variații ale acelei clase de fonturi. Spre exemplu, Pe această pagină s-a folosit DOAR fontul Lexend, cu toate acestea, titlurile, subtitlurile și call-to-action-urile sunt suficient de diverse și vizibile.', ''),
(247, 39, 9, '<strong>Sfat:</strong> Citește descrierile fonturilor. De cele mai multe ori, autorii includ indicații legate de situații potrivite pentru utilizarea fonturilor. De asemenea, Google fonts de multe ori sugerează perechi potrivite pentru fontul ales de tine.', ''),
(248, 39, 7, 'Știai că unele fonturi includ design-uri alternative pentru anumite caractere? Acest lucru poate fi foarte util atunci când vrei să scoți în evidență un titlu.', ''),
(249, 34, 7, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.', ''),
(250, 41, 1, 'O componentă importantă a poziționării, și un ajutor foarte mare este grila. Grilele, pe care le vom numi și grid-uri, reprezintă scheletul design-ului. Pe baza grid-urilor se așază diferite elemente în pagină, iar numărul, lățimea, distanțarea coloanelor și rândurilor grid-ului se setează în funcție de cerințele de design.<br><br>\r\nScopul principal al unui grid este de a păstra consistența unui ansamblu de pagini, oferind în același timp opțiuni de a deveni creativ și de a varia poziționarea elementelor, păstrând totodată structura principală.<br><br>\r\nÎn funcție de nevoi, se poate folosi un ansamblu de grid-uri.', './img/grid.png'),
(251, 41, 9, '<strong>Sfat: </strong>ar trebui să existe o unitate de bază, iar dimensiunile tuturor elementelor, inclusiv al spațiilor, ar trebui să fie relative la acea unitate de bază.', ''),
(252, 42, 7, 'Anatomia grilelor este compusă din mai multe părți. Prezența lor nu este obligatorie în toate compozițiile; din nou, totul depinde de cerințe și nevoi. Vom prezenta elementele cele mai des întâlnite.<br><br>\r\nUnele concepte pot părea familiare, iar motivul este că aceste concepte nu se aplică doar în cazul design-ului de interfețe, ci și în cazul proiectării produselor tipărite. Așadar, dacă ați editat vreodată un document Word, ați întâlnit cel puțin unul dintre următorii termeni.', ''),
(253, 42, 10, 'Formatul', ''),
(254, 42, 1, '<br>Reprezintă tot spațiul în care va fi așezată compoziția finală.', './img/format.jpg'),
(255, 42, 10, 'Marginea', ''),
(256, 42, 1, '<br>Marginea reprezintă spațiul alb din exteriorul formatului și conținutului. Dimensiunea marginilor ajută la definirea clară a conținutului.', './img/margin.jpg'),
(257, 42, 9, '<strong>Sfat: </strong>conținutul nu ar trebui să iasă niciodată din format sau din spațiul vizibil.', ''),
(258, 42, 10, 'Coloanele', ''),
(259, 42, 1, 'Coloanele sunt blocurile verticale care se plasează pe întreaga înălțime a formatului. Indiferent de numărul lor, coloanele au aceeași lățime.', './img/column.png'),
(260, 42, 10, 'Rândurile', ''),
(261, 42, 1, 'Rândurile sunt blocuri orizontale care se întind de la stânga la dreapta formatului. Precum coloanele, și rândurile sunt consistente în dimensiuni.', './img/rows.jpg'),
(262, 42, 10, 'Gutters', ''),
(263, 42, 1, 'Gutter este spațiul fix dintre coloane, respectiv dintre rânduri. Ar trebui mereu să existe o spațiere între blocuri mari de elemente vizuale pentru a menține consistența designului.', './img/gutters.jpg'),
(264, 42, 9, '<strong>Important: </strong>spațierea este acolo pentru a ne ajuta să delimităm elementele vizuale, așadar acestea trebuie să se extindă pe toată lățimea coloanelor setate, și pe toată înălțimea rândurilor.', ''),
(265, 42, 10, 'Zone și regiuni', ''),
(266, 42, 1, 'Reginiunile sunt module adiacente din interiorul gridului. Elementele vizuale se pot plasa pe mai multe coloane și rânduri, nu este obligatoriu să se extindă doar pe spațiul delimitat de o singură coloană sau rând.', './img/regions.jpg'),
(267, 42, 9, '<strong>Important:</strong> Unele imagini din cadrul acestei secțiuni au fost luate de pe <a href=\"https://visme.co/blog/layout-design/\"> visme.co </a>, și tot aici puteți găsi mai multe informații.', ''),
(268, 43, 1, '<br>  Regula treimilor este o regulă de compoziție foarte des întâlnită în design. Este un sistem de grile care poate fi aplicat pe orice poziționare. Regula este ca spațiul vizual să se împartă în exact nouă spații egale (3 rânduri și 3 coloane).<br><br>\r\nExistă patru puncte focale, în jurul cărora se plasează elementele cheie. Aceste patru puncte focale reprezintă intersecția liniilor care separă formatul în coloane respectiv rânduri.<br><br>\r\nAlte elemente, cu o importanță mai scăzută sunt poziționate în interiorul spațiilor create de intersecția liniilor.<br><br>\r\nRegula treimilor creează compoziție plăcută vizual, dar și proporționalitate și consistență.', './img/rule_of_thirds.jpg'),
(269, 44, 1, '<br>Această regulă de compoziție se bazează pe relația dintre dimensiunile elementelor dintr-o pagină. În linii mari, teoria spune că între elementele vizuale ar trebui să existe o proporție de aproxiamtiv 1.618, adică dimensiunea unui titlu, spre exemplu ar trebui să fie de 1.618 ori mai mare decât restul textului. Aceeași teoremă se poate aplica în impărțirea paginilor sau în redimensionarea imaginilor pentru a obține rezultate plăcute vizual.<br><br>\r\nTeorema se aplică de multe ori în design-ul de logo-uri, și se poate observa peste tot în natura din jur.', './img/golden_ratio.jpg'),
(270, 44, 1, 'O explicație mai detaliată se găsește <a href=\"https://www.invisionapp.com/inside-design/golden-ratio-designers/\"> aici.</a>', './img/golden_ratio2.jpg'),
(271, 45, 10, 'Avantaje', ''),
(272, 45, 7, '<ul>\r\n<li>Este gratis, pentru un număr limitat de useri pe echipă și un număr limitat de proiecte</li>\r\n<li>Facilitează colaborarea în timp real</li>\r\n<li>Suportă import-ul fișierelor din Sketch</li>\r\n<li>În secțiunea Community sunt disponibile multe resurse gratis</li>\r\n<li>Permite crearea prototipurilor interactive și distribuirea lor pentru feedback</li>\r\n<li>Salvează progresul automat</li>\r\n<li>Fișierele create sunt disponibile de oriunde</li>\r\n<li>Există o funcționalitate de brainstorming pentru echipe</li>\r\n<li>Funcționează atât pe Windows cât și pe MacOS</li>\r\n<li>Planul de $12/ lună este gratis pentru studenți și profesori</li>\r\n</ul>', ''),
(273, 45, 10, 'Dezavantaje', ''),
(274, 45, 7, '<ul>\r\n<li>Pentru a putea salva progresul în cloud, trebuie să existe <strong>conexiune la Internet. </strong></li>\r\n<li>Pe versiunea gratis poți crea doar trei proiecte, dar poți avea fișiere nelimitate în fiecare proiect</li>\r\n</ul>', ''),
(275, 46, 7, 'Accesează <a href=\"figma.com\">figma.com</a>, creează un cont sau conectează-te cu un cont Google existent și gata. <br><br>\r\nSpre deosebire de Sketch, de exemplu, proiectele nu sunt salvate pe computerul utilizatorului, ci sunt salvate într-un cloud. Așadar, dacă un utilizator se conectează cu contul personal, poate accesa toate proiectele la care a lucrat. Pentru ca acest lucru să fie posibil, utilizatorul trebuie să fie <strong>online</strong>. Deși nu e nevoie, fișierele se pot salva și local. Acest lucru poate fi util atunci când nu există conexiune la internet. <br><br>\r\n\r\nSe poate lucra atât din browser, cât și din aplicația disponibilă pe PC sau Mac. Deși recomand utilizarea aplicației, ea nu este necesară pentru un flow optim. \r\n', ''),
(276, 46, 1, '<br>La deschiderea softului, veți fi întâmpinați de pagina de start. În mijloc, sunt vizibile proiectele recente, iar în partea stângă sunt câteva butoane importante. Se poate creea un proiect nou fie prin click pe + de lângă drafts/team projects din stânga, fie prin click pe New din colțul dreapta sus.', './img/home.png'),
(277, 47, 1, '<br>\r\nDupă crearea primului fișier, se deschide spațiul de editare. Spațiul de lucru vor fi frame-urile. Ele vor conține elementele vizuale pe care le edităm. Un frame se creează prin click pe butonul din stânga sus. Există câteva dimensiuni prestabilite, dar se pot crea frame-uri de orice dimensiune prin click and drag în mijlocu spațiului de editare.\r\n', './img/frame.png'),
(278, 47, 1, '<br>Într-un fișier pot exista mai multe frame-uri. În unele cazuri chiar este nevoie de mai multe frame-uri.', './img/frames 2.png'),
(279, 47, 9, '<strong>Sfat:</strong> se pot crea frame-uri în frame-uri.', ''),
(280, 48, 2, 'Se pot adăuga forme prin click pe butonul din meniul de stânga sus. După selectarea formei dorite, se poate da click pe frame-ul creat, iar această acțiune va genera plasarea unei forme de dimensiunea 100x100. Se poate redimensiona acest element, sau în loc de click se poate da click+drag pe frame pentru a crea o formă de dimensiuni oarecare.', './img/shapes.png'),
(281, 48, 9, '<strong>Sfat:</strong> dacă se ține apăsat <strong> Shift</strong> cât timp se crează forma, ea va fi o formă perfectă ex. pătrat sau cerc. ', ''),
(282, 48, 3, 'Formele se pot redimensiona și din meniul din dreapta. Tot de acolo se poate selecta cât de rotunde să fie colțurile, sau unghiul de înclinare al formei.', './img/shape_dimensions.png'),
(283, 48, 2, 'În mod predefinit, formele create au culoarea gri. Acest lucru se poate schimba din meniul din stânga. ', './img/shape_colors.png'),
(284, 48, 3, 'De asemenea, dacă se dorește, se poate șterge culoarea formei, prin click pe - de lângă câmpul field. Se poate adăuga și contur pe forme din meniul din dreapta cu click pe + din secțiunea Stroke. Se poate edita culoarea conturului, grosimea lui sau rotunjirea colțurilor.', './img/shape_strokes.png'),
(285, 48, 2, 'Conturul poate fi o linie întreruptă, iar aceasta se configurează prin click pe cele 3 puncte, setând dimensiunea liniilor și spațiilor dintre ele.', './img/shape_dashed_stroke.png'),
(286, 48, 10, 'Alinierea elementelor', ''),
(287, 48, 1, '<br>Dacă se selectează mai multe elemente, din meniul din dreapta ele se pot alinia orizontal sus, jos, sau centrat, sau vertical la stânga, la dreapta sau în centrul spațiului selectat', './img/horizontal align 1.png'),
(288, 48, 2, 'Aliniere orizontală în centru', './img/horizontal align 2.png'),
(289, 48, 5, 'Aliniere verticală la dreapta', './img/vertical align right.png'),
(290, 48, 10, 'Efecte', ''),
(291, 48, 2, 'Din secțiunea effects, se poate adăuga un efect special unui element oarecare. Acest efect poate fi o umbră exterioară sau interioară, un blur sau blur pe fundal.', './img/shape_effects.png'),
(292, 48, 3, ' Efectul se poate edita prin deschiderea unui meniu cu click pe butonul de lângă efectul selectat.\r\n', './img/effect_settings.png'),
(293, 49, 7, 'De multe ori, pentru a realiza un element vizual, ne folosim de un ansamblu de instrumente, de exemplu mai multe forme, dau forme și text. Deoarece dorim a elementele pe care le creem să funcționeze ca un ansamblu le putem grupa. Există două opțiuni pentru acest lucru:', ''),
(294, 49, 10, 'Gruparea elementelor (Group)', ''),
(295, 49, 2, 'Această opțiune păstrează ierarhia și structura frame-ului în care se află elementele, dar tratează obiectele grupate ca un ansamblu.', './img/grouping.png'),
(296, 49, 9, '<strong>Sfat: </strong> cele trei cercuri din imagine sunt aliniate perfect orizontal cu opțiunea de aliniere din meniul din dreapta.', ''),
(297, 49, 10, 'Crearea unui frame separat ', ''),
(298, 49, 3, 'Această opțiune crează un frame nou, în interiorul frame-ului principal, iar elementele grupate nu mai fac parte din frame-ul principal ca și elemente de sine stătătoare, ci sunt incluse în noul frame, care e inclus în frame-ul principal.', './img/framing.png'),
(299, 49, 2, 'Există posibilitatea de a combina cele două metode. Spre exemplu, dacă un buton conține o pictogramă formată din trei cercuri, cele trei cercuri vor fi un grup, iar butonul însăși va fi un frame separat.', './img/frame and group.png'),
(300, 49, 9, 'Folosirea frame-urilor pentru delimitarea ansamblurilor de elemente va fi necesar atunci când se va trece la etapa de prototipizare.', ''),
(301, 50, 9, 'Atunci când se proiectează ceva, este foarte probabil că vor exista elemente foarte similar, cum ar fi butoanele. Crearea fiecărui buton separat poate dura. În Figma, se pot crea <i>asset-uri </i> reutilizabile. ', ''),
(302, 50, 2, 'Se poate crea un frame cu componente unde se poate realiza design-ul inițial. Ajută dacă componenta creată este grupată sau separată într-un frame. Apoi, prin click pe butonul evidențiat în imagine se crează componenta reutilizabilă. ', './img/components.png'),
(303, 50, 3, 'Ea se va regăsi în secțiunea Assets din partea stângă. Se poate reutiliza selectând-o de aici și mutând-o la locul necesar. Componenta reutilizata va fi o copie a celei inițiale, iar orice modificare adusă asupra copiei nu va afecta originalul. În schimb, dacă se schimbă originalul, se vor actualiza și copiile.', './img/components 2.png'),
(304, 51, 7, 'Pentru o proiectare mai corectă, se pot aplica asupra  grid-uri asupra frame-urilor. În lecția despre layout am detaliat importanța gridului, așa că nu vom intra în detalii Aici. ', ''),
(305, 51, 1, 'Grid-urile se aplică din meniul din dreapta, prin click pe butonul +. Se pot aplica trei tripuri de grid: coloane, rânduri sau grilă. Se poate schimba dimensiunea, spațierea, culoarea sau opacitatea prin click pe butonul de lângă tipul de grid selectat. ', './img/grid.png'),
(306, 51, 2, 'Gridurile se pot aplica pe orice frame, chiar și unul care se află în interiorul altuia.', './img/grid in grid.png'),
(307, 52, 1, 'Pe pagina de start, există secțiunea de comunitate, unde utilizatorii Figma își postează propriile creații. Fiecare creație are o descriere cu mai multe detalii, dar de obicei acestea sunt asset-uri copyright-free. În același timp, comunitatea este o sursă bună de inspirație. Tot în comunitate găsiți resurse pentru prototyping și proiectare, cum ar fi asset-uri pentru wireframe-uri sau sitemaps, sau pictograme.', './img/community.png'),
(308, 53, 4, 'Există o serie de plugin-uri descărcabile pentru Figma, care ajută de multe ori procesul de creație. ', './img/plugins.png'),
(309, 53, 7, 'Lorem Ipsum este un plugin care ajută prin generarea unui text ”dummy” care ajută la vizualizarea modului în care textul se așază în pagină.', ''),
(310, 53, 5, 'Autoflow este o unealtă care conectează două frame-uri printr-o săgeată. Sitemap-ul proiectat pentru această platformă a fost creat cu Autoflow.', './img/sitemap.png');

-- --------------------------------------------------------

--
-- Table structure for table `subsection_layout`
--

CREATE TABLE `subsection_layout` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subsection_layout`
--

INSERT INTO `subsection_layout` (`id`, `type`) VALUES
(1, 'Landscape sus'),
(2, 'Landscape stânga'),
(3, 'Landscape dreapta'),
(4, 'Portret stânga'),
(5, 'Portret dreapta'),
(6, 'Trei pătrate'),
(7, 'Doar text'),
(8, 'game_url'),
(9, 'Highlight'),
(10, 'Subtitlu');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `topic`) VALUES
(1, 'Accesibilitate'),
(2, 'Culori'),
(3, 'Figma'),
(4, 'Tipografie'),
(5, 'UI/UX'),
(6, 'Cercetare'),
(7, 'Asseturi'),
(8, 'Layout'),
(9, 'Sfaturi'),
(10, 'Design');

-- --------------------------------------------------------

--
-- Table structure for table `unlocked_badges`
--

CREATE TABLE `unlocked_badges` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reward_id` int(11) NOT NULL,
  `selected` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unlocked_badges`
--

INSERT INTO `unlocked_badges` (`id`, `user_id`, `reward_id`, `selected`) VALUES
(20, 49, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unlocked_titles`
--

CREATE TABLE `unlocked_titles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reward_id` int(11) NOT NULL,
  `selected` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unlocked_titles`
--

INSERT INTO `unlocked_titles` (`id`, `user_id`, `reward_id`, `selected`) VALUES
(79, 49, 1, 0),
(80, 53, 1, 1),
(81, 49, 18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `cover_image` varchar(255) NOT NULL DEFAULT 'cover1',
  `profile_image` varchar(255) NOT NULL DEFAULT '',
  `course_target` int(11) NOT NULL DEFAULT 0,
  `community_points` int(11) NOT NULL DEFAULT 0,
  `community_target` int(11) NOT NULL DEFAULT 0,
  `public_progress` tinyint(1) NOT NULL DEFAULT 1,
  `public_badges` tinyint(1) NOT NULL DEFAULT 1,
  `public_titles` tinyint(1) NOT NULL DEFAULT 1,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `created_at`, `status`, `url`, `cover_image`, `profile_image`, `course_target`, `community_points`, `community_target`, `public_progress`, `public_badges`, `public_titles`, `admin`) VALUES
(49, 'noraleonte@yahoo.com', '$2y$10$TSNFDARka27HP1RjSIiwl.ENRGPq3I/KJcPph43rscUoDopovAAvC', 'Maimuțica Determinată Neagră', '2021-05-01 21:00:00', 2, 'maimutica-determinata-neagra', 'cover3', './img/faces/face4-01.png', 40, 8, 20, 1, 1, 1, 1),
(52, 'noraleonte00@gmail.com', '$2y$10$Dj2y0xODB7TbNb7i9Hogu.YgPcC5OS3DNc0WWUBcNPOnCXc.AtBCS', 'Șoricelul Harnic Cafeniu', '2021-06-22 22:42:50', 2, 'soricelul-harnic-cafeniu', 'cover6', './img/faces/face14-01.png', 10, 6, 20, 1, 1, 1, 0),
(53, 'ketahep781@0ranges.com', '$2y$10$yI5A3RZxlSNlWzgIzz5ZcOTL.7ize7gLN.EwWi.d8pk6OWnAwdbm6', 'Pantera Curiosă Neagră', '2021-06-22 23:32:57', 2, 'pantera-curiosa-neagra', 'cover1', './img/faces/face5-01.png', 30, 5, 20, 1, 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_status`
--
ALTER TABLE `account_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `chapter_progress`
--
ALTER TABLE `chapter_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapter_id` (`chapter_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `chapter_type`
--
ALTER TABLE `chapter_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `confirmation_codes`
--
ALTER TABLE `confirmation_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_progress`
--
ALTER TABLE `course_progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `topic` (`topic`);

--
-- Indexes for table `rewards`
--
ALTER TABLE `rewards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `reward_category`
--
ALTER TABLE `reward_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reward_type`
--
ALTER TABLE `reward_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subsections`
--
ALTER TABLE `subsections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapter_id` (`chapter_id`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `subsection_layout`
--
ALTER TABLE `subsection_layout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unlocked_badges`
--
ALTER TABLE `unlocked_badges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reward_id` (`reward_id`);

--
-- Indexes for table `unlocked_titles`
--
ALTER TABLE `unlocked_titles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reward_id` (`reward_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_status`
--
ALTER TABLE `account_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `chapter_progress`
--
ALTER TABLE `chapter_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `chapter_type`
--
ALTER TABLE `chapter_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `confirmation_codes`
--
ALTER TABLE `confirmation_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `course_progress`
--
ALTER TABLE `course_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `rewards`
--
ALTER TABLE `rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reward_category`
--
ALTER TABLE `reward_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reward_type`
--
ALTER TABLE `reward_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subsections`
--
ALTER TABLE `subsections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=313;

--
-- AUTO_INCREMENT for table `subsection_layout`
--
ALTER TABLE `subsection_layout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `unlocked_badges`
--
ALTER TABLE `unlocked_badges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `unlocked_titles`
--
ALTER TABLE `unlocked_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`type`) REFERENCES `chapter_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chapters_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chapter_progress`
--
ALTER TABLE `chapter_progress`
  ADD CONSTRAINT `chapter_progress_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chapter_progress_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `confirmation_codes`
--
ALTER TABLE `confirmation_codes`
  ADD CONSTRAINT `confirmation_codes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_progress`
--
ALTER TABLE `course_progress`
  ADD CONSTRAINT `course_progress_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `course_progress_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`topic`) REFERENCES `topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rewards`
--
ALTER TABLE `rewards`
  ADD CONSTRAINT `rewards_ibfk_1` FOREIGN KEY (`category`) REFERENCES `reward_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rewards_ibfk_2` FOREIGN KEY (`type`) REFERENCES `reward_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subsections`
--
ALTER TABLE `subsections`
  ADD CONSTRAINT `subsections_ibfk_1` FOREIGN KEY (`type`) REFERENCES `subsection_layout` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subsections_ibfk_2` FOREIGN KEY (`chapter_id`) REFERENCES `chapters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unlocked_badges`
--
ALTER TABLE `unlocked_badges`
  ADD CONSTRAINT `unlocked_badges_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unlocked_badges_ibfk_2` FOREIGN KEY (`reward_id`) REFERENCES `rewards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `unlocked_titles`
--
ALTER TABLE `unlocked_titles`
  ADD CONSTRAINT `unlocked_titles_ibfk_1` FOREIGN KEY (`reward_id`) REFERENCES `rewards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `unlocked_titles_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`status`) REFERENCES `account_status` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
