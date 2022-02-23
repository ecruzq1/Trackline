--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`EMP_ID`, `EMP_NOMBRE`) VALUES
(1, 'ESPE-Pruebas');
COMMIT;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`TPU_ID`, `TPU_NOMBRE`, `TPU_DESCRIPCION`) VALUES
(1, 'Administrador', 'Usuario encargado de administrar la empresa y las rutas de sus empleados.'),
(2, 'Vendedor', 'Usuario encargado de ender los productos de la empresa.'),
(3, 'Promotor', 'Usuario encargado de promocionar los nuevos productos.'),
(4, 'Reparador', 'Usuario que repara productos.');
COMMIT;
