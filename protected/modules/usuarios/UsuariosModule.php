<?php

class UsuariosModule extends CWebModule
{   
    public $nombre;
    public $modulo;
    public $padre;
    public $desplegable;
    public $version;
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
                
                $configuracion = '-- phpMyAdmin SQL Dump
                                -- version 4.2.7.1
                                -- http://www.phpmyadmin.net
                                --
                                -- Servidor: 127.0.0.1
                                -- Tiempo de generaciÃ³n: 16-02-2016 a las 15:30:07
                                -- VersiÃ³n del servidor: 5.5.39
                                -- VersiÃ³n de PHP: 5.4.31

                                SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                                SET time_zone = "+00:00";


                                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                                /*!40101 SET NAMES utf8 */;

                                --
                                -- Base de datos: `bdsofint`
                                --

                                -- --------------------------------------------------------

                                --
                                -- Estructura de tabla para la tabla `sofint_users`
                                --

                                CREATE TABLE IF NOT EXISTS `sofint_users` (
                                `id` int(11) NOT NULL,
                                  `nick` varchar(10) NOT NULL,
                                  `password` varchar(50) NOT NULL,
                                  `nombre` varchar(20) NOT NULL,
                                  `apellido` varchar(20) NOT NULL,
                                  `telefono` int(11) NOT NULL,
                                  `movil` bigint(11) NOT NULL,
                                  `email` varchar(40) NOT NULL,
                                  `foto` varchar(50) NOT NULL,
                                  `direccion` text NOT NULL,
                                  `perfil` int(11) NOT NULL,
                                  `estado` int(11) NOT NULL,
                                  `fecha_creacion` int(11) NOT NULL,
                                  `dat1` int(11) NOT NULL,
                                  `dat2` varchar(50) NOT NULL,
                                  `dat3` varchar(100) NOT NULL,
                                  `dat4` varchar(50) NOT NULL,
                                  `dat5` text NOT NULL
                                ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

                                --
                                -- Ãndices para tablas volcadas
                                --

                                --
                                -- Indices de la tabla `sofint_users`
                                --
                                ALTER TABLE `sofint_users`
                                 ADD PRIMARY KEY (`id`);

                                --
                                -- AUTO_INCREMENT de las tablas volcadas
                                --

                                --
                                -- AUTO_INCREMENT de la tabla `sofint_users`
                                --
                                ALTER TABLE `sofint_users`
                                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
                                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

				';
		$command=Yii::app()->db->createCommand($configuracion);
		$command->execute();
            
                $configuracion = '-- phpMyAdmin SQL Dump
                                -- version 4.2.7.1
                                -- http://www.phpmyadmin.net
                                --
                                -- Servidor: 127.0.0.1
                                -- Tiempo de generaciÃ³n: 17-02-2016 a las 14:25:26
                                -- VersiÃ³n del servidor: 5.5.39
                                -- VersiÃ³n de PHP: 5.4.31

                                SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                                SET time_zone = "+00:00";


                                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                                /*!40101 SET NAMES utf8 */;

                                --
                                -- Base de datos: `bdsofint_new`
                                --

                                -- --------------------------------------------------------

                                --
                                -- Estructura de tabla para la tabla `perfil`
                                --

                                CREATE TABLE IF NOT EXISTS `perfil` (
                                `id` int(11) NOT NULL,
                                  `nombre` varchar(20) NOT NULL,
                                  `descripcion` varchar(200) NOT NULL,
                                  `fecha_creacion` bigint(20) NOT NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

                                --
                                -- Ãndices para tablas volcadas
                                --

                                --
                                -- Indices de la tabla `perfil`
                                --
                                ALTER TABLE `perfil`
                                 ADD PRIMARY KEY (`id`);

                                --
                                -- AUTO_INCREMENT de las tablas volcadas
                                --

                                --
                                -- AUTO_INCREMENT de la tabla `perfil`
                                --
                                ALTER TABLE `perfil`
                                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
                                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
				';
		$command=Yii::app()->db->createCommand($configuracion);
		$command->execute();
                
                $configuracion = '-- phpMyAdmin SQL Dump
                                -- version 4.2.7.1
                                -- http://www.phpmyadmin.net
                                --
                                -- Servidor: 127.0.0.1
                                -- Tiempo de generacion: 17-02-2016 a las 14:25:42
                                -- Version del servidor: 5.5.39
                                -- Version de PHP: 5.4.31

                                SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
                                SET time_zone = "+00:00";


                                /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
                                /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
                                /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
                                /*!40101 SET NAMES utf8 */;

                                --
                                -- Base de datos: `bdsofint_new`
                                --

                                -- --------------------------------------------------------

                                --
                                -- Estructura de tabla para la tabla `perfil_contenido`
                                --

                                CREATE TABLE IF NOT EXISTS `perfil_contenido` (
                                `id` int(11) NOT NULL,
                                  `modulo` varchar(20) NOT NULL,
                                  `controlador` varchar(20) NOT NULL,
                                  `accion` varchar(20) NOT NULL,
                                  `estado` int(11) NOT NULL,
                                  `perfil` int(11) NOT NULL,
                                  `fecha_creacion` bigint(20) NOT NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

                                --
                                -- Ãndices para tablas volcadas
                                --

                                --
                                -- Indices de la tabla `perfil_contenido`
                                --
                                ALTER TABLE `perfil_contenido`
                                 ADD PRIMARY KEY (`id`);

                                --
                                -- AUTO_INCREMENT de las tablas volcadas
                                --

                                --
                                -- AUTO_INCREMENT de la tabla `perfil_contenido`
                                --
                                ALTER TABLE `perfil_contenido`
                                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
                                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
				';
		$command=Yii::app()->db->createCommand($configuracion);
		$command->execute();                                               
                
                
		// import the module-level models and components
		$this->setImport(array(
			'usuarios.models.*',
			'usuarios.components.*',                        
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
