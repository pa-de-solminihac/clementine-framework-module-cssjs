<?php
/**
 * cssjsCssjsModel : 
 *
 * @package
 * @version $id$
 * @copyright
 * @author Pierre-Alexis <pa@quai13.com>
 * @license
 */
class cssjsCssjsModel extends cssjsCssjsModel_Parent
{

    /**
     * __construct : initialisation du tableau qui stocke les css, js et scripts head et footer
     * 
     * @access public
     * @return void
     */
    public function __construct ()
    {
        $types = array ('css', 'js', 'heads', 'foots');
        foreach ($types as $type) {
            if (!isset(Clementine::$register['cssjs'][$type])) {
                Clementine::$register['cssjs'][$type] = array();
            }
        }
    }

    /**
     * get_css : recupere les CSS
     * 
     * @param mixed $key
     * @access public
     * @return void
     */
    public function get_css ($key = null)
    {
        return $this->get('css', $key);
    }

    /**
     * get_js : recupere les JS
     * 
     * @param mixed $key
     * @access public
     * @return void
     */
    public function get_js ($key = null)
    {
        return $this->get('js', $key);
    }

    /**
     * get_heads : recupere les heads (scripts du block cssjs/head)
     * 
     * @param mixed $key
     * @access public
     * @return void
     */
    public function get_heads ($key = null)
    {
        return $this->get('heads', $key);
    }

    /**
     * get_foots : recupere les foots (scripts du block cssjs/foot)
     * 
     * @param mixed $key
     * @access public
     * @return void
     */
    public function get_foots ($key = null)
    {
        return $this->get('foots', $key);
    }

    /**
     * is_registered_css : verifie si la CSS $key est déjà enregistrée
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function is_registered_css ($key)
    {
        return isset(Clementine::$register['cssjs']['css'][$key]);
    }

    /**
     * is_registered_js : verifie si le JS $key est déjà enregistré
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function is_registered_js ($key)
    {
        return isset(Clementine::$register['cssjs']['js'][$key]);
    }

    /**
     * is_registered_head : verifie si le script $key est déjà enregistré
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function is_registered_head ($key)
    {
        return isset(Clementine::$register['cssjs']['heads'][$key]);
    }

    /**
     * is_registered_foot : verifie si le script $key est déjà enregistré
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function is_registered_foot ($key)
    {
        return isset(Clementine::$register['cssjs']['foots'][$key]);
    }

    /**
     * register_css : enregistre la CSS $key
     * 
     * @param mixed $key 
     * @param mixed $src 
     * @access public
     * @return void
     */
    public function register_css ($key, $src)
    {
        return $this->register('css', $key, $src);
    }

    /**
     * register_js : enregistre le JS $key
     * 
     * @param mixed $key 
     * @param mixed $src 
     * @access public
     * @return void
     */
    public function register_js ($key, $src)
    {
        return $this->register('js', $key, $src);
    }

    /**
     * register_head : enregistre le head $key
     * 
     * @param mixed $key 
     * @param mixed $src 
     * @access public
     * @return void
     */
    public function register_head ($key, $src)
    {
        return $this->register('heads', $key, $src);
    }

    /**
     * register_foot : enregistre le foot $key
     * 
     * @param mixed $key 
     * @param mixed $src 
     * @access public
     * @return void
     */
    public function register_foot ($key, $src)
    {
        return $this->register('foots', $key, $src);
    }

    /**
     * unregister_css : supprime la CSS $key du head
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function unregister_css ($key)
    {
        return $this->unregister('css', $key);
    }

    /**
     * unregister_js : supprime le JS $key du head
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function unregister_js ($key)
    {
        return $this->unregister('js', $key);
    }

    /**
     * unregister_head : supprime le head $key du head
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function unregister_head ($key)
    {
        return $this->unregister('heads', $key);
    }

    /**
     * unregister_foot : supprime le foot $key du head
     * 
     * @param mixed $key 
     * @access public
     * @return void
     */
    public function unregister_foot ($key)
    {
        return $this->unregister('foots', $key);
    }

    /**
     * get : 
     * 
     * @param mixed $type : js ou css
     * @param mixed $key 
     * @access protected
     * @return void
     */
    protected function get ($type, $key = null)
    {
        if ($type != 'css' && $type != 'js' && $type != 'heads' && $type != 'foots') {
            return false;
        }
        $is_registered_type = 'is_registered_' . $type;
        if ($key) {
            if ($is_registered_type($key)) {
                return Clementine::$register['cssjs'][$type][$key];
            } else {
                return false;
            }
        } else {
            return Clementine::$register['cssjs'][$type];
        }
    }

    /**
     * register 
     * 
     * @param mixed $type : js ou css
     * @param mixed $key : index du tableau associatif dans lequel on enregistre la CSS ou le JS
     * @param mixed $src : string, ou tableau contenant les attributs src, media, etc... du JS ou de la CSS
     * @access protected
     * @return void
     */
    protected function register ($type, $key, $src)
    {
        if ($type != 'css' && $type != 'js' && $type != 'heads' && $type != 'foots') {
            return false;
        }
        // on n'enregistre la CSS que si elle n'est pas deja enregistree, et si on a fourni une cle acceptable (c'est a dire un string) pour le tableau associatif Clementine::$register['cssjs'][$type]
        if (((string) $key) !== ((string) ((int) $key))) {
            if (!isset(Clementine::$register['cssjs'][$type][$key])) {
                Clementine::$register['cssjs'][$type][$key] = $src;
            }
        } else {
            return false;
        }
    }

    /**
     * unregister : supprime la CSS ou le JS du head
     * 
     * @param mixed $type 
     * @param mixed $key 
     * @access protected
     * @return void
     */
    protected function unregister ($type, $key)
    {
        if ($type != 'css' && $type != 'js' && $type != 'heads' && $type != 'foots') {
            return false;
        }
        unset(Clementine::$register['cssjs'][$type][$key]);
    }

}
?>
