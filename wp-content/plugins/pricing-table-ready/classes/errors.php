<?php
class errorsPrt {
    const FATAL = 'fatal';
    const MOD_INSTALL = 'mod_install';
    static private $errors = array();
    static private $haveErrors = false;
    
    static public $current = array();
    static public $displayed = false;
    
    static public function push($error, $type = 'common') {
        if(!isset(self::$errors[$type]))
            self::$errors[$type] = array();
        if(is_array($error))
            self::$errors[$type] = array_merge(self::$errors[$type], $error);
        else
            self::$errors[$type][] = $error;
        self::$haveErrors = true;
        
        if($type == 'session') 
            self::setSession(self::$errors[$type]);
    }
    static public function setSession($error) {
        $sesErrors = self::getSession();
        if(empty($sesErrors))
            $sesErrors = array();
        if(is_array($error))
            $sesErrors = array_merge($sesErrors, $error);
        else
            $sesErrors[] = $error;
        reqPrt::setVar('sesErrors', $sesErrors, 'session');
    }
    static public function init() {
        $prtErrors = reqPrt::getVar('prtErrors');
        if(!empty($prtErrors)) {
            if(!is_array($prtErrors)) {
                $prtErrors = array( $prtErrors );
            }
            $prtErrors = array_map('htmlspecialchars', array_map('stripslashes', array_map('trim', $prtErrors)));
            if(!empty($prtErrors)) {
                self::$current = $prtErrors;
                add_filter('the_content', array('errorsPrt', 'appendErrorsContent'), 99999);
            }
        }
    }
    static public function appendErrorsContent($content) {
        if(!self::$displayed && !empty(self::$current)) {
            $content = '<div class="toeErrorMsg">'. implode('<br />', self::$current). '</div>'. $content;
            self::$displayed = true;
        }
        return $content;
    }
    static public function getSession() {
        return reqPrt::getVar('sesErrors', 'session');
    }
    static public function clearSession() {
        reqPrt::clearVar('sesErrors', 'session');
    }
    static public function get($type = '') {
        $res = array();
        if(!empty(self::$errors)) {
            if(empty($type)) {
                foreach(self::$errors as $e) {
                    foreach($e as $error) {
                        $res[] = $error;
                    }
                }
            } else 
                $res = self::$errors[$type];
        }
        return $res;
    }
    static public function haveErrors($type = '') {
        if(empty($type))
            return self::$haveErrors;
        else
            return isset(self::$errors[$type]);
    }
    static public function pushCritical($msg) {
        
    }
    static public function displayOnAdmin() {
        $common = self::$errors['common'];
        if(empty($common))
            $common = array();
        $ses = self::getSession();
        if(empty($ses))
            $ses = array();
        self::clearSession();    //Clear current session errors
        $errors = array_merge( $common, $ses );
        if(!empty( $errors )) {
            $str = '';
            foreach($errors as $error) { 
                $str .= '<div class="error">';
                $str .= $error;
                $str .= '</div>';
            }
            echo $str;
        }
    }
}

