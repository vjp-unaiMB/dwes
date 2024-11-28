<?php

    require 'utils/utils.php';
    require_once 'entity/File.class.php';
    require_once 'entity/imagenGaleria.class.php';
    //require_once 'entity/Partner.class.php';
    require_once 'entity/connection.class.php';
    require_once 'exceptions/AppException.class.php';
    require 'core/app.class.php';
    require_once 'repository/imagenGaleriaRepository.class.php';
    require_once 'repository/CategoriaRepository.class.php';
    require 'entity/categoria.class.php';

    $errores = [];
    $imagenes = [];

    try{
    $config = require_once 'app/config.php';
    App::bind('config',$config); 
    //$queryBuilder = new QueryBuilder('imagenes','ImagenGaleria');
    $imagenRepository = new ImagenGaleriaRepositorio();
    //$partnerRepository = new PartnerRepository();


    }catch(FileException $exception){
    $errores[]=$exception->getMessage();
    }catch(QueryException $exception){
    $errores[]=$exception->getMessage();
    }catch (AppException $exception){
    $errores[] = $exception->getMessage();
    }
    finally{
    $imagenes = $imagenRepository->findAll();
    //$partners = $partnerRepository->findAll();
    }

    require 'views/index.view.php';

    
?>