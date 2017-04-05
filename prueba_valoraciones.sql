-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-04-2017 a las 08:25:23
-- Versión del servidor: 5.7.14
-- Versión de PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba_valoraciones`
--
CREATE DATABASE IF NOT EXISTS `prueba_valoraciones` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `prueba_valoraciones`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `email` varchar(255) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `salt_password` text NOT NULL,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`email`, `nombres`, `apellidos`, `salt_password`, `estado`) VALUES
('prueba@gmail.com', 'Prueba', 'Prueba', 'MTIz', 'ACTIVO'),
('shelvinbb@gmail.com', 'SHelvin', 'Batista', 'MTIz', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id` bigint(20) NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text,
  `categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id`, `titulo`, `descripcion`, `categoria`) VALUES
(1, 'KONG: LA ISLA CALAVERA', 'Un diverso equipo de exploradores es reunido para aventurarse en el interior de una isla del Pacífico —tan bella como traicionera— que no aparece en los mapas, sin saber que están invadiendo los dominios del mítico King Kong.', 'Aventura'),
(2, 'LA BELLA Y LA BESTIA', 'La bella y la bestia es una próxima película estadounidense de imagen real, fantasía dirigida por Bill Condon y escrita por Evan Spiliotopoulos y Stephen Chbosky, basada en el cuento de hadas del mismo nombre de Jeanne-Marie Leprince de Beaumont.', 'Romance'),
(3, 'LA VIGILANTE DEL FUTURO', 'Basada en la internacionalmente aclamada propiedad de ciencia ficción, "GHOST IN THE SHELL: VIGILANTE DEL FUTURO" sigue a la mayor de las operaciones especiales, una única híbrido humana y ciber-organismo que comanda a la fuerza de élite Sección 9, dedicada a detener a los más peligrosos criminales. Sección 9 se enfrenta con un enemigo cuya meta es eliminar los avances tecnológicos en robótica.', 'Acción'),
(4, 'LOGAN', 'Sin sus poderes, por primera vez, Wolverine es verdaderamente vulnerable. Después de una vida de dolor y angustia, sin rumbo y perdido en el mundo donde los X-Men son leyenda, su mentor Charles Xavier lo convence de asumir una última misión: proteger a una joven que será la única esperanza para la raza mutante. Una poderosa, dramática historia emocional que nos mostrará la leyenda como nunca antes la habíamos visto.', 'Acción'),
(5, 'POWER RANGERS', 'La película sigue a cinco ordinarios jóvenes en la preparatoria que tienen que convertirse en algo extraordinario cuando descubren que su modesto poblado de Angel Grove –y el resto del mundo– está al borde de la aniquilación por una amenaza alienígena. Elegidos por el destino, nuestros héroes descubren rápidamente que son los únicos que pueden salvar al planeta. Pero para lograrlo tendrán que superar problemas de la vida real y unirse como los Power Rangers antes de que sea demasiado tard', 'Acción'),
(6, 'RÁPIDOS Y FURIOSOS 8', 'Justo cuando Dom y Letty celebran su luna de miel, Brian y Mia se han retirado del juego y el resto del equipo se ha desintegrado en busca de una vida común y corriente; una misteriosa mujer (Charlize Theron, ganadora al Óscar) intentará seducir a Dom para convencerlo de regresar a la vida criminal que tanto lo acecha, traicionando a quienes lo rodean y enfrentándose a retos nunca antes vistos.Desde la costa cubana pasando por las calles de Nueva York y hasta el helado Ártico, el equipo deberá cruzar el mundo para detener a una anarquista y evitar un desastre mundial trayendo de vuelta a casa al hombre que los convirtió en una familia.', 'Acción'),
(7, 'UN JEFE EN PAÑALES', 'DreamWorks Animation y el director de Madagascar te invitan a conocer al bebé más inusual. Usa traje, habla con la voz e ingenio de Alec Baldwin y estelariza la comedia animada Un Jefe en Pañales, para DreamWorks. Un Jefe en Pañales es una historia universal e hilarante acerca de cómo la llegada de un nuevo bebé impacta a una familia, contada desde la perspectiva de un narrador poco fiable, pero encantador: Tim, un niño de siete años, de mente desenfrenada e imaginativa. Con un mensaje pícaro, pero conmovedor, acerca de la importancia de la familia, The Boss Baby, de DreamWorks, es una comedia original y auténtica que llamará la atención a audiencias de todas las edades.', 'Animada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `id` bigint(20) NOT NULL,
  `email_cliente` varchar(255) NOT NULL,
  `id_pelicula` bigint(20) NOT NULL,
  `valor` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_cliente` (`email_cliente`),
  ADD KEY `id_pelicula` (`id_pelicula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `FK_Cliente_Valoracion` FOREIGN KEY (`email_cliente`) REFERENCES `clientes` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Pelicula_Valoracion` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
