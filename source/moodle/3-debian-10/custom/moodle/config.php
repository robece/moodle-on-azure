<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'moodledb02.mysql.database.azure.com';
$CFG->dbname    = 'moodle';
$CFG->dbuser    = 'moodleuser';
$CFG->dbpass    = 'Password.123';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => 3306,
  'dbsocket' => '',
  'dbcollation' => 'utf8mb4_unicode_ci',
);

if (empty($_SERVER['HTTP_HOST'])) {
  $_SERVER['HTTP_HOST'] = '127.0.0.1:8080';
}
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
  $CFG->wwwroot   = 'https://' . $_SERVER['HTTP_HOST'];
} else {
  $CFG->wwwroot   = 'http://' . $_SERVER['HTTP_HOST'];
}
$CFG->dataroot  = '/bitnami/moodledata';
$CFG->admin     = 'admin';

#$CFG->directorypermissions = 02775;

$CFG->directorypermissions = 0777;
$CFG->emailconnectionerrorsto = 'admin@moodle.com';
$CFG->tempdir = '/bitnami/moodledata/temp'; // Directory MUST BE SHARED by all cluster nodes.
$CFG->cachedir = '/bitnami/moodledata/cache'; // Directory MUST BE SHARED by all cluster nodes, locking required.
$CFG->localcachedir = '/tmp'; // Intended for local node caching.
$CFG->preventfilelocking = true;
$CFG->lock_factory = "\core\lock\db_record_lock_factory";

$CFG->session_handler_class = '\core\session\redis';
$CFG->session_redis_host = 'redis-master.redis.svc';
$CFG->session_redis_port = 6379;  // Optional.
$CFG->session_redis_database = 0;  // Optional, default is db 0.
$CFG->session_redis_prefix = 'moodle_session_'; // Optional, default is don't set one.
$CFG->session_redis_acquire_lock_timeout = 120;
$CFG->session_redis_lock_expire = 7200;
$CFG->session_redis_serializer_use_igbinary = true; // Optional, default is PHP builtin serializer.

define('CONTEXT_CACHE_MAX_SIZE', 7500);

require_once(__DIR__ . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
