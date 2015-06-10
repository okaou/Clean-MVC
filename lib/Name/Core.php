<?php
/**
 * MyClass Class Doc Comment
 *
 * PHP version 5
 *
 * @category Class
 * @package  MyPackage
 * @author   Oussama.kaoutar <ouss.kau@epitech.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://pear.php.net/package/PackageName
 */

/**
 * Classe user permettant l'inscription et la connexion
 *
 * Description plus détaillée de la classe (si besoin en est)...
 *
 * @category   NomCatégorie
 * @package    NomPaquetage
 * @author     Auteur original <auteur@example.com>
 * @author     Un autre author <autre@example.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      Class available since Release 1.2.0
 * @deprecated Class deprecated in Release 2.0.0
 */
namespace Name;
use app\controllers;
/**
 * MyClass Class Doc Comment
 *
 * PHP version 5
 *
 * @category Class
 * @package  MyPackage
 * @author   Oussama.kaoutar <ouss.kau@epitech.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://pear.php.net/package/PackageName
 */

/**
 * Classe user permettant l'inscription et la connexion
 *
 * Description plus détaillée de la classe (si besoin en est)...
 *
 * @category   NomCatégorie
 * @package    NomPaquetage
 * @author     Auteur original <auteur@example.com>
 * @author     Un autre author <autre@example.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      Class available since Release 1.2.0
 * @deprecated Class deprecated in Release 2.0.0
 */
class Core
{
    /**
    * Run method
    *
    * @return view
    */
    public static function run()
    {
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            $exp = explode("/", $page);
            if (isset($exp[0]) && !empty($exp[0])) {
                $controller = ucfirst($exp[0]) . "Controller.php";
                $path = "../app/controllers/" . $controller;
                Core::registerAutoload($path);
                spl_autoload_register('Name\Core::registerAutoload');
                if (file_exists($path)) {
                    $name = ucfirst($exp[0]) . "Controller";
                    $namespace = "app\controllers\\" . $name;
                    if (isset($exp[1]) && !empty($exp[1])) {
                        $method = $exp[1] . "Action";
                        $obj = new $namespace();
                        if (method_exists($namespace, $method)) {
                            $obj->$method();
                        } else {
                            echo "Method inexistante";
                        }
                    } else {
                        echo "Action non presisé";
                    }
                } else {
                    echo "Controller inexistant";
                }
            }
        }
    }

    /**
    * Register method
    *
    * @param string $path string
    *
    * @return view
    */
    public static function registerAutoload($path)
    {
        if (file_exists($path)) {
            require_once($path);
        } else {
            return false;
        }
    }
}
?>