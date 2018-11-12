<?php

class PluginsModule extends CWebModule
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
                                -- Tiempo de generaciÃ³n: 16-02-2016 a las 15:59:53
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
                                -- Estructura de tabla para la tabla `modulos`
                                --

                                CREATE TABLE IF NOT EXISTS `modulos` (
                                  `id` varchar(20) NOT NULL,
                                  `nombre` varchar(20) NOT NULL,
                                  `estado` int(11) NOT NULL,
                                  `fecha_creacion` bigint(20) NOT NULL,
                                  `version` varchar(20) NOT NULL,
                                  `desarrollador` varchar(50) NOT NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                                --
                                -- Indices para tablas volcadas
                                --

                                --
                                -- Indices de la tabla `modulos`
                                --
                                ALTER TABLE `modulos`
                                 ADD PRIMARY KEY (`id`);

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
                                -- Tiempo de generaciÃ³n: 17-02-2016 a las 19:19:42
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
                                -- Estructura de tabla para la tabla `acciones`
                                --

                                CREATE TABLE IF NOT EXISTS `acciones` (
                                `id` int(11) NOT NULL,
                                  `modulo` varchar(20) NOT NULL,
                                  `accion` varchar(20) NOT NULL,
                                  `ruta` varchar(100) NOT NULL
                                ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

                                --
                                -- Ãndices para tablas volcadas
                                --

                                --
                                -- Indices de la tabla `acciones`
                                --
                                ALTER TABLE `acciones`
                                 ADD PRIMARY KEY (`id`);

                                --
                                -- AUTO_INCREMENT de las tablas volcadas
                                --

                                --
                                -- AUTO_INCREMENT de la tabla `acciones`
                                --
                                ALTER TABLE `acciones`
                                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
                                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
				';
		$command=Yii::app()->db->createCommand($configuracion);
		$command->execute();
                
		// import the module-level models and components
		$this->setImport(array(
			'plugins.models.*',
			'plugins.components.*',
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
