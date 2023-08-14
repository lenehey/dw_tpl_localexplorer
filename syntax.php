<?php
/**
 * DokuWiki Plugin localexplorer (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Leonard Heyman <lenehey@gmail.com>
 */
class syntax_plugin_localexplorer extends \dokuwiki\Extension\SyntaxPlugin
{
    /** @inheritDoc */
    public function getType()
    {
        return 'substition';
    }

    /** @inheritDoc */
    public function getPType()
    {
        return 'normal';
    }

    /** @inheritDoc */
    public function getSort()
    {
        return 299; // Adjust the sorting value as needed
    }

    /** @inheritDoc */
    public function connectTo($mode)
    {
        $this->Lexer->addSpecialPattern('\[\[localexplorer>[^|\]]+\|[^]]+\]\]', $mode, 'plugin_localexplorer');
    }

    /** @inheritDoc */
    public function handle($match, $state, $pos, Doku_Handler $handler)
    {
        // Extract path and title from the match
        preg_match('/\[\[localexplorer>([^|]+)\|([^]]+)\]\]/i', $match, $matches);
        $path = str_replace('"', '', $matches[1]);
        $title = $matches[2];

        // Construct the HTML link
        $html = '<a href="localexplorer:' . str_replace('\\', '/', $path) . '">' . $title . '</a>';

        return $html;
    }

    /** @inheritDoc */
    public function render($mode, Doku_Renderer $renderer, $data)
    {
        if ($mode === 'xhtml') {
            $renderer->doc .= $data;
            return true;
        }
        return false;
    }
}
