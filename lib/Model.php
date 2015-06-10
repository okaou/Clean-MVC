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
namespace DB;
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
abstract class Model
{
    private $_host = "localhost";
    private $_port;
    private $_socket = "/home/user/.mysql/mysql.sock";
    private $_username = "root";
    private $_password = "";
    private $_dbname = "my_framework";
    protected $_pdo;

    public function setHost($host) {
        $this->_host = $host;
    }

    public function getHost() {
        return $this->_host;
    }

    public function setPort($port) {
        $this->_port = $port;
    }

    public function getPort() {
        return $this->_port;
    }

    public function setSocket($socket) {
        $this->_socket = $socket;
    }

    public function getSocket() {
        return $this->_socket;
    }

    public function setUsername($username) {
        $this->_username = $username;
    }

    public function getUsername() {
        return $this->_username;
    }

    public function setPassword($password) {
        $this->_password = $password;
    }

    public function getPassword() {
        return $this->_password;
    }

    public function setDbname($dbname) {
        $this->_dbname = $dbname;
    }

    public function getDbname() {
        return $this->_dbname;
    }

    public function setPdo($pdo) {
        $this->_pdo = $pdo;
    }

    public function getPdo() {
        return $this->_pdo;
    }

    /**
    * connect method
    *
    * @return array
    */
    public function connect()
    {
        try{
            $this->_pdo = new \PDO('mysql:host=' . $this->_host . ';dbname=' . $this->_dbname . ';unix_socket=' . $this->_socket . '', $this->_username, $this->_password);
            $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $this->_pdo;
        }catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }
    }

    /**
    * currentTable method
    *
    *@param string $class string
    *
    * @return array
    */
    public function currentTable($class)
    {
        $pars1 = explode("\\", $class);
        foreach ($pars1 as $value) {
            $pos = strripos($value, "Table");
            if ($pos !== false) {
                $table = str_replace("Table", "", $value);
                $table = strtolower($table);
                $db = $this->connect();
                $re = $db->prepare('show tables');
                $re->execute();
                $tables = $re->fetchAll();
                foreach ($tables[0] as $ta) {
                    if ($table == $ta) {
                        return $ta;
                    } else {
                        return "Error Synthaxe Model";
                    }
                }
            }
        }
    }

    public function findOne($param1, $param2)
    {   
        /**
        * findOne method
        *
        *@param string $param1 string
        *
        *@param array $param2 array
        *
        * @return array
        */
        $table = $this->currentTable(get_class($this));
        if ($table !== "Error Synthaxe Model") {
            $where = " WHERE " . $param1;
            $query = $this->_pdo->prepare('SELECT * FROM ' . $table . $where);
            $query->bindValue(1, $param2[0], \PDO::PARAM_STR);
            $query->execute();
            $res = $query->fetch();
            return $res;
        } else {
            return $table;
        }       
    }

    public function findAll()
    {
        /**
        * findAll method
        *
        * @return array
        */
        $table = $this->currentTable(get_class($this));
        if ($table !== "Error Synthaxe Model") {
            $query = $this->_pdo->prepare('SELECT * FROM ' . $table);
            $query->execute();
            $res = $query->fetchAll();
            return $res;
        } else {
            return $table;
        }
    }
}
?>