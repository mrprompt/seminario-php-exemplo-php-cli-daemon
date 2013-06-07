<?php
/**
 * Um daemon que n?o faz nada.
 *
 * @author Thiago Paes <mrprompt@gmail.com>
 * @copyright (c) 2013, Thiago Paes
 */

/**
 * @see autoload
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// bibliotecas utilizadas.
use Uecode\Daemon;

try {
    $options = array(
        "appName"        => "daemon",
        "appDescription" => "Daemon de exemplo",
        "appDir"         => __DIR__,
        "appExecutable"  => basename(__FILE__),
        "appRunAsUID"    => getmyuid(),
        "appRunAsGID"    => getmygid(),
        "appUser"        => get_current_user(),
        "appPidLocation" => implode(
            DIRECTORY_SEPARATOR,
            array(
                __DIR__,
                "log",
                "daemon",
                "daemon.pid"
            )
        ),
        "logVerbosity"  => 1,
        "logPhpErrors"  => true,
        "logTrimAppDir" => true,
        "logLocation"   => implode(
            DIRECTORY_SEPARATOR,
            array(
                __DIR__,
                "log",
                "daemon.log"
            )
        ),
        "authorName"     => "Thiago Paes",
        "authorEmail"    => "mrprompt@gmail.com",
        "sysMemoryLimit" => "128M",
    );

    $daemon = new Daemon($options);
    $daemon->start();
    
    while (true) {
        echo 'ainda to rodando...', PHP_EOL;

        sleep(3);
    }
} catch (Uecode\Daemon\Exception $de) {
    echo 'Erro do daemon: ', $e->getMessage(), PHP_EOL;
} catch (Exception $e ) {
    echo 'Erro geral: ', $e->getMessage(), PHP_EOL;
}
