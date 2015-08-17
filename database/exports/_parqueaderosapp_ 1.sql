-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-08-2015 a las 23:31:55
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `app_v1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE IF NOT EXISTS `ciudades` (
  `id_ciudad` int(10) unsigned NOT NULL COMMENT 'Clave única de registro',
  `nombre_ciudad` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Nombre de ciudad'
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id_ciudad`, `nombre_ciudad`) VALUES
(1, 'fr'),
(2, 'rfr'),
(3, '2'),
(4, '2'),
(5, '2'),
(6, '2'),
(7, '6'),
(8, '2'),
(9, '2'),
(10, '2'),
(11, '2'),
(12, '999'),
(13, '2'),
(14, '3'),
(15, '7'),
(16, '6'),
(17, '3'),
(18, '67'),
(19, '4'),
(20, '76'),
(21, '76'),
(22, '55'),
(23, '13'),
(24, '5'),
(25, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE IF NOT EXISTS `direcciones` (
  `id_direccion` int(10) unsigned NOT NULL COMMENT 'Clave única de registro',
  `direccion` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Dirección del parqueaderp',
  `id_pais` int(10) unsigned NOT NULL COMMENT 'Clave foranea de paises',
  `id_ciudad` int(10) unsigned NOT NULL COMMENT 'Clave foranea de ciudades'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id_direccion`, `direccion`, `id_pais`, `id_ciudad`) VALUES
(1, 'Algo', 1, 1),
(2, 'Caranqui', 1, 4),
(3, 'Los Ceibos', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE IF NOT EXISTS `horarios` (
  `id_horario` int(10) unsigned NOT NULL COMMENT 'Clave única de registro',
  `hora_inicio` time DEFAULT NULL COMMENT 'hora de apertura del servicio',
  `hora_fin` time DEFAULT NULL COMMENT 'hora de cierra del servicio'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id_horario`, `hora_inicio`, `hora_fin`) VALUES
(1, '00:00:00', '04:00:00'),
(2, '05:00:00', '11:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_01_15_105324_create_roles_table', 1),
('2015_01_15_114412_create_role_user_table', 1),
('2015_01_26_115212_create_permissions_table', 1),
('2015_01_26_115523_create_permission_role_table', 1),
('2015_02_09_132439_create_permission_user_table', 1),
('2015_07_18_111515_entrust_setup_tables', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
  `id_pais` int(10) unsigned NOT NULL COMMENT 'Clave única de registro',
  `nombre_pais` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Nombre de país'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id_pais`, `nombre_pais`) VALUES
(1, 'Ecuador'),
(2, 'Francia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parqueaderos`
--

CREATE TABLE IF NOT EXISTS `parqueaderos` (
  `id_parqueadero` int(10) unsigned NOT NULL COMMENT 'Clave única de registro',
  `nombre` varchar(250) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Nombre del parqueadero',
  `numero_plazas` int(4) unsigned NOT NULL COMMENT 'Número de plazas del parqueadero',
  `telefono` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Teléfono del parqueadero',
  `ubicacion_geografica` point DEFAULT NULL COMMENT 'Ubicación geográfica del parqueadero',
  `id_direccion` int(10) unsigned NOT NULL,
  `estado` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT 'Etado del parqueadero'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `parqueaderos`
--

INSERT INTO `parqueaderos` (`id_parqueadero`, `nombre`, `numero_plazas`, `telefono`, `ubicacion_geografica`, `id_direccion`, `estado`) VALUES
(1, 'Parkoloco', 100, '0989827390', '\0\0\0\0\0\0\0\0\0\0\0\0\0@\0\0\0\0\0\0\0@', 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(62, 'ver_usuarios', 'ver usuarios', NULL, '2015-07-18 17:22:16', '2015-07-18 17:22:16'),
(63, 'ver_roles', 'ver roles', NULL, '2015-07-18 17:22:16', '2015-07-18 17:22:16'),
(64, 'crear_roles', 'crear roles', NULL, '2015-07-18 17:22:16', '2015-07-18 17:22:16'),
(65, 'crear_usuarios', 'crear usuarios', NULL, '2015-07-18 17:22:16', '2015-07-18 17:22:16'),
(66, 'editar_roles', 'editar roles', NULL, '2015-07-18 17:22:16', '2015-07-18 17:22:16'),
(67, 'editar_usuarios', 'editar usuarios', NULL, '2015-07-18 17:22:16', '2015-07-18 17:22:16'),
(68, 'eliminar_usuarios', 'eliminar usuarios', NULL, '2015-07-18 17:22:16', '2015-07-18 17:22:16'),
(69, 'eliminar_roles', 'eliminar roles', NULL, '2015-07-18 17:22:16', '2015-07-18 17:22:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(62, 7),
(63, 7),
(64, 7),
(65, 7),
(66, 7),
(67, 7),
(68, 7),
(69, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plazas_estacionamiento`
--

CREATE TABLE IF NOT EXISTS `plazas_estacionamiento` (
  `id_parqueadero` int(10) unsigned NOT NULL COMMENT 'Clave foranea de parqueaderos',
  `plazas_ocupadas` int(4) DEFAULT NULL,
  `plazas_mantenimiento` int(4) DEFAULT NULL COMMENT 'Plazas cerradas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE IF NOT EXISTS `precios` (
  `id_tarifa` int(10) unsigned NOT NULL COMMENT 'Clave única de registro',
  `por_hora` double(6,2) DEFAULT NULL COMMENT 'Precio por hora',
  `semanal` double(6,2) DEFAULT NULL COMMENT 'Precio semanal',
  `mensual` double(6,2) DEFAULT NULL COMMENT 'Precio mensual',
  `anual` double(6,2) DEFAULT NULL COMMENT 'Precio anual'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`id_tarifa`, `por_hora`, `semanal`, `mensual`, `anual`) VALUES
(1, 0.00, 10.00, 50.00, 1000.00),
(2, 0.50, 10.00, 10.00, 10.00),
(3, 1.00, 10.00, 40.00, 500.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE IF NOT EXISTS `propietarios` (
  `id_usuario` int(10) unsigned NOT NULL,
  `id_parqueadero` int(10) unsigned NOT NULL COMMENT 'id del Parqueadero'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(7, 'admin', NULL, NULL, '2015-07-18 17:22:16', '2015-07-18 17:22:16'),
(10, 'cliente', 'cliente', 'cliente', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'invitado', 'invitado', 'invitado', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(12, 7),
(9, 10),
(8, 100),
(10, 100),
(11, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa_horario`
--

CREATE TABLE IF NOT EXISTS `tarifa_horario` (
  `id` int(10) unsigned NOT NULL COMMENT 'Clave única de registro de trarifas - horarios',
  `id_tarifa` int(10) unsigned DEFAULT NULL COMMENT 'Clave foranea de Tarifas',
  `id_horario` int(10) unsigned DEFAULT NULL COMMENT 'Clave foranea de Horarios',
  `id_parqueadero` int(10) unsigned NOT NULL COMMENT 'Clave foranea de Horarios'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Guarda las tarifas según los horarios de atención del parqueadero';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vehiculos`
--

CREATE TABLE IF NOT EXISTS `tipo_vehiculos` (
  `id_tipo` int(10) unsigned NOT NULL COMMENT 'Clave única de registro',
  `nombre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'nombre del tipo de vehículo',
  `largo` double(6,2) NOT NULL DEFAULT '0.00' COMMENT 'Largo máximo de un vehículo',
  `altura` double(6,2) NOT NULL COMMENT 'Altura del vahículo',
  `peso` double(6,2) NOT NULL COMMENT 'Peso del vehículo en toneladas',
  `descripcion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Descripción del tipo de vehiculo',
  `imagen` char(10) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Imagen que representa el tipo de vehículo'
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_vehiculos`
--

INSERT INTO `tipo_vehiculos` (`id_tipo`, `nombre`, `largo`, `altura`, `peso`, `descripcion`, `imagen`) VALUES
(1, 'Bicicleta', 0.00, 0.00, 0.00, 'Todo tipo de Bicicletas', 'tv_1.png'),
(5, 'Moto', 0.00, 0.00, 0.00, 'Todo tipo de motos', 'tv_5.png'),
(10, 'Vehículo', 0.00, 0.00, 0.00, 'Todo tipo de vehículos livianos.', 'tv_10.png'),
(15, 'Camión', 13.20, 4.10, 6.00, 'Camión de máximo 13.2 metros de largo, 4.10 metros de altura y 6 tonelas de peso.', 'tv_15.png'),
(20, 'Camión dual de 1 eje', 18.60, 4.10, 10.50, 'Camión dual de 1 eje con máximo 18.6 metros de altura, 4.10 metros de altura y 10.5 toneladas de peso.', 'tv_20.png'),
(25, 'Camión dual con remolque de 2 ejes', 20.00, 4.10, 18.00, 'Camión dual con remolque de 2 ejes con máximo 20 metros de largo, 4.10 metros de  altura y 18 tonelas.', 'tv_25.png'),
(30, 'Camión dual con remolque de 3 ejes', 20.50, 4.10, 25.50, 'Camión dual con remolque de 3 ejes con máximo 20.5 metros de largo, 4.10 metros de altura y 25.5 toneladas', 'tv_30.png'),
(35, 'Plataforma de transporte de vehículos', 22.40, 4.30, 0.00, 'Plataforma para transporte de vehículos', 'tv_35.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vehiculos_parqueadero`
--

CREATE TABLE IF NOT EXISTS `tipo_vehiculos_parqueadero` (
  `id_tipo_vehiculo` int(10) unsigned NOT NULL COMMENT 'Clave foranea de tipo de vehículos',
  `id_parqueadero` int(10) unsigned NOT NULL COMMENT 'Clave foranea de parqueaderos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombres` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `nombres`, `apellidos`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(8, 'Rosero23', 'Gandhy Lenadro', 'Cuasapas', 'leandro@hotmail.com', '$2y$10$hANOmgChxdLpAoPIXAP4JOU884/tVP4o7wsHZjy1GhJE38VWr8j0q', 'usVTQSYUIhmwsxo2qct2nT0rvkgQKcSTLOBt7dHD2gALjQ0QOxe0jYKBvz35', '2015-07-21 02:46:46', '2015-07-26 23:58:36'),
(9, 'lopez1278', 'Cristian Daniel', 'Hernández Robles', 'cris23@gmail.com', '$2y$10$l/1KKjRRcAlThyDV0xjN8eNoQoAYhKHi2AsalHfbKTy4Siq3y5qO2', 'HlIuuVs4wZ30IxDtbBkgCDaJTQyR6YGLv0KmCyxApaKVUegnZhqquKLPO59o', '2015-07-21 02:48:31', '2015-07-22 02:57:15'),
(10, 'JhonatanDF', 'Juan David', 'López Marquez', 'juan23@gmail.com', '$2y$10$GdWj.kVDOTkkuYNc8PKPm./0bdjRlRyvh36T66shmtyVzhwPghuGq', 'LOVOOCWoi73GwDNrWfcGBSCnogzot71FQzMd8NSkVIy2iiounBbrAfalJhXd', '2015-07-21 02:49:43', '2015-07-22 14:56:11'),
(11, 'Invitado', 'invitado', 'invitado', 'invitado@invitado.com', '$2y$10$O515T.ylUSa0EhKrNWPKQeCgE..B9zmJDEwJmwrEYg2jNlv4NubSy', 'whFbCEYa48tIZ4HJyF8XmP2fAa2IoXfMNfzZ1FBwmBPi4xwOoluYldt53uZ3', '2015-07-27 00:05:15', '2015-07-27 01:26:26'),
(12, 'Admin', 'nAdmin', 'aAdmin', 'admin@admin.com', '$2y$10$CY5Y2KGK8v2F8MHtyRCUseimkFF7UGsE8FYMy88izKB4zyGl9Jo4.', 'yK2zfrQTEZbEvn6FPLOfyw8J2ul27LvrXJDdjaK2fXUjte0S7Qo9GrvcZwBz', '2015-08-09 18:49:45', '2015-08-11 14:38:37');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id_ciudad`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id_direccion`), ADD KEY `fk_direcciones_paises_1` (`id_pais`), ADD KEY `fk_direcciones_ciudades_1` (`id_ciudad`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`), ADD KEY `fk_horarios_horas_1` (`hora_inicio`), ADD KEY `fk_horarios_horas_2` (`hora_fin`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `parqueaderos`
--
ALTER TABLE `parqueaderos`
  ADD PRIMARY KEY (`id_parqueadero`), ADD KEY `fk_direcciones` (`id_direccion`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indices de la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`), ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `plazas_estacionamiento`
--
ALTER TABLE `plazas_estacionamiento`
  ADD PRIMARY KEY (`id_parqueadero`);

--
-- Indices de la tabla `precios`
--
ALTER TABLE `precios`
  ADD PRIMARY KEY (`id_tarifa`);

--
-- Indices de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`id_usuario`,`id_parqueadero`), ADD KEY `fk_propietarios_parqueaderos_1` (`id_parqueadero`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indices de la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`), ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `tarifa_horario`
--
ALTER TABLE `tarifa_horario`
  ADD PRIMARY KEY (`id`), ADD KEY `id_tarifa` (`id_tarifa`), ADD KEY `id_horario` (`id_horario`), ADD KEY `id_parqueadero` (`id_parqueadero`);

--
-- Indices de la tabla `tipo_vehiculos`
--
ALTER TABLE `tipo_vehiculos`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tipo_vehiculos_parqueadero`
--
ALTER TABLE `tipo_vehiculos_parqueadero`
  ADD PRIMARY KEY (`id_tipo_vehiculo`,`id_parqueadero`), ADD KEY `fk_tipo_vehiculos_parqueadero_parqueaderos_1` (`id_parqueadero`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id_ciudad` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro',AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id_direccion` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id_pais` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro',AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `parqueaderos`
--
ALTER TABLE `parqueaderos`
  MODIFY `id_parqueadero` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro',AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT de la tabla `precios`
--
ALTER TABLE `precios`
  MODIFY `id_tarifa` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT de la tabla `tarifa_horario`
--
ALTER TABLE `tarifa_horario`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro de trarifas - horarios';
--
-- AUTO_INCREMENT de la tabla `tipo_vehiculos`
--
ALTER TABLE `tipo_vehiculos`
  MODIFY `id_tipo` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Clave única de registro',AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
ADD CONSTRAINT `fk_direcciones_ciudades_1` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudades` (`id_ciudad`),
ADD CONSTRAINT `fk_direcciones_paises_1` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`);

--
-- Filtros para la tabla `parqueaderos`
--
ALTER TABLE `parqueaderos`
ADD CONSTRAINT `fk_direcciones` FOREIGN KEY (`id_direccion`) REFERENCES `direcciones` (`id_direccion`);

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `plazas_estacionamiento`
--
ALTER TABLE `plazas_estacionamiento`
ADD CONSTRAINT `fk_plazas_estacionamiento_parqueaderos_1` FOREIGN KEY (`id_parqueadero`) REFERENCES `parqueaderos` (`id_parqueadero`);

--
-- Filtros para la tabla `propietarios`
--
ALTER TABLE `propietarios`
ADD CONSTRAINT `fk_propietarios_parqueaderos_1` FOREIGN KEY (`id_parqueadero`) REFERENCES `parqueaderos` (`id_parqueadero`),
ADD CONSTRAINT `fk_propietarios_users_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tarifa_horario`
--
ALTER TABLE `tarifa_horario`
ADD CONSTRAINT `fk_parqueadero` FOREIGN KEY (`id_parqueadero`) REFERENCES `parqueaderos` (`id_parqueadero`),
ADD CONSTRAINT `fk_precios` FOREIGN KEY (`id_tarifa`) REFERENCES `precios` (`id_tarifa`),
ADD CONSTRAINT `tarifa_horario_ibfk_1` FOREIGN KEY (`id_horario`) REFERENCES `horarios` (`id_horario`);

--
-- Filtros para la tabla `tipo_vehiculos_parqueadero`
--
ALTER TABLE `tipo_vehiculos_parqueadero`
ADD CONSTRAINT `fk_tipo_vehiculos_parqueadero_parqueaderos_1` FOREIGN KEY (`id_parqueadero`) REFERENCES `parqueaderos` (`id_parqueadero`),
ADD CONSTRAINT `fk_tipo_vehiculos_parqueadero_tipo_vehiculos_1` FOREIGN KEY (`id_tipo_vehiculo`) REFERENCES `tipo_vehiculos` (`id_tipo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
