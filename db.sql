-- Versión de PHP: 7.2.31

CREATE TABLE `usr` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `dpi` int(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

ALTER TABLE `usr`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `usr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


