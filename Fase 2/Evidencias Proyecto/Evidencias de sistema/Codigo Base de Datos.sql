-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2024 a las 15:55:25
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dblaravel`
--
CREATE DATABASE IF NOT EXISTS `dblaravel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dblaravel`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `ID` int(1) NOT NULL,
  `NOMBRE` varchar(40) DEFAULT NULL,
  `CORREO` varchar(60) NOT NULL,
  `CONTRASENIA` varchar(200) DEFAULT NULL,
  `TIPO` int(1) NOT NULL,
  `google_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `admin`
--

TRUNCATE TABLE `admin`;
--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`ID`, `NOMBRE`, `CORREO`, `CONTRASENIA`, `TIPO`, `google_id`) VALUES
(7, 'aaa', 'angelsw.3010@gmail.com', '$2y$12$D0FdIfPq5knRpn21WXw40.wRGaj.nrqULeGab2P1Pt2UdgeIU0CMm', 1, NULL),
(12, 'votacion duoc', 'votacionduoc@gmail.com', '$2y$12$.l5gtMtThiv62gHSIoLxTe/Ojy6WkLEghlSLri.dx8FtR6BEwDGxK', 2, '105625134143175740215');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncar tablas antes de insertar `cache`
--

TRUNCATE TABLE `cache`;
--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('ange.meza@duocuc.cl|127.0.0.1', 'i:1;', 1728094702),
('ange.meza@duocuc.cl|127.0.0.1:timer', 'i:1728094702;', 1728094702),
('angelsw.3010@gmail.com|127.0.0.1', 'i:2;', 1728094676),
('angelsw.3010@gmail.com|127.0.0.1:timer', 'i:1728094676;', 1728094676);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncar tablas antes de insertar `cache_locks`
--

TRUNCATE TABLE `cache_locks`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncar tablas antes de insertar `failed_jobs`
--

TRUNCATE TABLE `failed_jobs`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncar tablas antes de insertar `jobs`
--

TRUNCATE TABLE `jobs`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncar tablas antes de insertar `job_batches`
--

TRUNCATE TABLE `job_batches`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncar tablas antes de insertar `migrations`
--

TRUNCATE TABLE `migrations`;
--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncar tablas antes de insertar `password_reset_tokens`
--

TRUNCATE TABLE `password_reset_tokens`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncar tablas antes de insertar `sessions`
--

TRUNCATE TABLE `sessions`;
--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('aWGEPcyTjRNIh5hvCrYLqDOOwQ2QF38yhsGjKDrG', 12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoidURneUgxN0E3N0JncEVoMEJvcEk3MzhRRXZFaWJCenNadmVETHRzVyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9hZS1oaXN0b3JpYWwtdm90YWNpb25lcyI7fXM6NToic3RhdGUiO3M6NDA6Ik5VNFR4M3FXNE5qa3Vvc0J6UjF6eUtBdXhLajFxcGlXU2N6Y2YzUkgiO3M6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1730964234);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `run` varchar(8) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `carrera` varchar(60) DEFAULT NULL,
  `edad` int(2) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Truncar tablas antes de insertar `users`
--

TRUNCATE TABLE `users`;
--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `run`, `name`, `email`, `email_verified_at`, `password`, `google_id`, `carrera`, `edad`, `sexo`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, '20603622', 'ANGEL FERMIN MEZA VELIS', 'ange.meza@duocuc.cl', NULL, NULL, '104415041677343236917', 'A', 24, 'M', NULL, '2024-10-29 03:32:33', '2024-10-29 04:23:21'),
(7, '20603623', 'ANGEL FERMIN MEZA VELIS\n\n 1', 'ange.sdmeza@duocuc.cl', NULL, NULL, '104415041677343236917', 'A', 24, 'M', NULL, '2024-10-29 03:32:33', '2024-10-29 04:23:21'),
(9, '20603624', 'ANGEL FERMIN MEZA VELIS\n\n 2', 'ange.sdmezas@duocuc.cl', NULL, NULL, '104415041677343236917', 'A', 24, 'M', NULL, '2024-10-29 03:32:33', '2024-10-29 04:23:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votacion`
--

DROP TABLE IF EXISTS `votacion`;
CREATE TABLE `votacion` (
  `SIGLA` varchar(12) NOT NULL,
  `NOMBRE` varchar(60) NOT NULL,
  `ESTADO` tinyint(1) NOT NULL,
  `DESCRIPCION` varchar(300) NOT NULL,
  `OPC_1` varchar(30) NOT NULL,
  `OPC_2` varchar(30) NOT NULL,
  `OPC_3` varchar(30) DEFAULT NULL,
  `OPC_4` varchar(30) DEFAULT NULL,
  `GANADOR` varchar(30) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `votacion`
--

TRUNCATE TABLE `votacion`;
--
-- Volcado de datos para la tabla `votacion`
--

INSERT INTO `votacion` (`SIGLA`, `NOMBRE`, `ESTADO`, `DESCRIPCION`, `OPC_1`, `OPC_2`, `OPC_3`, `OPC_4`, `GANADOR`, `created_at`, `updated_at`) VALUES
('VTA-357', 'Desayuno mensual', 0, 'AAAAAAAAAAAAAAA', 'Lunes - Miercoles', 'Martes - Jueves', 'Lunes - Viernes', 'Martes - Viernes', NULL, '2024-11-02 05:03:22', '2024-11-02 23:44:20'),
('VTA-358', 'Desayuno mensual', 1, 'BBBBBBBB', 'Lunes - Miercoles', 'Martes - Jueves', NULL, NULL, NULL, '2024-11-02 05:08:58', '2024-11-02 05:08:58'),
('VTA-359', 'Desayuno mensual', 0, 'CCCCCCCCCCCCCCCC', 'Lunes - Miercoles', 'Martes - Jueves', 'Lunes - Viernes', 'Martes - Viernes', NULL, '2024-11-02 23:39:04', '2024-11-02 23:39:04'),
('VTA-360', 'Desayuno mensual 2', 1, 'DDDDDDDDDDDDDDDDDDDDDDD', 'Lunes - Miercoles', 'Martes - Jueves', 'Lunes - Viernes', 'Martes - Viernes', NULL, '2024-11-02 23:44:47', '2024-11-03 00:52:10'),
('VTA-361', 'Desayuno mensual 3', 1, 'EEEEEEEEEEEEEEEEEEEEEE', 'Lunes - Miercoles', 'Martes - Jueves', 'Lunes - Viernes', 'Martes - Viernes', NULL, '2024-11-02 23:58:03', '2024-11-02 23:58:03'),
('VTA-362', 'Desayuno mensual 4', 1, 'FFFFFFFFFFFFFFFFFFF', 'Lunes - Miercoles', 'Martes - Jueves', NULL, NULL, NULL, '2024-11-05 05:15:53', '2024-11-05 05:15:53'),
('VTA-363', 'Desayuno mensual 5', 0, 'GGGGGGGGGGGGGGGGGGG', 'opc 1', 'opc 2', 'opc 3', 'opc 4', 'opc 2', '2024-11-07 04:51:05', '2024-11-07 06:33:27'),
('VTA-364', 'Desayuno mensual 6', 0, 'HHHHHHHHHHHHHHHHHHHHH', 'opc 1', 'opc 2', 'opc 3', 'opc 4', 'opc 1', '2024-11-07 06:43:26', '2024-11-07 10:23:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voto`
--

DROP TABLE IF EXISTS `voto`;
CREATE TABLE `voto` (
  `ID` int(5) NOT NULL,
  `SIGLA` varchar(12) NOT NULL,
  `RUN` int(8) NOT NULL,
  `OPCION_VOTADA` varchar(100) NOT NULL,
  `CARRERA` varchar(60) NOT NULL,
  `CORREO` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncar tablas antes de insertar `voto`
--

TRUNCATE TABLE `voto`;
--
-- Volcado de datos para la tabla `voto`
--

INSERT INTO `voto` (`ID`, `SIGLA`, `RUN`, `OPCION_VOTADA`, `CARRERA`, `CORREO`) VALUES
(6, 'VTA-362', 20603622, 'Martes - Jueves', 'A', 'ange.meza@duocuc.cl'),
(7, 'VTA-357', 20603622, 'Martes - Jueves', 'A', 'ange.meza@duocuc.cl'),
(8, 'VTA-358', 20603622, 'Lunes - Miercoles', 'A', 'ange.meza@duocuc.cl'),
(9, 'VTA-363', 20603622, 'opc 1', 'A', 'ange.meza@duocuc.cl'),
(10, 'VTA-364', 20603622, 'opc 1', 'A', 'ange.meza@duocuc.cl'),
(11, 'VTA-364', 20603623, 'opc 3', 'A', 'ange.meza@duocuc.cl'),
(12, 'VTA-364', 20603624, 'opc 1', 'A', 'ange.meza@duocuc.cl');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `CORREO` (`CORREO`);

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `run` (`run`);

--
-- Indices de la tabla `votacion`
--
ALTER TABLE `votacion`
  ADD PRIMARY KEY (`SIGLA`);

--
-- Indices de la tabla `voto`
--
ALTER TABLE `voto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SIGLA` (`SIGLA`),
  ADD KEY `RUN` (`RUN`),
  ADD KEY `OPCION_VOTADA` (`OPCION_VOTADA`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `voto`
--
ALTER TABLE `voto`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
