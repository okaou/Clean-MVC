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
class Templeter
{
    protected $_sortie = "";

    private $_entries = array();

    public function fileToTemp($_file) {
        $this->_entries = array();

        if (!file_exists($_file)) {
            throw new Exception("File not found");
        }

        $this->_sortie = file_get_contents($_file);
    }

    public function values($values) {
        $this->_entries = $values;
    }

    public function __toString() {
        $this->convert();
        return $this->_sortie;
    }

    private function convert() {
        foreach ($this->_entries as $key => $value) {
            $this->_sortie = str_replace("{{ " . $key . " }}", $value, $this->_sortie);
        }
    }
}
?>