
<?php 

class Session {
    // class variables.
    var $socket, $info, $buffer, $bpos, $bsize;
     function __construct() {
        // Leer fichero config BD
        $config = parse_ini_file("BDsetup.ini");
        $host = $config['host'];
        $port = intval($config['puerto']);
        $user = $config['usuario'];
        $pw = $config['clave'];

        //echo $host. $port. $user. $pw;
        //echo "boooff";
        
        // create server connection
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if(!socket_connect($this->socket, $host, $port)) {
            throw new Exception("Can't communicate with server.");
        }
        // receive timestamp
        $ts = $this->readString();
        // Hash container
        if (false !== strpos($ts, ':')) {
            // digest-auth
            $challenge = explode(':', $ts, 2);
            $md5 = hash("md5", hash("md5", $user . ':' . $challenge[0] . ':' . $pw) . $challenge[1]);
        } else {
            // Legacy: cram-md5
            $md5 = hash("md5", hash("md5", $pw) . $ts);
        }
        // send username and hashed password/timestamp
        socket_write($this->socket, $user . chr(0) . $md5 . chr(0));
        // receives success flag
        if(socket_read($this->socket, 1) != chr(0)) {
            throw new Exception("Access denied.");
        }
    }
    public function execute($com) {
        // send command to server
        socket_write($this->socket, $com.chr(0));
        // receive result
        $result = $this->receive();
        $this->info = $this->readString();
        if($this->ok() != True) {
            throw new Exception($this->info);
        }
        return $result;
    }
    public function query($q) {
        return new Query($this, $q);
    }
    public function create($name, $input) {
        $this->sendCmd(8, $name, $input);
    }
    public function add($path, $input) {
        $this->sendCmd(9, $path, $input);
    }
    public function replace($path, $input) {
        $this->sendCmd(12, $path, $input);
    }
    public function store($path, $input) {
        $this->sendCmd(13, $path, $input);
    }
    public function info() {
        return $this->info;
    }
    public function close() {
        socket_write($this->socket, "exit".chr(0));
        socket_close($this->socket);
    }
    private function init() {
        $this->bpos = 0;
        $this->bsize = 0;
    }
    public function readString() {
        $com = "";
        while(($d = $this->read()) != chr(0)) {
            $com .= $d;
        }
        return $com;
    }
    private function read() {
        if($this->bpos == $this->bsize) {
            $this->bsize = socket_recv($this->socket, $this->buffer, 4096, 0);
            $this->bpos = 0;
        }
        return $this->buffer[$this->bpos++];
    }
    private function sendCmd($code, $arg, $input) {
        socket_write($this->socket, chr($code).$arg.chr(0).$input.chr(0));
        $this->info = $this->receive();
        if($this->ok() != True) {
            throw new Exception($this->info);
        }
    }
    public function send($str) {
        socket_write($this->socket, $str.chr(0));
    }
    public function ok() {
        return $this->read() == chr(0);
    }
    public function receive() {
        $this->init();
        return $this->readString();
    }
}

// create session
$session = new Session();        
// open database
$session->execute("open criptomonedas");
// query
$xmlStr = $session->execute("xquery /");
// close session
$session->close();
         
$xml = new DOMDocument;           
$xml->loadXML($xmlStr); // Crea el objeto a partir del xml en string

$xsl = new DOMDocument;

$xsl->load('precios.xsl');

$proc = new XSLTProcessor;

$proc->importStyleSheet($xsl);

echo $proc->transformToXML($xml);
?>