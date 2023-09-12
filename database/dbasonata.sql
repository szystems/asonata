-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-07-2023 a las 19:51:32
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbasonata`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atleta`
--

CREATE TABLE `atleta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cui_dpi` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `birth_certificate` varchar(100) DEFAULT NULL,
  `vaccination_card` varchar(50) DEFAULT NULL,
  `birth` date NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `doses_number` varchar(20) NOT NULL,
  `ethnic_group` varchar(20) NOT NULL,
  `education_obtained` varchar(50) NOT NULL,
  `tshirt_size` varchar(10) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `responsible_name` varchar(100) NOT NULL,
  `responsible_dpi` varchar(20) NOT NULL,
  `responsible_image` varchar(100) DEFAULT NULL,
  `responsible_phone` varchar(20) NOT NULL,
  `responsible_whatsapp` varchar(20) NOT NULL,
  `responsible_email` varchar(100) NOT NULL,
  `responsible_address` varchar(200) NOT NULL,
  `kinship` varchar(20) NOT NULL,
  `responsible_doses_number` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `atleta`
--

INSERT INTO `atleta` (`id`, `cui_dpi`, `name`, `image`, `birth_certificate`, `vaccination_card`, `birth`, `gender`, `doses_number`, `ethnic_group`, `education_obtained`, `tshirt_size`, `phone`, `whatsapp`, `email`, `address`, `city`, `state`, `country`, `status`, `responsible_name`, `responsible_dpi`, `responsible_image`, `responsible_phone`, `responsible_whatsapp`, `responsible_email`, `responsible_address`, `kinship`, `responsible_doses_number`, `created_at`, `updated_at`) VALUES
(3, '1676902560901', 'Otto Francisco Szarata Maldonado1', '1690326343.jpeg', '1690326343.jpg', '1690326343.jpg', '1984-08-18', 0, '3ra. Dosis', 'Ladino', 'Diversificado', '16', '77676345', '42153288', 'szotto18@gmail.com', 'diagonal 2 32-22 zona 3', 'Quetzaltenango', 'Quetzaltenango', 'Guatemala', 1, 'Mauricio Wolff', '123456789', '1690326343.jpeg', '78945612', '78945612', 'mwolff@gmail.com', 'al;sdkfj a;lskdjf al;ksdj fa;lkdjf alksdjf als;kdjf alskdfj', 'Hermano', '3ra. Dosis', '2023-05-18 21:50:27', '2023-07-25 23:05:43'),
(4, '3343342', 'sdfsdfsd', '1684513243.jpg', NULL, NULL, '2023-02-21', 1, '0', '', '', '', '342345345', '45345345', 'sdfsdfsdf@szystems.com-Deleted', 'diagonal 2 32-22 zona 3 JLP', 'Quetzaltenango', 'Quetzaltenango', 'Guatemala', 0, 'sdfsdf', '32422344234', '1684513243.jpg', '324534534', '34345345', 'sdrfsdf@gmail.com', 'diagonal 2 32-22 zona 3 Quetzaltenango, Guatemala.', '', '0', '2023-05-19 16:20:43', '2023-05-19 16:20:59'),
(5, '12345657898', 'Jorge Ortiz', '1687363078.jpg', NULL, NULL, '2010-07-14', 0, '0', '', '', '', '754685454', '65478951', 'jortiz@hotmail.com', 'rotonda la marimba calle 0-9', 'Quetzaltenango', 'Quetzaltenango', 'Guatemala', 1, 'Casio Amparo', '45698784565', NULL, '45687444', '45465456', 'jortiz@hotmail.com', 'zona 14 gualtemala', '', '0', '2023-06-21 15:57:58', '2023-06-21 15:57:58'),
(6, '45687874654', 'OTTO FRANCISCO', '1689875111.jpg', NULL, '1689875111.jpeg', '2017-07-13', 0, '0', '', '', '', '42153288', '42153288', 'oszarata@szystems.com', 'diagonal 2 32-22 zona 3', 'Quetzaltenango', 'Quetzaltenango', 'Guatemala', 1, 'Otto Szarata', '46794546545', '1689875111.jpg', '42153288', '42153288', 'szystems@hotmail.com', 'diagonal 2 32-22 zona 3', '', '0', '2023-07-13 17:09:23', '2023-07-20 17:45:11'),
(7, '65498765496874', 'Paulina Szarata', '1689271463.jpeg', NULL, '1689271463.jpg', '2019-06-19', 1, '0', '', '', '', '42153288', '42153288', 'pau@szarata.com', 'diagonal 2 32-22 zona 3 JLP', 'Quetzaltenango', 'Quetzaltenango', 'Guatemala', 1, 'Ana Mercedes Szarata', '45649454654', '1689271463.jpg', '42153288', '42153288', 'anaszarata@hotmail.com', 'diagonal 2', '', '0', '2023-07-13 18:04:23', '2023-07-13 18:04:23'),
(8, '1676902560902', 'Mauricio Wolff', '1689875131.jpeg', NULL, NULL, '1984-08-23', 0, '0', '', '', '', '56521254', '54215865', 'mauwolff@hotmail.com', 'diagonal 2 32-22 zona 3', 'Santo Domingo Xenacoj', 'Sacatepéquez', 'Guatemala', 1, 'Otto Szarata', '1676902560901', NULL, '42153288', '42153288', 'szotto18@hotmail.com', 'diagonal 2 32-22 zona 3', '', '0', '2023-07-19 17:02:39', '2023-07-20 17:45:31'),
(9, '123', 'Maria Consuelo', '1690415987.jpg', '1690415987.jpeg', '1690415987.jpg', '2019-06-19', 0, '1ra. Dosis', 'Garífuna', 'Parvulos', '6', '78545654', '54548454', 'mconsuelo@hotm.com', 'quiche calle poniente 45-09', 'Chichicastenango', 'Quiché', 'Guatemala', 1, 'pancracia consuelo', '4587654687445', '1690415987.jpeg', '48785487', '548754654', 'pconsuelo@hotm.com', 'poniente calle 45', 'Madre', '3ra. Dosis', '2023-07-19 17:36:43', '2023-07-26 23:59:47'),
(10, '1235678', 'manuel baldizon', '1689789274.jpg', NULL, '1689789274.jpeg', '2023-07-21', 0, '0', '', '', '', '45687854', '54875487', 'mbaldi@ht.com', 'baja verapaz son miguel dhicaj', 'San Miguel Chicaj', 'Baja Verapaz', 'Guatemala', 1, 'julio baldizon', '45687546545', '1689789274.jpeg', '45968756', '49687565', 'jbladi@hotm.com', 'baja miguel chicaj', '', '0', '2023-07-19 17:54:34', '2023-07-19 17:54:34'),
(11, '4596874549875', 'Marcela Garcia', '1689897442.jpeg', '1689898357.jpg', '1689897442.jpg', '2019-06-21', 1, '0', '', '', '', '457878454', '5445446545', 'mgarcia@ht.com', 'guatemala sna pedro sacatepequz', 'San Pedro Sacatepéquez', 'Guatemala', 'Guatemala', 1, 'Hania GArcia', '23432343343', '1689897442.jpg', '33453234', '23453233', 'hgarcia@ht.com', 'san pedro sacatepequez guatemala', '', '0', '2023-07-20 23:57:22', '2023-07-21 00:12:37'),
(12, '3432', 'Gabriela Citan', '1689898618.jpeg', '1689898618.jpg', '1689898758.jpg', '2020-11-27', 0, '0', '', '', '', '7895487', '48754875', 'gabcitan@hotmail.com', 'colomba quetgo', 'Colomba', 'Quetzaltenango', 'Guatemala', 1, 'Ana Citan', '4598784568755', '1689898618.jpg', '7898748', '7895787', 'acitan@hotmail.com', 'colomba quetgo 2', '', '0', '2023-07-21 00:16:58', '2023-07-21 00:19:18'),
(13, '49687546548', 'Gardenia Fernandez', '1689979674.jpg', '1689979674.jpg', '1689979674.jpg', '2023-07-12', 1, 'Refuerzo y más', 'Garífuna', 'Basico', '10', '546545445', '23234234', 'gardenia@hotma.com', 'gardenia baja verapaz', 'Cubulco', 'Baja Verapaz', 'Guatemala', 1, 'flora gardenia', '4676546465', '1689979674.jpeg', '234234234', '234234234', 'gardeniaflora@fhaksd.com', 'baja vera', 'Encargado', 'Refuerzo y más', '2023-07-21 22:47:54', '2023-07-21 22:57:42'),
(14, '456', 'Nanci Quenn', '1690241806.jpg', '1690241806.jpg', '1690241806.jpg', '2021-06-24', 0, '2da. Dosis', 'Mestizo', 'Kinder', '8', '45687545', '598455658', 'nqueen@hotmail.com', 'san martin zapotitlan retalhuleu', 'San Martín Zapotitlán', 'Retalhuleu', 'Guatemala', 1, 'Areta Queen', '46876545452', '1690241806.jpeg', '54968845', '65485454', 'areta@htomail.com', 'reu', 'Madre', '3ra. Dosis', '2023-07-24 23:36:46', '2023-07-24 23:36:46'),
(15, '654', 'Jorge Santos', '1690326504.jpg', '1690326504.jpg', '1690326504.jpg', '2019-02-20', 0, '2da. Dosis', 'Garífuna', 'Kinder', '4', '45621521', '45654789', 'jsantos@goami.com', 'quetzaltenango zunil guatemala', 'Zunil', 'Quetzaltenango', 'Guatemala', 1, 'Maria Santos', '468754685454', '1690326504.jpeg', '45687854', '4568978', 'msantos@lskd.com', 'santos direccion', 'Madre', '2da. Dosis', '2023-07-25 23:08:24', '2023-07-25 23:08:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age_from` int(11) NOT NULL DEFAULT 0,
  `age_to` int(11) NOT NULL DEFAULT 0,
  `requirements` mediumtext DEFAULT NULL,
  `implements` mediumtext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `group_id`, `name`, `age_from`, `age_to`, `requirements`, `implements`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(5, 1, 'Estrellitas I', 4, 5, NULL, NULL, 'Niños de 4 a 5 años cumplidos', '1685459900.png', 1, '2023-05-30 00:59:47', '2023-06-05 17:58:10'),
(6, 1, 'Pulpos', 1, 3, NULL, NULL, 'Niños de 1 a 3 años cumplidos', '1685458829.jpg', 1, '2023-05-30 15:00:29', '2023-06-05 17:58:41'),
(7, 1, 'fgfgf1', 0, 0, NULL, NULL, 'fggfgfgfg1', '1685488605.jpg', 0, '2023-05-30 23:16:15', '2023-05-30 23:20:33'),
(8, 1, 'Estrellitas II', 4, 5, NULL, NULL, 'Niños de 4 a 5 años cumplidos', '1685638358.jpg', 1, '2023-06-01 16:52:38', '2023-06-05 17:58:20'),
(9, 1, 'Estrellitas III', 4, 5, NULL, NULL, 'Niños de 4 a 5 años cumplidos', '1685638386.jpeg', 1, '2023-06-01 16:53:06', '2023-06-05 17:58:30'),
(10, 1, 'Pulpos Avanzados', 1, 3, NULL, NULL, 'Niños de 1 a 3 años cumplidos', '1685638432.jpeg', 1, '2023-06-01 16:53:52', '2023-06-05 17:58:49'),
(11, 1, 'Caracoles', 0, 1, NULL, NULL, 'Bebes de 6 a 12 meses cumplidos', '1685638526.jpeg', 1, '2023-06-01 16:55:26', '2023-06-05 17:53:29'),
(12, 2, 'Infantil A', 0, 0, NULL, NULL, 'Niños de 8 a 10 años cumplidos', NULL, 1, '2023-06-01 17:12:26', '2023-06-01 17:12:26'),
(13, 2, 'Infantil B', 0, 0, NULL, NULL, 'Niños de 11 a 12 años cumplidos', NULL, 1, '2023-06-01 17:12:52', '2023-06-01 17:12:52'),
(14, 2, 'Juvenil A', 0, 0, NULL, NULL, 'Niños de 13 a 14 años cumplidos', NULL, 1, '2023-06-01 17:13:23', '2023-06-01 17:13:23'),
(15, 2, 'Juvenil B', 0, 0, NULL, NULL, 'Niños de 15 a 17 años cumplidos', NULL, 1, '2023-06-01 17:15:18', '2023-06-01 17:15:18'),
(16, 1, 'sdf', 1, 2, NULL, NULL, 'sdfsdfsdf', NULL, 0, '2023-06-05 21:56:52', '2023-06-05 23:36:52'),
(17, 1, 'sdf', 1, 2, NULL, NULL, 'sdfsdfsdf', NULL, 0, '2023-06-05 21:57:22', '2023-06-05 23:36:56'),
(18, 1, 'sdfasdfasdf', 1, 5, 'ad fasd f\r\na dfasd f\r\na d fasd fa', 'as dfasdf asdf asdf\r\n\r\nas d\r\nfadf \r\n\r\na sdf\r\nasd f\r\n\r\na sdf', 'asdfa dfas df\r\nasd fasd f\r\nads fad sff', '1686760015.jpg', 0, '2023-06-14 16:26:55', '2023-06-14 16:27:07'),
(19, 1, '3asdfsdf', 2, 6, 'sdfasdfasdf asdf adf asdf', 'a dfad fasdf asd fasd f', 'asdf asdf asdf ad asdf asd f\r\nasd f\r\nasds\r\n fa\r\nd ad\r\n\r\nad fasdf \r\nas df\r\na\r\nds fadf \r\n\r\na ds\r\nfa\r\ndf - ads fadf \r\n-a dsfasd f-\r\n\r\n- ads fad fadf a', '1686760066.jpg', 1, '2023-06-14 16:27:46', '2023-06-14 16:33:19'),
(20, 1, 'asd fad f', 2, 2, NULL, NULL, NULL, NULL, 0, '2023-06-14 16:28:37', '2023-06-14 16:28:41'),
(21, 1, 'asd fasdf adf ad', 2, 2, 'df asd', 'f asd fa', 'asd fad fa', NULL, 0, '2023-06-14 16:33:44', '2023-06-14 16:33:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `class`
--

CREATE TABLE `class` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cycle_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `instructor_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `notes` mediumtext DEFAULT NULL,
  `inscription_payment` decimal(11,2) NOT NULL DEFAULT 0.00,
  `monthly_payment` decimal(11,2) NOT NULL DEFAULT 0.00,
  `badge` decimal(11,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `class`
--

INSERT INTO `class` (`id`, `cycle_id`, `category_id`, `schedule_id`, `instructor_id`, `start_date`, `end_date`, `notes`, `inscription_payment`, `monthly_payment`, `badge`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, 1, '2023-01-01', '2023-12-31', '', '0.00', '0.00', '0.00', 1, '2023-06-06 16:51:02', '2023-06-06 16:51:02'),
(2, 1, 8, 5, 26, '2023-01-15', '2023-12-15', 'Estrellitas II ciclo 2023 en piscina olimpica', '0.00', '0.00', '0.00', 1, '2023-06-07 22:11:46', '2023-06-07 22:11:46'),
(3, 1, 9, 6, 24, '2023-01-15', '2023-12-15', NULL, '100.00', '200.00', '20.00', 1, '2023-06-07 22:16:58', '2023-07-27 16:57:39'),
(4, 1, 10, 8, 25, '2023-01-23', '2023-11-20', 'Esto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hf\r\nEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hfEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hfEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hfEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hfEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hfEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hfEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hfEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hfEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hfEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hfEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hfEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hfEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hfEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hf\r\nEsto es una anotacion\r\n- con espacios\r\n- para saber como se veaokdhakdsjh akd fhalksjdhf akljsdh flakjsdh faksjdfh akljsdfh aksljdhf aksjdjhf askjdhf \r\nasdhjkj fasdlkjf haslkdjfha lksjsdfh alksdjfhalksjdfhalksjdfh laksjdhflaksjdhf laksjdjhf laksjdhf laksjdh flaksjdhf laksjdh falksjdhf a\r\n asdfh alskjdf halskjdhf alksjdhf alksjdhf laksjdhf alksdj hf', '0.00', '0.00', '0.00', 1, '2023-06-07 22:39:29', '2023-06-12 16:26:26'),
(5, 1, 12, 1, 24, '2023-01-01', '2023-04-11', NULL, '0.00', '0.00', '0.00', 1, '2023-06-07 23:34:05', '2023-06-07 23:34:05'),
(6, 1, 13, 1, 25, '2023-07-12', '2023-10-18', 'hola hola2', '0.00', '0.00', '0.00', 1, '2023-06-07 23:34:40', '2023-06-08 00:20:59'),
(7, 1, 12, 1, 24, '2023-01-01', '2023-07-26', 'hola', '0.00', '0.00', '0.00', 0, '2023-06-08 00:17:44', '2023-06-08 16:20:06'),
(8, 1, 9, 1, 26, '2023-06-23', '2023-06-28', 'vcvbxcvbxcvb', '0.00', '0.00', '0.00', 0, '2023-06-08 16:20:34', '2023-06-08 16:28:06'),
(9, 1, 19, 1, 26, '2023-06-20', '2023-12-12', 'asd fasdf asdf a\r\nads fasd fa\r\n- asdf asd f\r\n-ada df \r\n\r\n-asd fad f', '0.00', '200.00', '200.00', 1, '2023-06-14 17:00:54', '2023-06-14 17:13:03'),
(10, 1, 5, 12, 22, '2023-06-01', '2023-12-31', NULL, '100.00', '300.00', '20.00', 1, '2023-06-21 16:31:02', '2023-07-21 17:30:45'),
(11, 5, 5, 10, 24, '2024-01-01', '2024-12-31', NULL, '0.00', '350.00', '50.00', 1, '2023-07-13 22:33:44', '2023-07-13 22:33:44'),
(12, 1, 15, 9, 26, '2023-07-01', '2023-12-29', NULL, '100.00', '300.00', '20.00', 1, '2023-07-21 17:14:25', '2023-07-21 17:24:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configs`
--

CREATE TABLE `configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `currency` varchar(191) NOT NULL DEFAULT 'USD',
  `currency_simbol` varchar(191) NOT NULL DEFAULT '$',
  `email` varchar(100) DEFAULT NULL,
  `tax_status` tinyint(4) NOT NULL DEFAULT 0,
  `tax` int(11) NOT NULL DEFAULT 0,
  `paypal` tinyint(4) NOT NULL DEFAULT 0,
  `dbt` tinyint(4) NOT NULL DEFAULT 0,
  `shipping_description` varchar(191) DEFAULT NULL,
  `contract` varchar(100) DEFAULT NULL,
  `registration_process` mediumtext DEFAULT NULL,
  `payments_description` mediumtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `configs`
--

INSERT INTO `configs` (`id`, `logo`, `currency`, `currency_simbol`, `email`, `tax_status`, `tax`, `paypal`, `dbt`, `shipping_description`, `contract`, `registration_process`, `payments_description`, `created_at`, `updated_at`) VALUES
(1, '1686765041.jpg', 'GTQ Q', 'Q', 'oszarata@szystems.com', 0, 0, 0, 0, NULL, '1686765172.pdf', '1. Llenar el presente formulario de Preinscripción.\r\n2. Imprimir, Leer, Llenar y Firmar el Contrato Anual 2023 (Se adjunta a este mismo formulario el Link de descarga del Contrato en PDF).\r\n3. Realizar el pago de inscripción y primera cuota de Enero 2023 del curso anual en efectivo en las oficinas de la Asonata Xela. (NO contamos con cuenta bancaria para realizar depósitos o transferencias).\r\n4. Realizar el pago del carnet 2023 con un costo de Q20.00, dicho carnet les exonera 2 horas de parqueo en el Complejo deportivo Zona 3 Quetgo.', 'Recuerde acudir a las oficinas de secretaria de la Asonata Xela (de forma física) a realizar los pagos en efectivo únicamente. No debe de presentar nada de papelería siempre y cuando logre adjuntarlos a este formulario.', '2023-02-13 23:08:39', '2023-06-14 17:53:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cycles`
--

CREATE TABLE `cycles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` mediumtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cycles`
--

INSERT INTO `cycles` (`id`, `name`, `start_date`, `end_date`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ciclo 2023', '2023-01-01', '2023-12-31', 'Ciclo del año 2023 para todas las grupos y categorías de todos los niveles', 1, '2023-06-01 23:09:29', '2023-06-01 23:22:33'),
(2, 'egdfgdfg', '2023-06-22', '2023-06-27', 'dfgdfgdfg', 0, '2023-06-01 23:26:13', '2023-06-01 23:26:34'),
(3, 'Ciclo 2022', '2022-01-01', '2022-12-31', 'Ciclo del 2022', 1, '2023-06-05 22:52:21', '2023-06-05 22:52:21'),
(4, 'Ciclo 2021', '2021-01-01', '2021-12-31', 'Ciclo 2021', 1, '2023-06-05 22:53:30', '2023-06-05 22:53:30'),
(5, 'Ciclo 2024', '2024-01-01', '2024-12-31', 'Ciclo del Año 2024', 1, '2023-06-21 16:18:51', '2023-07-13 22:18:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facilities`
--

CREATE TABLE `facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `location` varchar(500) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `description`, `location`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Piscina Olimpica', 'Piscina olimpica de 12 carriles', 'domo principal de piscinas', '1685056681.jpg', 1, '2023-05-25 17:57:41', '2023-05-26 23:15:38'),
(2, 'Piscina Infantil', 'Piscina pequeña', 'Ubicada a un costado de domo principal', '1685141262.jpg', 1, '2023-05-25 18:14:25', '2023-05-26 22:47:42'),
(3, 'xczxczxc', 'zxczx', 'czxczxczxcz', '1685056942.jpg', 0, '2023-05-25 23:22:22', '2023-05-25 23:22:29'),
(4, 'sdfsdfa sdfa', 'sfasdf asdf asd f  sdfsdfg sdfg sfd gs fgsfdgsf dgsgs fdg sf gsfdgsfdgs df  sdf gsdf gsf gsddfg sdfd gsdf gsdf gsfdg sdf gsdf gsf gsf g', 'asdf adf asdf asdf', '1685059102.jpg', 0, '2023-05-25 23:54:47', '2023-05-26 00:13:56'),
(5, 'Piscina Informal', 'Piscina de diversion', 'ubicada dentro de las instalaciones de diversion', NULL, 0, '2023-05-26 23:14:47', '2023-06-01 16:45:13'),
(6, 'gtyutyutyu', 'tyutyu', 'tyutyu', NULL, 0, '2023-06-05 16:01:55', '2023-06-05 16:58:15'),
(7, 'tyutyu', 'tyutyu', 'tyutyu', NULL, 0, '2023-06-05 16:02:03', '2023-06-05 16:58:19'),
(8, 'tyutyuty', 'utyuty', 'utyutyutyu', NULL, 0, '2023-06-05 16:02:11', '2023-06-05 16:58:34'),
(9, 'tyutyu', 'tyutyu', 'tyutyuty', NULL, 0, '2023-06-05 16:02:20', '2023-06-05 16:58:26'),
(10, 'tyutyu', 'tyut', 'yutyutyu', NULL, 0, '2023-06-05 16:02:34', '2023-06-05 16:58:30'),
(11, 'tyutyuty', 'utyu', 'tyutyutyu', NULL, 0, '2023-06-05 16:02:49', '2023-06-05 16:58:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Matronatación', 'Grupo para aprendizage para todas las edades infantiles y juveniles', '1685144781.jpg', 1, '2023-05-26 23:43:39', '2023-05-26 23:46:21'),
(2, 'Selección Y Pre', 'Seleccionados y Pre-Seleccionados para el departamento de Quetzaltenango', '1685639428.jpg', 1, '2023-06-01 17:10:28', '2023-06-01 17:10:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscriptions`
--

CREATE TABLE `inscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_id` int(11) NOT NULL,
  `cycle_id` int(11) NOT NULL,
  `atleta_id` int(11) NOT NULL,
  `inscription_number` varchar(191) DEFAULT NULL,
  `inscription_payment` tinyint(4) DEFAULT NULL,
  `badge_payment` tinyint(4) DEFAULT NULL,
  `contract` tinyint(4) DEFAULT NULL,
  `notes` mediumtext DEFAULT NULL,
  `inscription_status` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `inscriptions`
--

INSERT INTO `inscriptions` (`id`, `class_id`, `cycle_id`, `atleta_id`, `inscription_number`, `inscription_payment`, `badge_payment`, `contract`, `notes`, `inscription_status`, `status`, `created_at`, `updated_at`) VALUES
(28, 10, 1, 3, 'INSC-2507202328', 0, 0, 1, NULL, 0, 1, '2023-07-25 23:05:43', '2023-07-25 23:05:43'),
(29, 11, 5, 15, 'INSC-2507202329', 0, 0, 1, NULL, 0, 1, '2023-07-25 23:08:24', '2023-07-25 23:08:24'),
(30, 3, 1, 9, 'INSC-2607202330', 0, 0, 1, NULL, 0, 1, '2023-07-26 23:59:47', '2023-07-26 23:59:47'),
(31, 3, 1, 6, 'INSC-2707202331', 0, 0, 1, NULL, 0, 1, '2023-07-27 21:12:29', '2023-07-27 21:12:29'),
(32, 6, 1, 7, 'INSC-2707202332', 0, 0, 1, 'editado', 2, 0, '2023-07-27 22:37:38', '2023-07-27 23:31:00'),
(33, 4, 1, 5, 'INSC-3107202333', 0, 0, 1, NULL, 0, 1, '2023-07-31 15:57:20', '2023-07-31 15:57:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_12_20_164418_create_categories_table', 2),
(6, '2022_12_22_174834_create_products_table', 3),
(7, '2022_12_28_175036_create_carts_table', 4),
(8, '2022_12_28_175319_create_carts_table', 5),
(9, '2023_01_09_173718_create_orders_table', 6),
(10, '2023_01_09_174317_create_order_items_table', 6),
(11, '2023_01_17_170939_create_wishlists_table', 7),
(12, '2023_01_30_154745_create_ratings_table', 8),
(13, '2023_01_31_172307_create_reviews_table', 9),
(14, '2023_02_13_224240_create_configs_table', 10),
(15, '2023_03_21_215853_add_timezone_field_to_users_table', 11),
(17, '2023_05_17_104031_create_atleta_table', 12),
(18, '2023_05_25_104514_create_facilities_table', 13),
(19, '2023_05_25_105000_create_facilities_table', 14),
(20, '2023_05_25_105122_create_facilities_table', 15),
(21, '2023_05_25_105301_create_facilities_table', 16),
(22, '2023_05_26_170239_create_groups_table', 17),
(23, '2023_05_29_173529_create_categories_table', 18),
(24, '2023_06_01_095100_create_cycles_table', 19),
(25, '2023_06_02_100121_create_schedule_table', 20),
(26, '2023_06_05_160445_create_class_table', 21),
(27, '2023_07_24_102711_create_inscriptions_table', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('szystems@hotmail.com', '$2y$10$LtXqCh5hScwxhtKtwF5AQuUt.RhoP6wBGzvtL1Ofo9UIjkciJIGPa', '2023-02-03 05:33:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schedule`
--

CREATE TABLE `schedule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cycle_id` int(11) NOT NULL,
  `facility_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `sunday` tinyint(4) NOT NULL DEFAULT 0,
  `monday` tinyint(4) NOT NULL DEFAULT 0,
  `tuesday` tinyint(4) NOT NULL DEFAULT 0,
  `wednesday` tinyint(4) NOT NULL DEFAULT 0,
  `thursday` tinyint(4) NOT NULL DEFAULT 0,
  `friday` tinyint(4) NOT NULL DEFAULT 0,
  `saturday` tinyint(4) NOT NULL DEFAULT 0,
  `quota` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `schedule`
--

INSERT INTO `schedule` (`id`, `cycle_id`, `facility_id`, `start_time`, `end_time`, `sunday`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `quota`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '08:30:00', '09:10:00', 0, 1, 0, 1, 0, 1, 0, 15, 1, '2023-06-02 23:14:17', '2023-06-02 23:49:38'),
(2, 1, 2, '11:40:00', '12:10:00', 0, 1, 0, 1, 0, 1, 0, 10, 1, '2023-06-07 21:58:56', '2023-06-07 21:59:04'),
(3, 1, 2, '12:10:00', '12:40:00', 0, 1, 0, 1, 0, 1, 0, 12, 1, '2023-06-07 22:00:43', '2023-06-07 22:00:43'),
(4, 1, 2, '12:40:00', '13:10:00', 0, 1, 0, 1, 0, 1, 0, 12, 1, '2023-06-07 22:02:18', '2023-06-07 22:04:37'),
(5, 1, 1, '09:50:00', '10:30:00', 0, 1, 0, 1, 0, 1, 0, 12, 1, '2023-06-07 22:05:41', '2023-06-07 22:05:41'),
(6, 1, 1, '11:00:00', '11:40:00', 0, 1, 0, 1, 0, 1, 0, 12, 1, '2023-06-07 22:06:26', '2023-06-07 22:06:26'),
(7, 1, 1, '12:10:00', '12:40:00', 0, 1, 0, 1, 0, 1, 0, 12, 1, '2023-06-07 22:07:39', '2023-06-07 22:07:39'),
(8, 1, 2, '09:10:00', '09:50:00', 0, 1, 0, 1, 0, 1, 0, 12, 1, '2023-06-07 22:19:16', '2023-06-07 22:19:16'),
(9, 1, 2, '09:10:00', '09:50:00', 0, 1, 0, 1, 0, 1, 0, 12, 1, '2023-06-07 22:20:42', '2023-06-07 22:20:42'),
(10, 5, 2, '08:30:00', '09:10:00', 0, 1, 0, 1, 0, 1, 0, 10, 1, '2023-06-21 16:21:37', '2023-06-21 16:21:37'),
(11, 5, 2, '09:10:00', '09:50:00', 0, 1, 0, 1, 0, 1, 0, 10, 1, '2023-06-21 16:22:35', '2023-06-21 16:22:35'),
(12, 1, 2, '08:30:00', '09:10:00', 0, 0, 1, 0, 1, 0, 0, 12, 1, '2023-06-21 16:29:55', '2023-06-21 16:29:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `lname` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `address1` varchar(191) DEFAULT NULL,
  `address2` varchar(191) DEFAULT NULL,
  `city` varchar(191) DEFAULT NULL,
  `state` varchar(191) DEFAULT NULL,
  `country` varchar(191) DEFAULT NULL,
  `zipcode` varchar(191) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `principal` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `timezone` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `lname`, `phone`, `whatsapp`, `address1`, `address2`, `city`, `state`, `country`, `zipcode`, `description`, `image`, `role_as`, `status`, `principal`, `remember_token`, `created_at`, `updated_at`, `timezone`) VALUES
(1, 'Otto Szarata', 'szystems@hotmail.com', NULL, '$2y$10$kdmLU.0IgcTI/K96fCWlXecz6AUGboIQHYj8FtlaoG0CLTx4FHhu6', '', '42153288', '42153288', '1120 e 2nd st apt 12', 'Diagonal 2 32-22 zona 3', 'Long Beach', 'California', 'EEUU', '90802', 'Programador de sistemas informaticos', '1684259029.jpg', 1, 1, 1, '9zGQlHA9jNDU2SD5Dk53IJqA3JKkV5759sFrEpmem9DliUNkHVbCtqyOBG9C', '2022-12-17 00:25:50', '2023-05-16 17:43:49', NULL),
(2, 'Otto Szarata', 'szotto18@hotmail.com', NULL, '$2y$10$xlxxqXS9OogTQU35mT6C5.5XdFx3NccWHxxzSNGnAZSmuSN.AGRYC', '', '+50242153288', NULL, 'y 1120 e 2nd st apt 12', '2nd Address', 'long beach', 'ca', 'Estados Unidos', '90802', NULL, NULL, 0, 1, 0, NULL, '2022-12-17 03:48:19', '2023-01-11 04:22:12', NULL),
(3, 'Francisco Maldonado', 'szotto18@gmail.com', NULL, '$2y$10$lfeJlbbof86GaM0S/8KCKOxSnppBIBbb3CchtuTQEK2Ifc5Zw0m8K', NULL, '+50242153288', NULL, 'Diagonal 2 32-22 zona 3', 'Diagonal 2 32-28 zona 3', 'Quetzaltenango', 'Quetzaltenango', 'Guatemala', '09001', NULL, NULL, 0, 1, 0, NULL, '2023-01-14 00:06:45', '2023-01-14 04:21:04', NULL),
(4, 'maco cuellar', 'mc@gmail.com-Deleted-Deleted-Deleted', NULL, '$2y$10$KkBvIxJ6BsuTvdUBa8OBJOSW.7Qx8EQR2yHo72WRJC19zUwEBIZgK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, '2023-01-14 00:09:38', '2023-03-17 23:00:16', NULL),
(5, 'asdf', 'asdf@lskdf.com-Deleted', NULL, '$2y$10$Ph8T1fUlQ0B9UfluNVt0Wep15w5aJC/Y7z7vP8leMmmSqY9cxw0ay', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, '2023-01-14 00:13:09', '2023-01-14 04:17:56', NULL),
(6, 'nombre', 'email@email.com', NULL, 'eshop1677', NULL, '234234324', NULL, 'primera direccion', 'segunda direccion', 'quetzaltenango', 'quetgostate', 'Guatemala', '09001', NULL, NULL, 0, 1, 0, NULL, '2023-01-17 05:14:51', '2023-01-17 05:14:51', NULL),
(7, 'Alfredo Sagastume', 'asagas@hotmail.com', NULL, '$2y$10$lPBbNdklPT.x/m2XEhB7/OrKN2weO7TICzhb4Av8MyDbiwFatRUL6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, '2023-02-02 23:54:04', '2023-02-02 23:54:04', NULL),
(8, 'Afredo Durango', 'alfredo@hotmail.com', NULL, '$2y$10$Yq5G3OPHFSxz0DrvyxwLxO4MHCH/1xPEHTNXr..phhlu3sVoD9GVa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, '2023-02-03 04:17:10', '2023-02-03 04:17:10', NULL),
(9, 'Ulises Godoy', 'uligodo@gmail.com', NULL, '$2y$10$ru3l0OY6cWdgtFEzZGfv5ecAmfzXK9JSzmKp/KxzwtsyuWNhOEU2i', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, '2023-02-03 04:20:00', '2023-02-03 04:20:00', NULL),
(10, 'Bruno Fernandez', 'bfernandez@gmail.com', NULL, '$2y$10$LLouA/qLOXM52hwtmXfGbO/4wtBxvmNpKQMmmddv54ZdOZkWHXBVu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, '2023-02-03 04:29:35', '2023-02-03 04:29:35', NULL),
(11, 'Mamfredo Jackobs', 'mjack@gmail.com', NULL, '$2y$10$dsMdYYqqpH7Lp9zI2.CjaesF.mSzlySUVUsZ0lo9SAEN8GolQKrPm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, '2023-02-03 04:32:18', '2023-02-03 04:32:18', NULL),
(12, 'Almeida Giron', 'ag@gmail.com', NULL, 'eshop4954', NULL, '23423423', NULL, 'Zona 4 56-89', NULL, 'Guatemala', 'Guatemala', 'Guatemala', '09001', NULL, NULL, 0, 1, 0, NULL, '2023-03-22 04:30:43', '2023-03-22 04:30:43', NULL),
(13, 'Michi Santisteban', 'michi@gmail.com', NULL, 'eshop8336', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, '2023-03-22 04:34:45', '2023-03-22 04:34:45', 'America/Guatemala'),
(14, 'opulo marco', 'opulo@gmail.com', NULL, '$2y$10$hH7g/ULfIpSiFiIspb3CZO7tA9FBZe029QuDYrDvmXfFpKJiZCCtK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, 0, NULL, '2023-03-22 04:58:45', '2023-03-22 04:58:45', NULL),
(15, 'Kamila Maldonado', 'kmaldonado@gmail.com-Deleted-Deleted', NULL, 'eshop9309', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Guatemala', NULL, NULL, NULL, 0, 0, 0, NULL, '2023-05-16 17:44:36', '2023-05-16 17:45:08', NULL),
(16, 'Kamila Maldonado', 'kmaldonado@gmail.com-Deleted', NULL, 'eshop1259', NULL, NULL, '2352w345345', NULL, NULL, NULL, NULL, 'Guatemala', NULL, NULL, NULL, 0, 0, 0, NULL, '2023-05-16 17:45:02', '2023-05-16 17:57:36', NULL),
(21, 'Kamila Maldonado', 'kmaldonado@gmail.com', NULL, 'eshop6267', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Guatemala', NULL, NULL, '1684259870.jpg', 0, 1, 0, NULL, '2023-05-16 17:57:50', '2023-05-16 17:57:50', NULL),
(22, 'Miguel Ochoa', 'mochoa@fgmail.com', NULL, 'eshop8442', NULL, '4585421', '564968745', NULL, NULL, NULL, NULL, 'Guatemala', NULL, 'es un buen instructor', '1684280031.jpg', 3, 1, 0, NULL, '2023-05-16 23:33:51', '2023-05-16 23:33:51', NULL),
(23, 'Marcos Alonzo', 'malonzo@gmail.com-Deleted', NULL, 'eshop4940', NULL, '498754548', '649454654', NULL, NULL, NULL, NULL, 'Guatemala', NULL, 'asdf adsf adf ads f', '1684280538.jfif', 3, 0, 0, NULL, '2023-05-16 23:35:43', '2023-05-16 23:51:27', NULL),
(24, 'Gaudi Roman', 'groman@gmail.com', NULL, 'eshop6216', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Guatemala', NULL, NULL, '1685637992.jpg', 3, 1, 0, NULL, '2023-06-01 16:46:32', '2023-06-01 16:46:32', NULL),
(25, 'Silvia Capuano', 'scapuano@hotmail.com', NULL, 'eshop7973', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Guatemala', NULL, NULL, '1685638021.jpg', 3, 1, 0, NULL, '2023-06-01 16:47:01', '2023-06-01 16:47:01', NULL),
(26, 'Manuela Garcia', 'mgarcia@gmail.com', NULL, 'eshop4430', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Guatemala', NULL, NULL, '1685638092.png', 3, 1, 0, NULL, '2023-06-01 16:48:12', '2023-06-01 16:48:12', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `atleta`
--
ALTER TABLE `atleta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `atleta_cui_dpi_unique` (`cui_dpi`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cycles`
--
ALTER TABLE `cycles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `atleta`
--
ALTER TABLE `atleta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `class`
--
ALTER TABLE `class`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cycles`
--
ALTER TABLE `cycles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inscriptions`
--
ALTER TABLE `inscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
