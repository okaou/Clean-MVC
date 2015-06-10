<?php
/**
 * MyClass Class Doc Comment
 *
 * PHP version 5
 *
 * @category Class
 * @package  MyPackage
 * @author   okaou
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
namespace Controller;
require_once 'Templeter.php';

/**
 * MyClass Class Doc Comment
 *
 * PHP version 5
 *
 * @category Class
 * @package  MyPackage
 * @author   okaou
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
abstract class Controller
{
    /**
    * Render method
    *
    * @param string $view view
    *
    * @param array $array array
    *
    * @return view
    */
    public function render($view, $array = NULL)
    {
        $views = RACINE . "/../app/views/";
        $render = explode(":", $view);
        if (isset($render[0]) && !empty($render[0])) {
            $pos = strripos($render[0], "Controller");
            if ($pos === false) {
                echo "Syntaxe Controller Error";
            } else {
                $controller = str_replace("Controller", "", $render[0]);
                $dirs = scandir($views);
                foreach ($dirs as $value) {
                    if ($value != "." && $value != "..") {
                        $new = $views . $value;
                        if (is_dir($new)) {
                            if ($value == $controller) {
                                if (isset($render[1]) && !empty($render[1])) {
                                    if ($handle = opendir($new)) {
                                        while (false !== ($entry = readdir($handle))) {
                                            if ($entry != "." && $entry != "..") {
                                                if ($render[1] == $entry) {
                                                    $pathView = $new . "/" . $entry;
                                                    if (isset($array)) {
                                                        if (is_array($array)) {
                                                            $template = new Templeter();
                                                            $template->fileToTemp($pathView);
                                                            $template->values($array);
                                                            echo $template;
                                                        } else {
                                                            echo "Parameter two is wrong";
                                                        }
                                                    } else {
                                                        require_once $pathView;
                                                    }
                                                }
                                            }
                                        }
                                        closedir($handle);
                                    }
                                } else {
                                    echo "View file was not filled";
                                }
                            }
                        }
                    }
                }
            }
        } else {
            echo "Controller was not filled";
        }
    }
}
?>