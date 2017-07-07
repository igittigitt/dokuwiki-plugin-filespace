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
       $controller->register_hook('IO_WIKIPAGE_WRITE', 'BEFORE', $this, 'handle_io_wikipage_write');
    }

    /**
     * IO_WIKIPAGE_WRITE/BEFORE
     *
     * @param Doku_Event $event  event object by reference
     * @param mixed      $param  [the parameters passed as fifth argument to register_hook() when this
     *                           handler was registered]
     * @return void
     */
    public function handle_io_wikipage_write(Doku_Event &$event, $param)
    {
        global $conf;
        global $INFO;

if ($INFO['namespace'] != 'home:ogeisen:new_namespace_test_for_plugin') return;

        $page = $event->data[2];
        $ns = $event->data[1];
        $is_attic = $event->data[3];

        if ($is_attic) return;  // don't handle archived pages
        if ($page != $conf['start']) return;  // only handle namespace pages
        if ($ns == '') return;  // void wiki startpage

        if ( ! $INFO['exists']) {
            $new_title = '';
            if (preg_match('/^==+(.+?)==+/', $event->data[0][1], $match)) {
                $new_title = trim($match[1]);
            }
msg("New namespace page created. Try to create filesystem dir '$new_title' too.");
            #_page_created();
        }
        elseif ($event->data[0][1] == '') {
            $id = $ns . ':' . $page;
            $old_title = p_get_first_heading($id);
msg("Namespace page deleted. Try to delete filesystem dir '$old_title' too.");
        }
        else {
msg("Namespace page edited. Check if Title has changed");
            $id = $ns . ':' . $page;
            $old_title = p_get_first_heading($id);
msg("old_title: $old_title");

            $new_title = '';
            if (preg_match('/^==+(.+?)==+/', $event->data[0][1], $match)) {
                $new_title = trim($match[1]);
            }
msg("new_title: $new_title");

            if ($new_title != $old_title) {
msg("Namespace page title has changed from '$old_title' -> '$new_title'. Try to change filesystem dir too.");
            } else {
msg("NO FILESPACE ACTION REQUIRED :-)");
            }
        }


#msg("<pre>\$INFO:\n".print_r($INFO,true)."</pre>");
// if there is no previous version of the current page, it must be the initial one
// if the 
        
/*
        $exist = $INFO['exists'];

            if (( ! $rev) && ( ! $exist) && ($name == $conf['start'])) {
                msg("NAMESPACE STARTPAGE CREATED");
            }
            elseif (
            #msg("<pre>IO_WIKIPAGE_WRITE\n".print_r($event,true).print_r($INFO,true)."</pre>",0);
msg("Namespace: $ns");
    msg("<pre>IO_NAMESPACE_DELETED\n".print_r($event,true)."</pre>",0);
        $t_dirname = "";
        if ($conf['useheading']) {
            $t_dirname = p_get_first_heading($ns . $conf['start']);
        } else {
            $t_dirname = curNS($ns);
        }
msg("Erstelle Ordner: ".$t_dirname);
msg("Erstelle Ordner: ".curNS($ns));
*/
     }

}

// vim:ts=4:sw=4:et:
