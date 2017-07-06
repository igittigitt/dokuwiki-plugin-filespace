<?php
/**
 * DokuWiki Plugin filespace (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Oliver Geisen <oliver@rehkopf-geisen.de>
 */

// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

class action_plugin_filespace extends DokuWiki_Action_Plugin {

    /**
     * Registers a callback function for a given event
     *
     * @param Doku_Event_Handler $controller DokuWiki's event controller object
     * @return void
     */
    public function register(Doku_Event_Handler $controller) {
       $controller->register_hook('IO_NAMESPACE_CREATED', 'AFTER', $this, 'handle_io_namespace_created');
       $controller->register_hook('IO_NAMESPACE_DELETED', 'AFTER', $this, 'handle_io_namespace_deleted');
       $controller->register_hook('IO_WIKIPAGE_WRITE', 'BEFORE', $this, 'handle_io_wikipage_write');
    }

    /**
     * [Custom event handler which performs action]
     *
     * @param Doku_Event $event  event object by reference
     * @param mixed      $param  [the parameters passed as fifth argument to register_hook() when this
     *                           handler was registered]
     * @return void
     */

    public function handle_io_namespace_created(Doku_Event &$event, $param) {
		global $conf;
		if ($data[1] != 'pages') return;
		$ns = $data[0];
		$t_dirname = "";
		if ($conf['useheading']) {
			$t_dirname = p_get_first_heading($ns + $conf['start']);
		} else {
			$t_dirname = curNS($ns);
		}
		dbg("Erstelle Ordner: ".$t_dirname);
    }

    public function handle_io_namespace_deleted(Doku_Event &$event, $param) {
		global $conf;
    }

    public function handle_io_wikipage_write(Doku_Event &$event, $param) {
		global $conf;
    }

}

// vim:ts=4:sw=4:et:
