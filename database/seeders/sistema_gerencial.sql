-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2022 a las 16:58:24
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_gerencial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras_g`
--

CREATE TABLE `carreras_g` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_carrera` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `codigo_carrera` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facultad_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `carreras_g`
--

INSERT INTO `carreras_g` (`id`, `nombre_carrera`, `codigo_carrera`, `facultad_id`, `created_at`, `updated_at`) VALUES
(1, 'Ingeniería Agronómica', 'I10304', 3, '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(2, 'Doctorado en Medicina', 'M10304', 5, '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(3, 'Licenciatura en Periodismo', 'L10409', 1, '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(4, 'Ingeniería de Sistemas Informaticos', 'I10515', 2, '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(5, 'Doctorado en Cirugia Dental', 'F10304', 4, '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(6, 'Licenciatura en Relaciones Internacionales', 'L10202', 6, '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(7, 'Licenciatura en Química y Farmacia', 'L10601', 7, '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(8, 'Licenciatura en Matemática', 'L10940', 8, '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(9, 'Licenciatura en Mercadeo Internacional', 'L1080L', 9, '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(10, 'Ingenieria Industrial', 'I10520', 2, '2021-11-28 13:11:51', '2021-11-28 13:11:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `constancias_cumplimiento_g`
--

CREATE TABLE `constancias_cumplimiento_g` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estudiante_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `constancias_cumplimiento_g`
--

INSERT INTO `constancias_cumplimiento_g` (`id`, `estudiante_id`, `created_at`, `updated_at`) VALUES
(1, 4, '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(2, 3, '2022-05-01 15:37:58', '2022-05-01 15:37:58'),
(4, 2, '2022-05-01 15:38:59', '2022-05-01 15:38:59'),
(5, 5, '2022-05-01 15:38:59', '2022-05-01 15:38:59'),
(6, 6, '2022-05-01 15:39:32', '2022-05-01 15:39:32'),
(7, 1, '2022-05-01 15:39:32', '2022-05-01 15:39:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `constancia_c_proyecto_s_g`
--

CREATE TABLE `constancia_c_proyecto_s_g` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `constancia_cumplimiento_id` bigint(20) UNSIGNED DEFAULT NULL,
  `proyecto_social_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `constancia_c_proyecto_s_g`
--

INSERT INTO `constancia_c_proyecto_s_g` (`id`, `constancia_cumplimiento_id`, `proyecto_social_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2022-05-02 15:40:09', '2022-05-01 15:40:09'),
(2, 2, 2, '2022-05-01 15:37:58', '2022-05-01 15:37:58'),
(3, 4, 2, '2021-08-20 17:58:09', '2021-08-21 17:58:09'),
(4, 5, 2, '2022-05-01 15:37:58', '2022-05-01 15:37:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes_g`
--

CREATE TABLE `estudiantes_g` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_estudiante` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_estudiante` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `carnet_estudiante` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexo_estudiante` enum('Masculino','Femenino') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrera_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cantidad_horas_ss` int(10) UNSIGNED NOT NULL,
  `estado_estudiante` enum('Inactivo','Activo','En espera','Realizando servicio','Servicio finalizado') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estudiantes_g`
--

INSERT INTO `estudiantes_g` (`id`, `nombre_estudiante`, `apellido_estudiante`, `carnet_estudiante`, `sexo_estudiante`, `carrera_id`, `cantidad_horas_ss`, `estado_estudiante`, `created_at`, `updated_at`) VALUES
(1, 'Fredy', 'Martinez', 'MM16045', 'Masculino', 1, 500, 'Activo', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(2, 'Leo', 'Urquilla', 'UR17008', 'Masculino', 2, 400, 'Activo', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(3, 'Chico', 'Santana', 'SM16006', 'Masculino', 3, 400, 'Activo', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(4, 'Fransisco', 'Ganuza', 'GR18015', 'Masculino', 4, 500, 'Realizando servicio', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(5, 'Stefany', 'Ruiz', 'RR16003', 'Femenino', 5, 500, 'Activo', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(6, 'Carlos', 'Gutierrez', 'CG12025', 'Masculino', 4, 500, 'Realizando servicio', '2021-11-28 13:45:29', '2021-11-28 13:48:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultades_g`
--

CREATE TABLE `facultades_g` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_facultad` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `facultades_g`
--

INSERT INTO `facultades_g` (`id`, `nombre_facultad`, `created_at`, `updated_at`) VALUES
(1, 'Facultad de Ciencias y Humanidades', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(2, 'Facultad de Ingeníeria y Arquitectura', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(3, 'Facultad de Agronomía', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(4, 'Facultad de Odontología', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(5, 'Facultad de Medicina', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(6, 'Facultad de Jurisprudencia y Ciencias Sociales', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(7, 'Facultad de Química y Farmacia', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(8, 'Facultad de Ciencias Naturales y Matemática', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(9, 'Facultad de Ciencias Económicas', '2021-11-28 12:17:07', '2021-11-28 12:17:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instituciones_g`
--

CREATE TABLE `instituciones_g` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_institucion` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contacto_institucion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo_institucion` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `instituciones_g`
--

INSERT INTO `instituciones_g` (`id`, `nombre_institucion`, `contacto_institucion`, `correo_institucion`, `created_at`, `updated_at`) VALUES
(1, 'Applaudo Studios', 'Rudy Chicas', 'applaudo@gmail.com', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(2, 'NovaTech', 'Karen Peñate', 'novatech@gmail.com', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(3, 'Apple', 'Andres Mendez', 'apple@gmail.com', '2021-11-28 13:30:54', '2021-11-28 13:30:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peticiones_g`
--

CREATE TABLE `peticiones_g` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cantidad_estudiantes` int(10) UNSIGNED NOT NULL,
  `nombre_peticion` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_peticion` date DEFAULT NULL,
  `fecha_peticion_fin` date DEFAULT NULL,
  `cantidad_horas` bigint(20) UNSIGNED NOT NULL,
  `estado_peticion` enum('En espera','Aceptado','Rechazado') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrera_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tipo_servicio_social_id` bigint(20) UNSIGNED DEFAULT NULL,
  `institucion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `peticiones_g`
--

INSERT INTO `peticiones_g` (`id`, `cantidad_estudiantes`, `nombre_peticion`, `fecha_peticion`, `fecha_peticion_fin`, `cantidad_horas`, `estado_peticion`, `carrera_id`, `tipo_servicio_social_id`, `institucion_id`, `created_at`, `updated_at`) VALUES
(1, 2, 'Pasantia para desarrollo', '2021-09-24', '2021-10-10', 300, 'En espera', 4, 1, 1, '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(2, 3, 'Desarrollador Web', '2021-09-27', '2021-11-10', 400, 'Aceptado', 4, 3, 1, '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(3, 1, 'Pasantia como tecnico', '2021-12-06', '2021-11-30', 0, 'Aceptado', 4, 1, 3, '2021-11-28 13:33:04', '2021-11-28 13:33:46'),
(4, 2, 'Prueba', '2021-12-01', '2021-12-31', 0, 'Aceptado', 3, 1, 2, '2021-12-03 14:40:53', '2021-12-03 14:40:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos_sociales_g`
--

CREATE TABLE `proyectos_sociales_g` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `peticion_id` bigint(20) UNSIGNED DEFAULT NULL,
  `estado_proyecto_social` enum('No iniciado','En curso','Finalizado','Cancelado') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `proyectos_sociales_g`
--

INSERT INTO `proyectos_sociales_g` (`id`, `peticion_id`, `estado_proyecto_social`, `created_at`, `updated_at`) VALUES
(1, 2, 'En curso', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(2, 3, 'Finalizado', '2021-11-28 13:34:00', '2021-11-28 13:49:27'),
(3, 4, 'En curso', '2022-05-01 16:10:53', '2022-05-15 16:10:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_servicio_social_g`
--

CREATE TABLE `tipos_servicio_social_g` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_tipo_servicio` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipos_servicio_social_g`
--

INSERT INTO `tipos_servicio_social_g` (`id`, `nombre_tipo_servicio`, `created_at`, `updated_at`) VALUES
(1, 'Pasantia', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(2, 'Documentacion', '2021-11-28 12:17:07', '2021-11-28 12:17:07'),
(3, 'Interinato', '2021-11-28 12:17:07', '2021-11-28 12:17:07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carreras_g`
--
ALTER TABLE `carreras_g`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_carreras_facultades` (`facultad_id`);

--
-- Indices de la tabla `constancias_cumplimiento_g`
--
ALTER TABLE `constancias_cumplimiento_g`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_constancias_estudiantes` (`estudiante_id`);

--
-- Indices de la tabla `constancia_c_proyecto_s_g`
--
ALTER TABLE `constancia_c_proyecto_s_g`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_constancia_constancia` (`constancia_cumplimiento_id`),
  ADD KEY `FK_constancia_proyectos` (`proyecto_social_id`);

--
-- Indices de la tabla `estudiantes_g`
--
ALTER TABLE `estudiantes_g`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_estudiantes_carreras` (`carrera_id`);

--
-- Indices de la tabla `facultades_g`
--
ALTER TABLE `facultades_g`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `instituciones_g`
--
ALTER TABLE `instituciones_g`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `peticiones_g`
--
ALTER TABLE `peticiones_g`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_peticiones_carrera` (`carrera_id`),
  ADD KEY `FK_peticiones_tipos` (`tipo_servicio_social_id`),
  ADD KEY `FK_peticiones_instituciones` (`institucion_id`);

--
-- Indices de la tabla `proyectos_sociales_g`
--
ALTER TABLE `proyectos_sociales_g`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_proyectos_peticiones` (`peticion_id`);

--
-- Indices de la tabla `tipos_servicio_social_g`
--
ALTER TABLE `tipos_servicio_social_g`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carreras_g`
--
ALTER TABLE `carreras_g`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `constancias_cumplimiento_g`
--
ALTER TABLE `constancias_cumplimiento_g`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `constancia_c_proyecto_s_g`
--
ALTER TABLE `constancia_c_proyecto_s_g`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estudiantes_g`
--
ALTER TABLE `estudiantes_g`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `facultades_g`
--
ALTER TABLE `facultades_g`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `instituciones_g`
--
ALTER TABLE `instituciones_g`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `peticiones_g`
--
ALTER TABLE `peticiones_g`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `proyectos_sociales_g`
--
ALTER TABLE `proyectos_sociales_g`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipos_servicio_social_g`
--
ALTER TABLE `tipos_servicio_social_g`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carreras_g`
--
ALTER TABLE `carreras_g`
  ADD CONSTRAINT `FK_carreras_facultades` FOREIGN KEY (`facultad_id`) REFERENCES `facultades_g` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `constancias_cumplimiento_g`
--
ALTER TABLE `constancias_cumplimiento_g`
  ADD CONSTRAINT `FK_constancias_estudiantes` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiantes_g` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `constancia_c_proyecto_s_g`
--
ALTER TABLE `constancia_c_proyecto_s_g`
  ADD CONSTRAINT `FK_constancia_constancia` FOREIGN KEY (`constancia_cumplimiento_id`) REFERENCES `constancias_cumplimiento_g` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_constancia_proyectos` FOREIGN KEY (`proyecto_social_id`) REFERENCES `proyectos_sociales_g` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiantes_g`
--
ALTER TABLE `estudiantes_g`
  ADD CONSTRAINT `FK_estudiantes_carreras` FOREIGN KEY (`carrera_id`) REFERENCES `carreras_g` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `peticiones_g`
--
ALTER TABLE `peticiones_g`
  ADD CONSTRAINT `FK_peticiones_carrera` FOREIGN KEY (`carrera_id`) REFERENCES `carreras_g` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_peticiones_instituciones` FOREIGN KEY (`institucion_id`) REFERENCES `instituciones_g` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_peticiones_tipos` FOREIGN KEY (`tipo_servicio_social_id`) REFERENCES `tipos_servicio_social_g` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyectos_sociales_g`
--
ALTER TABLE `proyectos_sociales_g`
  ADD CONSTRAINT `FK_proyectos_peticiones` FOREIGN KEY (`peticion_id`) REFERENCES `peticiones_g` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
